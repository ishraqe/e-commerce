@extends('layouts.admin')

@section('title')
Edit 
@endsection


@section('content')
<div class="form-container">
	<h1>Edit info:</h1>
	<form action="{{action('adminController@saveProductInfo',[$product->id])}}" method="post">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="title">Title</label>
			<input class="form-control" type="text" name="title" value="{{$product->title}}">
			 @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
		</div>
		<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label>Description </label>
                    
                    <textarea class="form-control" type="text" name="description" > {{$product->description}}</textarea>
                    @if ($errors->has('description'))
                      <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif
        </div>

		<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
			<label>Price</label>
			<input class="form-control price-form" type="number" name="price" value="{{$product->price}}">
			 @if ($errors->has('price'))
              <span class="help-block">
                  <strong>{{ $errors->first('price') }}</strong>
              </span>
            @endif
		</div>
		<div class="form-group ">
			<ul class="user_info">
				<li class="single_field {{ $errors->has('categories') ? ' has-error' : '' }}">
					<label>Category:</label>
					<select name="category_id">
						<option>Select</option>
						@foreach($category as $c)
						<option value="{{$c->id}}">{{$c->category_name}}</option>
						@endforeach
					</select>
					 @if ($errors->has('categories'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('categories') }}</strong>
		              </span>
		            @endif
				</li>
				<li class="single_field {{ $errors->has('brand') ? ' has-error' : '' }}">
					<label>Brand:</label>
					<select name="brand_id">
						<option>Select</option>
						@foreach($brand as $b)
						<option value="{{$b->id}}">{{$b->brand_name}}</option>
						@endforeach
						
					</select>
				 @if ($errors->has('brand'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('brand') }}</strong>
	              </span>
	            @endif
				</li>
			</ul>		
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label>Old image: </label>
					<img class="pro-image" src="{{$product->image}}">
				</div>
				<div class="col-md-6">
					<label>New Image</label>
					<input  type="file" name="image">
					@if ($errors->has('image'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('image') }}</strong>
		              </span>
		            @endif
				</div>
			</div>
		</div>
		<div class="form-group">
			
			<input class="btn btn-primary" type="Submit" name="submit" value="Update">
		</div>
	</form>	

</div>
@endsection