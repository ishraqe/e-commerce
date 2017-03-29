<ul class="nav">
            <li><a href="{{url('admin/dashboard')}}" class="active"><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>
            <li>
              <a href="#user" data-toggle="collapse" class="collapsed"><i class="fa fa-user-o" aria-hidden="true"></i></i> <span>User</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="user" class="collapse ">
                <ul class="nav">
                  <li><a href="{{route('admin.users')}}" class="">All</a></li>
                  <li><a href="{{route('admin.alluser')}}" class="">Users</a></li>
                  <li><a href="{{route('admin.allAdmin')}}" class="">Admin</a></li>
                  <li><a href="{{route('admin.users')}}" class="">Reported users</a></li>
                  <li><a href="{{route('admin.users')}}" class="">Pending request</a></li> 
                </ul>
              </div>
            </li>
            <li><a href="{{route('admin.notificationLanding')}}" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
            <li><a href="{{url('/admin/product')}}" class=""><i class="fa fa-gift" aria-hidden="true"></i><span>Products</span></a></li>
            <li><a href="{{route('admin.to-do')}}" class=""><i class="fa fa-bars" aria-hidden="true"></i><span>To do</span></a></li>
            <li><a href="#mail" data-toggle="collapse" class="collapsed"><i class="fa fa-envelope -o" aria-hidden="true"></i></i> <span>MailBox</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
              <div id="mail" class="collapse "><ul class="nav"><li><a href="" class="">Inbox</a></li></ul></div>
            </li>
            <li><a href="notifications.html" class=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Orders</span></a></li>
            <li><a href="notifications.html" class=""><i class="fa fa-comments-o" aria-hidden="true"></i></i> <span>Review</span></a></li>
            <li><a href="notifications.html" class=""><i class="fa fa-book" aria-hidden="true"></i> <span>Blog</span></a></li>
            <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
            <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
            <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
          </ul>