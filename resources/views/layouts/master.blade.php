<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/price-range.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/lightbox/lightbox.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/icon-sets.css">
    <script src="/js/jquery.js"></script>
    <script src="/assets/handlebars-v4.0.5.js"></script>

    <script src="/js/jquery.elevatezoom.js"></script>
    @yield('style')
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{url('/')}}"><img height="31px" src="images/home/story.png" alt="" /></a>
                        </div>
                       
                        
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                                <li><a href="{{route('product.wishListmain')}}">
                                    <i class="fa fa-star"></i> Wishlist
                                   
                                    <span class="badge">
                                    <?php if (Auth::guest()) { ?>
                                       {{Session::has('wish') ? Session::get('wish')->totalQty : ''}}
                                   <?php }else{ ?>
                                       <?php 
                                        $wishNumber= \App\WishList::where('user_id',Auth::user()->id)->count();
                                        echo $wishNumber;
                                        ?>
                                   <?php } ?>
                                    </span>
                                    </a>
                                </li>
                                <li><a href="{{route('cart.checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li id="addToCart-body">
                                    <a id="header-cart-item" href="{{route('product.shoppingCart')}}">Cart -
                                        <span class="cart-amunt">
                                            {{Cart::subtotal()}}
                                        </span>
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="badge">{{Cart::count()}}
                                        </span>
                                    </a>
                                </li>
                                @if(Auth::user())
                                <li class="dropdown"><a href="#"><i class="fa fa-user"></i> {{ucfirst(Auth::user()->name)}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">

                                        @if(!Auth::user()->admin)
                                            <li><a href="{{route('user.account')}}"><i class="fa fa-user"></i> My profile</a></li>
                                        @else
                                            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-user"></i> Admin panel</a></li>
                                        @endif
                                        <li><a href="{{action('UserController@getMyblog',[Auth::user()->id])}}"><i class="fa fa-user"></i> My Blogs</a></li>
                                        <li><a href="{{route('user.getProduct')}}"><i class="fa fa-user"></i> My products</a></li>
                                         <li><a href="#"><i class="fa fa-user"></i>Account Setting</a></li>
                                          <li><a href="#"><i class="fa fa-user"></i> Account blah blah</a></li>
                                        <li><a href="{{url('/logout')}}"><i class="fa fa-user"></i> Log-out</a></li> 
                                    </ul>
                                </li> 
                                @else
                                 <li><a href="{{url('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{url('/')}}" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{url('/shop')}}">Products</a></li>
                                        <li><a href="{{route('cart.checkout')}}">Checkout</a></li> 
                                        <li><a href="{{route('product.shoppingCart')}}">Cart</a></li>  
                                    </ul>
                                </li> 
                                <li><a href="{{url('/blog')}}">Blog</a></li>
                                <li class="dropdown"><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $c)
                                        <li>
                                            <a href="#">{{ ucfirst($c->category_name)}}</a>
                                        </li>
                                        @endforeach
                                        <li><a href="{{route('category.all')}}">See all</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Brands<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    @foreach($brand as $b)
                                        <li><a href="#">{{ ucfirst($b->brand_name)}}</a></li>
                                    @endforeach    
                                        <li><a href="{{route('brand.all')}}">See all</a></li>
                                    </ul>
                                </li>  
                                <li><a href="{{url('/contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{url('/search')}}" method="get">
                                <input type="text" name="query" autocomplete="off" placeholder="Search"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
   

       @include('partials.message')

       @yield('content')
   
    
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="companyinfo">
                            <h2><span>Artisan's</span> Story</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-3 pull-right">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Artisan</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Aritsan</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © <?php echo date('Y'); ?> Artisan's Story. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank">ISH MAN</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.scrollUp.min.js"></script>
    <script src="/js/price-range.js"></script>
    <script src="/js/jquery.prettyPhoto.js"></script>
    <script src="/js/main.js"></script>
    <script src="/lightbox/lightbox.js"></script>
    <script src="/tinymce/tinymce.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script>
      $(document).ready(function(){
          $('.flash').delay(3000).slideUp(300);
       });
    </script>
    <script type="text/javascript">
        var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "#blog-body",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars  fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(editor_config);
    </script>

    @yield('script')
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                dotsEach:true,
                nav:true,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            })
        });

    </script>
    <script id="addToCart-template" type="text/x-handlebars-template">
        <a id="header-cart-item" href="/shopping-cart">Cart -
            <span class="cart-amunt">@{{subtotal}}</span>
            <i class="fa fa-shopping-cart"></i>
            <span class="badge">@{{count}} </span>
        </a>
    </script>
    <script>
        function  addToCart(trigger) {

            var trigger=$(trigger);
            var dataId=trigger.attr("data-id");



            param = {
                id : dataId
            };

            $.ajax({
                url: "/add-to-cart",
                method: "get",
                data: param,
                dataType: "json",
                success: function (res) {
                    if(res.status==200){

                        var source   = $("#addToCart-template").html();
                        var template = Handlebars.compile(source);
                        var context = {subtotal:res.subTotal,count:res.count};
                        var html    = template(context);
                        $('#addToCart-body').replaceWith(html);
                    }
                }
            })
        }


    </script>


</body>
</html>