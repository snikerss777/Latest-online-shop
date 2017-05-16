@extends('app')



@section('styles')

	<link href="{{ asset('/css/uploadImage.css') }}" rel="stylesheet">

@endsection




@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a href="/">Home</a></li>
  		<li><a href="/advertisement/{{$advertisement->id}}">{{$advertisement->name}}</a></li>
  		<li class="active">Dodaj zdjęcia do ogłoszenia</li>

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

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Dodaj zdjęcia do ogłoszenia: {{ $advertisement->name }}</div>
				
				<div class="panel-body" >
					
					@include('errors.user')

					<div id="wrapper">
							

					    <!-- <h1>Dodaj zdjęcia do ogłoszenia (Maksymalnie 8)</h1> -->
					        {!! Form::open([ 'route' => [ 'image.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 
				                	'class' => 'dropzone', 'id' => 'book-image' ]) !!}
					        	<div>
					                	
					            	 <h3>Dodaj zdjęcie</h3>
					        	</div>
					        	<input type="hidden" value="{{$advertisement->id}}" name="advertisement_id">
					        {!! Form::close() !!}
					        
					        <br> <br>

					        <input type="hidden" value="{{count($images)}}" id="count_of_images">

					        @if(count($images))
								<h3>Aktualne zdjęcia:</h3>
								<div>
								@for($i = 0; $i< ceil(count($images) / 3); $i++)
									<div class="row">

											@for($j = $i*3; $j < $i +3; $j++)
												  <div id="img{{$images[$j]->id}}" class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
												  		
												  		<a href="" class="changeIconContainer" data-content="Ustaw to zdjęcie jako ikonę" rel="popover" 
												  			data-placement="top" data-trigger="hover">
												  			<i  class="glyphicon glyphicon-link myIcon" id="changeIcon" onclick="setAsIcon({{$images[$j]->id}})"></i>
												  		</a>
												  		<a href=""class="removePhotoContainer" data-content="Usuń to zdjęcie" rel="popover" 
												  			data-placement="top" data-trigger="hover">
												  			<i  class="glyphicon glyphicon-remove myIcon" id="removeIcon" onclick="removeImage({{$images[$j]->id}})"></i>
												  		</a>
										                <img id="imgId{{$images[$j]->id}}" src="/images/{{$images[$j]->src}}" class="img-responsive @if($advertisement->photo_id == $images[$j]->id) iconImage @endif">
										          </div>
											@endfor
									</div>
								@endfor
								</div>
							@endif
					        <br> <br>


			      	</div>
			      	<br>
			      	
			      	<!-- <button type="submit" class="btn btn-primary" id="submit-all">Przejdź do strony głównej</button> -->


				</div>
			</div>
		</div>

		




	</div>



@endsection




@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<script src="/js/upload.js"></script>

@endsection