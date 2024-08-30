<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light"  data-sidebar-size="lg" data-sidebar-image="none"> 
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Selamat datang di Sistem Kepegawaian Sekolah Bumi Kartini Jepara, platform terintegrasi yang dirancang untuk mengelola dan memantau seluruh data kepegawaian dengan efisien dan akurat. Sistem ini menyediakan berbagai fitur yang membantu dalam pengelolaan administrasi dan sumber daya manusia, sehingga mendukung terciptanya lingkungan kerja yang profesional dan produktif.">
        <meta name="keywords" content="Sistem Informasi, Sigawai, Sekolah, Jepara" >
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200" >
        <meta property="og:image:height" content="600" >

        <title>Sigawai | Sistem Kepegawaian Sekolah Bumi kartini</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        
        <!-- Font family -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

		<!-- Layout Js -->
		<script src="{{asset('assets/js/layout.js')}}"></script>
	</head>
	<body>
	
		<!-- Main Wrapper -->
		<div class="main-wrapper login-body">
			<div class="login-wrapper">
				<div class="container">
				
					<div class="loginbox">
						
						<div class="login-right">
							<div class="login-right-wrap">
								<h1>Hai, <b>Sigawai.</b></h1>
								<p class="account-subtitle">Login to access your account</p>
								<br>
								@if($errors->any())
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										{{ $errors->first('login_error') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@endif
								<form action="{{route('admin.login')}}" method="POST">
									@csrf
									<div class="input-block mb-3">
										<label class="form-control-label">Username</label>
										<input type="text" name="username" placeholder="Username" value="{{old('username')}}" class="form-control" required>
									</div>
									<div class="input-block mb-3">
										<label class="form-control-label">Password</label>
										<div class="pass-group">
											<input type="password" name="password" placeholder="Password" value="{{old('password')}}" class="form-control pass-input" required>
											<span class="fas fa-eye toggle-password"></span>
										</div>
									</div>
									<div class="input-block mb-3">
										<div class="row">
											<div class="col-6">
												<div class="form-check custom-checkbox">
													<input type="checkbox" class="form-check-input" id="cb1">
													<label class="custom-control-label" for="cb1">Remember me</label>
												</div>
											</div>
											
										</div>
									</div>
									<button class="btn btn-lg  btn-primary w-100" type="submit">Login</button>
									
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Wrapper -->

		<!-- /Theme Setting -->		
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

		<!-- Theme Settings JS -->
		<script src="{{asset('assets/js/theme-settings.js')}}"></script>
		<script src="{{asset('assets/js/greedynav.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>

	</body>
</html>