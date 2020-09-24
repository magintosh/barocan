@extends('layout')

@section('header')
<div class="container px-0 mt-4 d-none d-sm-block header">
	<div class="row">
		<div class="col-sm-6 mt-4">
			<a href="../"><img src="{{ asset('baro_dokuman/logo.png') }}" style="width:150px"></a>
		</div>
		<div class="col-sm-6 text-center">
			<h4>2020</h4>
			<h3>SEÇİM SONUÇLARI</h3>
			<h5>11 EKİM 2020</h5>
		</div>
	</div>
</div>
<div class="container px-0">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand d-sm-none" href="#"><img src="{{ asset('baro_dokuman/logo.png') }}" style="width:150px"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				@foreach($groups as $item)
				<li class="nav-item">
					<a class="nav-link" href="{{ route('show',[ $item->id]) }}">{{ $item->title }}</a>
				</li>
				@endforeach
				@auth
				<li class="nav-item">
					<a class="nav-link" href="{{ route('profile',['group'=>'home']) }}">Ayarlar</a>
				</li>
				<li class="nav-item ">
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Çıkış Yap</a>
				</li>
				@endauth
			</ul>
		</div>
	</nav>
</div>
@endsection
@section('sub_content')

<div class="sub-background" >
	<div class="container">
		<div class="row">
			<input type="hidden" id="group_ids" value="{{ $group_ids }}">
			<div class="col-12">
				<div class="page-header">
					<label id="title">SEÇİM SONUÇLARI</label>
				</div>
			</div>
			<div class="col-12 col-sm-6 elections-field" id="list">
				<div class="elections">
					<div class="row election-items justify-content-center"></div>
				</div>
			</div>
			<div class="col-12 col-sm-6" id="graphic">
				<div id="chartContainer" style="height: 370px; max-width: 100%; margin: 0px auto;"></div>
			</div>
		</div>
	</div>
    
    <div class="mt-4" style="background: #ebedec;">
    	<div class="container">
    		<div class="row">
    			<div class="col-12" id="table">
    				<div class="elections-result">
    					<div class="title">
    						<label>SANDIK SONUÇLARI</label>
    					</div>
    					<div class="table-responsive">
    						<table class="table elections-table" >
    							<thead>
    								<tr>
    									<th colspan="2" class="text-right">SANDIK NO</th>
    									<th scope="col">-1-</th>
    									<th scope="col">-2-</th>
    									<th scope="col">-3-</th>
    									<th scope="col">-4-</th>
    									<th scope="col">-5-</th>
    									<th scope="col">-6-</th>
    									<th scope="col">-7-</th>
    									<th scope="col">-8-</th>
    									<th scope="col">-9-</th>
    									<th scope="col">-10-</th>
    									<th scope="col">-11-</th>
    									<th scope="col">-12-</th>
    									<th scope="col">-13-</th>
    									<th scope="col">-14-</th>
    									<th scope="col">-15-</th>
    									<th scope="col">-16-</th>
    									<th scope="col">-17-</th>
    									<th scope="col">-18-</th>
    									<th scope="col">-19-</th>
    									<th scope="col">-20-</th>
    									<th scope="col">TOPLAM</th>
    								</tr>
    							</thead>
    							<tbody id="elections-list">
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<div class="text-center footer">
				<a href="http://konyabarosu.org.tr/anasayfa" target="_blank">www.konyabarosu.org.tr</a><a>
			</a></div>
<script id="templateList" type="text/x-jquery-tmpl">
<tr style="background-color:${color}">
	<td>${counter}</td>
	<td style="background-color:${color}">${title}</td>
	<td>${rate1}</td>
	<td>${rate2}</td>
	<td>${rate3}</td>
	<td>${rate4}</td>
	<td>${rate5}</td>
	<td>${rate6}</td>
	<td>${rate7}</td>
	<td>${rate8}</td>
	<td>${rate9}</td>
	<td>${rate10}</td>
	<td>${rate11}</td>
	<td>${rate12}</td>
	<td>${rate13}</td>
	<td>${rate14}</td>
	<td>${rate15}</td>
	<td>${rate16}</td>
	<td>${rate17}</td>
	<td>${rate18}</td>
	<td>${rate19}</td>
	<td>${rate20}</td>
	<td>${total}</td>
</tr>
</script>
<script id="template" type="text/x-jquery-tmpl">
	<div class="col-sm-4 item-field">
		<div class="item" style="background-color:${color}">
			<div class="row">
				<div class="col-5">
					<div class="image">
						<img src="../${image}">
					</div>
					<div class="clearfix"></div>
					<div class="d-none d-sm-block">
					    <label class="percent">%${percent}</label>
					</div>
				</div>
				<div class="col-7 pl-sm-0">
			    	<div class="info">
    					<h4 class="title">${title}</h4>
    					<h5 class="sub-title">${detail}</h5>
    				</div>
					<div class="clearfix"></div>
					<div class="d-sm-none">
					    <label class="percent">%${percent}</label>
					</div>
					<div class="clearfix"></div>
					<label class="rate-title">TOPLAM OY</label>
					<div class="clearfix"></div>
					<label class="rate-field">${total}</label>
				</div>
			</div>
		</div>
	</div>
			
</script>
<script id="templateCol" type="text/x-jquery-tmpl">
	<div class="col-sm-6 item-field">
		<div class="item" style="background-color:${color}">
			<div class="row">
				<div class="col-5">
					<div class="image">
						<img src="../${image}">
					</div>
					<div class="clearfix"></div>
					<div class="d-none d-sm-block">
					    <label class="percent">%${percent}</label>
					</div>
				</div>
				<div class="col-7 pl-sm-0">
			    	<div class="info">
    					<h4 class="title">${title}</h4>
    					<h5 class="sub-title">${detail}</h5>
    				</div>
					<div class="clearfix"></div>
					<div class="d-sm-none">
					    <label class="percent">%${percent}</label>
					</div>
					<div class="clearfix"></div>
					<label class="rate-title">TOPLAM OY</label>
					<div class="clearfix"></div>
					<label class="rate-field">${total}</label>
			</div>
		</div>
	</div>
			
</script>

@endsection