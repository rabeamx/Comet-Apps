@extends('admin.layouts.app')

@section('title', 'Post')
@section('main-section')

<div class="row">   
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Post</h4>
                <a href="{{ route('sliders.trash') }}" class="text-danger">Trash Posts<i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Tag</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($posts as $item)
                                <tr>
                                    <td>{{ $loop -> index +1 }}</td>
                                    <td>{{ $item -> title }}</td>
                                    <td>{{ $item -> slug }}</td>
                                    <td>
                                        <ul class="comet-list">
                                            @foreach($item -> tag as $cat)
                                            <li>{{ $cat -> name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    {{-- this category is the relation catefory method --}}
                                    <td>
                                        <ul class="comet-list">
                                            @foreach($item -> category as $cat)
                                            <li>{{ $cat -> name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @php
                                            $featured = json_decode($item -> featured);
                                            echo $featured -> post_type;
                                        @endphp  
                                    </td>
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
                                        <a href="{{ route('counter.edit', $item -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('sliders.trash.update', $item -> id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

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
                <h4 class="card-title">Add new post</h4>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ old('title') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Post Type</label>
                        <select class="form-control" name="type" id="post-type-selector">
                            <option value="standard">standard</option>
                            <option value="gallery">gallery</option>
                            <option value="video">video</option>
                            <option value="audio">audio</option>
                            <option value="quote">quote</option>
                        </select>
                    </div>

                    <div class="form-group post-standard">
                        <label>Featued Photo</label>
                        <br>
                        <img style="max-width:100%;" id="slider-photo-preview" src="" alt="">
                        <input style="display:none;" name="standard" type="file" class="form-control" id="slider-photo">
                        <label for="slider-photo">
                            <img style="width: 60px; cursor:pointer;" src="{{ url('storage/default_photo/avatar.png') }}" alt="">
                        </label>
                    </div>

                    <div class="form-group post-gallery">
                        <label>Gallery Photo</label> 
                        <br>

                        <div class="port-gall">  </div>

                        <input style="display:none;" name="gallery[]" multiple type="file" class="form-control" id="portfolio-gallery">
                        <label for="portfolio-gallery">
                            <img style="width: 60px; cursor:pointer;" src="{{ url('storage/default_photo/avatar.png') }}" alt="">
                        </label>
                    </div>

                    <div class="form-group post-video">
                        <label>Video Post</label>
                        <input name="video" type="text" value="{{ old('video') }}" class="form-control">
                    </div>

                    <div class="form-group post-audio">
                        <label>Audio Post</label>
                        <input name="audio" type="text" value="{{ old('audio') }}" class="form-control">
                    </div>

                    <div class="form-group post-quote">
                        <label>Quote Post</label>
                        <textarea class="form-control" name="quote" id=""></textarea>
                    </div>

                    <div class="form-group">
                        <label>Post Content</label>
                        <textarea name="content" id="portfolio-desc" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Post Categories</label>
                        <ul class="comet-list">

                            @foreach ($cats as $cat)
                            <li>
                                <label> <input name="cat[]" type="checkbox" value="{{ $cat -> id }}"> {{ $cat -> name }} </label>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="form-group">
                        <label>Tag</label><br>
                        <select class="form-control comet-select-2" name="tag[]" id="" multiple>

                            @foreach ($tags as $tag)
                            <option value="{{ $tag -> id }}">{{ $tag -> name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        {{-- @if( $form_type == 'edit' )
        @endif --}}
    </div>  
</div>

@endsection