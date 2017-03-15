@extends('layouts.admin')

@section('title')
	{{Auth::user()->name}}
@endsection

@section('content')
<div class="main-content">
	<div class="container-fluid">
		<div class="panel panel-profile">
			<div class="clearfix">
				<!-- LEFT COLUMN -->
				<div class="profile-left">
					<!-- PROFILE HEADER -->
					<div class="profile-header">
						<div class="overlay"></div>
						<div class="profile-main">
							<img src="{{Auth::user()->basicInfo->user_image}}" width="120px" height="60px" class="img-circle" alt="Avatar">
							<h3 class="name">{{Auth::user()->name}}</h3>
							<span class="online-status status-available">Available</span>
						</div>
						<div class="profile-stat">
							<div class="row">
								<div class="col-md-4 stat-item">
									45 <span>Projects</span>
								</div>
								<div class="col-md-4 stat-item">
									15 <span>Awards</span>
								</div>
								<div class="col-md-4 stat-item">
									2174 <span>Points</span>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE HEADER -->
					<!-- PROFILE DETAIL -->
					<div class="profile-detail">
						<div class="profile-info">
							<h4 class="heading">Basic Info</h4>
							<ul class="list-unstyled list-justify">
								<li>Mobile <span>{{Auth::user()->basicInfo->mobile_number}}</span></li>
								<li>Email <span>{{Auth::user()->email}}</span></li>
								<li>Website <span><a href="{{Auth::user()->basicInfo->website}}"  target="_blank">{{Auth::user()->basicInfo->website}}</a></span></li>
							</ul>
						</div>

						<div class="profile-info">
							<h4 class="heading">About</h4>
							<p>{{Auth::user()->basicInfo->about}}</p>
						</div>
						<div class="text-center">
							<button class="btn btn-primary" data-toggle="modal" data-target="#profileEditModal" >Edit basic info</button>
						</div>
					</div>
					<div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<i class="material-icons">clear</i>
									</button>
									<h4 class="modal-title">Edit basic info</h4>
								</div>
								<div class="modal-body">
									@include('admin.profile.edit-profile')
								</div>
								<div class="modal-footer">

									<button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE DETAIL -->
				</div>
				<!-- END LEFT COLUMN -->
				<!-- RIGHT COLUMN -->
				<div class="profile-right">
					<h4 class="heading">{{Auth::user()->name}}'s Awards</h4>
					<!-- AWARDS -->
					{{--<div class="awards">--}}
						{{--<div class="row">--}}
							{{--<div class="col-md-3 col-sm-6">--}}
								{{--<div class="award-item">--}}
									{{--<div class="hexagon">--}}
										{{--<span class="lnr lnr-sun award-icon"></span>--}}
									{{--</div>--}}
									{{--<span>Most Bright Idea</span>--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<div class="col-md-3 col-sm-6">--}}
								{{--<div class="award-item">--}}
									{{--<div class="hexagon">--}}
										{{--<span class="lnr lnr-clock award-icon"></span>--}}
									{{--</div>--}}
									{{--<span>Most On-Time</span>--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<div class="col-md-3 col-sm-6">--}}
								{{--<div class="award-item">--}}
									{{--<div class="hexagon">--}}
										{{--<span class="lnr lnr-magic-wand award-icon"></span>--}}
									{{--</div>--}}
									{{--<span>Problem Solver</span>--}}
								{{--</div>--}}
							{{--</div>--}}
							{{--<div class="col-md-3 col-sm-6">--}}
								{{--<div class="award-item">--}}
									{{--<div class="hexagon">--}}
										{{--<span class="lnr lnr-heart award-icon"></span>--}}
									{{--</div>--}}
									{{--<span>Most Loved</span>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
						{{--<div class="text-center"><a href="#" class="btn btn-default">See all awards</a></div>--}}
					{{--</div>--}}
					<!-- END AWARDS -->
					<!-- TABBED CONTENT -->
					<div class="custom-tabs-line tabs-line-bottom left-aligned">
						<ul class="nav" role="tablist">
							<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent Activity</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab-bottom-left1">
							<ul class="list-unstyled activity-timeline">
								<li>
									<i class="fa fa-comment activity-icon"></i>
									<p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2 minutes ago</span></p>
								</li>
								<li>
									<i class="fa fa-cloud-upload activity-icon"></i>
									<p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New Year Campaign</a> <span class="timestamp">7 hours ago</span></p>
								</li>
								<li>
									<i class="fa fa-plus activity-icon"></i>
									<p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to project repository <span class="timestamp">Yesterday</span></p>
								</li>
								<li>
									<i class="fa fa-check activity-icon"></i>
									<p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1 day ago</span></p>
								</li>
							</ul>
							<div class="margin-top-30 text-center"><a href="#" class="btn btn-default">See all activity</a></div>
						</div>
						
					</div>
					<!-- END TABBED CONTENT -->
				</div>
				<!-- END RIGHT COLUMN -->
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT -->
@endsection

@section('script')
	
	@if(!$errors->editBasicError->isEmpty())
		<script>
            $(function() {
                $('#profileEditModal').modal('show');
            });

		</script>
	@endif


@endsection
