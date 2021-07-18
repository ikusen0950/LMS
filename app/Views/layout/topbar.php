<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm-1.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark-1.svg" class="rounded text-center mt-3 mx-auto d-block" alt="" height="55">
                            </span>
                        </a>

                        <a href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm-1.svg" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-dark-1.svg" class="rounded text-center mt-3 mx-auto d-block" alt="" height="55">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-search"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-7.jpg" -->
                            <!-- alt="Header Avatar"> -->
                            <img src="img/profile/<?= user()->image; ?>" class="rounded-circle header-profile-user" alt="Header Avatar">


                            <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?= user()->first_name ?> <?= user()->last_name ?></span>

                            <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="profile"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="logout"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
                        </div>
                    </div>

                    <!--
             <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div>
            -->

                </div>
            </div>
        </header>