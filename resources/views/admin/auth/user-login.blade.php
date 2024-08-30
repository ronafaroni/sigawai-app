<!DOCTYPE html>
<html lang="id"> 
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
		<link rel="shortcut icon" href="{{asset('assets/img/logo-small.png')}}">
		
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

<div class="main-wrapper">
    <div class="row m-0 align-items-center bg-white vh-100">
		<div class="col-lg">
            <div class="saas-login-wrapper p-0">
                <div class="login-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-userset">
                            <div class="login-card">
								<div class="text-center">
									<img src="{{asset('assets/img/logo.png')}}" width="50%" alt="" class="img-fluid"><br><br>
									<p class="account-subtitle">Hai, Silahkan login dengan akunmu.</p>
								</div>
								<br>
								@if($errors->any())
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										@foreach ($errors->all() as $error)
											<p>{{ $error }}</p>
										@endforeach
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@endif
                                <div class="input-block mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Anda" autocomplete="off" value="{{ old('username') }}">
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" id="password" class="form-control pass-input" placeholder="Masukkan Password Anda" autocomplete="off" value="{{ old('password') }}">
                                        <span class="fas fa-eye-slash toggle-password"></span>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
		</div>
    </div>
</div>

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