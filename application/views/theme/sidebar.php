<?php
$method = $this->router->fetch_class();
$Menu = [
    'news'   => null,
    'event'  => null,
    'artist' => null,
    'user'   => null
];
$Menu[$method] = 'active';
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle"
                 alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= $this->session->userdata('name') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i>
                <?php
                $level = ['Super Admin', 'Administrator', 'Mobile User', 'Mobile Social'];
                echo $level[$this->session->userdata('level')];
                ?>
            </a>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="<?= base_url('dashboard/'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <!--        <li class="--><? //= $Menu['news'] ?><!--">-->
        <!--            <a href="--><? //= base_url('news/'); ?><!--">-->
        <!--                <i class="fa fa-newspaper-o"></i> <span>Berita</span>-->
        <!--            </a>-->
        <!--        </li>-->
        <li class="<?= $Menu['event'] ?>">
            <a href="<?= base_url('event/'); ?>">
                <i class="fa fa-calendar"></i> <span>Event</span>
            </a>
        </li>
        <li class="<?= $Menu['artist'] ?>">
            <a href="<?= base_url('artist/'); ?>">
                <i class="fa fa-microphone"></i> <span>Artist</span>
            </a>
        </li>
        <li class="<?= $Menu['user'] ?>">
            <a href="<?= base_url('user/'); ?>">
                <i class="fa fa-users"></i> <span>Users</span>
            </a>
        </li>

    </ul>
</section>
<!-- /.sidebar -->