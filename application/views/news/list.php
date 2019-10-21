<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Berita</h3>
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
            <a href="<?= base_url('news/add') ?>" class="btn btn-info">
                <i class="fa fa-plus"></i> &nbsp; Tambah
            </a>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tgl Terbit</th>
                    <th>Author</th>
                    <th>Tags</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?= $row['title']; ?></td>
                        <td><?= convertDate($row['created_at'], 'indo'); ?></td>
                        <td><?= $row['fullname']; ?></td>
                        <td><?= $row['tags']; ?></td>
                        <td>
                            <a href="<?= 'news/detail/' . $row['url'] ?>" class="btn btn-info"
                               data-toggle="tooltip" data-placement="top"
                               title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </a> &nbsp;
                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'news/modalDelete/' . $row['url'] ?>"
                                    x-submiturl="<?= 'news/delete/' . $row['url'] ?>"
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
