<?php

namespace App\Http\Controllers\Admin\Sponsors;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function sponsor()
    {
        $sponsors=Sponsors::query()->get();
        return view('Admin/pages/sponsors/index',compact('sponsors'));
    }

    public function showSponsorCreate()
    {
        return view('Admin/pages/sponsors/create');
    }
    public function sponsorCreate(Request $request)
    {
        $request->validate([
            'itemImg' => 'required'
        ]);

        $sponsor = new Sponsors();
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("sponsors", $request->file('itemImg'));
            $sponsor->image = $imagePath;
        }
        $sponsor->status = $request->input('status');
        $sponsor->save();
        return redirect()->route('admin.sponsor');
    }

    public function sponsorDelete($id)
    {
        $sponsor = Sponsors::find($id);

        if ($sponsor) {
            Storage::delete($sponsor->image);
            $sponsor->delete();

            return redirect()->route('admin.sponsor')->with('success', 'Sponsor successfully deleted.');
        } else {
            return redirect()->route('admin.sponsor')->with('error', 'Sponsor not found.');
        }
    }
    public function sponsorEditView($id)
    {
        $sponsor=Sponsors::findOrFail($id);
        return view('Admin/pages/sponsors/edit',compact('sponsor'));
    }
    public function sponsorUpdate(Request $request ,$id)
    {
        $request->validate([
            'itemImg' => 'nullable|image'
        ]);

        $sponsor = Sponsors::findOrFail($id);
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("sliders", $request->file('itemImg'));
            if ($sponsor->image && Storage::exists($sponsor->image)) {
                Storage::delete("$imagePath");
            }else{
                Storage::delete("$imagePath");
            }
            $sponsor->image = $imagePath;
        }
        $sponsor->status = $request->input('status');
        $sponsor->save();
        return redirect()->route('admin.sponsor');
    }
}
