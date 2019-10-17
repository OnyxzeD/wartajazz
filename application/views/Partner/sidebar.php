<?php
$method = $this->router->fetch_class();
$Menu = [
    'Home'   => null,
    'Outlet' => null,
    'Users'  => null
];
$Menu[$method] = 'active';
?>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <!--<div class="user-panel">
        <div class="pull-left image">
            <img src="<?/*= base_url('assets/office/') */?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?/*= $_SESSION['Account']['Name'] */?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>-->
    <!-- search form -->
    <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= $Menu['Home'] ?>">
            <a href="<?= base_url('Partner/Home') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="<?= $Menu['Outlet'] ?>">
            <a href="<?= base_url('Partner/Outlet') ?>">
                <i class="fa fa-building-o"></i> <span>Outlets</span>
            </a>
        </li>
        <li class="header">SETTING</li>
        <li class="<?= $Menu['Users'] ?>">
            <a href="<?= base_url('Partner/Users') ?>">
                <i class="fa fa-user-circle-o"></i> <span>Manajer</span></a></li>
    </ul>
</section>
<!-- /.sidebar -->
