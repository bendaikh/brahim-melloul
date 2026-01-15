<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $featuredArticles = Article::with(['carLogo', 'category'])->where('is_active', true)->take(6)->get();
        $brands = \App\Models\CarLogo::where('is_active', true)->get();
        $categories = Category::whereNull('parent_id')->get();
        
        return view('public.home', compact('featuredArticles', 'brands', 'categories'));
    }

    /**
     * Display the product catalog.
     */
    public function catalog(Request $request)
    {
        $query = Article::with(['carLogo', 'category'])->where('is_active', true);

        if ($request->has('brand')) {
            $query->whereHas('carLogo', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->brand . '%');
            });
        }

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $articles = $query->paginate(12);
        $brands = Brand::all();
        $categories = Category::whereNull('parent_id')->get();

        return view('public.catalog', compact('articles', 'brands', 'categories'));
    }

    /**
     * Display a single article.
     */
    public function show($slug)
    {
        $article = Article::with(['carLogo', 'category'])->where('slug', $slug)->firstOrFail();
        return view('public.article_detail', compact('article'));
    }
}
