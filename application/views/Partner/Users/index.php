<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Manajer</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-info" onclick="Add()">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nama Manager</th>
                    <th>No Telp</th>
                    <th>Alamat Email</th>
                    <th>Outlet</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($Data as $row) { ?>
                    <tr>
                        <td><?= $row['Nama']; ?></td>
                        <td><?= $row['Telp']; ?></td>
                        <td><?= $row['Email']; ?></td>
                        <td><?= $row['Outlet_Nama']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Users/modalDetail/' . $row['Id_Manager'] ?>"
                                    x-okbtn="false"
                                    x-title="Detail Manajer" data-toggle="tooltip" data-placement="top"
                                    title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </button> &nbsp;
                            <button class="btn btn-primary x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Users/modalEdit/' . $row['Id_Manager'] ?>"
                                    x-submiturl="<?= 'Partner/Users/edit/' . $row['Id_Manager'] ?>"
                                    x-title="Ubah Data"
                                    x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip"
                                    data-placement="top" title="Ubah Data">
                                <i class="fa fa-pencil"></i>
                            </button> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Partner/Users/modalDelete/' . $row['Id_Manager'] ?>"
                                    x-submiturl="<?= 'Partner/Users/delete/' . $row['Id_Manager'] ?>"
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
