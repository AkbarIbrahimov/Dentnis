<?php

namespace App\Http\Controllers\Admin\Icon;

use App\Http\Controllers\Controller;
use App\Models\Icon;
use App\Models\TvProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconController extends Controller
{
    public function icon()
    {
        $icons=Icon::query()->get();
        return view('Admin/pages/icon/index', compact('icons'));
    }

    public function showIconCreate()
    {
        return view('Admin/pages/icon/create');
    }

    public function iconCreate(Request $request)
    {

        $request->validate([
            'image' => 'required|image',
            'url' => 'required',
        ]);

        $icon = new Icon();
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->putFile("icons", $request->file('image'));
            $icon->image = $imagePath;
        }
        $icon->url = $request->input('url');
        $icon->status = $request->input('status');
        $icon->save();
        return redirect()->route('admin.icon');
    }

    public function iconEditView($id)
    {
        $icon=Icon::findOrFail($id);
        return view('Admin/pages/icon/edit',compact('icon'));
    }

    public function iconUpdate(Request $request ,$id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'url' => 'required',
        ]);

        $icon = Icon::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($icon->image) {
                Storage::delete($icon->image);
            }
            $imagePath = Storage::disk('public')->putFile("icons", $request->file('image'));
            $icon->image = $imagePath;
        }
        $icon->url = $request->input('url');
        $icon->status = $request->input('status');
        $icon->save();
        return redirect()->route('admin.icon');
    }

    public function iconDelete($id)
    {
        $icon = Icon::find($id);

        if ($icon) {
            $icon->delete();

            return redirect()->route('admin.icon')->with('success', 'Icon successfully deleted.');
        } else {
            return redirect()->route('admin.icon')->with('error', 'Icon not found.');
        }
    }

}
