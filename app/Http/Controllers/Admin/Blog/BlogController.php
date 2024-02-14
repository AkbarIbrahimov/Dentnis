<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Blog main page
    public function blog()
    {
        $blogs = Blog::with('translations', 'languages')->get();
        return view('Admin.pages.blog.index', compact('blogs'));
    }

    // Blog delete
    public function blogDelete($id)
    {
        $blogTranslations = BlogTranslation::where('blog_id', $id)->get();
        $blog = Blog::find($id);

        if ($blog && $blogTranslations) {
            Storage::delete($blog->image);
            foreach ($blogTranslations as $translation) {
                $translation->delete();
            }
            $blog->delete();

            return redirect()->route('admin.blog')->with('success', 'Blog successfully deleted.');
        } else {
            return redirect()->route('admin.blog')->with('error', 'Blog not found.');
        }
    }

    // Blog Create page
    public function showBlogCreate(Request $request)
    {
        $categories=Category::query()->with('translations')->get();
        return view('Admin.pages.blog.create',compact('categories'));
    }

    // BLog Create
    public function blogCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            "$defaultLanguage.description" => 'required|string',
            "$defaultLanguage.miniDescription" => 'required|string|max:255',
            'itemImg' => 'required|image',
            'itemSlug' => 'required|string',
        ]);

        $defaultTitle = $request->input("$defaultLanguage.title");
        $defaultDescription = $request->input("$defaultLanguage.description");
        $defaultMiniDescription = $request->input("$defaultLanguage.miniDescription");

        $blog = new Blog();
        $blog->category_id = $request->input('category_id');
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("blogs", $request->file('itemImg'));
            $blog->image = $imagePath;
        }
        $blog->slug = $request->input('itemSlug');
        $blog->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        BlogTranslation::create([
            'blog_id' => $blog->id,
            'language_id' => $defaultLangId,
            'title' => $defaultTitle,
            'description' => $defaultDescription,
            'mini_description' => $defaultMiniDescription,
        ]);

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");
                $description = $request->input("$lang.description");
                $miniDescription = $request->input("$lang.miniDescription");

                if (!empty($title) || !empty($description)) {
                    $request->validate([
                        "$lang.title" => 'string|max:255',
                        "$lang.description" => 'string',
                        "$lang.miniDescription" => 'string|max:255',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    BlogTranslation::create([
                        'blog_id' => $blog->id,
                        'language_id' => $langId,
                        'title' => $title,
                        'description' => $description,
                        'mini_description' => $miniDescription,

                    ]);
                }
            }
        }

        return redirect()->route('admin.blog')->with('success', 'Blog created successfully');
    }

    // Blog Edit page
    public function blogEditView($id)
    {
        $blogs = Blog::findOrFail($id);
        $categories=Category::query()->with('translations')->get();
        return view('Admin.pages.blog.edit', compact('blogs','categories'));
    }

    // Blog Edit
    public function blogUpdate(Request $request, $id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            "$defaultLanguage.description" => 'required|string',
            "$defaultLanguage.miniDescription" => 'required|string|max:255',
            'itemImg' => 'nullable|image',
            'itemSlug' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->category_id = $request->input('category_id');
        if ($request->hasFile('itemImg')) {
            if ($blog->image) {
                Storage::delete($blog->image);
            }
            $imagePath = Storage::disk('public')->putFile("blogs", $request->file('itemImg'));
            $blog->image = $imagePath;
        }

        $blog->slug = $request->input('itemSlug');
        $blog->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $title = $request->input("$defaultLanguage.title");
        $description = $request->input("$defaultLanguage.description");
        $miniDescription = $request->input("$defaultLanguage.miniDescription");
        $blogTranslation = BlogTranslation::updateOrCreate(
            ['blog_id' => $blog->id, 'language_id' => $defaultLangId],
            ['title' => $title, 'description' => $description,'mini_description'=>$miniDescription]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");
                $description = $request->input("$lang.description");
                $miniDescription = $request->input("$lang.miniDescription");

                if (!empty($title) || !empty($description)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    BlogTranslation::updateOrCreate(
                        ['blog_id' => $blog->id, 'language_id' => $langId],
                        ['title' => $title, 'description' => $description,'mini_description'=>$miniDescription]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    BlogTranslation::where('blog_id', $blog->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.blog')->with('success', 'Blog updated successfully');


    }
}
