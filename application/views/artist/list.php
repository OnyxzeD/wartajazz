<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Artist</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                    x-targeturl="<?= 'artist/modalCreate' ?>"
                    x-submiturl="<?= 'artist/create' ?>"
                    x-title="Tambah Artist" x-presubmit=""
                    x-onshown="" x-postsubmit="Postsubmit">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table id="dtDef" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nama Artist / Group</th>
                    <th>Asal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $row['artist_name']; ?></td>
                        <td><?= $row['country_of_origin']; ?></td>
                        <td>
                            <button class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'artist/modalEdit/' . $row['artist_id'] ?>"
                                    x-submiturl="<?= 'artist/edit/' ?>"
                                    x-title="Ubah Data" x-width="600px"
                                    x-postsubmit="Postsubmit" data-toggle="tooltip" data-placement="top"
                                    title="Ubah Data">
                                <i class="fa fa-pencil"></i>
                            </button> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'artist/modalDelete/' . $row['artist_id'] ?>"
                                    x-submiturl="<?= 'artist/delete/' . $row['artist_id'] ?>"
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
