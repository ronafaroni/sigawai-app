<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light"  data-sidebar-size="lg" data-sidebar-image="none">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Selamat datang di Sistem Kepegawaian Sekolah Bumi Kartini Jepara, platform terintegrasi yang dirancang untuk mengelola dan memantau seluruh data kepegawaian dengan efisien dan akurat. Sistem ini menyediakan berbagai fitur yang membantu dalam pengelolaan administrasi dan sumber daya manusia, sehingga mendukung terciptanya lingkungan kerja yang profesional dan produktif.">
        <meta name="keywords" content="Sistem Informasi, Sigawai, Sekolah, Jepara">

		<title>Sigawai | Sistem Kepegawaian Sekolah Bumi kartini</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('assets/img/logo-small.png') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Font family -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

		<!-- Feather CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
		
		<!-- Datatables CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
		
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/flatpickr/flatpickr.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

		<!-- Layout JS -->
		<script src="{{asset('assets/js/layout.js')}}"></script>

	</head>
	<body>
	
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
			<div class="header header-one">

				{{-- <a href="index.html"  class="d-inline-flex d-sm-inline-flex align-items-center d-md-inline-flex d-lg-none align-items-center device-logo">
					<img src="{{ asset('assets/img/logo.png') }}" class="img-fluid logo2" alt="Logo">
			   </a> --}} 
			   <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none">
				   <div class="logo-white">
					   <a href="#"> 
						   <img src="{{ asset('assets/img/logo.png') }}" width="60%" class="img-fluid logo-blue" alt="Logo">
					   </a>
					   <a href="#">
						   <img src="{{ asset('assets/img/logo.png') }}" width="60%" class="img-fluid logo-small" alt="Logo">
					   </a>
				   </div>
				   <div class="logo-color">
					   <a href="#">
						   <img src="{{ asset('assets/img/logo.png') }}" width="60%" class="img-fluid logo-blue" alt="Logo">
					   </a>
					   <a href="#">
						   <img src="{{ asset('assets/img/logo.png') }}" width="60%" class="img-fluid logo-small" alt="Logo">
					   </a>
				   </div>
			   </div>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fas fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Menu -->
				<ul class="nav nav-tabs user-menu">
					
					<li class="nav-item  has-arrow dropdown-heads ">
                        <a href="javascript:void(0);" class="win-maximize">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </li>
					<!-- User Menu -->
					<li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img src="{{ asset('assets/img/user.png') }}" alt="img" class="profilesidebar">
                                <span class="animate-circle"></span>
                            </span>
                            <span class="user-content">
                                <span class="user-details">{{ Auth::guard('web')->user()->niy }}</span>
								<span class="user-name">{{ Auth::guard('web')->user()->name }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilemenu">
                                <div class="subscription-menu">
                                    <ul>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user-pegawai') }}">Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user-akun') }}">Pengaturan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="subscription-logout"> 
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf 
									</form>
                                    <ul>
                                        <li class="pb-0">
											<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
										</li>
									</ul>
                                </div>
                            </div>
                        </div>
                    </li>
					<!-- /User Menu -->
					
				</ul>
				
				<!-- /Header Menu -->
				
			</div>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<nav class="greedys sidebar-horizantal">
							<ul class="list-inline-item list-unstyled links">
									<li class="menu-title"><span>Main Menu</span></li>
								<li>
									<a href="{{ route('user-dashboard') }}" class="{{ request()->routeIs('user-dashboard') ? 'active' : '' }}"><i class="fe fe-home"></i> <span> Dashboard</span></a>
								</li>
								<li class="submenu">
									<a><i class="fe fe-users"></i> <span> Profile Pegawai</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('user-pegawai') }}" class="{{ request()->routeIs('user-pegawai') ? 'active' : '' }}">Data Pegawai</a></li>
										<li><a href="{{ route('user-status-pegawai') }}" class="{{ request()->routeIs('user-status-pegawai') ? 'active' : '' }}">Status Pegawai</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a><i class="fe fe-calendar"></i> <span> Absensi & Kehadiran</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="{{ route('user-absensi-pegawai') }}" class="{{ request()->routeIs('user-absensi-pegawai') ? 'active' : '' }}">Absensi Pegawai</a></li>
										{{-- <li><a href="{{ route('user-catatan-kehadiran') }}" class="{{ request()->routeIs('user-catatan-kehadiran') ? 'active' : '' }}">Catatan Kehadiran</a></li> --}}
										<li><a href="{{ route('user-pengajuan-izin-cuti') }}" class="{{ request()->routeIs('user-pengajuan-izin-cuti') ? 'active' : '' }}">Pengajuan Izin & Cuti</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a><i class="fe fe-shopping-bag"></i> <span> Penggajian</span> <span class="menu-arrow"></span></a>
									<ul style="display: none;">
										<li><a href="{{ route('user-slip-penggajian') }}" class="{{ request()->routeIs('user-slip-penggajian') ? 'active' : '' }}">Slip Penggajian</a></li>
										<li><a href="{{ route('historis-penggajian') }}" class="{{ request()->routeIs('historis-penggajian') ? 'active' : '' }}">Historis Pengajian</a></li>
									</ul>
								</li>
								<li>
									<a href="{{ route('user-informasi') }}" class="{{ request()->routeIs('user-informasi') ? 'active' : '' }}"><i class="fe fe-bell"></i> <span>Notifikasi & Informasi</span></a>
								</li>						
								<li class="menu-title"><span>Settings</span></li>
								<li>
									<a href="{{ route('user-akun') }}" class="{{ request()->routeIs('user-akun') ? 'active' : '' }}"><i class="fe fe-settings"></i> <span>Pengaturan Akun</span></a>
								</li>						
							</ul>
						</nav>

						<ul class="sidebar-vertical">
							<li class="menu-title"><span>Main Menu</span></li>
							<li>
								<a href="{{ route('user-dashboard') }}" class="{{ request()->routeIs('user-dashboard') ? 'active' : '' }}"><i class="fe fe-home"></i> <span> Dashboard</span></a>
							</li>
							<li class="submenu">
								<a><i class="fe fe-users"></i> <span> Profile Pegawai</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ route('user-pegawai') }}" class="{{ request()->routeIs('user-pegawai') ? 'active' : '' }}">Data Pegawai</a></li>
                                    <li><a href="{{ route('user-status-pegawai') }}" class="{{ request()->routeIs('user-status-pegawai') ? 'active' : '' }}">Status Pegawai</a></li>
								</ul>
							</li>
                            <li class="submenu">
								<a><i class="fe fe-calendar"></i> <span> Absensi & Kehadiran</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{{ route('user-absensi-pegawai') }}" class="{{ request()->routeIs('user-absensi-pegawai') ? 'active' : '' }}">Absensi Pegawai</a></li>
									{{-- <li><a href="{{ route('user-catatan-kehadiran') }}" class="{{ request()->routeIs('user-catatan-kehadiran') ? 'active' : '' }}">Catatan Kehadiaran</a></li> --}}
									<li><a href="{{ route('user-pengajuan-izin-cuti') }}" class="{{ request()->routeIs('user-pengajuan-izin-cuti') ? 'active' : '' }}">Pengajuan Izin & Cuti</a></li>
								</ul>
							</li> 
							<li class="submenu">
								<a><i class="fe fe-shopping-bag"></i> <span> Penggajian</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('user-slip-penggajian') }}" class="{{ request()->routeIs('user-slip-penggajian') ? 'active' : '' }}">Slip Penggajian</a></li>
									<li><a href="{{ route('historis-penggajian') }}" class="{{ request()->routeIs('historis-penggajian') ? 'active' : '' }}">Historis Penggajian</a></li>
								</ul>
							</li>
                            <li>
								<a href="{{ route('user-informasi') }}" class="{{ request()->routeIs('user-informasi') ? 'active' : '' }}"><i class="fe fe-bell"></i> <span>Notifikasi & Informasi</span></a>
							</li>						
							<li class="menu-title"><span>Settings</span></li>
                            <li>
								<a href="{{ route('user-akun') }}" class="{{ request()->routeIs('user-akun') ? 'active' : '' }}"><i class="fe fe-settings"></i> <span>Pengaturan Akun</span></a>
							</li>						
						</ul>
					</div>
				</div>
			</div>
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
				
					@yield('content-user')
					
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->

				<!--Theme Setting -->
				<div class="settings-icon"> 
					<span data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas"><img src="{{asset('assets/img/siderbar-icon2.svg')}}" class="feather-five" alt="layout"></span> 
				</div> 
				<div class="offcanvas offcanvas-end border-0 " tabindex="-1" id="theme-settings-offcanvas"> 
					<div class="sidebar-headerset">
						<div class="sidebar-headersets">
							<h2>Pengaturan Tampilan</h2>
							<h3>Mengatur tampilan halaman</h3>
						</div>
						<div class="sidebar-headerclose">
							<a data-bs-dismiss="offcanvas" aria-label="Close"><img src="{{ asset('assets/img/close.png')}}" alt="img"></a>
						</div>
					</div>
					<div class="offcanvas-body p-0"> 
						<div data-simplebar class="h-100"> 
							<div class="settings-mains"> 
								<div class="layout-head">
									<h5>Tampilan</h5>
									<h6>Mengatur Tampilan</h6>
								</div>
								<div class="row"> 
									<div class="col-4"> 
										<div class="form-check card-radio p-0"> 
											<input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input"> 
											<label class="form-check-label avatar-md w-100" for="customizer-layout01"> 
												<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Menu Atas</h5> 
									</div> 
									<div class="col-4"> 
										<div class="form-check card-radio p-0"> 
										<input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input"> 
											<label class="form-check-label  avatar-md w-100" for="customizer-layout02"> 
												<img src="{{ asset('assets/img/horizontal.png')}}" alt="img">
											</label> 
										</div> 
										<h5 class="fs-13 text-center mt-2">Menu Samping</h5> 
									</div> 
									<div class="d-flex align-items-center justify-content-between pt-3">
								</div>
							<div class="layout-head pt-3">
										<h5>Tampilan Warna</h5>
										<h6>Pilihan warna gelap dan terang.</h6>
									</div>
									<div class="colorscheme-cardradio"> 
										<div class="row"> 
											<div class="col-4">
												<div class="form-check card-radio blue  p-0 "> 
													<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-blue" value="blue"> 
													<label class="form-check-label  avatar-md w-100" for="layout-mode-blue"> 
														<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
													</label> 
												</div> 
												<h5 class="fs-13 text-center mt-2 mb-2">Asli</h5> 
											</div>
										<div class="col-4"> 
											<div class="form-check card-radio p-0"> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-light" value="light"> 
												<label class="form-check-label  avatar-md w-100" for="layout-mode-light"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Terang</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check card-radio dark  p-0 "> 
												<input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-dark" value="dark"> 
												<label class="form-check-label avatar-md w-100 " for="layout-mode-dark"> 
													<img src="{{ asset('assets/img/vertical.png')}}" alt="img">
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2 mb-2">Gelap</h5> 
										</div> 
									</div> 
								</div> 
	
								<div id="sidebar-color"> 
									<div class="layout-head pt-3">
										<h5>Warna Menu</h5>
										<h6>Pilih Warna Menu</h6>
									</div>
									<div class="row"> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
												<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-color-light"> 
													<span class="bg-light bg-sidebarcolor"></span>
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Terang</h5> 
										</div> 
										<div class="col-4"> 
											<div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show"> 
												<input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark"> 
												<label class="form-check-label  avatar-md w-100" for="sidebar-color-dark"> 
													<span class="bg-darks bg-sidebarcolor"></span>
												</label> 
											</div> 
											<h5 class="fs-13 text-center mt-2">Gelap</h5> 
										</div> 

									</div>
									
								</div> 
							</div> 
						</div> 
		
					</div> 
				</div>
				<!-- /Theme Setting -->	
				
		 <!-- Link to jQuery and Bootstrap JS -->
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Datatable JS -->
		<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>

		<!-- select CSS -->
		<script src="{{asset('assets/js/select2.min.js')}}"></script>

        <!-- Select 2 -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
		<script src="{{asset('assets/plugins/select2/js/custom-select.js')}}"></script>
		
		<!-- Feather Icon JS -->
		<script src="{{asset('assets/js/feather.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

		<!-- multiselect JS -->
		<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

		<!-- Theme Settings JS -->
		<script src="{{asset('assets/js/theme-settings.js')}}"></script>
		<script src="{{asset('assets/js/greedynav.js')}}"></script>

		<!-- Fileupload JS -->
		<script src="{{asset('assets/js/file-upload.js')}}"></script>

		<!-- Datepicker Core JS -->
		<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

		<!-- Moment JS -->
		<script src="{{asset('assets/js/moment.min.js')}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

		<!-- Plyr JS -->
		<script src="{{asset('plugins/scrollbar/scrollbar.min.js')}}"></script>
		<script src="{{asset('plugins/scrollbar/custom-scroll.js')}}"></script>
		
		<!-- multiselect JS -->
		<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>

	</body>
</html>