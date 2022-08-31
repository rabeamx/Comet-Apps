@extends('admin.layouts.app')

@section('title', 'Client')
@section('main-section')

<div class="row">   
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Clients</h4>
                <a href="{{ route('sliders.trash') }}" class="text-danger">Trash Testimonials <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse ($clients as $item)
                                <tr>
                                    <td>{{ $loop -> index +1 }}</td>
                                    <td>{{ $item -> name }}</td>
                                    <td><img style="width: 60px;height: 60px; object-fit: cover;" src="{{ url('storage/clients/'. $item -> logo) }}" alt=""></td>
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
                                        <a href="{{ route('testimonial.edit', $item -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('sliders.trash.update', $item -> id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
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
                <h4 class="card-title">Add new Client</h4>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Client Name</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <br>
                        <img style="max-width:100%;" id="slider-photo-preview" src="" alt="">
                        <input style="display:none;" name="logo" type="file" class="form-control" id="slider-photo">
                        <label for="slider-photo">
                            <img style="width: 60px; cursor:pointer;" src="https://cdn.icon-icons.com/icons2/1993/PNG/512/frame_gallery_image_images_photo_picture_pictures_icon_123209.png" alt="">
                        </label>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @if( $form_type == 'edit' )
        @endif
    </div>  
</div>

@endsection