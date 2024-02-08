<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\Language;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function teams()
    {
        $teams=Team::with('translations', 'languages')->get();
        $languages=Language::query()->get();
        return view('Admin/pages/teams/index',compact('teams','languages'));

    }
    public function showTeamCreate()
    {
        return view('Admin.pages.teams.create');
    }
    public function teamCreate(Request $request)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.position" => 'required|string|max:255',
            'itemImg' => 'required|image',
            'title' => 'required|string',
        ]);

        $defaultPosition = $request->input("$defaultLanguage.position");
        $team = new Team();
        if ($request->hasFile('itemImg')) {
            $imagePath = Storage::disk('public')->putFile("teams", $request->file('itemImg'));
            $team->image = $imagePath;
        }
        $team->title = $request->input('title');
        $team->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->first();
        $defaultLangId = $defaultLanguageModel->id;
        TeamTranslation::create([
            'teams_id' => $team->id,
            'language_id' => $defaultLangId,
            'position' => $defaultPosition,
        ]);

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $position = $request->input("$lang.position");
                if (!empty($position)) {
                    $request->validate([
                        "$lang.position" => 'string|max:255',
                    ]);

                    $languageModel = Language::where('lang', $lang)->first();
                    $langId = $languageModel->id;

                    TeamTranslation::create([
                        'teams_id' => $team->id,
                        'language_id' => $langId,
                        'position' => $position,
                    ]);
                }
            }
        }

        return redirect()->route('admin.teams')->with('success', 'Team created successfully');
    }

    public function teamDelete($id)
    {
        $teamTranslations = TeamTranslation::where('teams_id', $id)->get();
        $team = Team::find($id);

        if ($team && $teamTranslations) {
            Storage::delete($team->image);
            foreach ($teamTranslations as $translation) {
                $translation->delete();
            }
            $team->delete();

            return redirect()->route('admin.teams')->with('success', 'Team successfully deleted.');
        } else {
            return redirect()->route('admin.teams')->with('error', 'Team not found.');
        }
    }
    public function teamEditView($id)
    {
        $teams = Team::findOrFail($id);
        return view('Admin.pages.teams.edit', compact('teams'));
    }

    public function teamUpdate(Request $request, $id)
    {
        $defaultLanguage = config('app.locale');

        $request->validate([
            "$defaultLanguage.position" => 'required|string|max:255',
            'itemImg' => 'nullable|image',
            'title' => 'required|string',
        ]);

        $team = Team::findOrFail($id);
        if ($request->hasFile('itemImg')) {
            if ($team->image) {
                Storage::delete($team->image);
            }
            $imagePath = Storage::disk('public')->putFile("teams", $request->file('itemImg'));
            $team->image = $imagePath;
        }

        $team->title = $request->input('title');
        $team->save();

        $defaultLanguageModel = Language::where('lang', $defaultLanguage)->firstOrFail();
        $defaultLangId = $defaultLanguageModel->id;
        $position = $request->input("$defaultLanguage.position");
        $teamTranslation = TeamTranslation::updateOrCreate(
            ['teams_id' => $team->id, 'language_id' => $defaultLangId],
            ['position' => $position]
        );

        foreach (config('app.languages') as $lang) {
            if ($lang != $defaultLanguage) {
                $position = $request->input("$lang.position");

                if (!empty($position)) {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();
                    $langId = $languageModel->id;

                    TeamTranslation::updateOrCreate(
                        ['teams_id' => $team->id, 'language_id' => $langId],
                        ['position' => $position]
                    );
                } else {
                    $languageModel = Language::where('lang', $lang)->firstOrFail();

                    $langId = $languageModel->id;

                    TeamTranslation::where('teams_id', $team->id)
                        ->where('language_id', $langId)
                        ->delete();
                }
            }
        }

        return redirect()->route('admin.teams')->with('success', 'Team updated successfully');


    }
}
