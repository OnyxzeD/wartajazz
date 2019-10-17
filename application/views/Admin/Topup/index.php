<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Topup</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nominal</th>
                <th>Tgl Transaksi</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $status = ['Belum Konfirmasi', 'Sukses', 'Siap Verifikasi', 'Ditolak'];
            foreach ($Data as $row) { ?>
                <tr>
                    <td><?= $row['Id_Customer']; ?></td>
                    <td><?= $row['Nama']; ?></td>
                    <td><?= convertRupiah($row['Nominal']); ?></td>
                    <td><?= convertDate($row['Tgl_Transaksi'], 'indo'); ?></td>
                    <td><?= $status[$row['Status']]; ?></td>
                    <td>
                        <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                x-targeturl="<?= 'Admin/Topup/modalDetail/' . $row['Id_Topup'] ?>"
                                x-okbtn="false"
                                x-title="Detail User" data-toggle="tooltip" data-placement="top"
                                title="Detail Data">
                            <i class="fa fa-eye"></i>
                        </button> &nbsp;
                        <?php if ($row['Status'] == 2) { ?>
                            <button type="button" class="btn btn-success x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Admin/Topup/modalVerifikasi/' . $row['Id_Topup'] ?>"
                                    x-submiturl="<?= 'Admin/Topup/verifikasi/' . $row['Id_Topup'] ?>"
                                    x-title="Verifikasi"
                                    x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                                    data-placement="top" title="Verifikasi">
                                <i class="fa fa-check"></i>
                            </button> &nbsp;
                        <?php } ?>
                        <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                x-targeturl="<?= 'Admin/Topup/modalDelete/' . $row['Id_Customer'] ?>"
                                x-submiturl="<?= 'Admin/Topup/delete/' . $row['Id_Customer'] ?>"
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
</div>
