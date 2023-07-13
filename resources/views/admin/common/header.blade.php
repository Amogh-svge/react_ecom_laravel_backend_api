<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="{{ route('dashboard') }}" class="az-logo"><span></span> JhiguPasa</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="index.html" class="az-logo"><span></span> azia</a>
                <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                <li class="nav-item active show">
                    <a href="{{ route('dashboard') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i>
                        Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Products</a>
                    <nav class="az-menu-sub">
                        <a href="{{ route('product.create') }}" class="nav-link">Add Products</a>
                        <a href="{{ route('product.index') }}" class="nav-link">List Products</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-th-small-outline"></i>
                        Category</a>
                    <nav class="az-menu-sub">
                        <a href={{ route('category.create') }} class="nav-link">Add Category</a>
                        <a href={{ route('category.index') }} class="nav-link">List Category</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> SubCategory</a>
                    <nav class="az-menu-sub">
                        <a href={{ route('subcategory.create') }} class="nav-link">Add Sub_Category</a>
                        <a href={{ route('subcategory.index') }} class="nav-link">List Sub_Category</a>
                    </nav>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i>Slides</a>
                    <nav class="az-menu-sub">
                        <a href={{ route('slider.create') }} class="nav-link">Add Slides</a>
                        <a href={{ route('slider.index') }} class="nav-link">List Slides</a>
                    </nav>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Customer Order</a>
                    <nav class="az-menu-sub">
                        <div class="m-2 border-dark" onmouseleave="hideMenuOnOver(this)">
                            <a href="#" onmouseover="showMenuOnOver(this)"
                                class="nav-link d-flex justify-content-between align-items-center">Manage Order
                                <ion-icon name="ios-arrow-down"></ion-icon>
                            </a>
                            <div class="hidden_menu mt-2">
                                <a href="{{ route('pending.list') }}" class="nav-link">Pending Order</a>
                                <a href="{{ route('processing.list') }}" class="nav-link">Processing Order</a>
                                <a href="{{ route('purchased.list') }}" class="nav-link">Complete Order</a>
                            </div>
                        </div>

                    </nav>
                </li> --}}
            </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
            <a href="https://www.bootstrapdash.com/demo/azia-free/docs/documentation.html" target="_blank"
                class="az-header-search-link"><i class="far fa-file-alt"></i></a>
            <a href="" class="az-header-search-link"><i class="fas fa-search"></i></a>
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 unread notification</p>
                    <div class="az-notification-list">
                        <div class="media new">
                            <div class="az-img-user"><img src="#" alt=""></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15 12:32pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media new">
                            <div class="az-img-user online"><img src="#" alt="">
                            </div>
                            <div class="media-body">
                                <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                <span>Mar 13 04:16am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="az-img-user"><img src="#" alt=""></div>
                            <div class="media-body">
                                <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                <span>Mar 13 02:56am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="az-img-user"><img src="#" alt=""></div>
                            <div class="media-body">
                                <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                <span>Mar 12 10:40pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- az-notification-list -->
                    <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{{ asset(Auth::user()->profile_photo_url) }}"
                        alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="{{ Auth::user()->name }}">
                        </div><!-- az-img-user -->
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->email }}</span>
                    </div><!-- az-header-profile -->

                    <a href={{ route('user.profile') }} class="dropdown-item"><i
                            class="typcn typcn-user-outline"></i>
                        My
                        Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account
                        Settings</a>
                    <span class="dropdown-item"><i class="typcn typcn-power-outline"></i>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="submit" value="Sign Out" class="dropdown-item mt-1"
                                @click.prevent="$root.submit();">
                        </form>
                    </span>

                </div><!-- dropdown-menu -->
            </div>


        </div><!-- az-header-right -->
    </div><!-- container -->
</div>
