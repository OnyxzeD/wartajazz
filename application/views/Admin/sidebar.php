<?php
$method = $this->router->fetch_class();
$Menu = [
    'Home'    => null,
    'Partner' => null,
    'Topup'   => null,
    'User'    => null
];
$Menu[$method] = 'active';
?>
<section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?= $Menu['Home'] ?>">
            <a href="<?= base_url('Admin') ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="<?= $Menu['Partner'] ?>">
            <a href="<?= base_url('Admin/Partner/') ?>">
                <i class="fa fa-users"></i>
                <span>Partners</span>
            </a>
        </li>

        <li class="<?= $Menu['Topup'] ?>">
            <a href="<?= base_url('Admin/Topup/') ?>">
                <i class="fa fa-dollar"></i>
                <span>Top Up</span>
            </a>
        </li>

		<li class="header">SETTING</li>

        <li class="<?= $Menu['User'] ?>">
			<a href="<?= base_url('Admin/User/') ?>">
				<i class="fa fa-user-circle-o"></i>
                <span>Users</span>
			</a>
		</li>

    </ul>
</section>
<!-- /.sidebar -->
