@extends('admin.layouts.app')

@section('title', 'Slider Trash')
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
    </div>
</div>

@endsection