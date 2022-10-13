<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest() -> where('trash', false) -> get();
        return view('admin.pages.slider.index', [
            'form_type'  => 'create',
            'sliders'    => $sliders, 
        ]); 
    }

    public function trashUsers()
    {
        $sliders = Slider::latest() -> where('trash', true) -> get();
        return view('admin.pages.slider.trash', [
            'sliders'   => $sliders,
            'form_type'  => 'trash',
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
        $this -> validate($request, [
            'title'      => 'required',
            'subtitle'   => 'required',
            'photo'      => 'required',
        ]); 

        // btn management
        $buttons = [];  

        for( $i = 0; $i < count($request -> btn_title); $i++ ){

            array_push($buttons, [
                'btn_title'   => $request -> btn_title[$i],
                'btn_link'    => $request -> btn_link[$i],
                'btn_type'    => $request -> btn_type[$i],
            ]); 
        } 

        // slider image manage
        if( $request -> hasFile('photo') ){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()) . '.' . $img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/sliders/') . $file_name);
        }

        // add new slide
        Slider::create([
            'title'    => $request -> title,
            'subtitle' => $request -> subtitle,
            'photo'    => $file_name,
            'btns'     => json_encode($buttons),  
        ]);

        // return back
        return back() -> with('success', 'slide added successfully');
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
        $slider = Slider::findOrFail($id);
        $sliders = Slider::latest() -> get();
        return view('admin.pages.slider.index', [
            'form_type'  => 'edit',
            'sliders'    => $sliders,
            'slider'     => $slider,
        ]);
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
        $slider = Slider::findOrFail($id);

        // if( $request -> hasFile('new_photo') ){
   
        //     $img       = $request -> file('new_photo');
        //     $file_name = md5(time(). rand()) .'.'. $img -> clientExtension();
        //     $img -> move(storage_path('app/public/photo/'), $file_name);

        //     unlink('storage/photo/' . $request -> old_photo);

        // }else {
        //     $file_name = $request -> old_photo;
        // }

         // slider image manage
         if( $request -> hasFile('new_photo') ){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()) . '.' . $img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/sliders/') . $file_name);
            
        }else {
            $file_name = $request -> photo;
        }

        // btn management
        $buttons = [];  

        for( $i = 0; $i < count($request -> btn_title); $i++ ){

            array_push($buttons, [
                'btn_title'   => $request -> btn_title[$i],
                'btn_link'    => $request -> btn_link[$i],
                'btn_type'    => $request -> btn_type[$i],
            ]); 
        } 

        $slider -> update([
            'title'    => $request -> title,
            'subtitle' => $request -> subtitle,
            'photo'    => $file_name,
            'btns'     => json_encode($buttons), 
        ]);
        return back() -> with('success', 'slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Slider::findOrFail($id);
        $delete_data -> delete();
        return back() -> with('success-main', 'User Deleted Successfully');
    }
    
    /**
     *  status update
     *
     * @return void
     */
    public function updateStatus($id)
    {
        $data = Slider::findOrFail($id);
        if($data -> status){

            $data -> update([
                'status' => false,
            ]);

        } else{
            $data -> update([
                'status' => true,
            ]);
        }

        return back() -> with('success-main', 'status updated successfully');

    }

    /**
     *  trash update
     *
     * @return void
     */
    public function updateTrash($id)
    {
        $data = Slider::findOrFail($id);
        if($data -> trash){
            $data -> update([
                'trash' => false,
            ]);
        } else{
            $data -> update([
                'trash' => true,
            ]);
        }

        return back() -> with('success-main', 'status updated successfully');

    }
}
