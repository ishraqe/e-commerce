@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')

<div class="main-content">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a href="{{url('/admin/dashboard')}}">Dashborad</a></li>
		  <li class="active"><a href="{{url('/admin/product')}}">Product</a></li>
		</ol>
	</div>
	@include('admin.partials.addProduct')
	@include('admin.product.allProduct')
</div>




@endsection