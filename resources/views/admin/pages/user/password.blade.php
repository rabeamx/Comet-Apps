<!-- Change Password Tab -->

<div id="password_tab" class="tab-pane fade">
                        
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Change Password</h5>
            <div class="row">
                <div class="col-md-10 col-lg-6">
                    <form action="{{ route('admin.password.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input name="old_pass" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input name="pass" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input name="pass_confirmation" type="password" class="form-control">
                        </div>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- /Change Password Tab -->