<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Order</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                    x-targeturl="<?= 'Partner/Outlet/modalCreate' ?>"
                    x-submiturl="<?= 'Partner/Outlet/create' ?>"
                    x-title="Tambah Outlet" x-presubmit="cekInput"
                    x-onshown="" x-postsubmit="Postsubmit">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nama Outlet</th>
                    <th>Nama Customer</th>
                    <th>Orang</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $status = ["Aktif", "Datang", "Tidak Datang"];
                foreach ($Data as $row) { ?>
                    <tr>
                        <td><?= $row['Outlet_Nama']; ?></td>
                        <td><?= $row['Cust_Nama']; ?></td>
                        <td><?= $row['Orang']; ?></td>
                        <td><?= $row['created_at']; ?></td>
                        <td><?= $status[$row['Status']]; ?></td>
                        <td>
                            <?php if ($row['Status'] == 0) { ?>
                                <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                        x-targeturl="<?= 'Outlet/Order/modalVerifikasi/' . $row['Id_Reservasi'] ?>"
                                        x-submiturl="<?= 'Outlet/Order/verifikasi/' . $row['Id_Reservasi'] ?>"
                                        x-title="Verifikasi Pesanan" x-presubmit="cekInput"
                                        x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                                        data-placement="top" title="Verifikasi Pesanan">
                                    <i class="fa fa-check"></i>
                                </button> &nbsp;
                            <?php } ?>
                            <!--<button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<? /*= 'Partner/Outlet/modalDelete/' . $row['Id_Reservasi'] */ ?>"
                                    x-submiturl="<? /*= 'Partner/Outlet/delete/' . $row['Id_Reservasi'] */ ?>"
                                    x-title="Hapus Data" x-width="600px"
                                    x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip" data-placement="top"
                                    title="Hapus Data">
                                <i class="fa fa-trash"></i>
                            </button>-->
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
