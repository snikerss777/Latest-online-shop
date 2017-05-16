@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/adminProducts.css">
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Lista produktów</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
    @endif


@endsection

@section('content')

	<div class="row" >

		@include('menus.adminMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Lista produktów</div>
				
				<div class="panel-body" >
				@if(count($advertisements) == 0)
				    <div class="alert alert-info alert-dismissable">
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    	Brak nowych zamówień
				    </div>
				@else	
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Id</th>
								<th>Nazwa</th>
								<th>Liczba egzemplarzy</th>	
								<th>Cena</th>
								<th>Akcje</th>
							</tr>
						</thead>

						<tbody>
						
							@foreach($advertisements as $advertisement)
								<tr @if($advertisement->number_of_copies == 0) class="danger" @endif>
									<td class="imageTd"><image @if($advertisement->src != null) src="/images/{{$advertisement->src}}" @else src="/images/defaultIcon.png" @endif></td>
									<td onclick="clickRow({{$advertisement->id}})">{{$advertisement->id}}</td>
									<td onclick="clickRow({{$advertisement->id}})">{{ $advertisement->name }}</td>
									<td onclick="clickRow({{$advertisement->id}})">{{$advertisement->number_of_copies}}</td>
									<td onclick="clickRow({{$advertisement->id}})">{{ number_format($advertisement->price, 2, ',', ' ') }} zł</td>
									<!-- <td><i class="glyphicon glyphicon-th-list" onclick=""></i></td> -->
									<td>
										<div class="dropdown">
										  <i class="glyphicon glyphicon-th-list dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										    
										  </i>
										  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										    <li><a href="/advertisement/edit/{{$advertisement->id}}">Edytuj dane</a></li>
										    <li><a href="/upload/{{$advertisement->id}}">Zarządzaj zdjęciami</a></li>
										    <li><a href="/advertisement/destroy/{{$advertisement->id}}/3">Usuń produkt</a></li>
										  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

				
				@endif

				</div>
			</div>

			<div class="row">
							
				<div class="col-sm-12" style="text-align:center;">
					{!! $advertisements->render() !!}
				</div>
			</div>

		</div>
	</div>

@endsection



@section('scripts')

<script type="text/javascript" src="/js/adminProducts.js"></script>

@endsection