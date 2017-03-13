<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $me->image ? route('image', $me->image_thumbnail) : asset('assets/img/backend/avatar.png') }}" class="img-circle">
            </div>
            <div class="pull-left info">
                <p>{{ str_limit($me->name, 15) }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
        </ul>
        
    </section>
</aside>
