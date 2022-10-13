@extends('admin.layouts.app')

@section('title', 'Admin-User')
@section('main-section')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">All Admin Users</h4>
                <a href="{{ route('admin.trash') }}" class="text-danger">Trash Users <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Photo</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_admin as $per)
                            @if($per -> name !== 'provider')
                            <tr>
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $per -> name }}</td>    
                                <td>{{ $per -> role -> name }}</td>
                                <td>
                                    @if($per -> photo == 'avatar.png')
                                    <img style="width:50px; height:50px; object-fit:cover;" src="{{ url('storage/admins/avatar.png') }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $per -> created_at -> diffForHumans() }}</td>
                                <td>
                                    @if($per -> status)
                                        <span class="badge badge-success">Active User</span>
                                        <a href="{{ route('admin.status.update', $per -> id ) }}" class="text-danger"><i class="fa fa-times"></i></a>
                                    @else
                                        <span class="badge badge-danger">Blocked User</span>
                                        <a href="{{ route('admin.status.update', $per -> id ) }}" class="text-success"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                                <td>
                                    {{-- <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> --}}
                                    <a href="{{ route('admin-user.edit', $per -> id ) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.trash.update', $per -> id ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    {{-- <form action="{{ route('admin-user.destroy', $per -> id) }}" class="d-inline delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form> --}}
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
        @if( $form_type == 'create' )
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new Admin</h4>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('admin-user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Cell</label>
                        <input name="cell" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="">Select</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role -> id }}">{{ $role -> name }}</option>
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
        @if( $form_type == 'edit' )
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Edit Admin User</h4>
                <a href="{{ route('admin-user.index') }}">back</a>
            </div>
            <div class="card-body">
                @include('validate')
                <form action="{{ route('admin-user.update', $edit -> id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ $edit -> name }}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" value="{{ $edit -> email }}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Cell</label>
                        <input name="cell" value="{{ $edit -> cell }}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" value="{{ $edit -> username }}" type="text" class="form-control">
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