@extends('admin.layouts.app')

@section('title', 'Role Trash')
@section('main-section')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Roles</h4>
                <a href="{{ route('role.index') }}" class="text-success">Published Roles <i class="fa fa-arrow-right"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 data-table-haq">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $per)
                            <tr>
                                <td>{{ $loop -> index +1 }}</td>
                                <td>{{ $per -> name }}</td>
                                <td>{{ $per -> created_at -> diffForHumans() }}</td>
                                <td>
                                    <ul>
                                        @forelse (json_decode($per -> users) as $role_user)
                                            <li>{{ $role_user -> name }}</li>
                                        @empty
                                            
                                        @endforelse
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('role.trash.update', $per -> id ) }}" class="btn btn-sm btn-info">Restore Role</i></a>
                                    <form action="{{ route('role.destroy', $per -> id) }}" class="d-inline delete-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete Permanently</i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">No records found</td>
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