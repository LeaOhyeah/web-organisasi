<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

/**
 * FOR Admin only
 */

class NewsFeatureController extends Controller
{
    // #### News Function ####
    public function newsIndex()
    {
        $data = [
            'news' => News::all()->sortBy('created_at'),
        ];
        return view('news.index_news', $data);
    }

    public function newsCreate()
    {
        $data = [
            'categories' => Category::all()->sortBy('name'),
        ];
        return view('news.create_news', $data);
    }

    public function newsStore(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:150',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,img|max:2048',
            'body' => 'required',
            'hastag' => 'max:300',
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-image');
        }
        $validateData['uploaded_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';
        $validateData['code'] = Str::uuid();
        $validateData['id'] = Str::uuid();

        if (News::create($validateData)) {
            return redirect('/dashboard/news/news/index')->with('success', "Data added successfully!");
        } else {
            return redirect('/dashboard/news/news/index')->with('error', "Error! Something went wrong");
        }

    }

    public function newsEdit($id)
    {
        $data = [
            'news' => News::find($id),
            'categories' => Category::all()->sortBy('name'),
        ];
        return view('news.edit_news', $data);
    }

    public function newsUpdate(Request $request)
    {
        $news = News::find($request->id);
        $validateData = $request->validate([
            'title' => 'required|max:150',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,img|max:2048',
            'body' => 'required',
            'hastag' => 'max:300',
        ]);

        if ($request->file('image')) {
            if ($news->image != null || $news->image != '') {
                Storage::delete($news->image);
            }
            $validateData['image'] = $request->file('image')->store('post-image');
        }

        $validateData['uploaded_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';

        if (News::where('id', $request->id)->update($validateData)) {
            return redirect('/dashboard/news/news/index')->with('success', "Data updated successfully!");
        } else {
            return redirect('/dashboard/news/news/index')->with('error', "Error! Error! ");
        }
    }

    public function newsDelete($id)
    {
        if (News::destroy($id)) {
            return back()->with('success', 'Data deleted successfully!');
        } else {
            return back()->with('error', 'Error! Failed to delete the data');
        }
    }
    // #### End News Function ####

    // #### Category Function ####
    public function categoriesIndex()
    {
        $data = [
            'categories' => Category::all()->sortBy('name'),
        ];
        return view('news.index_categories', $data);
    }

    public function categoryStore(Request $request)
    {
        $unique = Category::where('name', $request->name)->first();
        if ($unique) {
            return redirect('/dashboard/news/categories/index')->with('error', "Error! Data already exists");
        } else {
            $validateData = $request->validate([
                'name' => 'required|unique:categories|max:20',
            ]);
            $validateData['edited_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';
            $validateData['id'] = Str::uuid();

            if (Category::create($validateData)) {
                return redirect('/dashboard/news/categories/index')->with('success', "Data added successfully!");
            } else {
                return redirect('/dashboard/news/categories/index')->with('error', "Error! Failed to add the data");
            }
        }

    }

    public function categoryUpdate(Request $request)
    {
        $enabled = Category::find($request->id);
        $duplicate = Category::withTrashed()->where('name', $request->name)->first();
        $isChange = $enabled->name == $request->name ? false : true;

        if ($isChange == false) {
            return back()->with('success', 'Nothing to update');
        }
        
        if ($duplicate == null) {
            $validateData = $request->validate([
                'id' => 'required',
                'name' => 'required|max:20',
            ]);
            $validateData['edited_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';

            if (Category::where('id', $request->id)->update($validateData)) {
                return back()->with('success', 'Data updated successfully!');
            }
            return back()->with('error', "Error! Something went wrong");
        }
        
        return back()->with('error', 'Error! Data already exists');

    }

    public function categoryDelete(Request $request)
    {
        if (Category::destroy($request->id)) {
            return back()->with('success', 'Data deleted successfully!');
        } else {
            return back()->with('error', 'Error! Failed to delete the data');
        }
    }

    // #### End Category Function ####
}