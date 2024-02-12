<?php

namespace App\Http\Controllers\Admin\TvPrograms;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Slider;
use App\Models\TvProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TvProgramsController extends Controller
{
    public function tvPrograms()
    {
        $tvPrograms=TvProgram::query()->get();
        return view('Admin/pages/tv-programs/index', compact('tvPrograms'));
    }

    public function showTvProgramCreate()
    {
        return view('Admin/pages/tv-programs/create');
    }

    public function TvProgramsCreate(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        $tvProgram = new TvProgram();
        $tvProgram->title = $request->input('title');
        $tvProgram->url = $request->input('url');
        $tvProgram->status = $request->input('status');
        $tvProgram->save();
        return redirect()->route('admin.tvPrograms');
    }

    public function tvProgramEditView($id)
    {
        $tvProgram=TvProgram::findOrFail($id);
        return view('Admin/pages/tv-programs/edit',compact('tvProgram'));
    }

    public function tvProgramUpdate(Request $request ,$id)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        $tvProgram = TvProgram::findOrFail($id);
        $tvProgram->title = $request->input('title');
        $tvProgram->url = $request->input('url');
        $tvProgram->status = $request->input('status');
        $tvProgram->save();
        return redirect()->route('admin.tvPrograms');
    }

    public function tvProgramDelete($id)
    {
        $tvProgram = TvProgram::find($id);

        if ($tvProgram) {
            $tvProgram->delete();

            return redirect()->route('admin.tvPrograms')->with('success', 'TvProgram successfully deleted.');
        } else {
            return redirect()->route('admin.tvPrograms')->with('error', 'TvProgram not found.');
        }
    }
}
