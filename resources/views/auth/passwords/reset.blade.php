@extends('system.app')

@section('content')


<section class="blog-pg-section blog-with-left-sidebar section-padding">
	<div class="container">
		<div class="row">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">Şifre Sıfırlama</div>
						
						<div class="panel-body">
							<form method="POST" action="{{ route('password.update') }}">
								@csrf
								
								<input type="hidden" name="token" value="{{ $token }}">
								
								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">Eposta</label>
									
									<div class="col-md-6">
										<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
										
										@if ($errors->has('email'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
										@endif
									</div>
								</div>
								
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">Şifre</label>
									
									<div class="col-md-6">
										<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">
										
										@if ($errors->has('password'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
									</div>
								</div>
								
								<div class="form-group row">
									<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Şifre Yeniden</label>
									
									<div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
									</div>
								</div>
								
								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary" style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
											Sıfırla
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
