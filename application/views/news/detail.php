<div class="box box-primary">
    <div class="box-header with-border">
        <h2 class=""><?= $data['title']?></h2> <br>
        <h5 style="display: inline-block; margin: 5px;"><i class="fa fa-calendar"></i> <?= convertDate($data['created_at'],'indo')?></h5>
        <h5 style="display: inline-block; margin: 5px;"><i class="fa fa-user"></i> <?= $data['fullname'] ?></h5>
        <h5 style="display: inline-block; margin: 5px;"><i class="fa fa-book"></i> <?= $data['tags'] ?></h5>

    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <div class="col-md-12" style="background-image: url('<?= base_url('assets/images/news/') . $data['thumbnail']; ?>'); background-size: cover; min-height: 500px;">
            </div>
            <?= $data['content']?>
        </div>
        <div style="margin: 10px 0 10px 0">
            <a href="<?= base_url('news/edit/') . $data['url'] ?>" class="btn btn-info">
                <i class="fa fa-pencil"></i> &nbsp; Ubah
            </a> &nbsp;
            <a href="<?= base_url('news/') ?>" class="btn btn-default">
                <i class="fa fa-chevron-circle-left"></i> &nbsp;Kembali
            </a>
        </div>
    </div>
</div>
