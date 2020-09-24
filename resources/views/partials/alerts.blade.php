@if(session('success'))
<section class="alert-field mt-4 w-100">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="alert alert-success w-100 mb-0" role="alert">
				{!! session('success') !!}
			</div>
		</div>
	</div>
</div>
</section>
@elseif(session('error'))
<section class="alert-field">
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="alert alert-danger" role="alert">
				{!! session('error') !!}
			</div>
		</div>
	</div>
</div>
</section>
@elseif(session('info'))
<section class="alert-field">
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="alert alert-primary" role="alert">
				{!! session('info') !!}
			</div>
		</div>
	</div>
</div>
</section>
@elseif(session('warning'))
<section class="alert-field">
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="alert alert-warning" role="alert">
				{!! session('warning') !!}
			</div>
		</div>
	</div>
</div>
</section>
@endif