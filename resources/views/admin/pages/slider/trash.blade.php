@extends('admin.layouts.app')

@section('title', 'trash')
@section('main-section')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Slider Trash</h4>
                <a href="{{ route('sliders.index') }}" class="text-success">Published Sliders <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $per)
                            @if($per -> name !== 'provider')
                            <tr>
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $per -> title }}</td>    
                                <td>
                                    <img style="width:50px; height:50px; object-fit:cover;" src="{{ url('storage/sliders/', $per -> photo) }}" alt="">
                                </td>
                                <td>
                                    {{-- <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> --}}
                                    
                                    <a href="{{ route('sliders.trash.update', $per -> id ) }}" class="btn btn-sm btn-info">Restore User</i></a>
                                    <form action="{{ route('sliders.destroy', $per -> id) }}" class="d-inline delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete Permanently</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {{-- @if( $form_type == 'create' )
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
                        <input style="display:none;" name="photo" type="file" class="form-control" id="slider-photo">
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
        @endif --}}
    </div>
</div>

@endsection