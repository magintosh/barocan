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
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif
							
							<form method="POST" action="{{ route('password.email') }}">
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
								
								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary" style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
											Sıfırlama BağlantısıGönder
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
