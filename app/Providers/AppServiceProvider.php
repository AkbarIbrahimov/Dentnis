<?php

namespace App\Providers;

use App\Models\AboutMenu;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Category;
use App\Models\DoctorImage;
use App\Models\HeadDoctor;
use App\Models\Icon;
use App\Models\Language;
use App\Models\Setting;
use App\Models\TvProgram;
use App\Models\Youtubes;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $languages = Language::pluck('lang')->toArray();
        config([
            'app.languages' => $languages,
        ]);
        view()->composer('Front.*',function ($view){
            $categories=Category::with(['translations','blogs.translations'])->get();
            $languageIcon=Language::query()->get();
            $blogs=Blog::with(['translations'])->get();
            $aboutMenu=AboutMenu::with(['translations'])->first();
            $aboutUs=AboutUs::with(['translations'])->first();
            $tvPrograms=TvProgram::query()->get();
            $doctorImages=DoctorImage::query()->get();
            $icons=Icon::query()->get();
            $settings=Setting::query()->first();
            $headDoctor=HeadDoctor::with(['translations'])->first();
            $youtubeAbout=Youtubes::query()->where('status','active')->first();
            return $view->with(compact('categories','languageIcon','blogs','aboutMenu','aboutUs','tvPrograms','doctorImages','icons','settings','headDoctor','youtubeAbout'));
        });
    }
}
