@extends('admin.layouts.app')

@section('title', 'portfolio')
@section('main-section')

<div class="row">   
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Portfolios</h4>
                <a href="{{ route('sliders.trash') }}" class="text-danger">Trash Sliders <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Featured</th>
                                <th>Gallery</th>
                                <th>Category</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($portfolios as $item)
                            @if( $item ->where('status', true) )
                               <tr class="align-middle" >
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $item -> title }}</td>
                                <td><img style="width: 60px;height: 60px; object-fit: cover;" src="{{ url('storage/portfolios/' . $item -> featured ) }}" alt=""></td>
                                <td><img style="width: 60px;height: 60px; object-fit: cover;" src="{{ url('storage/gallery_photos/' . $item -> gallery ) }}" alt=""></td>
                                <td>
                                    <ul class="comet-list">
                                        @foreach( $item -> category as $catt )
                                            <li><i class="fa fa-angle-right"></i> {{ $catt -> name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item -> client }}</td>
                                <td>{{ date('F d, Y', strtotime($item -> date)) }}</td>
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
                <h4 class="card-title">Add new Portfolio</h4>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Featued Photo</label>
                        <br>
                        <img style="max-width:100%;" id="slider-photo-preview" src="" alt="">
                        <input style="display:none;" name="photo" type="file" class="form-control" id="slider-photo">
                        <label for="slider-photo">
                            <img style="width: 60px; cursor:pointer;" src="{{ url('storage/default_photo/avatar.png') }}" alt="">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Gallery Photo</label> 
                        <br>

                        <div class="port-gall">  </div>

                        <input style="display:none;" name="gallery[]" multiple type="file" class="form-control" id="portfolio-gallery">
                        <label for="portfolio-gallery">
                            <img style="width: 60px; cursor:pointer;" src="{{ url('storage/default_photo/avatar.png') }}" alt="">
                        </label>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Select Categories</label>
                        <ul class="comet-list">
                            @foreach ($categories as $cat)
                            <li>
                                <label> <input name="cat[]" type="checkbox" value="{{ $cat -> id }}"> {{ $cat -> name }} </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-group">
                        <label>Project Description</label>
                        <textarea name="pdesc" id="portfolio-desc" ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Project Steps</label>
                        <div class="accordion" id="accordionExample">

                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                        <h6 class="mb-0" style="cursor: pointer" data-toggle="collapse" data-target="#collapseOne">
                                        Step 01
                                        </h6>
                                </div>

                                <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                    <div class="my-3">
                                        <label for="">Title</label>
                                        <input name="title[]" type="text" class="form-control">
                                    </div>

                                    <div class="my-3">
                                        <label for="">Description</label>
                                        <textarea name="desc[]" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                        <h6 class="mb-0" style="cursor: pointer" data-toggle="collapse" data-target="#collapseTwo">
                                        Step 02
                                        </h6>
                                </div>

                                <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                    <div class="my-3">
                                        <label for="">Title</label>
                                        <input name="title[]" type="text" class="form-control">
                                    </div>

                                    <div class="my-3">
                                        <label for="">Description</label>
                                        <textarea name="desc[]" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card portfolio-step shadow-sm">
                                <div class="card-header" id="headingOne">
                                        <h6 class="mb-0" style="cursor: pointer" data-toggle="collapse" data-target="#collapseThree">
                                        Step 03
                                        </h6>
                                </div>

                                <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                    <div class="my-3">
                                        <label for="">Title</label>
                                        <input name="title[]" type="text" class="form-control">
                                    </div>

                                    <div class="my-3">
                                        <label for="">Description</label>
                                        <textarea name="desc[]" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                          </div>
                    </div>

                    <div class="form-group">
                        <label>Client Name</label>
                        <input name="client" type="text" value="{{ old('client') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Project Link</label>
                        <input name="link" type="text" value="{{ old('link') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Project Types</label>
                        <input name="types" type="text" value="{{ old('types') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Project Date</label>
                        <input name="done" type="date" value="{{ old('done') }}" class="form-control">
                    </div>

                    <hr>

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