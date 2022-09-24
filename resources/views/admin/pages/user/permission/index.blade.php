@extends('admin.layouts.app')

@section('title', 'permission')
@section('main-section')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Permissions</h4>
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
                                        {{-- <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> --}}
                                        <a href="{{ route('permission.edit', $per -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('permission.destroy', $per -> id) }}" class="d-inline delete-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
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