<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Partners</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Bentuk Usaha</th>
                <th>Jenis Tempat</th>
                <th>Telepon</th>
                <th>Bank</th>
                <th>Tanggal Bergabung</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($Data as $row) { ?>
                <tr>
                    <td><?= $row['Nama']; ?></td>
                    <td><?= $row['Bentuk']; ?></td>
                    <td><?= (($row['Jenis_Tempat'] == "rt") ? "Rumah Makan" : "Kafe"); ?></td>
                    <td><?= $row['Telp']; ?></td>
                    <td><?= $row['Bank_Nama']; ?></td>
                    <td><?= convertDate($row['created_at'], 'indo'); ?></td>
                    <td>
                        <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                x-targeturl="<?= 'Admin/Partner/modalDetail/' . $row['ID_Partner'] ?>"
                                x-okbtn="false"
                                x-title="Detail Partner" data-toggle="tooltip" data-placement="top" title="Detail Data">
                            <i class="fa fa-eye"></i>
                        </button> &nbsp;
                        <button type="button" class="btn btn-primary x_BM_GetForm_AjaxSubmit"
                                x-targeturl="<?= 'Admin/Partner/modalEdit/' . $row['ID_Partner'] ?>"
                                x-submiturl="<?= 'Admin/Partner/edit/' . $row['ID_Partner'] ?>"
                                x-title="Ubah Partner" x-presubmit="cekInput"
                                x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                                data-placement="top" title="Ubah Data">
                            <i class="fa fa-pencil"></i>
                        </button> &nbsp;
                        <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                x-targeturl="<?= 'Admin/Partner/modalDelete/' . $row['ID_Partner'] ?>"
                                x-submiturl="<?= 'Admin/Partner/delete/' . $row['ID_Partner'] ?>"
                                x-title="Hapus Data" x-width="600px"
                                x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip" data-placement="top"
                                title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
