@extends('layout')

@section('content')


<div class="col col-md-12 my-4">
	<div class="card">
			<h5 class="card-title">Kullanıcı Girişi</h5>
		<div class="card-body">
			<form method="POST" action="{{ route('login') }}">
				@csrf
				
				<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label text-md-right">Eposta</label>
					<div class="col-md-6">
						<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						
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
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password">
						
						@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-md-6 offset-md-4">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
							
							<label class="form-check-label" for="remember">
								Beni Hatırla
							</label>
						</div>
					</div>
				</div>
				
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary"style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
							Giriş Yap
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>
@endsection
