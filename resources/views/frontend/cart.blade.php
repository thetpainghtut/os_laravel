@extends('frontendtemplate')

@section('title','Cart Page')

@section('content')
	<div class="container">
		<div class="row my-5">
			<div class="col-md-12">
				<h4 class="text-center mb-3">Cart Page</h4>
 
				<table class="table table-bordered cart-table">
					<thead>
						<tr>
							<th>Name/Photo</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Sub Total</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody id="tbody">
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row mb-3">
			<div class="col-md-12 cart-process">
				<a href="{{route('home')}}" class="btn btn-success float-left">Continue Shopping</a>

				<a href="#" class="btn btn-info checkout float-right">Login to Checkout</a>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript" src="{{asset('frontendtemplate/js/custom.js')}}"></script>
@endsection
