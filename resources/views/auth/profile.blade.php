@extends('layout')

@section('header')
<div class="container px-0 mt-4 d-none d-sm-block header">
	<div class="row">
		<div class="col-sm-6 mt-4">
			<a href="#"><img src="{{ asset('baro_dokuman/logo.png') }}" style="width:150px"></a>
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

<div class="container-fluid">
<div class="row">
<div class="col col-md-12 my-4">
	<div class="card">
		<h5 class="card-title">Grup Listesi</h5>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table sortable-list" data-target="group-sort" data-value="0">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Başlık</th>
							<th scope="col">Grafik</th>
							<th scope="col">Gösterim</th>
							<th scope="col">Toplam Oy</th>
							<th scope="col">Geçersiz Oy</th>
							<th scope="col">Ayar</th>
						</tr>
					</thead>
					<tbody>
					
						@foreach($groups as $item)
						<tr class="sortable-item" id="{{$item->id}}" data-item="{{$item->id}}">
							<form method="POST" action="{{ route('group-update') }}" class="group-form" enctype='multipart/form-data'.>
							@csrf
							<td>
								<input type="hidden" data-id="{{ $item->id }}" name="id" value="{{ $item->id }}">
								{{ $item->id }}
							</td>
							<td>
								<input type="text" name="title" class="form-control group-item" data-id="{{ $item->id }}" value="{{ $item->title }}">
							</td>
							<td>
								<select class="form-control group-item" name="graphic"  data-id="{{ $item->id }}">
								@if($item->graphic == "true")
									<option value="true" selected>Evet</option>
									<option value="false">Hayır</option>
								@else
									<option value="true">Evet</option>
									<option value="false" selected>Hayır</option>
								@endif
								</select>
							</td>
							<td style="width:70px">
								<input type="text" name="show_count" class="form-control group-item" data-id="{{ $item->id }}" value="{{ $item->show_count }}">
							</td>
							<td>
								<input type="number" name="total_rate" class="form-control group-item" data-id="{{ $item->id }}" value="{{ $item->total_rate }}">
							</td>
							<td>
								<input type="number" name="invalid_rate" class="form-control group-item" data-id="{{ $item->id }}" value="{{ $item->invalid_rate }}">
								<input type="submit" name="submit" class="d-none" value="submit">
							</td>
							<td>
								<a class="btn btn-small btn-xs btn-success mx-1" href="{{ route('profile',[ 'group' => $item->id ]) }}">D</a>
								<a class="btn btn-small btn-xs btn-danger mx-1 group-delete" href="{{ route('group-delete',[ 'id' => $item->id ]) }}">S</a>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>

@if(isset($group))

<div class="col col-md-12 my-4">
	<div class="card">
		<h5 class="card-title">{{ $group->title }} Adayları</h5>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table election-table sortable-list" data-target="election-sort" data-value="0">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">#</th>
							<th scope="col">Ad</th>
							<th scope="col">Detay</th>
							<th scope="col">1</th>
							<th scope="col">2</th>
							<th scope="col">3</th>
							<th scope="col">4</th>
							<th scope="col">5</th>
							<th scope="col">6</th>
							<th scope="col">7</th>
							<th scope="col">8</th>
							<th scope="col">9</th>
							<th scope="col">10</th>
							<th scope="col">11</th>
							<th scope="col">12</th>
							<th scope="col">13</th>
							<th scope="col">14</th>
							<th scope="col">15</th>
							<th scope="col">16</th>
							<th scope="col">17</th>
							<th scope="col">18</th>
							<th scope="col">19</th>
							<th scope="col">20</th>
							<th scope="col">#</th>
							<th scope="col">#</th>
						</tr>
					</thead>
					<tbody>
					
						@foreach($elections as $item)
						<tr class="sortable-item" id="{{$item->id}}" data-item="{{$item->id}}">
							<form method="POST" action="{{ route('election-update') }}" class="election-form" enctype='multipart/form-data'.>
							@csrf
							<td style="width:100px">
								<div class="image-upload">
									<input type="hidden" data-id="{{ $item->group_id }}" name="group_id" value="{{ $item->group_id }}">
									<input type="hidden" data-id="{{ $item->id }}" name="id" value="{{ $item->id }}">
									<input type="file" name="image" class="uploader election-item" data-id="{{ $item->id }}">
									<img src="{{ $item->image==null ? asset('uploads/null.jpg') : asset($item->image) }}" data-image="{{ $item->id }}" style="width:100px;height:auto">
								</div>
							</td>
							<td>
								<input type="text" name="color" class="color-picker form-control election-item" data-id="{{ $item->id }}" value="{{ $item->color }}">
							</td>
							<td>
								<input type="text" name="title" class="form-control election-item" data-id="{{ $item->id }}" value="{{ $item->title }}">
							</td>
							<td>
								<input type="text" name="detail" class="form-control election-item" data-id="{{ $item->id }}" value="{{ $item->detail }}">
							</td>
							<td>
								<input type="text" name="rate1" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate1 }}">
							</td>
							<td>
								<input type="text" name="rate2" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate2 }}">
							</td>
							<td>
								<input type="text" name="rate3" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate3 }}">
							</td>
							<td>
								<input type="text" name="rate4" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate4 }}">
							</td>
							<td>
								<input type="text" name="rate5" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate5 }}">
							</td>
							<td>
								<input type="text" name="rate6" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate6 }}">
							</td>
							<td>
								<input type="text" name="rate7" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate7 }}">
							</td>
							<td>
								<input type="text" name="rate8" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate8 }}">
							</td>
							<td>
								<input type="text" name="rate9" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate9 }}">
							</td>
							<td>
								<input type="text" name="rate10" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate10 }}">
							</td>
							<td>
								<input type="text" name="rate11" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate11 }}">
							</td>
							<td>
								<input type="text" name="rate12" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate12 }}">
							</td>
							<td>
								<input type="text" name="rate13" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate13 }}">
							</td>
							<td>
								<input type="text" name="rate14" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate14 }}">
							</td>
							<td>
								<input type="text" name="rate15" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate15 }}">
							</td>
							<td>
								<input type="text" name="rate16" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate16 }}">
							</td>
							<td>
								<input type="text" name="rate17" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate17 }}">
							</td>
							<td>
								<input type="text" name="rate18" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate18 }}">
							</td>
							<td>
								<input type="text" name="rate19" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate19 }}">
							</td>
							<td>
								<input type="text" name="rate20" class=" election-item" data-id="{{ $item->id }}" value="{{ $item->rate20 }}">
							</td>
							<td>
								<input type="submit" name="submit" class="d-none" value="submit">
								<a class="btn btn-small btn-xs btn-danger mx-1 election-delete" href="{{ route('election-delete',[ 'id' => $item->id ]) }}">S</a>
							</td>
							<td>
								<a class="btn btn-small btn-xs btn-primary mx-1 election-clone" href="{{ route('election-clone',[ 'id' => $item->id ]) }}">C</a>
							</td>
							</form>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>

<div class="col col-md-12 my-4">
	<div class="card">
		<h5 class="card-title">Aday Ekle</h5>
		<div class="card-body">
			<form method="POST" action="{{ route('election-create') }}" enctype='multipart/form-data'.>
				@csrf
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label for="title" class="col-form-label text-md-right">Ad Soyad</label>
							<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required>
							
							@if ($errors->has('title'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="detail" class="col-form-label text-md-right">Detay</label>
							<input id="detail" type="text" class="form-control{{ $errors->has('detail') ? ' is-invalid' : '' }}" name="detail" >
							
							@if ($errors->has('detail'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('detail') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="image" class="col-form-label text-md-right">Resim</label>
							<input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
							@if ($errors->has('image'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							<label for="color" class="col-form-label text-md-right">Renk</label><br>
							<input id="color" type="text" class="color-picker form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" >
							
							@if ($errors->has('color'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('color') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate1" class="col-form-label text-md-right">1</label>
							<input id="rate1" type="number" value="0"class="form-control{{ $errors->has('rate1') ? ' is-invalid' : '' }}" required name="rate1" >
							
							@if ($errors->has('rate1'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate1') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate2" class="col-form-label text-md-right">2</label>
							<input id="rate2" type="number" value="0"class="form-control{{ $errors->has('rate2') ? ' is-invalid' : '' }}" required name="rate2" >
							
							@if ($errors->has('rate2'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate2') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate3" class="col-form-label text-md-right">3</label>
							<input id="rate3" type="number" value="0"class="form-control{{ $errors->has('rate3') ? ' is-invalid' : '' }}" required name="rate3" >
							
							@if ($errors->has('rate3'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate3') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate4" class="col-form-label text-md-right">4</label>
							<input id="rate4" type="number" value="0"class="form-control{{ $errors->has('rate4') ? ' is-invalid' : '' }}" required name="rate4" >
							
							@if ($errors->has('rate4'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate4') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate5" class="col-form-label text-md-right">5</label>
							<input id="rate5" type="number" value="0"class="form-control{{ $errors->has('rate5') ? ' is-invalid' : '' }}" required name="rate5" >
							
							@if ($errors->has('rate5'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate5') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate6" class="col-form-label text-md-right">6</label>
							<input id="rate6" type="number" value="0"class="form-control{{ $errors->has('rate6') ? ' is-invalid' : '' }}" required name="rate6" >
							
							@if ($errors->has('rate6'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate6') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate7" class="col-form-label text-md-right">7</label>
							<input id="rate7" type="number" value="0"class="form-control{{ $errors->has('rate7') ? ' is-invalid' : '' }}" required name="rate7" >
							
							@if ($errors->has('rate7'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate7') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate8" class="col-form-label text-md-right">8</label>
							<input id="rate8" type="number" value="0"class="form-control{{ $errors->has('rate8') ? ' is-invalid' : '' }}" required name="rate8" >
							
							@if ($errors->has('rate8'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate8') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate9" class="col-form-label text-md-right">9</label>
							<input id="rate9" type="number" value="0"class="form-control{{ $errors->has('rate9') ? ' is-invalid' : '' }}" required name="rate9" >
							
							@if ($errors->has('rate9'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate9') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate10" class="col-form-label text-md-right">10</label>
							<input id="rate10" type="number" value="0"class="form-control{{ $errors->has('rate10') ? ' is-invalid' : '' }}" required name="rate10" >
							
							@if ($errors->has('rate10'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate10') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate11" class="col-form-label text-md-right">11</label>
							<input id="rate11" type="number" value="0"class="form-control{{ $errors->has('rate11') ? ' is-invalid' : '' }}" required name="rate11" >
							
							@if ($errors->has('rate11'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate11') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate12" class="col-form-label text-md-right">12</label>
							<input id="rate12" type="number" value="0"class="form-control{{ $errors->has('rate12') ? ' is-invalid' : '' }}" required name="rate12" >
							
							@if ($errors->has('rate12'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate12') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate13" class="col-form-label text-md-right">13</label>
							<input id="rate13" type="number" value="0"class="form-control{{ $errors->has('rate13') ? ' is-invalid' : '' }}" required name="rate13" >
							
							@if ($errors->has('rate13'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate13') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate14" class="col-form-label text-md-right">14</label>
							<input id="rate14" type="number" value="0"class="form-control{{ $errors->has('rate14') ? ' is-invalid' : '' }}" required name="rate14" >
							
							@if ($errors->has('rate14'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate14') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate15" class="col-form-label text-md-right">15</label>
							<input id="rate15" type="number" value="0"class="form-control{{ $errors->has('rate15') ? ' is-invalid' : '' }}" required name="rate15" >
							
							@if ($errors->has('rate15'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate15') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate16" class="col-form-label text-md-right">16</label>
							<input id="rate16" type="number" value="0"class="form-control{{ $errors->has('rate16') ? ' is-invalid' : '' }}" required name="rate16" >
							
							@if ($errors->has('rate16'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate16') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate17" class="col-form-label text-md-right">17</label>
							<input id="rate17" type="number" value="0"class="form-control{{ $errors->has('rate17') ? ' is-invalid' : '' }}" required name="rate17" >
							
							@if ($errors->has('rate17'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate17') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate18" class="col-form-label text-md-right">18</label>
							<input id="rate18" type="number" value="0"class="form-control{{ $errors->has('rate18') ? ' is-invalid' : '' }}" required name="rate18" >
							
							@if ($errors->has('rate18'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate18') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate19" class="col-form-label text-md-right">19</label>
							<input id="rate19" type="number" value="0"class="form-control{{ $errors->has('rate19') ? ' is-invalid' : '' }}" required name="rate19" >
							
							@if ($errors->has('rate19'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate19') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							<label for="rate20" class="col-form-label text-md-right">20</label>
							<input id="rate20" type="number" value="0"class="form-control{{ $errors->has('rate20') ? ' is-invalid' : '' }}" required name="rate20" >
							
							@if ($errors->has('rate20'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('rate20') }}</strong>
							</span>
							@endif
						</div>
					</div>
				</div>
				
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4">
						<input type="hidden" name="group_id" value="{{ $group->id }}">
						<button type="submit" class="btn btn-primary"style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
							Kaydet
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>
@else
	

<div class="col col-md-12 my-4">
	<div class="card">
		<h5 class="card-title">Hesap Ayarları</h5>
		<div class="card-body">
			<form method="POST" action="{{ route('profile-update') }}">
				@csrf
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
				
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary"style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
							Kaydet
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>


<div class="col col-md-12 my-4">
	<div class="card">
		<h5 class="card-title">Grup Ekle</h5>
		<div class="card-body">
			<form method="POST" action="{{ route('group-create') }}">
				@csrf
				<div class="form-group row">
					<label for="title" class="col-md-4 col-form-label text-md-right">Başlık</label>
					
					<div class="col-md-6">
						<input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required autocomplete="current-password">
						
						@if ($errors->has('title'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label for="total_rate" class="col-md-4 col-form-label text-md-right">Toplam Oy Sayısı</label>
					
					<div class="col-md-6">
						<input id="total_rate" type="number" class="form-control{{ $errors->has('total_rate') ? ' is-invalid' : '' }}" name="total_rate" required autocomplete="current-password">
						
						@if ($errors->has('total_rate'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('total_rate') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label for="show_count" class="col-md-4 col-form-label text-md-right">Gösterim Adedi</label>
					
					<div class="col-md-6">
						<input id="show_count" value="6" type="number" class="form-control{{ $errors->has('total_rate') ? ' is-invalid' : '' }}" name="show_count" required autocomplete="current-password">
						
						@if ($errors->has('show_count'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('show_count') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label for="graphic" class="col-md-4 col-form-label text-md-right">Grafik</label>
					<div class="col-md-6">
						<select class="form-control group-item" id="graphic" name="graphic" data-id="{{ $item->id }}">
							<option value="true">Evet</option>
							<option value="false">Hayır</option>
						</select>
						@if ($errors->has('graphic'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('graphic') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label for="invalid_rate" class="col-md-4 col-form-label text-md-right">Geçersiz Oy Sayısı</label>
					
					<div class="col-md-6">
						<input id="invalid_rate" type="number" class="form-control{{ $errors->has('invalid_rate') ? ' is-invalid' : '' }}" name="invalid_rate" required autocomplete="current-password">
						
						@if ($errors->has('invalid_rate'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('invalid_rate') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4">
						<button type="submit" class="btn btn-primary"style=" color: #fff; padding: 5px 20px; border: none; margin: 10px; ">
							Kaydet
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>
</div>	
</div>
@endif
	
@endsection
