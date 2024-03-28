<!--Start topbar header-->
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>
          
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
            
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"
                    href="#">
                    <span class="user-profile"><img src="https://img.freepik.com/vecteurs-libre/illustration-homme-affaires_53876-5856.jpg?t=st=1711661657~exp=1711665257~hmac=a557ddb742bf6bc264a6a834ca6560f77adec97f18983486afbd4a61b373f5b3&w=740"
                            class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3"
                                        src="https://img.freepik.com/vecteurs-libre/illustration-homme-affaires_53876-5856.jpg?t=st=1711661657~exp=1711665257~hmac=a557ddb742bf6bc264a6a834ca6560f77adec97f18983486afbd4a61b373f5b3&w=740" alt="user avatar"></div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{Auth::user()->name}}</h6>
                                    <p class="user-subtitle">{{Auth::user()->email}}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item">  <a class="dropdown-item" href="{{ route('logout') }}"><i class="icon-power mr-2"></i> Logout </a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!--End topbar header-->