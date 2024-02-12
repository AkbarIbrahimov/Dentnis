<?php

namespace App\Http\Controllers\Admin\Youtube;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Youtubes;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function youtube()
    {
        $youtubes = Youtubes::query()->get();
        return view('Admin.pages.youtube.index', compact('youtubes'));
    }

    public function showYoutubeCreate()
    {
        return view('Admin.pages.youtube.create');
    }

    public function youtubeCreate(Request $request)
    {
        $youtube=new Youtubes();
        $youtube->url=$request->input('url');
        $youtube->status = $request->input('status');
        $youtube->save();
        return redirect()->route('admin.youtube');
    }

    public function youtubeDelete($id)
    {
        $youtube=Youtubes::find($id);
        if ($youtube){
            $youtube->delete();
            return redirect()->route('admin.youtube');
        }else{
            return redirect()->route('admin.youtube');
        }
    }

    public function youtubeEditView($id)
    {
        $youtube=Youtubes::findOrFail($id);
        return view('Admin.pages.youtube.edit', compact('youtube'));
    }

    public function youtubeUpdate(Request $request, $id)
    {
        $youtube=Youtubes::findOrFail($id);
        $youtube->url=$request->input('url');
        $youtube->status = $request->input('status');
        $youtube->save();
        return redirect()->route('admin.youtube');
    }
}
