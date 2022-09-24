			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">   
								<span>Main</span>
							</li>
							<li> 
								<a href="{{ route('admin.dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							@if(in_array('Slider', json_decode(Auth::guard('admin') -> user() -> role -> permissions) )) 
							<li> 
								<a href="{{ route('sliders.index') }}"><i class="fe fe-home"></i> <span>Slider</span></a>
							</li>
							@endif
							@if(in_array('Testimonials', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="{{ route('testimonial.index') }}"><i class="fe fe-home"></i> <span>Testimonials</span></a>
							</li>
							@endif
							@if(in_array('Our Clients', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="{{ route('client.index') }}"><i class="fe fe-home"></i> <span>Our Clients</span></a>
							</li>
							@endif
							@if(in_array('Counter', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="{{ route('counter.index') }}"><i class="fe fe-home"></i> <span>Counter</span></a>
							</li>
							@endif
							@if(in_array('Portfolio', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
									<li><a href="{{ route('portfolio-category.index') }}">Category</a></li>
									
								</ul>
							</li>
							@endif
							@if(in_array('Our Team', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="#"><i class="fe fe-home"></i> <span>Our Team</span></a>
							</li>
							@endif
							@if(in_array('Posts', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Posts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="invoice-report.html">All posts</a></li>
									<li><a href="invoice-report.html">Category</a></li>
									<li><a href="invoice-report.html">Tags</a></li>
								</ul>
							</li>
							@endif
							@if(in_array('Admin Options', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li class="menu-title"> 
								<span>Admin Options</span>
							</li>
							@endif
							@if(in_array('Admin User', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Admin User</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('admin-user.index') }}">Users</a></li>
									<li><a href="{{ route('role.index') }}">Role</a></li>
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
								</ul>
							</li>
							@endif
							@if(in_array('Theme Options', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="#"><i class="fe fe-home"></i> <span>Theme Options</span></a>
							</li>
							@endif
							@if(in_array('Settings', json_decode(Auth::guard('admin') -> user() -> role -> permissions) ))
							<li> 
								<a href="#"><i class="fe fe-home"></i> <span>Settings</span></a>
							</li>
							@endif
							
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->