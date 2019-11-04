<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $users ?></h3>

                <p>Pengguna Baru</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $artists ?></h3>

                <p>Artist / Band Jazz Baru</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <section class="col-lg-12 connectedSortable">

        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Event Bulan ini</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    <?php foreach ($events as $key => $val) { ?>
                        <!-- timeline time label -->
                        <?php $colors = ["bg-teal", "bg-purple", "bg-maroon", "bg-orange"] ?>
                        <li class="time-label">
                        <span class="<?= $colors[array_rand($colors)]; ?>">
                          <?= convertDate($key, 'indo') ?>
                        </span>
                        </li>
                        <!-- /.timeline-label -->
                        <?php foreach ($val as $row) { ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-calendar bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i
                                                class="fa fa-clock-o"></i> <?= convertDate($row['date_create'], 'indo') ?></span>

                                    <h3 class="timeline-header"><?= $row['event_name'] ?></h3>

                                    <div class="timeline-body">
                                        Lokasi : <?= $row['location'] ?> <br>
                                        HTM : Rp <?= number_format($row['htm'], 0, ".", "."); ?>
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="<?= base_url('event/detail/') . $row['event_id'] ?>"
                                           class="btn btn-primary btn-xs">Read more</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
            </div>
        </div>

    </section>
</div>