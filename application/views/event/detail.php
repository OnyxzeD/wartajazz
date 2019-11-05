<div class="box box-primary">
    <div class="box-header with-border">
        <h2 class=""><?= $data['event_name'] ?></h2>
        <h5 style="display: inline-block; margin: 5px;"><i
                    class="fa fa-info-circle"></i> Created by <?= $data['author'] ?>
            at <?= convertDate($data['date_create'], 'indo') ?></h5>

    </div>

    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" style="margin: 0 auto; height: 400px; width: auto"
                     src="<?= $data['poster'] ?>" alt="User profile picture">
            </div>
            <div class="col-md-6">
                <div style="margin-left: 20px; margin-right: 20px">
                    <strong style="font-size: 18px"><i class="fa fa-map-marker margin-r-5"></i> Lokasi</strong>
                    <p class="text-muted" style="font-size: 18px"><?= $data['location'] ?></p>
                    <hr>
                    <strong style="font-size: 18px"><i class="fa fa-calendar margin-r-5"></i> Tanggal</strong>
                    <p class="text-muted"
                       style="font-size: 18px"><?= convertDate($data['date_start'], 'indo') . ' s/d ' . convertDate($data['date_end'], 'indo'); ?></p>
                    <hr>
                    <strong style="font-size: 18px"><i class="fa fa-usd margin-r-5"></i> Harga Tiket</strong>
                    <p class="text-muted" style="font-size: 18px">
                        Rp <?= number_format($data['htm'], 0, ".", "."); ?></p>
                    <hr>
                    <strong style="font-size: 18px"><i class="fa fa-microphone margin-r-5"></i> Dimeriahkan : </strong>
                </div>
                <br>
                <ul class="list-group list-group-unbordered" style="margin-left: 20px; margin-right: 20px">
                    <?php foreach ($data['details'] as $d) { ?>
                        <li class="list-group-item">
                            <b><?= $d['artist_name'] ?></b> <a class="pull-right"><?= convertDate($d['show_time'],'time') ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <br><br>
        <a href="<?= base_url('event/edit/') . $data['event_id'] ?>" class="btn btn-primary btn-block"><b>Ubah</b></a>
        <a href="<?= base_url('event') ?>" class="btn btn-default btn-block">
            <b>Kembali</b>
        </a>

    </div>
</div>
