<?php

namespace App\Http\Controllers\Admin\DoctorImage;

use App\Http\Controllers\Controller;
use App\Models\DoctorImage;
use App\Models\TvProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorImageController extends Controller
{
    public function doctorImage()
    {
        $doctorImages = DoctorImage::query()->get();
        return view('Admin/pages/doctor-image/index', compact('doctorImages'));
    }

    public function showDoctorImageCreate()
    {
        return view('Admin/pages/doctor-image/create');
    }

    public function DoctorImageCreate(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $doctorImage = new DoctorImage();
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->putFile("doctor-image", $request->file('image'));
            $doctorImage->image = $imagePath;
        }
        $doctorImage->save();
        return redirect()->route('admin.doctorImage');
    }

    public function doctorImageEditView($id)
    {
        $doctorImage = DoctorImage::findOrFail($id);
        return view('Admin/pages/doctor-image/edit', compact('doctorImage'));
    }

    public function doctorImageUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
        ]);

        $doctorImage = DoctorImage::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($doctorImage->image) {
                Storage::disk('public')->delete($doctorImage->image);
            }
            $imagePath = Storage::disk('public')->putFile("doctor-image", $request->file('image'));
            $doctorImage->image = $imagePath;
        }
        $doctorImage->save();
        return redirect()->route('admin.doctorImage');
    }

    public function DoctorImageDelete($id)
    {
        $doctorImage = DoctorImage::findOrFail($id);

        if ($doctorImage) {
            $doctorImage->delete();
            return redirect()->route('admin.doctorImage')->with('success', 'DoctorImage successfully deleted.');
        } else {
            return redirect()->route('admin.doctorImage')->with('error', 'DoctorImage not found.');
        }
    }
}
