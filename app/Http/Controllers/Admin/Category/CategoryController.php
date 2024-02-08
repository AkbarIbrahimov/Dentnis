<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function category()
    {
        $categories = Category::with('translations', 'languages')->get();
        $languages = Language::query()->get();
        return view('Admin.pages.category.index', compact('categories', 'languages'));
    }

    public function showCategoryCreate()
    {
        return view('Admin.pages.category.create');
    }

    public function categoryCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.name" => 'required|string|max:255',
            "$defaultLanguage.slug" => 'required|string',
        ]);
        $defaultName = $request->input("$defaultLanguage.name");
        $category=new Category();
        $category->save();
        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        CategoryTranslation::create([
            'category_id'=>$category->id,
            'slug' => $request->input('slug'),
            'language_id' => $defaultLangId,
            'name' => $defaultName,
        ]);
        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $name = $request->input("$lang.name");
                if (!empty($name)) {
                    $request->validate([
                        "$lang.name" => 'string|max:255',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    CategoryTranslation::create([
                        'category_id'=>$category->id,
                        'slug' => $request->input('slug'),
                        'language_id' => $langId,
                        'name' => $name,
                    ]);
                }
            }
        }
        return redirect()->route('admin.category');
    }

    public function categoryDelete($id)
    {
        $categoryTranslations = CategoryTranslation::where('category_id', $id)->get();
        $category = Category::find($id);

        if ($category && $categoryTranslations) {
            foreach ($categoryTranslations as $translation) {
                $translation->delete();
            }
            $category->delete();

            return redirect()->route('admin.category')->with('success', 'Category successfully deleted.');
        } else {
            return redirect()->route('admin.category')->with('error', 'Category not found.');
        }
    }

    public function categoryEditView($id)
    {
        $categories=Category::findOrFail($id);
        return view('Admin.pages.category.edit', compact('categories'));
    }
    public function categoryUpdate(Request $request, $id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.name" => 'required|string|max:255',
            "$defaultLanguage.slug" => 'required|string',
        ]);

        $category = Category::findOrFail($id);
        $category->save();
        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $name = $request->input("$defaultLanguage.name");
        $slug = $request->input("$defaultLanguage.slug");
        $categoryTranslation = CategoryTranslation::updateOrCreate(
            ['category_id' => $category->id, 'language_id' => $defaultLangId],
            ['name' => $name, 'slug' => $slug]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $name = $request->input("$lang.name");
                $slug = $request->input("$lang.slug");

                if (!empty($name) || !empty($slug)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    CategoryTranslation::updateOrCreate(
                        ['category_id' => $category->id, 'language_id' => $langId],
                        ['name' => $name, 'slug' => $slug]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    CategoryTranslation::where('category_id', $category->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }
}
