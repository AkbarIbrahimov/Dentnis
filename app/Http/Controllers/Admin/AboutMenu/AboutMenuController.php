<?php

namespace App\Http\Controllers\Admin\AboutMenu;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutMenuTranslation;
use App\Models\Language;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutMenuController extends Controller
{
    public function aboutMenu()
    {
        $aboutMenu = AboutMenu::query()->get();
        return view('Admin/pages/about_menu/index', compact('aboutMenu'));
    }

    public function showAboutMenuCreate()
    {
        return view('Admin/pages/about_menu/create');
    }

    public function aboutMenuCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            'Slug' => 'required|string',
        ]);

        $defaultTitle = $request->input("$defaultLanguage.title");
        $aboutMenu = new AboutMenu();
        $aboutMenu->slug = $request->input('Slug');
        $aboutMenu->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        AboutMenuTranslation::create([
            'about_menu_id' => $aboutMenu->id,
            'language_id' => $defaultLangId,
            'title' => $defaultTitle,
        ]);

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");
                if (!empty($title)) {
                    $request->validate([
                        "$lang.title" => 'string|max:255',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    AboutMenuTranslation::create([
                        'about_menu_id' => $aboutMenu->id,
                        'language_id' => $langId,
                        'title' => $title,
                    ]);
                }
            }
        }

        return redirect()->route('admin.aboutMenu')->with('success', 'AboutMenu created successfully');
    }

    public function aboutMenuEditView($id)
    {
        $aboutMenu = AboutMenu::findOrFail($id);
        return view('Admin.pages.about_menu.edit', compact('aboutMenu'));
    }
    public function aboutMenuUpdate(Request $request, $id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.title" => 'required|string|max:255',
            'slug' => 'required|string',
        ]);

        $aboutMenu = AboutMenu::findOrFail($id);

        $aboutMenu->slug = $request->input('slug');
        $aboutMenu->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $title = $request->input("$defaultLanguage.title");
        $aboutMenuTranslation = AboutMenuTranslation::updateOrCreate(
            ['about_menu_id' => $aboutMenu->id, 'language_id' => $defaultLangId],
            ['title' => $title]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $title = $request->input("$lang.title");

                if (!empty($title)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    AboutMenuTranslation::updateOrCreate(
                        ['about_menu_id' => $aboutMenu->id, 'language_id' => $langId],
                        ['title' => $title]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    AboutMenuTranslation::where('about_menu_id', $aboutMenu->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.aboutMenu')->with('success', 'AboutMenu updated successfully');


    }

    public function aboutMenuDelete($id)
    {
        $aboutMenuTranslations = AboutMenuTranslation::where('about_menu_id', $id)->get();
        $aboutMenu = AboutMenu::find($id);

        if ($aboutMenu && $aboutMenuTranslations) {
            foreach ($aboutMenuTranslations as $translation) {
                $translation->delete();
            }
            $aboutMenu->delete();

            return redirect()->route('admin.aboutMenu')->with('success', 'AboutMenu successfully deleted.');
        } else {
            return redirect()->route('admin.aboutMenu')->with('error', 'AboutMenu not found.');
        }
    }

}
