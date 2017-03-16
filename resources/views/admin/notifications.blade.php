@extends('layouts.admin')

@section('title')
Notifications
@endsection
@section('content')
	<div class="main-content">
		<div class="container-fluid">
			<h3 class="page-title">Notifications</h3>
			<div id="toastr-demo" class="panel">
				<div class="panel-body">
					<div class="list-group">
						@if(count($notification))
							@foreach($notification as $noti)
								@if($noti->product_id==0)
									<a href="{{route('blog.single',['id'=>$noti->blog_id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
										<div class="d-flex w-100 justify-content-between">
											<h5 class="mb-1">{{$noti->name }} commented on your blog</h5>
											<small class="text-muted">{{\Carbon\Carbon::createFromTimeStamp(strtotime($noti->created_at))->diffForHumans()}}</small>
										</div>
									</a>
								@else
									<a href="{{route('show',['id'=>$noti->product_id])}}" class="list-group-item list-group-item-action flex-column align-items-start active">
										<div class="d-flex w-100 justify-content-between">
											<h5 class="mb-1">{{$noti->name }} reviewed on your product</h5>
											<small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($noti->created_at))->diffForHumans()}}</small>
										</div>
									</a>

								@endif
							@endforeach
						@else
							<li><a href="" class="notification-item"><span class="dot bg-info">No notification yet</span></a></li>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
@endsection
