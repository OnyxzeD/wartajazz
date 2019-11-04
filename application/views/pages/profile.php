<div class="box box-primary">
    <!-- /.box-header -->
    <div class="box-body">
        <?php if ($this->session->flashdata('sukses')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                <?= $this->session->flashdata('sukses'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('warning')) { ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                <?= $this->session->flashdata('warning'); ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle"
                         src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" alt="User profile picture">

                    <h3 class="profile-username text-center">
                        <?= $this->session->userdata('name') ?>
                    </h3>

                    <p class="text-muted text-center">
                        <?php
                        $level = ['Super Admin', 'Administrator', 'Mobile User', 'Mobile Social'];
                        echo $level[$this->session->userdata('level')];
                        ?>
                    </p>
                    <p class="text-muted text-center">
                        <?= "Member since : " . convertDate($this->session->userdata('join_date'), 'indo');
                        ?>
                    </p>
                    <form class="form-horizontal" action="<?= base_url('dashboard/updatePass') ?>" method="post">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password">
                                    <span class="input-group-addon toggle-password"><i class="fa fa-eye"></i></span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <label>Password Confirmation</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirm_password">
                                    <span class="input-group-addon toggle-password"><i class="fa fa-eye"></i></span>
                                </div>
                                <span id="err" class="help-block" style="color: #dd4b39; display: none">Password not match</span>
                            </li>
                        </ul>

                        <button type="submit" id="submit" class="btn btn-primary btn-block" disabled><b>Update</b></button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
</div>
