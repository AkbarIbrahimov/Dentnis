<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\AboutMenu;
use App\Models\AboutMenuTranslation;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $aboutUs=AboutUs::query()->get();
        return view('Admin/pages/about-us/index', compact('aboutUs'));
    }
    public function showAboutUsCreate()
    {
        return view('Admin/pages/about-us/create');
    }

    public function aboutUsCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.description" => 'required|string|',
        ]);
        $defaultDescription = $request->input("$defaultLanguage.description");
        $aboutUs = new AboutUs();
        $aboutUs->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        AboutUsTranslation::create([
            'about_us_id' => $aboutUs->id,
            'language_id' => $defaultLangId,
            'description' => $defaultDescription,
        ]);

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $description = $request->input("$lang.description");
                if (!empty($description)) {
                    $request->validate([
                        "$lang.description" => 'string|max:255',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    AboutUsTranslation::create([
                        'about_us_id' => $aboutUs->id,
                        'language_id' => $langId,
                        'description' => $description,
                    ]);
                }
            }
        }

        return redirect()->route('admin.aboutUs')->with('success', 'AboutUs created successfully');
    }

    public function aboutUsEditView($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('Admin.pages.about-us.edit', compact('aboutUs'));
    }

    public function aboutUsUpdate(Request $request, $id)
    {

        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.description" => 'required|string|max:255',
        ]);

        $aboutUs = AboutUs::findOrFail($id);

        $aboutUs->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $description = $request->input("$defaultLanguage.description");
        $aboutUsTranslation = AboutUsTranslation::updateOrCreate(
            ['about_us_id' => $aboutUs->id, 'language_id' => $defaultLangId],
            ['description' => $description]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $description = $request->input("$lang.description");

                if (!empty($description)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    AboutUsTranslation::updateOrCreate(
                        ['about_us_id' => $aboutUs->id, 'language_id' => $langId],
                        ['description' => $description]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    AboutUsTranslation::where('about_us_id', $aboutUs->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.aboutUs')->with('success', 'AboutUs updated successfully');
    }

    public function aboutUsDelete($id)
    {
        $aboutUsTranslations = AboutUsTranslation::where('about_us_id', $id)->get();
        $aboutUs = AboutUs::find($id);

        if ($aboutUs && $aboutUsTranslations) {
            foreach ($aboutUsTranslations as $translation) {
                $translation->delete();
            }
            $aboutUs->delete();

            return redirect()->route('admin.aboutUs')->with('success', 'AboutUs successfully deleted.');
        } else {
            return redirect()->route('admin.aboutUs')->with('error', 'AboutUs not found.');
        }
    }
}
