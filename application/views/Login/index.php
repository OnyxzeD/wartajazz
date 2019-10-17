<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <link href="<?= base_url('assets/landing/css/login.css'); ?>" rel="stylesheet" type="text/css"/>
</head>
<body bgcolor="#25499f">
<form class="modal-content animate" action="<?php echo base_url('Manage/showLogin'); ?>" method="post" id="form_login">
    <div class="imgcontainer">
        <!--				<span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>-->
        <img src="<?= base_url('assets/landing/img/avatar/1.png'); ?>" alt="Avatar" class="avatar">
        <h1 style="text-align:center">Silahkan Login</h1>
        <h3><?= $this->session->flashdata('flash'); ?></h3>

    </div>
    <div class="container">
        <input type="text" placeholder="Enter Username" name="username" value="<?= $user ?>" readonly>
        <input type="password" placeholder="Enter Password" name="password">
        <button type="submit" name="login">Login</button>
        <input type="checkbox" style="margin:26px 30px;"> Remember me
        <a href="#" style="text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
    </div>
</form>
</body>
</html>
