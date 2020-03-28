<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Área Restrita</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smooth Sliding Forms template Responsive, Login form web template,Flat Pricing w3tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="/adm/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->

<!-- font-awesome icons -->
<link href="/adm/css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->

</head>
<body>
	<!-- main -->
	<div class="main agileits-w3layouts">
		<h3>Bem Vindo ao Painel Administrativo!</h3>
		<div class="main-agileinfo">
			<div class="agileui-forms">
				<div class="container-form">
					<div class="form-item log-in"><!-- login form-->
						<div class="w3table agileinfo"> 
							<div class="w3table-cell register"> 
								<div class="w3table-tophead">
									<h2>Entrar</h2>
								</div>
								<form action="{{ route('login') }}" method="post">
								{{ csrf_field() }} 
									<div class="fields-grid">
										<div class="styled-input agile-styled-input-top">
											<input id="email" type="email" name="email" required=""> 
											<label>E-Mail</label>
                                @if ($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
										</div>
										<div class="styled-input">
											<input id="password" type="password" name="password" required="">
											<label>Senha</label>
                                @if ($errors->has('password'))
                                    <span>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
										</div>
										<a href="{{ route('password.request') }}">Esqueceu a senha?</a>
										<input type="submit" value="Entrar">
									</div>
{{--									<div class="social-grids">
										<div class="social-text">
											<p>Or Sign in with</p>
										</div>
										<div class="social-icons">
											<ul>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li><a href="#"><i class="fa fa-rss"></i></a></li>
											</ul>
										</div>
										<div class="clear"> </div>
									</div>--}}

								</form>  
							</div>
						</div>
					</div>
					<div class="form-item sign-up"><!-- sign-up form-->
						<div class="w3table w3-agileits">
							<div class="w3table-cell register">   
									<h3>Sign up</h3>
								<form action="{{ route('register') }}" method="post">
									{{ csrf_field() }}
									<div class="fields-grid">
										<div class="styled-input agile-styled-input-top">
											<input id="name" type="text" name="name" value="{{ old('name') }}" required="" autofocus> 
											<label>Name</label>
                                @if ($errors->has('name'))
                                    <span>
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
										</div>
										<div class="styled-input">
											<input id="email" type="email" name="email" value="{{ old('email') }}" required="">
											<label>Email</label>
											<span></span>
										</div>
										<div class="styled-input">
											<input id="password" type="password" name="password" required="">
											<label>Password</label>
                                @if ($errors->has('password'))
                                    <span>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
										</div>
										<div class="styled-input">
											<input type="password" name="password_confirmation" required="">
											<label>Password</label>
											<span></span>
										</div>
										<div class="clear"> </div>
										 <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>I agree to the <a href="#">Terms and Conditions</a></label>
									</div>
									<input type="submit" value="Sign up">
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="container-info">
					<div class="info-w3lsitem">
						<div class="w3table">
							<div class="w3table-cell">
								<p> Tem uma conta? </p>
								<div class="btn"> Entrar </div>
							</div>
						</div>
					</div>
					<div class="info-w3lsitem">
						<div class="w3table">
							<div class="w3table-cell">
								<p> Não tem uma conta?</p>
								<div class="btn">Cadastrar</div>
							</div>
						</div>
					</div>
					<div class="clear"> </div>
				</div>
			</div> 
		</div>	
	</div>   
	<!-- //main -->

	<!-- js -->  
	<script  src=" adm/js/jquery-1.12.3.min.js"></script> 
	<script>
		$(".info-w3lsitem .btn").click(function() {
			  $(".main-agileinfo").toggleClass("log-in");
			});
			$(".container-form .btn").click(function() {
			  $(".main-agileinfo").addClass("active");
		});
	</script>
	<!-- //js --> 
</body>
</html>