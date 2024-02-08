<?php

namespace App\Http\Controllers\Admin\HeadDoctor;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\HeadDoctor;
use App\Models\HeadDoctorTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class HeadDoctorController extends Controller
{
    public function headDoctor()
    {
        $headDoctor=HeadDoctor::query()->get();
        return view('Admin/pages/head-doctor/index', compact('headDoctor'));
    }
    public function showHeadDoctorCreate()
    {
        return view('Admin/pages/head-doctor/create');
    }

    public function HeadDoctorCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.description" => 'required|string|',
        ]);
        $defaultDescription = $request->input("$defaultLanguage.description");
        $headDoctor = new HeadDoctor();
        $headDoctor->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        HeadDoctorTranslation::create([
            'head_doctor_id' => $headDoctor->id,
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

                    HeadDoctorTranslation::create([
                        'head_doctor_id' => $headDoctor->id,
                        'language_id' => $langId,
                        'description' => $description,
                    ]);
                }
            }
        }

        return redirect()->route('admin.headDoctor')->with('success', 'HeadDoctor created successfully');
    }

    public function headDoctorEditView($id)
    {
        $headDoctor = HeadDoctor::findOrFail($id);
        return view('Admin.pages.head-doctor.edit', compact('headDoctor'));
    }

    public function headDoctorUpdate(Request $request, $id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.description" => 'required|string|',
        ]);

        $headDoctor = HeadDoctor::findOrFail($id);

        $headDoctor->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $description = $request->input("$defaultLanguage.description");
        $aboutUsTranslation = HeadDoctorTranslation::updateOrCreate(
            ['head_doctor_id' => $headDoctor->id, 'language_id' => $defaultLangId],
            ['description' => $description]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $description = $request->input("$lang.description");

                if (!empty($description)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    HeadDoctorTranslation::updateOrCreate(
                        ['head_doctor_id' => $headDoctor->id, 'language_id' => $langId],
                        ['description' => $description]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    HeadDoctorTranslation::where('head_doctor_id', $headDoctor->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.headDoctor')->with('success', 'HeadDoctor updated successfully');
    }

    public function HeadDoctorDelete($id)
    {
        $headDoctorTranslations = HeadDoctorTranslation::where('head_doctor_id', $id)->get();
        $headDoctor = HeadDoctor::find($id);

        if ($headDoctor && $headDoctorTranslations) {
            foreach ($headDoctorTranslations as $translation) {
                $translation->delete();
            }
            $headDoctor->delete();

            return redirect()->route('admin.headDoctor')->with('success', 'HeadDoctor successfully deleted.');
        } else {
            return redirect()->route('admin.headDoctor')->with('error', 'HeadDoctor not found.');
        }
    }}
