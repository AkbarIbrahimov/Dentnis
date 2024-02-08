<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\ContactForm;
use App\Models\Language;
use App\Models\Menu;
use App\Models\MenuBuilder;
use App\Models\Product;
use App\Models\Quotes;
use App\Models\Slider;
use App\Models\Sponsors;
use App\Models\Team;
use App\Models\Youtubes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->get();
        $quotes = Quotes::where('status', 'active')->with('translations')->limit(3)->get();
        $sponsors = Sponsors::where('status', 'active')->get();
        $youtubes = Youtubes::query()->get();
        $teams = Team::with('translations')->get();
        $blogs = Blog::with('translations')->limit(9)->get();
        $blogArticles = Blog::with('translations')->limit(3)->get();
        return view('Front.pages.main', compact('sliders', 'quotes', 'sponsors', 'youtubes', 'teams', 'blogs', 'blogArticles'));
    }

    public function singlePage($slug)
    {
        $blogsss = Blog::where('slug', $slug)->get();
        return view('Front.pages.singlePage', compact('blogsss'));
    }

    public function about()
    {
        return view('Front.pages.about');
    }

    public function contact()
    {
        $correct="";
        return view('Front.pages.contact',compact('correct'));
    }
    public function contactInfo(Request$request)
    {
        $request->validate([
            'fName' => 'required|',
            'message' => 'required|',
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $contact = new ContactForm();

        $contact->firstname = $request->input('fName');
        $contact->message = $request->input('message');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->kvkk_accepted = $request->input('accept') ? true : false;
        $contact->save();
        $correct="Məlumat  göndərildi";
        return view('Front.pages.contact',compact('correct'));
    }


    public function tvPrograms()
    {
        return view('Front.pages.tv-programs');
    }
    public function headDoctor()
    {
        return view('Front.pages.headDoctor');
    }

    public function article()
    {
        return view('Front.pages.articles');
    }

    public function search(Request $request)
    {
        $request->session()->put('search_term', $request->input('search'));
        $searchTerm = $request->input('search');
        $blogQuery = Blog::query()->with(['translations']);

        if ($request->filled('search')) {
            $blogQuery->whereHas('translations', function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        $blogs = $blogQuery;
        $matchedBlogsCount = $blogs->count();
        return view('Front.pages.search', compact('searchTerm', 'blogQuery','matchedBlogsCount'));
    }

}
