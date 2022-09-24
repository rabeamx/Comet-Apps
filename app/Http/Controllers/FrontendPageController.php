<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Slider;
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
    
}
