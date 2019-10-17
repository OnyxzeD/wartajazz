<div class="row">
    <div class="col-md-6">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <img class="profile-user-img img-responsive img-circle" src="<?= base_url($row['Logo']) ?>"
                     alt="User profile picture">

                <h3 class="profile-username text-center"><?= $row['Nama']; ?></h3>
                <p class="text-muted text-center"><?= $row['Bentuk']; ?></p>
            </div>
            <div class="box-body box-profile">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <?= $row['Alamat']; ?>
                    </li>
                    <li class="list-group-item">
                        <?= $row['Telp']; ?>
                    </li>
                    <li class="list-group-item">
                        Joining from : <?= convertDate($row['created_at'], 'indo'); ?>
                    </li>
                    <lis class="list-group-item">
                        <?php
                        for ($i = 1; $i <= floor($row['Rating']); $i++) { ?>
                            <i class="fa fa-star"></i>
                        <?php } ?>
                    </lis>
                </ul>
                <button type="button" class="btn btn-primary btn-block x_BM_GetForm_AjaxSubmit"
                        x-targeturl="<?= 'Partner/Profile/modalEdit/' . $row['ID_Partner'] ?>"
                        x-submiturl="<?= 'Partner/Profile/edit/' . $row['ID_Partner'] ?>"
                        x-title="Ubah Profil" x-presubmit=""
                        x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                        data-placement="top" title="Ubah Profil">
                    <i class="fa fa-pencil"></i> &nbsp; Ubah Profil
                </button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Rekening</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <?= $row['Bank_Nama'] ?>
                    </li>
                    <li class="list-group-item">
                        <?= $row['Rekening']; ?>
                    </li>
                    <li class="list-group-item">
                        A/n <?= $row['Pemilik_Rekening']; ?>
                    </li>
                </ul>
                <button type="button" class="btn btn-primary btn-block x_BM_GetForm_AjaxSubmit"
                        x-targeturl="<?= 'Partner/Profile/modalRekening/' . $row['ID_Partner'] ?>"
                        x-submiturl="<?= 'Partner/Profile/editRekening/' . $row['ID_Partner'] ?>"
                        x-title="Ubah Rekening" x-presubmit="cekInput"
                        x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                        data-placement="top" title="Ubah Rekening">
                    <i class="fa fa-pencil"></i> &nbsp; Ganti Rekening
                </button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->
