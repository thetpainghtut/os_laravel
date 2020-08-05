@extends('frontendtemplate')

@section('title','Home Page')

@section('content')

	<div class="container">

		<!-- Heading Row -->
		<div class="row align-items-center my-5">
			<div class="col-lg-7">
				<img class="img-fluid rounded mb-4 mb-lg-0" src="http://placehold.it/900x400" alt="">
			</div>
			<!-- /.col-lg-8 -->
			<div class="col-lg-5">
				<h1 class="font-weight-light">Business Name or Tagline</h1>
				<p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
				<a class="btn btn-primary" href="#">Call to Action!</a>
			</div>
			<!-- /.col-md-4 -->
		</div>
		<!-- /.row -->

		<!-- Call to Action Well -->
		<div class="card text-white bg-secondary my-5 py-4 text-center">
			<div class="card-body">
				<p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p>
			</div>
		</div>

		<!-- Content Row -->
		<div class="row">
			@foreach($items as $item)
			<div class="col-md-3 mb-5">
				<div class="card h-100">
					<div class="card-body">
						<h4 class="card-title mb-3">{{$item->name}}</h4>
						<img src="{{asset($item->photo)}}" class="img-fluid w-50 mx-auto d-block">
						<p class="card-text mt-3">Price: {{$item->price}} MMK</p>
					</div>
					<div class="card-footer">
						<a href="{{route('itemdetail',$item->id)}}" class="btn btn-primary btn-sm">More Info</a>
						<a href="#" class="btn btn-info btn-sm addtocart" data-id="{{$item->id}}" data-photo="{{asset($item->photo)}}" data-name="{{$item->name}}" data-price="{{$item->price}}">Add To Cart</a>
					</div>
				</div>
			</div>
			@endforeach
			<!-- /.col-md-4 -->
		</div>
		<!-- /.row -->

	</div>


@endsection

@section('script')
	<script type="text/javascript" src="{{asset('frontendtemplate/js/custom.js')}}"></script>
@endsection