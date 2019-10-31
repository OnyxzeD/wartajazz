<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Event</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <?php if ($this->session->flashdata('warning')) { ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                <?= $this->session->flashdata('warning'); ?>
            </div>
        <?php }
        if ($this->session->flashdata('sukses')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                <?= $this->session->flashdata('sukses'); ?>
            </div>
        <?php } ?>

        <div style="margin-bottom: 10px">
            <a href="<?= base_url('event/add') ?>" class="btn btn-info">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </a>
        </div>
        <div class="table-responsive">
            <table id="dtDef" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $row['event_name']; ?></td>
                        <td><?= convertDate($row['date_start'], 'indo') .' s/d '.convertDate($row['date_end'], 'indo'); ?></td>
                        <td><?= $row['location']; ?></td>
                        <td>
                            <a href="<?= base_url('event/detail/') . $row['event_id'] ?>" class="btn btn-info"
                               data-toggle="tooltip" data-placement="top"
                               title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'news/modalDelete/' . $row['event_id'] ?>"
                                    x-submiturl="<?= 'news/delete/' . $row['event_id'] ?>"
                                    x-title=" Hapus Data" x-width="600px"
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
