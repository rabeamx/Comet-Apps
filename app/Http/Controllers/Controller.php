<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // $link = "https://www.youtube.com/watch?v=yHSF8ZJDpDQ&ab_channel=StreamingBirds";

    // $add_embed = str_replace('watch?v=', 'embed/', $link);
    // // echo $add_embed;

    // $new_array = explode('&ab', $add_embed);
    // // print_r($new_array);

    // echo $new_array[0];


    /**
     *  youtube video link conversion
     */
    public function embed($link = '')
    {
        // $link = 'https://vimeo.com/291494147';
        // $link = 'https://vimeo.com/466463294';

        if( strpos( $link, 'vimeo.com') ){
            $arr = explode('vimeo.com/', $link);
            $id = $arr[1];
            return "https://player.vimeo.com/video/{$id}";
        } else{
            $embed_link = str_replace('watch?v=', 'embed/', $link);
            if( explode('&t', $embed_link) ){
                $link_arr = explode('&ab', $embed_link);
            } elseif( explode('&ab', $embed_link) ){
                $link_arr = explode('&ab', $embed_link);
            }
            return $link_arr[0];
        }

        

    }

    /**
     *  slug make
     */
    public function slugMake($title)
    {
        $lower = strtolower($title);
        return str_replace(' ', '-', $lower);
    }




}
