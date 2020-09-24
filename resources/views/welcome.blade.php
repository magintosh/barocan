@extends('layout')

@section('content')
<section class="col-12 home">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<img src="{{ asset('baro_dokuman/logo.png') }}" class="img-fluid mx-auto" style="width:150px">
				<h4>2020</h4>
				<h3>SEÇİM SONUÇLARI</h3>
				<h5>11 EKİM 2020</h5>
			</div>
			<div class="col-12 text-center">
				<div class="groups">
					@foreach($groups as $item)
						<a class="btn-election" href="{{ route('show',[ $item->id]) }}">{{ $item->title }}</a>
					@endforeach
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="footer">
					<a href="https://konyabarosu.org.tr/anasayfa" target="_blank">www.konyabarosu.org.tr</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection