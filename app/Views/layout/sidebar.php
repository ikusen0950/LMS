<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

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

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <?php if (has_permission('dashboard_view')) :?>
                
                    <li>
                        <a href="/">
                            <i class="uil-home-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                <?php endif; ?>

                <li class="menu-title"></li>

                <?php if (has_permission('request_list')) :?>
                
                    <li>
                        <a href="requests" class="waves-effect">
                            <i class="uil-edit"></i>
                            <span>Request's</span>
                        </a>
                    </li>

                <?php endif; ?>

                <!-- <?php if (has_permission('request_list')) :?>
                
                    <li>
                        <a href="history" class="waves-effect">
                            <i class="uil-edit"></i>
                            <span>History</span>
                        </a>
                    </li>

                <?php endif; ?> -->

                <?php if (has_permission('issue_book_view')) :?>
                
                    <li>
                        <a href="issue" class="waves-effect">
                            <i class="uil-sign-alt"></i>
                            <span>Issue Books</span>
                        </a>
                    </li>

                <?php endif; ?>
                <!-- 
                <?php if (has_permission('circulation_view')) :?>
                
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-sign-alt"></i>
                            <span>Circulation</span>
                        </a>

                        
                        <ul class="sub-menu" aria-expanded="false">
                            <?php if (has_permission('issue_book_view')) :?>
                                <li><a href="issue">Issue Book</a></li>                            
                            <?php endif; ?>

                            <?php if (has_permission('return_book_view')) :?>
                                <li><a href="return">Return Book</a></li>                            
                            <?php endif; ?>

                        </ul>

                        

                    </li>

                <?php endif; ?> -->

                <?php if (has_permission('inventory_list')) :?>
                
                    <li>
                        <a href="inventory" class="waves-effect">
                            <i class="uil-books"></i>
                            <span>Book Inventory</span>
                        </a>
                    </li>                
                
                <?php endif; ?>

                <?php if (has_permission('students_list')) :?>
                                
                    <li>
                        <a href="students" class="waves-effect">
                            <i class="uil-users-alt"></i>
                            <span>Students</span>
                        </a>
                    </li>

                <?php endif; ?>

                <?php if (has_permission('reports_view')) :?>
                                
                    <li>
                        <a href="reports" class="waves-effect">
                            <i class="uil-file-medical-alt"></i>
                            <span>Report's</span>
                        </a>
                    </li>

                <?php endif; ?>
                               

                <?php if (has_permission('setting_view')) :?>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-setting"></i>
                            <span>Setting</span>
                        </a>

                        
                        <ul class="sub-menu" aria-expanded="false">
                        <?php if (has_permission('app_setting')) :?>
                            <li><a href="setting_app">App Setting</a></li>                            
                        <?php endif; ?>

                        <?php if (has_permission('user_management_list')) :?>
                            <li><a href="setting_users">User Management</a></li>                            
                        <?php endif; ?>

                        <?php if (has_permission('author_list')) :?>
                            <li><a href="setting_authors">Authors</a></li>                            
                        <?php endif; ?>

                        <?php if (has_permission('status_list')) :?>
                            <li><a href="setting_status">Status</a></li>                            
                        <?php endif; ?> 

                        <?php if (has_permission('book_status_list')) :?>
                            <li><a href="setting_book_status">Book Status</a></li>                            
                        <?php endif; ?> 

                        <?php if (has_permission('grade_list')) :?>
                            <li><a href="setting_grade">Grades</a></li>                            
                        <?php endif; ?> 
                        
                        <?php if (has_permission('genre_list')) :?>
                            <li><a href="setting_genre">Genres</a></li>                            
                        <?php endif; ?>
                        
                        <?php if (has_permission('publisher_list')) :?>
                            <li><a href="setting_publisher">Publishers</a></li>                            
                        <?php endif; ?> 

                        <?php if (has_permission('activity_log_view')) :?>
                            <li><a href="setting_activity_log">Activity Logs</a></li>                            
                        <?php endif; ?> 
                        

                        </ul>

                        

                    </li>                 

                <?php endif; ?>
               
                       
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
   


