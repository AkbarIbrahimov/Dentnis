<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Quotes;
use App\Models\QuotesTranslation;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function admin()
    {
        $id = Auth::id();
        $userprofile = User::query()->where('id', $id)->get();
        $users = User::query()->get();
        return view('Admin.pages.dashboard', compact('users', 'userprofile'));
    }

    public function adminCreate()
    {
        return view('Admin.pages.adminAdd');
    }


}
