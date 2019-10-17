<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Outlets</h3>
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
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Jumlah Kursi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($Data as $row) { ?>
                    <tr>
                        <td><?= $row['Nama']; ?></td>
                        <td><?= $row['Alamat']; ?></td>
                        <td><?= $row['Telp']; ?></td>
                        <td><?= (int)$row['Jumlah_Kursi']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Outlet/modalDetail/' . $row['ID_Outlet'] ?>"
                                    x-okbtn="false"
                                    x-title="Detail Partner" data-toggle="tooltip" data-placement="top"
                                    title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-primary x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Outlet/modalEdit/' . $row['ID_Outlet'] ?>"
                                    x-submiturl="<?= 'Partner/Outlet/edit/' . $row['ID_Outlet'] ?>"
                                    x-title="Ubah Outlet" x-presubmit="cekInput"
                                    x-onshown="" x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                                    data-placement="top" title="Ubah Data">
                                <i class="fa fa-pencil"></i>
                            </button> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Outlet/modalDelete/' . $row['ID_Outlet'] ?>"
                                    x-submiturl="<?= 'Partner/Outlet/delete/' . $row['ID_Outlet'] ?>"
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
</div>
