<?php

namespace App\Http\Controllers;

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
    
}
