<header class="main-header">
    <a href="/backend" class="logo">
        <span class="logo-mini"><b>D</b></span>
        <span class="logo-lg"><b>Application</b> Blog</span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ str_limit($me->name, 10) }}</a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ $me->image ? route('image', $me->image_thumbnail) : asset('assets/img/backend/avatar.png') }}" class="img-circle">
                            <p>{{ $me->email }}<small>{{ $me->name }}</small></p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                              <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
