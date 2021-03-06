
<!doctype html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/vendor/icon-sets.css">
  <link rel="stylesheet" href="/assets/css/main.min.css">

  <link rel="stylesheet" href="/assets/css/demo.css">
  <link rel="stylesheet" type="text/css" href="/lightbox/lightbox.css">
 <link rel="stylesheet" href="/assets/css/dropzone.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">

  <script src="/assets/js/jquery/jquery-2.1.0.min.js"></script>
  <script src="/assets/handlebars-v4.0.5.js"></script>
  <script src="/assets/js/handelBarhelper.js" ></script>
  <script type="text/javascript" src="/assets/js/chart.js"></script>
  <link rel="stylesheet" href="/assets/css/flatpicker.css">
  <script src="/assets/js/flatpicker.js"></script>
 

  @yield('head-script')
  @yield('style')


</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar">
      <div class="brand">
        <a href="{{url('/admin/dashboard')}}">Artisan's Story</a>
      </div>
      <div class="sidebar-scroll">
        <nav>
          @include('admin.partials.nav')
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
              <li>
                <a href="{{route('admin.to-do')}}" onclick="makeTodoRead(this)" class=" icon-menu"  alt="to do">
                  <i class="fa fa-bars" aria-hidden="true"></i>
                  <span class="badge bg-danger">{{count($todoNoti)}}</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>

                  <span class="badge bg-danger">{{count($message)}}</span>
                </a>
                <ul class="dropdown-menu notifications">

                @foreach($message as $m)
                    <?php 
                      
                      $users = DB::table('users')->where('id',$m->sender_id )->get();
                      
                      foreach ($users as $user) { ?>
                  <li>
                    <a href="#" class="notification-item">
                    <span class="dot bg-success">
                    </span>
                    <?= $user->name;  ?> Sent you a message
                    </a>
                  </li>
                    <?php } ?>
                @endforeach 
                  <li><a href="{{route('admin.messages')}}" class="more">See all messages</a></li>
                </ul>
              </li>
              <li class="dropdown" id="noti-holder"  onclick="makeNotificationRead(this)">
                <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                  <i class="lnr lnr-alarm"></i>
                  <span class="badge bg-danger">{{count($notification)}}</span>
                </a>
                <ul class="dropdown-menu notifications" onclick="makeNotificationRead(this)">
                  @if(count($notification))
                      @foreach($notification as $noti)
                          @if($noti->product_id==0)

                             <li><a href="{{route('blog.single',['id'=>$noti->blog_id])}}" class="notification-item"><span class="dot bg-info">{{$noti->name }} commented on your blog</span></a></li>
                          @else
                             <li><a href="{{route('show',['id'=>$noti->product_id])}}" class="notification-item"><span class="dot bg-info">{{$noti->name }} reviewed on your product</span></a></li>
                          @endif
                      @endforeach
                        <li><a href="{{route('admin.notificationLanding')}}" class="more">See all notifications</a></li>
                  @else
                    <li><a href="" class="notification-item"><span class="dot bg-info">No notification yet</span></a></li>
                  @endif
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

      </footer>
    </div>
    <!-- END MAIN -->
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
  <script src="/assets/js/plugins/chartist/chartist.min.js"></script>
  <script src="/assets/js/klorofil.min.js"></script>
  <script src="/lightbox/lightbox.js"></script>

  <script id="noti-template" type="text/x-handlebars-template">
    <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
      <i class="lnr lnr-alarm"></i>
      <span class="badge bg-danger">@{{noti}}</span>
    </a>
    <ul class="dropdown-menu notifications" >
        <li><a href="" class="notification-item"><span class="dot bg-info">No notification yet</span></a></li>
    </ul>

  </script>
  <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>

  <script>
   $(document).ready(function(){
       $('.flash').delay(3000).slideUp(300);
    });


</script>
  <script type="text/javascript">

  $("#pop").on("click", function() {
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});
</script>

  <script type="text/javascript">
var productTitle=null;

$('.action_button').find('.interaction').find('.edit').on('click', function(event){
    

   $("#edit_modal").modal();
   $.ajax(
   { 
      url: '/en/api/v0.1/social/removeAlbum/',
      type: 'GET',
      dataType: 'JSON',
      success: function (res) {
        if(res.status == 2000){
          window.location.href = '/'+vpUsername+'/albums';
        }
      }
    });
});
</script>

  <script>
  function readURL(input) {

      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }

  $("#imgInp").change(function(){
      readURL(this);
  });
  </script>
  <script>

    function  makeNotificationRead(trigger) {
        var  param = {
              "_token": "{{ csrf_token() }}",
          };

        $.ajax({
            url: "/admin/notification/makeRead",
            method: "post",
            data: param,
            dataType: "json",
            success: function (res) {
                if (res.status==200){
                    var source   = $("#noti-template").html();
                    var template = Handlebars.compile(source);
                    var context = {noti:res.notification};
                    var html    = template(context);
                    $('#noti-holder').replaceWith(html);
                }
            }
        })
    }
  </script>
@yield('script')

</body>

</html>
