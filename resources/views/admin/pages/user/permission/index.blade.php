@extends('admin.layouts.app')

@section('title', 'Permission')
@section('main-section')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Permissions</h4>
                    <a href="{{ route('permission.trash') }}" class="text-danger">Trash Permissions <i class="fa fa-arrow-right"></i></a>
                </div>
                @include('validate-main')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 data-table-haq">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($all_permission as $per)
                                <tr>
                                    <td>{{ $loop -> index +1 }}</td>
                                    <td>{{ $per -> name }}</td>
                                    <td>{{ $per -> slug }}</td>
                                    <td>{{ $per -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if($per -> status)
                                            <span class="badge badge-success">Published</span>
                                            <a href="{{ route('permission.status.update', $per -> id ) }}" class="text-danger"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Unpublished</span>
                                            <a href="{{ route('permission.status.update', $per -> id ) }}" class="text-success"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('permission.edit', $per -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('permission.trash.update', $per -> id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>  
                                        </td>
                                </tr>
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
            @if( $form_type == 'create' )
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add new Permission</h4>
                </div>
                <div class="card-body">
                    @include('validate')
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control">
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
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Edit Permission</h4>
                    <a href="{{ route('permission.index') }}">back</a>
                </div>
                <div class="card-body">
                    @include('validate')
                    <form action="{{ route('permission.update', $edit -> id ) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" value="{{ $edit -> name }}" type="text" class="form-control">
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