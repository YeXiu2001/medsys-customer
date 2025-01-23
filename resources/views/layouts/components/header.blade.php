<header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <!-- <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a> -->

                            <a href="/home" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{url ('assets/images/logo_only.png') }}" alt="" height="42">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url ('assets/images/medsys_logo_nobg.png') }}" alt="" height="49">
                                </span>
                            </a>
                        </div>
                        <!-- LOGO END -->

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form id="headsearchform" class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input id="headsearch" type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                        <!-- App search END -->
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search input">
                                
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                       

                        

                        

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{url ('assets/images/logo_only.png') }}"
                                    alt="Header Avatar">
                                <span class="ms-1">{{ $user->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                            
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> 
                                    <span key="t-logout">Logout</span>
                                </a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
    
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="/home" id="topnav-dashboard" role="button"
                                    >
                                        <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">Home</span> 
                                        <!-- <div class="arrow-down"></div> -->
                                    </a>
                                    <!-- <div class="dropdown-menu" aria-labelledby="topnav-dashboard">

                                        <a href="index.html" class="dropdown-item" key="t-default">Default</a>
                                        <a href="dashboard-saas.html" class="dropdown-item" key="t-saas">Saas</a>
                                        <a href="dashboard-crypto.html" class="dropdown-item" key="t-crypto">Crypto</a>
                                        <a href="dashboard-blog.html" class="dropdown-item" key="t-blog">Blog</a>
                                        <a href="dashboard-job.html" class="dropdown-item" key="t-Jobs">Jobs</a>
                                    </div> -->
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="/customer/index" id="topnav-uielement" role="button"
                                    >
                                        <i class="bx bx-plus-medical me-2"></i>
                                        <span key="t-ui-elements"> Orders</span> 
                                        <!-- <div class="arrow-down"></div> -->
                                    </a>

                                    <!-- <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                        aria-labelledby="topnav-uielement">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div>
                                                    <a href="ui-alerts.html" class="dropdown-item" key="t-alerts">Alerts</a>
                                                    <a href="ui-buttons.html" class="dropdown-item" key="t-buttons">Buttons</a>
                                                    <a href="ui-cards.html" class="dropdown-item" key="t-cards">Cards</a>
                                                    <a href="ui-carousel.html" class="dropdown-item" key="t-carousel">Carousel</a>
                                                    <a href="ui-dropdowns.html" class="dropdown-item" key="t-dropdowns">Dropdowns</a>
                                                    <a href="ui-grid.html" class="dropdown-item" key="t-grid">Grid</a>
                                                    <a href="ui-images.html" class="dropdown-item" key="t-images">Images</a>
                                                    <a href="ui-lightbox.html" class="dropdown-item" key="t-lightbox">Lightbox</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>