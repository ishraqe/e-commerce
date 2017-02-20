<!doctype html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/vendor/icon-sets.css">
  <link rel="stylesheet" href="/assets/css/main.min.css">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="/assets/css/demo.css">
  <link rel="stylesheet" type="text/css" href="/lightbox/lightbox.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="brand">
        <a href="index.html"><img src="/assets/img/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
      </div>
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="{{url('admin/dashboard')}}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
            <li><a href="elements.html" class=""><i class="lnr lnr-code"></i> <span>Elements</span></a></li>
            <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
            <li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
            <li><a href="{{url('/admin/product')}}" class=""><i class="lnr lnr-alarm"></i> <span>Products</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>User</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Orders</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Review</span></a></li>
            <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Blog</span></a></li>
            <li>
              <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="subPages" class="collapse ">
                <ul class="nav">
                  <li><a href="page-profile.html" class="">Profile</a></li>
                  <li><a href="page-login.html" class="">Login</a></li>
                  <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
                </ul>
              </div>
            </li>
            <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
            <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
            <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- MAIN -->
    <div class="main">
      <!-- NAVBAR -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
              <span class="sr-only">Toggle Navigation</span>
              <i class="fa fa-bars icon-nav"></i>
            </button>
          </div>
          <div id="navbar-menu" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left hidden-xs">
              <div class="input-group">
                <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                  <i class="lnr lnr-alarm"></i>
                  <span class="badge bg-danger">5</span>
                </a>
                <ul class="dropdown-menu notifications">
                  <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
                  <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
                  <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
                  <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
                  <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
                  <li><a href="#" class="more">See all notifications</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Help</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Basic Use</a></li>
                  <li><a href="#">Working With Data</a></li>
                  <li><a href="#">Security</a></li>
                  <li><a href="#">Troubleshooting</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/assets/img/user.png" class="img-circle" alt="Avatar"> <span>{{Auth::user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('/admin/profile')}}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                  <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                  <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                  <li><a href="{{url('/admin/logout')}}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- END NAVBAR -->
      <!-- MAIN CONTENT -->
       @if(Session::has('update_confirmation'))
       
       <button type="button" class="btn btn-success btn-toastr"  data-context="success" data-message="This is success info" data-position="top-right">{{Session::get('update_confirmation')}}</button>
      @elseif(Session::has('delete_confirmation'))
         <button type="button" class="btn btn-success btn-toastr-callback" id="toastr-callback1" data-context="info" data-position="top-right" data-message="onShown and onHidden callback demo">{{Session::get('delete_confirmation')}}
         </button>
      @elseif(Session::has('added_confirmation'))
         <div class="alert alert-success flash" id="#flash">{{Session::get('added_confirmation')}}</div>
      @endif
     @yield('content') 
     
      <!-- END MAIN CONTENT -->
      <footer>
        <div class="container-fluid">
          <p class="copyright">&copy; 2016. Designed &amp; Crafted by <a href="https://themeineed.com">The Develovers</a></p>
        </div>
      </footer>
    </div>
    <!-- END MAIN -->
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="/assets/js/jquery/jquery-2.1.0.min.js"></script>
  <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
  <script src="/assets/js/plugins/chartist/chartist.min.js"></script>
  <script src="/assets/js/klorofil.min.js"></script>
  <script src="/assets/js/plugins/toastr/toastr.min.js"></script>
  <script src="/lightbox/lightbox.js"></script>
  <script>
  // $(document).ready(function(){
  //     $('.btn-toastr').delay(3000).slideUp(300);
  //     console.log('hello');
  //  });


</script>
<script type="text/javascript">
  $("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>

<script type="text/javascript">
  $("#confirmationCheck").on("click", function() {
   // here asign the image to the modal when the user click the enlarge link
   $('#confirmationmodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>

</body>

</html>