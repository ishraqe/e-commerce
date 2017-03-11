@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('content')

	<div class="main-content">
        <div class="container-fluid">
          <!-- OVERVIEW -->
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title">Weekly Overview</h3>
              <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="metric">
                    <span class="icon"><i class="fa fa-download"></i></span>
                    <p>
                      <span class="number">1,252</span>
                      <span class="title">Downloads</span>
                    </p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="metric">
                    <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    <p>
                      <span class="number">203</span>
                      <span class="title">Sales</span>
                    </p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="metric">
                    <span class="icon"><i class="fa fa-eye"></i></span>
                    <p>
                      <span class="number">274,678</span>
                      <span class="title">Visits</span>
                    </p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="metric">
                    <span class="icon"><i class="fa fa-bar-chart"></i></span>
                    <p>
                      <span class="number">35%</span>
                      <span class="title">Conversions</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div id="headline-chart" class="ct-chart"></div>
                </div>
                <div class="col-md-3">
                  <div class="weekly-summary text-right">
                    <span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
                    <span class="info-label">Total Sales</span>
                  </div>
                  <div class="weekly-summary text-right">
                    <span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
                    <span class="info-label">Monthly Income</span>
                  </div>
                  <div class="weekly-summary text-right">
                    <span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                    <span class="info-label">Total Income</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END OVERVIEW -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Recent Products</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body no-padding">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product No.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php $index=1; ?>
                      @foreach($product as $p)
                        <tr class="text-center">
                          <th scope="row">{{$index++}}</th>
                          <td>
                            <a href="{{$p->image}}" data-lightbox="{{$p->image}}" id="productImage" data-title="{{$p->title}}" style=" width: 72px; height: 62px;">
                              <img src="{{$p->image}}" style=" width: 72px; height: 62px;">
                            </a>
                            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                                  </div>
                                  <div class="modal-body">
                                    <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>  
                          <td><h4 id="productTitle">{{ucfirst($p->title)}}</h4></td>
                          <td><p id="productDesc">{{ucfirst( implode(' ', array_slice (str_word_count($p->description,2),0,7)))}}</p></td>
                          <td><p id="productPrice">${{ucfirst($p->price)}}</p></td>
                          <td><p id="productCategory">{{ucfirst($p->category->category_name)}}</p></td>
                          <td><p id="productBrand">{{ucfirst($p->brand->brand_name) }}</p></td>
                          <td class="action_button">
                            <div class="interaction">
                              <a class="edit" href="{{action('adminController@showInfo',['id'=>$p->id])}}" id="confirmationCheck">Edit</a>

                              <a class="cart_quantity_delete" id="" href=#><i class="fa fa-times"></i></a>
                            </div>
                            
                          </td>           
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit info</h4>
                      </div>
                      <div class="modal-body">
                          <form>
                            <input type="text" id="productTitle" name="title">
                          </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                </div>
                <div class="panel-footer">
                  <div class="row">
                    <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
                    <div class="col-md-6 text-right"><a href="{{url('/admin/product')}}" class="btn btn-primary">View All Products</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <!-- RECENT PURCHASES -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Recent Purchases</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body no-padding">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Order No.</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date &amp; Time</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#">763648</a></td>
                        <td>Steve</td>
                        <td>$122</td>
                        <td>Oct 21, 2016</td>
                        <td><span class="label label-success">COMPLETED</span></td>
                      </tr>
                      <tr>
                        <td><a href="#">763649</a></td>
                        <td>Amber</td>
                        <td>$62</td>
                        <td>Oct 21, 2016</td>
                        <td><span class="label label-warning">PENDING</span></td>
                      </tr>
                      <tr>
                        <td><a href="#">763650</a></td>
                        <td>Michael</td>
                        <td>$34</td>
                        <td>Oct 18, 2016</td>
                        <td><span class="label label-danger">FAILED</span></td>
                      </tr>
                      <tr>
                        <td><a href="#">763651</a></td>
                        <td>Roger</td>
                        <td>$186</td>
                        <td>Oct 17, 2016</td>
                        <td><span class="label label-success">SUCCESS</span></td>
                      </tr>
                      <tr>
                        <td><a href="#">763652</a></td>
                        <td>Smith</td>
                        <td>$362</td>
                        <td>Oct 16, 2016</td>
                        <td><span class="label label-success">SUCCESS</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  <div class="row">
                    <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
                    <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Purchases</a></div>
                  </div>
                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
            <div class="col-md-6">
              <!-- MULTI CHARTS -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Projection vs. Realization</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <div id="visits-trends-chart" class="ct-chart"></div>
                </div>
              </div>
              <!-- END MULTI CHARTS -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-7">
              <!-- TODO LIST -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">To-Do List</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <ul class="list-unstyled todo-list">
                    <li>
                      <label class="control-inline fancy-checkbox">
                        <input type="checkbox"><span></span>
                      </label>
                      <p>
                        <span class="title">Restart Server</span>
                        <span class="short-description">Dynamically integrate client-centric technologies without cooperative resources.</span>
                        <span class="date">Oct 9, 2016</span>
                      </p>
                      <div class="controls">
                        <a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
                      </div>
                    </li>
                    <li>
                      <label class="control-inline fancy-checkbox">
                        <input type="checkbox"><span></span>
                      </label>
                      <p>
                        <span class="title">Retest Upload Scenario</span>
                        <span class="short-description">Compellingly implement clicks-and-mortar relationships without highly efficient metrics.</span>
                        <span class="date">Oct 23, 2016</span>
                      </p>
                      <div class="controls">
                        <a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
                      </div>
                    </li>
                    <li>
                      <label class="control-inline fancy-checkbox">
                        <input type="checkbox"><span></span>
                      </label>
                      <p>
                        <strong>Functional Spec Meeting</strong>
                        <span class="short-description">Monotonectally formulate client-focused core competencies after parallel web-readiness.</span>
                        <span class="date">Oct 11, 2016</span>
                      </p>
                      <div class="controls">
                        <a href="#"><i class="icon-software icon-software-pencil"></i></a> <a href="#"><i class="icon-arrows icon-arrows-circle-remove"></i></a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- END TODO LIST -->
            </div>
            <div class="col-md-5">
              <!-- TIMELINE -->
              <div class="panel panel-scrolling">
                <div class="panel-heading">
                  <h3 class="panel-title">Recent User Activity</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <ul class="list-unstyled activity-list">
                    <li>
                      <img src="assets/img/user1.png" alt="Avatar" class="img-circle pull-left avatar">
                      <p><a href="#">Michael</a> has achieved 80% of his completed tasks <span class="timestamp">20 minutes ago</span></p>
                    </li>
                    <li>
                      <img src="assets/img/user2.png" alt="Avatar" class="img-circle pull-left avatar">
                      <p><a href="#">Daniel</a> has been added as a team member to project <a href="#">System Update</a> <span class="timestamp">Yesterday</span></p>
                    </li>
                    <li>
                      <img src="assets/img/user3.png" alt="Avatar" class="img-circle pull-left avatar">
                      <p><a href="#">Martha</a> created a new heatmap view <a href="#">Landing Page</a> <span class="timestamp">2 days ago</span></p>
                    </li>
                    <li>
                      <img src="assets/img/user4.png" alt="Avatar" class="img-circle pull-left avatar">
                      <p><a href="#">Jane</a> has completed all of the tasks <span class="timestamp">2 days ago</span></p>
                    </li>
                    <li>
                      <img src="assets/img/user5.png" alt="Avatar" class="img-circle pull-left avatar">
                      <p><a href="#">Jason</a> started a discussion about <a href="#">Weekly Meeting</a> <span class="timestamp">3 days ago</span></p>
                    </li>
                  </ul>
                  <button type="button" class="btn btn-primary btn-bottom center-block">Load More</button>
                </div>
              </div>
              <!-- END TIMELINE -->
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <!-- TASKS -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">My Tasks</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <ul class="list-unstyled task-list">
                    <li>
                      <p>Updating Users Settings <span class="label-percent">23%</span></p>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width:23%">
                          <span class="sr-only">23% Complete</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <p>Load &amp; Stress Test <span class="label-percent">80%</span></p>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <p>Data Duplication Check <span class="label-percent">100%</span></p>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                          <span class="sr-only">Success</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <p>Server Check <span class="label-percent">45%</span></p>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                          <span class="sr-only">45% Complete</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <p>Mobile App Development <span class="label-percent">10%</span></p>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                          <span class="sr-only">10% Complete</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- END TASKS -->
            </div>
            <div class="col-md-4">
              <!-- VISIT CHART -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Website Visits</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <div id="visits-chart" class="ct-chart"></div>
                </div>
              </div>
              <!-- END VISIT CHART -->
            </div>
            <div class="col-md-4">
              <!-- REALTIME CHART -->
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">System Load</h3>
                  <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                  </div>
                </div>
                <div class="panel-body">
                  <div id="system-load" class="easy-pie-chart" data-percent="70">
                    <span class="percent">70</span>
                  </div>
                  <h4>CPU Load</h4>
                  <ul class="list-unstyled list-justify">
                    <li>High: <span>95%</span></li>
                    <li>Average: <span>87%</span></li>
                    <li>Low: <span>20%</span></li>
                    <li>Threads: <span>996</span></li>
                    <li>Processes: <span>259</span></li>
                  </ul>
                </div>
              </div>
              <!-- END REALTIME CHART -->
            </div>
          </div>
        </div>
      </div>

@endsection