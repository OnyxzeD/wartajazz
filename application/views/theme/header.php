<!-- Logo -->
<a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>PG</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>Page</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <!-- Notifications: style can be found in dropdown.less -->
<!--            <li class="dropdown notifications-menu">-->
<!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                    <i class="fa fa-bell-o"></i>-->
<!--                    <span class="label label-warning">10</span>-->
<!--                </a>-->
<!--                <ul class="dropdown-menu">-->
<!--                    <li class="header">You have 10 notifications</li>-->
<!--                    <li>-->
<!--                        <!-- inner menu: contains the actual data -->
<!--                        <ul class="menu">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-warning text-yellow"></i> Very long description here that-->
<!--                                    may not fit into the-->
<!--                                    page and may cause design problems-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-user text-red"></i> You changed your username-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li class="footer"><a href="#">View all</a></li>-->
<!--                </ul>-->
<!--            </li>-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="user-image"
                         alt="User Image">
                    <span class="hidden-xs"><?= $this->session->userdata('name')?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                            <?= $this->session->userdata('name')?>
                            <small>Member since <?= convertDate($this->session->userdata('join_date'), 'indo')?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?= base_url('dashboard/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= base_url('dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
