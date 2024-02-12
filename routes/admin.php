<?php

use Illuminate\Support\Facades\Route;

// Admin dashboard Main page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'admin'])->name('admin.index');
    Route::get('/adminCreate', [App\Http\Controllers\Admin\AdminController::class, 'adminCreate'])->name('admin.adminCreate');
    Route::get('/logout', [App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->name('admin.logout');
});
// Admin dashboard Blog page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/blog', [App\Http\Controllers\Admin\Blog\BlogController::class, 'blog'])->name('admin.blog');
    Route::get('/blogCreate', [App\Http\Controllers\Admin\Blog\BlogController::class, 'showBlogCreate'])->name('admin.showBlogCreate');
    Route::post('/blogCreate', [App\Http\Controllers\Admin\Blog\BlogController::class, 'blogCreate'])->name('admin.blogCreate');
    Route::get('/blogDelete{id}', [App\Http\Controllers\Admin\Blog\BlogController::class, 'blogDelete'])->name('admin.blogDelete');
    Route::get('/blogEdit{id}', [App\Http\Controllers\Admin\Blog\BlogController::class, 'blogEditView'])->name('admin.showBlogEdit');
    Route::post('/editBlog{id}', [App\Http\Controllers\Admin\Blog\BlogController::class, 'blogUpdate'])->name('admin.blogEdit');
});
// Admin dashboard Category page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/category', [App\Http\Controllers\Admin\Category\CategoryController::class, 'category'])->name('admin.category');
    Route::get('/categoryCreate', [App\Http\Controllers\Admin\Category\CategoryController::class, 'showCategoryCreate'])->name('admin.showCategoryCreate');
    Route::post('/categoryCreate', [App\Http\Controllers\Admin\Category\CategoryController::class, 'categoryCreate'])->name('admin.categoryCreate');
    Route::get('/categoryDelete{id}', [App\Http\Controllers\Admin\Category\CategoryController::class, 'categoryDelete'])->name('admin.categoryDelete');
    Route::get('/categoryEdit{id}', [App\Http\Controllers\Admin\Category\CategoryController::class, 'categoryEditView'])->name('admin.categoryEditView');
    Route::post('/editCategory{id}', [App\Http\Controllers\Admin\Category\CategoryController::class, 'categoryUpdate'])->name('admin.categoryEdit');
});
// Admin dashboard Language page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/language', [App\Http\Controllers\Admin\Language\LanguageController::class, 'language'])->name('admin.language');
    Route::get('/languageCreate', [App\Http\Controllers\Admin\Language\LanguageController::class, 'showLanguageCreate'])->name('admin.showLanguageCreate');
    Route::post('/languageCreate', [App\Http\Controllers\Admin\Language\LanguageController::class, 'languageCreate'])->name('admin.languageCreate');
    Route::get('/languageDelete{id}', [\App\Http\Controllers\Admin\Language\LanguageController::class, 'languageDelete'])->name('admin.languageDelete');
    Route::get('/languageEdit{id}', [App\Http\Controllers\Admin\Language\LanguageController::class, 'languageEditView'])->name('admin.languageEditView');
    Route::post('/editLanguage{id}', [App\Http\Controllers\Admin\Language\LanguageController::class, 'languageUpdate'])->name('admin.languageEdit');
});
// Admin dashboard Quotes page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/quotes', [\App\Http\Controllers\Admin\Quotes\QuoteController::class, 'quotes'])->name('admin.quotes');
    Route::get('/quoteCreate', [App\Http\Controllers\Admin\Quotes\QuoteController::class, 'showQuoteCreate'])->name('admin.showQuoteCreate');
    Route::post('/quoteCreate', [App\Http\Controllers\Admin\Quotes\QuoteController::class, 'quoteCreate'])->name('admin.quoteCreate');
    Route::get('/quoteDelete{id}', [App\Http\Controllers\Admin\Quotes\QuoteController::class, 'quoteDelete'])->name('admin.quoteDelete');
    Route::get('/quoteEdit{id}', [App\Http\Controllers\Admin\Quotes\QuoteController::class, 'quoteEditView'])->name('admin.showQuoteEdit');
    Route::post('/editQuote{id}', [App\Http\Controllers\Admin\Quotes\QuoteController::class, 'quoteUpdate'])->name('admin.quoteEdit');
});
// Admin dashboard Slider page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/sliders', [\App\Http\Controllers\Admin\Sliders\SliderController::class, 'sliders'])->name('admin.slider');
    Route::get('/sliderCreate', [App\Http\Controllers\Admin\Sliders\SliderController::class, 'showSliderCreate'])->name('admin.showSliderCreate');
    Route::post('/sliderCreate', [App\Http\Controllers\Admin\Sliders\SliderController::class, 'sliderCreate'])->name('admin.sliderCreate');
    Route::get('/sliderDelete{id}', [\App\Http\Controllers\Admin\Sliders\SliderController::class, 'sliderDelete'])->name('admin.sliderDelete');
    Route::get('/sliderEdit{id}', [\App\Http\Controllers\Admin\Sliders\SliderController::class, 'sliderEditView'])->name('admin.showSliderEdit');
    Route::post('/editSlider{id}', [App\Http\Controllers\Admin\Sliders\SliderController::class, 'sliderUpdate'])->name('admin.sliderEdit');

});
// Admin dashboard Sponsor page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/sponsor', [\App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'sponsor'])->name('admin.sponsor');
    Route::get('/sponsorCreate', [App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'showSponsorCreate'])->name('admin.showSponsorCreate');
    Route::post('/sponsorCreate', [App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'sponsorCreate'])->name('admin.sponsorCreate');
    Route::get('/sponsorDelete{id}', [\App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'sponsorDelete'])->name('admin.sponsorDelete');
    Route::get('/sponsorEdit{id}', [\App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'sponsorEditView'])->name('admin.showSponsorEdit');
    Route::post('/editSponsor{id}', [App\Http\Controllers\Admin\Sponsors\SponsorController::class, 'sponsorUpdate'])->name('admin.sponsorEdit');

});
// Admin dashboard Teams page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/teams', [\App\Http\Controllers\Admin\Teams\TeamController::class, 'teams'])->name('admin.teams');
    Route::get('/teamCreate', [App\Http\Controllers\Admin\Teams\TeamController::class, 'showTeamCreate'])->name('admin.showTeamCreate');
    Route::post('/teamCreate', [App\Http\Controllers\Admin\Teams\TeamController::class, 'teamCreate'])->name('admin.teamCreate');
    Route::get('/teamDelete{id}', [\App\Http\Controllers\Admin\Teams\TeamController::class, 'teamDelete'])->name('admin.teamDelete');
    Route::get('/teamEdit{id}', [\App\Http\Controllers\Admin\Teams\TeamController::class, 'teamEditView'])->name('admin.showTeamEdit');
    Route::post('/editTeam{id}', [App\Http\Controllers\Admin\Teams\TeamController::class, 'teamUpdate'])->name('admin.teamEdit');

});
// Admin dashboard Youtube page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/youtube', [\App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'youtube'])->name('admin.youtube');
    Route::get('/youtubeCreate', [App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'showYoutubeCreate'])->name('admin.showYoutubeCreate');
    Route::post('/youtubeCreate', [App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'youtubeCreate'])->name('admin.youtubeCreate');
    Route::get('/youtubeDelete{id}', [\App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'youtubeDelete'])->name('admin.youtubeDelete');
    Route::get('/youtubeEdit{id}', [\App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'youtubeEditView'])->name('admin.youtubeEditView');
    Route::post('/editYoutube{id}', [App\Http\Controllers\Admin\Youtube\YoutubeController::class, 'youtubeUpdate'])->name('admin.youtubeEdit');

});
// Admin dashboard AboutMenu page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/about-menu', [\App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class,'aboutMenu'])->name('admin.aboutMenu');
    Route::get('/aboutMenuCreate', [App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class, 'showAboutMenuCreate'])->name('admin.showAboutMenuCreate');
    Route::post('/aboutMenuCreate', [App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class, 'aboutMenuCreate'])->name('admin.aboutMenuCreate');
    Route::get('/aboutMenuDelete{id}', [\App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class, 'aboutMenuDelete'])->name('admin.aboutMenuDelete');
    Route::get('/aboutMenuEdit{id}', [\App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class, 'aboutMenuEditView'])->name('admin.showAboutMenuEdit');
    Route::post('/editAboutMenu{id}', [App\Http\Controllers\Admin\AboutMenu\AboutMenuController::class, 'aboutMenuUpdate'])->name('admin.aboutMenuEdit');

});
// Admin dashboard AboutUs page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/aboutUs', [\App\Http\Controllers\Admin\AboutUs\AboutUsController::class,'aboutUs'])->name('admin.aboutUs');
    Route::get('/aboutUsCreate', [App\Http\Controllers\Admin\AboutUs\AboutUsController::class, 'showAboutUsCreate'])->name('admin.showAboutUsCreate');
    Route::post('/aboutUsCreate', [App\Http\Controllers\Admin\AboutUs\AboutUsController::class, 'aboutUsCreate'])->name('admin.aboutUsCreate');
    Route::get('/aboutUsDelete{id}', [\App\Http\Controllers\Admin\AboutUs\AboutUsController::class, 'aboutUsDelete'])->name('admin.aboutUsDelete');
    Route::get('/aboutUsEdit{id}', [\App\Http\Controllers\Admin\AboutUs\AboutUsController::class, 'aboutUsEditView'])->name('admin.showAboutUsEdit');
    Route::post('/aboutUsEdit{id}', [App\Http\Controllers\Admin\AboutUs\AboutUsController::class, 'aboutUsUpdate'])->name('admin.aboutUsEdit');
});
// Admin dashboard Tv-Programs page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/tvPrograms', [\App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class,'tvPrograms'])->name('admin.tvPrograms');
    Route::get('/tvProgramCreate', [App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class, 'showTvProgramCreate'])->name('admin.showTvProgramCreate');
    Route::post('/tvProgramsCreate', [App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class, 'TvProgramsCreate'])->name('admin.TvProgramsCreate');
    Route::get('/tvProgramDelete{id}', [\App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class, 'tvProgramDelete'])->name('admin.tvProgramDelete');
    Route::get('/tvProgramEdit{id}', [\App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class, 'tvProgramEditView'])->name('admin.showTvProgramEdit');
    Route::post('/tvProgramEdit{id}', [App\Http\Controllers\Admin\TvPrograms\TvProgramsController::class, 'tvProgramUpdate'])->name('admin.TvProgramEdit');

});
// Admin dashboard Doctor-Image page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/doctorImage', [\App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class,'doctorImage'])->name('admin.doctorImage');
    Route::get('/doctorImageCreate', [App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class, 'showDoctorImageCreate'])->name('admin.showDoctorImageCreate');
    Route::post('/doctorImageCreate', [App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class, 'DoctorImageCreate'])->name('admin.DoctorImageCreate');
    Route::get('/doctorImageDelete{id}', [\App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class, 'DoctorImageDelete'])->name('admin.DoctorImageDelete');
    Route::get('/doctorImageEdit{id}', [\App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class, 'doctorImageEditView'])->name('admin.showDoctorImageEdit');
    Route::post('/editAboutUs{id}', [App\Http\Controllers\Admin\DoctorImage\DoctorImageController::class, 'doctorImageUpdate'])->name('admin.DoctorImageEdit');

});
// Admin dashboard Doctor-Image page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/headDoctor', [\App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class,'headDoctor'])->name('admin.headDoctor');
    Route::get('/headDoctorCreate', [App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class, 'showHeadDoctorCreate'])->name('admin.showHeadDoctorCreate');
    Route::post('/headDoctorCreate', [App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class, 'HeadDoctorCreate'])->name('admin.HeadDoctorCreate');
    Route::get('/headDoctorDelete{id}', [\App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class, 'HeadDoctorDelete'])->name('admin.HeadDoctorDelete');
    Route::get('/headDoctorEdit{id}', [\App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class, 'headDoctorEditView'])->name('admin.showHeadDoctorEdit');
    Route::post('/editHeadDoctor{id}', [App\Http\Controllers\Admin\HeadDoctor\HeadDoctorController::class, 'headDoctorUpdate'])->name('admin.HeadDoctorEdit');
});
// Admin dashboard Icon page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/icons', [\App\Http\Controllers\Admin\Icon\IconController::class,'icon'])->name('admin.icon');
    Route::get('/iconCreate', [App\Http\Controllers\Admin\Icon\IconController::class, 'showIconCreate'])->name('admin.showIconCreate');
    Route::post('/iconCreate', [App\Http\Controllers\Admin\Icon\IconController::class, 'iconCreate'])->name('admin.iconCreate');
    Route::get('/iconDelete{id}', [\App\Http\Controllers\Admin\Icon\IconController::class, 'iconDelete'])->name('admin.iconDelete');
    Route::get('/iconEdit{id}', [\App\Http\Controllers\Admin\Icon\IconController::class, 'iconEditView'])->name('admin.showIconEdit');
    Route::post('/editIcon{id}', [App\Http\Controllers\Admin\Icon\IconController::class, 'iconUpdate'])->name('admin.iconEdit');
});
// Admin dashboard Settings page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/setting', [\App\Http\Controllers\Admin\Setting\SettingController::class,'setting'])->name('admin.setting');
    Route::get('/settingCreate', [App\Http\Controllers\Admin\Setting\SettingController::class, 'showSettingCreate'])->name('admin.showSettingCreate');
    Route::post('/settingCreate', [App\Http\Controllers\Admin\Setting\SettingController::class, 'settingCreate'])->name('admin.settingCreate');
    Route::get('/settingDelete{id}', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'settingDelete'])->name('admin.settingDelete');
    Route::get('/settingEdit{id}', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'settingEditView'])->name('admin.showSettingEdit');
    Route::post('/editSetting{id}', [App\Http\Controllers\Admin\Setting\SettingController::class, 'settingUpdate'])->name('admin.settingEdit');
});
// Admin dashboard Contact-Form page
Route::group(['middleware' => ['auth']], function () {
    Route::get('/contactForm', [\App\Http\Controllers\Admin\Contact\ContactFormController::class,'contactForm'])->name('admin.contactForm');
    Route::get('/contactFormCreate', [App\Http\Controllers\Admin\Contact\ContactFormController::class, 'contactFormCreate'])->name('admin.contactFormCreate');
    Route::get('/contactFormDelete{id}', [\App\Http\Controllers\Admin\Contact\ContactFormController::class, 'contactFormDelete'])->name('admin.contactFormDelete');
    Route::get('/contactFormEdit{id}', [\App\Http\Controllers\Admin\Contact\ContactFormController::class, 'contactFormEditView'])->name('admin.showContactFormEdit');
    Route::post('/editContactForm{id}', [App\Http\Controllers\Admin\Contact\ContactFormController::class, 'contactFormUpdate'])->name('admin.contactFormEdit');
});
// Admin dashboard Login page
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\AuthController::class, 'authenticate'])->name('admin.authenticate');
});

Route::get('locale/{locale}', [\App\Http\Controllers\LocaleController::class, 'setLocale'])->name('locale.set');
