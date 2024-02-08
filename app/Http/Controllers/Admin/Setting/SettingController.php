<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function setting()
    {
        $settings = Setting::query()->get();
        return view('Admin/pages/setting/index', compact('settings'));
    }

    public function showSettingCreate()
    {
        return view('Admin/pages/setting/create');
    }

    public function settingCreate(Request $request)
    {
        $request->validate([
            'topLogo' => 'required|image',
            'bottomLogo' => 'required|image',
            'address' => 'required',
            'mail' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $setting = new Setting();
        if ($request->hasFile('topLogo')) {
            $imagePath1 = Storage::disk('public')->putFileAs(
                "settings/topImage",
                $request->file('topLogo'),
                $request->file('topLogo')->getClientOriginalName()
            );
            $setting->top_logo = $imagePath1;
        }
        if ($request->hasFile('bottomLogo')) {
            $imagePath2 = Storage::disk('public')->putFileAs(
                "settings/bottomImage",
                $request->file('bottomLogo'),
                $request->file('bottomLogo')->getClientOriginalName()
            );
            $setting->bottom_logo = $imagePath2;
        }
        $setting->address = $request->input('address');
        $setting->mail = $request->input('mail');
        $setting->phone = $request->input('phone');
        $setting->save();
        return redirect()->route('admin.setting');
    }

    public function settingEditView($id)
    {
        $setting = Setting::findOrFail($id);
        return view('Admin/pages/setting/edit', compact('setting'));
    }

    public function settingUpdate(Request $request, $id)
    {
        $request->validate([
            'topLogo' => 'nullable|image',
            'bottomLogo' => 'nullable|image',
            'address' => 'required',
            'mail' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $setting = Setting::findOrFail($id);

        if ($request->hasFile('topLogo')) {
            if ($setting->top_logo) {
                Storage::disk('public')->delete($setting->top_logo);
            }

            $imagePath1 = Storage::disk('public')->putFileAs(
                "settings/topImage",
                $request->file('topLogo'),
                $request->file('topLogo')->getClientOriginalName()
            );
            $setting->top_logo = $imagePath1;
        }

        if ($request->hasFile('bottomLogo')) {
            if ($setting->bottom_logo) {
                Storage::disk('public')->delete($setting->bottom_logo);
            }

            $imagePath2 = Storage::disk('public')->putFileAs(
                "settings/bottomImage",
                $request->file('bottomLogo'),
                $request->file('bottomLogo')->getClientOriginalName()
            );
            $setting->bottom_logo = $imagePath2;
        }
        $setting->address = $request->input('address');
        $setting->mail = $request->input('mail');
        $setting->phone = $request->input('phone');
        $setting->save();

        return redirect()->route('admin.setting');
    }

    public function settingDelete($id)
    {
        $setting = Setting::findOrFail($id);

        if ($setting) {
            if ($setting->top_logo) {
                Storage::disk('public')->delete($setting->top_logo);
            }
            if ($setting->bottom_logo) {
                Storage::disk('public')->delete($setting->bottom_logo);
            }
            $setting->delete();
            return redirect()->route('admin.setting')->with('success', 'Setting successfully deleted.');
        } else {
            return redirect()->route('admin.setting')->with('error', 'Setting not found.');
        }


    }
}
