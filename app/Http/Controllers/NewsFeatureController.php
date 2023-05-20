<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\Category;
use App\Models\Comment;

/**
 * FOR Admin only
 */

class NewsFeatureController extends Controller
{
    // #### News Function ####
    public function indexNews()
    {
        $data = [
            'news' => News::all()
        ];
        return view('news.index_news');
    }

    public function newsCreate()
    {
        return view('news.news_create');
    }

    // #### End News Function ####

    // #### Category Function ####
    public function indexCategory()
    {
        Category::all();
    }

    // #### End Category Function ####
}
