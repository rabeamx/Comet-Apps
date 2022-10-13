<?php

namespace App\Http\Controllers;

use App\Models\Categorypost;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Portfolio;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendPageController extends Controller
{
    public function showHomePage()
    {
        $sliders = Slider::where('status', true) -> where('trash', false) -> latest() -> get();
        return view('comet.pages.home', [
            'sliders'  => $sliders,
        ]);
    }

    public function showContactPage()
    {
        $sliders = Slider::where('status', true) -> where('trash', false) -> latest() -> get();
        return view('comet.pages.contact');
    }

    public function showSinglePortfolioPage($slug)
    { 
        // single array nibo tai first()
        $portfolio = Portfolio::where('slug', $slug) -> first();
        return view('comet.pages.portfolio', [
            'portfolio'   => $portfolio
        ]);
    }

    public function showBlogPage()
    { 
        // single array nibo tai first()
        $posts = Post::latest() -> get();
        return view('comet.pages.blog', [
            'posts'   => $posts,
        ]);
    }

    public function showBlogPostByCategory($slug)
    { 
        // show blog post by category
        $category = Categorypost::where('slug', $slug) -> first();
        $posts = $category -> posts;

        return view('comet.pages.blog', [
            'posts'    => $posts,
        ]);

    }

    public function showBlogPostByTag($slug)
    { 
        // show blog post by category
        $tag = Tag::where('slug', $slug) -> first();
        $posts = $tag -> posts;

        return view('comet.pages.blog', [
            'posts'    => $posts,
        ]);

    }

    public function showSinglePost($slug)
    {
        $single_post = Post::where('slug', $slug) -> first();

        return view('comet.pages.single-blog', [
            'post' => $single_post,
        ]);
    }


    
}
