<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::latest() -> get();
        $categories = Category::latest() -> get();

        return view('admin.pages.portfolio.index', [
            'portfolios' => $portfolios,
            'categories' => $categories,
            'form_type'      => 'create',
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        // $this -> validate($request, [
        //     'name'   => 'required',
        //     'cat'    => 'required',
        // ]);

        // image management
        if( $request -> hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5(time(). rand()) . '.' . $img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/portfolios/') . $file_name);
        }

        // gallery management
        // if( $request -> hasFile('gallery') ){
        //     return 'gallery is ok';
        // } else{
        //     return 'gallery is not ok';
        // }
        $gallery_files = [];
        if( $request -> hasFile('gallery') ){

            $gallery = $request -> file('gallery');
            
            foreach($gallery as $gall){
                $gall_name = md5(time(). rand()) . '.' . $gall -> clientExtension();

                $image = Image::make($gall -> getRealPath());
                $image -> save(storage_path('app/public/gallery_photos/') . $gall_name);

                array_push($gallery_files, $gall_name);
            }
            // return $gallery;
        } 
        // return $gallery_files;

        // steps management
        $steps = [];
        // if( isset($request -> title) ){
        if( count($request -> title) > 0 ){
            
            // $steps_arr = $request -> title;
            for ($i=0; $i < count($request -> title) ; $i++) { 
                array_push($steps, [
                    'title'  => $request -> title[$i],
                    'desc'  => $request -> desc[$i],
                ]);
            }
        } 
        // return $steps;

        // store data
        $portfolio = Portfolio::create([
            'title'       => $request -> name,
            'slug'        => Str::slug($request -> name),
            'featured'    => $file_name,
            'gallery'     => json_encode($gallery_files),
            'desc'        => $request -> pdesc,
            'steps'        => json_encode($steps),
            'client'      => $request -> client,
            'date'        => $request -> done,
            'link'        => $request -> link,
            'types'       => $request -> types,
        ]);

        $portfolio -> category() -> attach($request -> cat);

        // return back
        return back() -> with('success', 'portfolio added successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
