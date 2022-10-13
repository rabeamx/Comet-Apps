@extends('admin.layouts.app')

@section('title', 'Slider')
@section('main-section')

<div class="row">   
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Sliders</h4>
                <a href="{{ route('sliders.trash') }}" class="text-danger">Trash Sliders <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')  
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $item)
                            @if( $item ->where('status', true) )
                               <tr>
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $item -> title }}</td>
                                <td><img style="width: 60px;height: 60px; object-fit: cover;" src="{{ url('storage/sliders/' . $item -> photo) }}" alt=""></td>
                                <td>{{ $item -> created_at -> diffForHumans() }}</td>
                                <td> 
                                    @if($item -> status)
                                        <span class="badge badge-success">Published</span>
                                        <a href="{{ route('sliders.status.update', $item -> id ) }}" class="text-danger"><i class="fa fa-times"></i></a>
                                    @else
                                        <span class="badge badge-danger">Unpublished</span>
                                        <a href="{{ route('sliders.status.update', $item -> id ) }}" class="text-success"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sliders.edit', $item -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('sliders.trash.update', $item -> id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                               </tr>
                            @endif
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if( $form_type == 'create' )
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new Slide</h4>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input name="subtitle" type="text" value="{{ old('subtitle') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <br>
                        <img style="max-width:100%;" id="slider-photo-preview" src="" alt="">
                        <input style="display:none;" name="photo" type="file" class="form-control" id="slider-photo">
                        <label for="slider-photo">
                            <img style="width: 60px; cursor:pointer;" src="https://cdn.icon-icons.com/icons2/1993/PNG/512/frame_gallery_image_images_photo_picture_pictures_icon_123209.png" alt="">
                        </label>
                    </div>
                    <hr>
                    <div class="form-group slider-btn-opt">

                        

                        <a id="add-new-slider-button" class="btn btn-sm btn-info" href="">Add Slider Button</a>

                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @if( $form_type == 'edit' )
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Slide</h4>
                <a href="{{ route('sliders.index') }}">back</a>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('sliders.update', $slider -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $slider -> title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input name="subtitle" type="text" value="{{ $slider -> subtitle }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <br>
                        <img style="max-width:100%;" id="slider-photo-preview" src="{{ url('storage/sliders/'. $slider -> photo) }}" alt="">
                        <input style="display:none;" name="new_photo" type="file" class="form-control" id="slider-photo">
                        <label for="slider-photo">
                            <img style="width: 60px; cursor:pointer;" src="https://cdn.icon-icons.com/icons2/1993/PNG/512/frame_gallery_image_images_photo_picture_pictures_icon_123209.png" alt="">  
                        </label>
                    </div>
                    <hr>
                    <div class="form-group slider-btn-opt">

                         @php $i = 1; @endphp
                        @foreach (json_decode($slider -> btns) as $btn)
                        <div class="btn-opt-area">
                            <span>Button #{{ $i }}</span>
                            <span class="badge badge-danger remove-btn" style="margin-left:150px;cursor:pointer;" >remove</span>
                            <input class="form-control" name="btn_title[]" value="{{ $btn -> btn_title }}" type="text" placeholder="Button Title">
                            <input class="form-control" name="btn_link[]" value="{{ $btn -> btn_link }}" type="text" placeholder="Button Link">
                            <select class="form-control" name="btn_type[]" >
                                <option @if( $btn -> btn_type === "btn-light-out" ) selected @endif value="btn-light-out" > default </option>
                                <option @if( $btn -> btn_type === "btn-color btn-full" ) selected @endif value="btn-color btn-full" > Red </option>
                            </select>
                            <hr/>
                        </div>
                        @php $i++ @endphp
                        @endforeach

                        <a id="add-new-slider-button" class="btn btn-sm btn-info" href="">Add Slider Button</a>

                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>  
</div>

@endsection