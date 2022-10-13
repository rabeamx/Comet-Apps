<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest() -> get();
        $cats = Categorypost::latest() -> get();
        $tags = Tag::latest() -> get();
        return view('admin.pages.post.index', [
            'posts'       => $posts,
            'cats'       => $cats,
            'tags'       => $tags,
            'form_type'   => 'create',
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
        // return $request -> all();
        // $this -> validate($request, [
        //     'title'      => 'required|unique:posts',
        //     'content'      => 'required',
        // ]); 

        // upload standard post
        if( $request -> hasFile('standard') ){
            $img = $request -> file('standard');
            $standard = md5(time(). rand()) . '.' . $img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/posts/standard/') . $standard);
        }
        
        // manage post gallery image
        $gallery_files = [];
        if( $request -> hasFile('gallery') ){

            $gallery = $request -> file('gallery');
            
            foreach($gallery as $gall){
                $gall_name = md5(time(). rand()) . '.' . $gall -> clientExtension();

                $image = Image::make($gall -> getRealPath());
                $image -> save(storage_path('app/public/posts/gallery/') . $gall_name);

                array_push($gallery_files, $gall_name);
            }
            // return $gallery;
        } 
        // return $gallery_files;

        // https://www.youtube.com/watch?v=yHSF8ZJDpDQ&ab_channel=StreamingBirds

        // featured post management
        $post_type = [
            'post_type'  => $request -> type,
            'gallery'    => json_encode($gallery_files),
            'standard'   => $standard ?? null,
            'video'      => $this -> embed($request -> video),
            'audio'      => $request -> audio,
            'quote'      => $request -> quote,
        ];

        $post = Post::create([
            'admin_id'    => Auth::guard('admin') -> user() -> id,
            'title'       => $request -> title,
            'slug'        => $this -> slugMake($request -> title),
            'content'     => $request -> content,
            'featured'    => json_encode($post_type),
        ]);   

        $post -> category() -> attach($request -> cat);  
        $post -> tag() -> attach($request -> tag);  

        return back() -> with('success', 'Post added successfully');
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
