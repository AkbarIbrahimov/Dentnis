<?php

namespace App\Http\Controllers\Admin\Sliders;

use App\Http\Controllers\Controller;
use App\Models\Quotes;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function sliders()
    {
        $sliders = Slider::query()->get();
        return view('Admin/pages/sliders/index', compact('sliders'));
    }

    public function showSliderCreate()
    {
        return view('Admin/pages/sliders/create');
    }

    public function sliderCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'itemImg' => 'required'
        ]);

        $slider = new Slider();
        $slider->name = $request->input('name');
        $slider->url = $request->input('url');
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("sliders", $request->file('itemImg'));
            $slider->image = $imagePath;
        }
        $slider->status = $request->input('status');
        $slider->save();
        return redirect()->route('admin.slider');
    }

    public function sliderDelete($id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            Storage::delete($slider->image);
            $slider->delete();

            return redirect()->route('admin.slider')->with('success', 'Slider successfully deleted.');
        } else {
            return redirect()->route('admin.slider')->with('error', 'Slider not found.');
        }
    }

    public function sliderEditView($id)
    {
        $sliders=Slider::findOrFail($id);
        return view('Admin/pages/sliders/edit',compact('sliders'));
    }

    public function sliderUpdate(Request $request ,$id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'itemImg' => 'nullable|image'
        ]);

        $slider = Slider::findOrFail($id);
        $slider->name = $request->input('name');
        $slider->url = $request->input('url');
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("sliders", $request->file('itemImg'));
            if ($slider->image && Storage::exists($slider->image)) {
                Storage::delete("$imagePath");
            }else{
                Storage::delete("$imagePath");
            }
            $slider->image = $imagePath;
        }
        $slider->status = $request->input('status');
        $slider->save();
        return redirect()->route('admin.slider');
    }
}
