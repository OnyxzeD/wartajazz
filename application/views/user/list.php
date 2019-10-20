<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                    x-targeturl="<?= 'user/modalCreate' ?>"
                    x-submiturl="<?= 'user/create' ?>"
                    x-title="Tambah Pengguna" x-presubmit=""
                    x-onshown="" x-postsubmit="Postsubmit">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="dtDef" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Alamat Email</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $status = ["Banned", "Aktif"];
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $row['fullname']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['role_name']; ?></td>
                        <td><?= $status[$row['status']]; ?></td>
                        <td>
                            <button class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'user/modalEdit/' . $row['username'] ?>"
                                    x-submiturl="<?= 'user/edit/' ?>"
                                    x-title="Ubah Data" x-width="600px"
                                    x-postsubmit="Postsubmit" data-toggle="tooltip" data-placement="top"
                                    title="Ubah Data">
                                <i class="fa fa-pencil"></i>
                            </button> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'user/modalDelete/' . $row['username'] ?>"
                                    x-submiturl="<?= 'user/delete/' . $row['username'] ?>"
                                    x-title="Hapus Data" x-width="600px"
                                    x-postsubmit="Postsubmit" data-toggle="tooltip" data-placement="top"
                                    title="Hapus Data">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
