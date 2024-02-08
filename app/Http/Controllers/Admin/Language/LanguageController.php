<?php

namespace App\Http\Controllers\Admin\Language;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LanguageController extends Controller
{

    public function language()
    {
        $languages = Language::query()->get();
        return view('Admin.pages.language.index', compact('languages'));
    }

    public function showLanguageCreate()
    {
        return view('Admin.pages.language.create');
    }

    public function languageCreate(Request $request)
    {
        $language=new Language();
        $language->lang=$request->input('lang');
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("languages", $request->file('itemImg'));
            $language->image = $imagePath;
        }
        $language->save();
        return redirect()->route('admin.language');
    }

    public function languageDelete($id)
    {
        $language=Language::find($id);
        if ($language){
            $language->delete();
            return redirect()->route('admin.language');
        }else{
            return redirect()->route('admin.language');
        }
    }

    public function languageEditView($id)
    {
        $languages=Language::findOrFail($id);
        return view('Admin.pages.language.edit', compact('languages'));
    }

    public function languageUpdate(Request $request, $id)
    {
        $language=Language::findOrFail($id);
        $language->lang=$request->input('lang');
        if ($request->hasFile('itemImg')) {
            if ($language->image) {
                Storage::delete($language->image);
            }
            $imagePath = Storage::disk('public')->putFile("languages", $request->file('itemImg'));
            $language->image = $imagePath;
        }
        $language->save();
        return redirect()->route('admin.language');
    }
}
