@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('content')

<div class="main-content">
        <div class="container-fluid">
          <h3 class="page-title">Tables</h3>
          <div class="row">
            <div class="col-md-6">
              <!-- BASIC TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title btn btn-info">All users <span class="badge">{{count($users)}}</span></h3>
                </div>
                <div class="panel-body">
                  <table class="table">
                      @if(count($users)>0)
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $u)
                        <tr>
                          <td>1</td>
                          <td>Steve</td>
                          <td>Jobs</td>
                          <td>@steve</td>
                          <td><button>Delete</button></td>
                        </tr>
                        @endforeach
                    @else
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <i class="fa fa-info-circle"></i> No user available
                        </div>

                    @endif  
                    </tbody>
                  </table>
                </div>
                <div class="panel-heading">
                  <a href="{{route('admin.alluser')}}" class="panel-title btn btn-info">See All</a>
                </div>
              </div>
              <!-- END BASIC TABLE -->
            </div>
            <div class="col-md-6">
              <!-- TABLE NO PADDING -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title btn btn-info">Admin List <span class="badge">{{count($admin)}}</span></h3>
                </div>
                <div class="panel-body no-padding">
                  <table class="table">
                   @if(count($admin)>0)
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                      @foreach($admin as $a)
                      <tr>
                        <td>1</td>
                        <td>Steve</td>
                        <td>Jobs</td>
                        <td>@steve</td>
                      </tr>
                      @endforeach

                    @else
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <i class="fa fa-info-circle"></i> No admin available
                        </div>

                    @endif
                    
                    </tbody>
                  </table>
                </div>
                <div class="panel-heading">
                  <a href="{{route('admin.allAdmin')}}" class="panel-title btn btn-info">See All</a>
                </div>
              </div>
              <!-- END TABLE NO PADDING -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- TABLE STRIPED -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title btn btn-info">Reported user <span class="badge">{{count($reported_user)}}</span></h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped">
                     @if(count($reported_user)>0)
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                 
                      @foreach($reported_user as $r)
                      <tr>
                        <td>1</td>
                        <td>Steve</td>
                        <td>Jobs</td>
                        <td>@steve</td>
                      </tr>
                      @endforeach
                    @else
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <i class="fa fa-info-circle"></i> No reported user 
                        </div>

                    @endif
                      
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="panel-heading">
                  <!-- <a class="panel-title btn btn-info">See All</a> -->
                </div>
              </div>
              <!-- END TABLE STRIPED -->
            </div>
            <div class="col-md-6">
              <!-- TABLE HOVER -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title btn btn-info">Pending <span class="badge">{{count($pending)}}</span></h3>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                   @if(count($pending)>0)
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                      @foreach($pending as $p)
                      <tr>
                        <td>1</td>
                        <td>Steve</td>
                        <td>Jobs</td>
                        <td>@steve</td>
                      </tr>
                      @endforeach
                    @else
                        <div class="alert alert-info alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <i class="fa fa-info-circle"></i> No pending request
                        </div>

                    @endif
                      
                    </tbody>
                  </table>
                </div>
                <div class="panel-heading">
                 <!-- <a class="panel-title btn btn-info">See All</a> -->
                </div>
              </div>
              <!-- END TABLE HOVER -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- BORDERED TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Bordered Table</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Steve</td>
                        <td>Jobs</td>
                        <td>@steve</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Simon</td>
                        <td>Philips</td>
                        <td>@simon</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Jane</td>
                        <td>Doe</td>
                        <td>@jane</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END BORDERED TABLE -->
            </div>
            <div class="col-md-6">
              <!-- CONDENSED TABLE -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Condensed Table</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Steve</td>
                        <td>Jobs</td>
                        <td>@steve</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Simon</td>
                        <td>Philips</td>
                        <td>@simon</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Jane</td>
                        <td>Doe</td>
                        <td>@jane</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END CONDENSED TABLE -->
            </div>
          </div>
        </div>
      </div>
@endsection