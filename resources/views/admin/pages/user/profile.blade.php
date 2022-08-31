	@extends('admin.layouts.app')

    @section('main-section')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            
           @include('admin.layouts.header')
            
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image" src="{{ asset('storage/admins/'. Auth::guard('admin') -> user() -> photo) }}">
                                </a>
                            </div>
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ Auth::guard('admin') -> user() -> name }}</h4>
                                <h6 class="text-muted">{{ Auth::guard('admin') -> user() -> email }}</h6>
                                <div class="user-Cell"><i class="fa fa-phone"></i> {{ Auth::guard('admin') -> user() -> cell }}</div>
                            </div>
                            <div class="col-auto profile-btn">
                                
                                <a href="#" class="btn btn-primary">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                            </li>
                        </ul>
                    </div>	
                    <div class="tab-content profile-tab-cont">
                        
                        <!-- Personal Details Tab -->
                        <div class="tab-pane fade show active" id="per_details_tab">
                        
                            <!-- Personal Details -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span> 
                                                <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-10">{{ Auth::guard('admin') -> user() -> name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                                <p class="col-sm-10">{{ Auth::guard('admin') -> user() -> email }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                                <p class="col-sm-10">{{ Auth::guard('admin') -> user() -> cell }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Edit Details Modal -->
                                    <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document" >
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Personal Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.profile.update') }}" method="POST">
                                                        @csrf
                                                        <div class="row form-row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input name="name" type="text" class="form-control" value="{{ Auth::guard('admin') -> user() -> name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Mobile</label>
                                                                    <input name="cell" type="text" value="{{ Auth::guard('admin') -> user() -> cell }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Edit Details Modal -->
                                    
                                </div>
                            </div>
                            <!-- /Personal Details -->

                        </div>
                        <!-- /Personal Details Tab -->
                        @include('validate')
                        @include('admin.pages.user.password')
                        
                    </div>
                </div>
            </div>
        
        </div>			
    </div>
    <!-- /Page Wrapper -->
        
    @endsection