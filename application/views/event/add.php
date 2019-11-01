<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Event</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="<?= base_url('event/save') ?>" name="registration" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">
                    <?php if ($this->session->flashdata('warning')) { ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                            <?= $this->session->flashdata('warning'); ?>
                        </div>
                    <?php } ?>
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-primary">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <div class="box-header with-border"
                                     style="background-color: #337ab7; border-color: #2e6da4; color: white">
                                    <h4 class="box-title">
                                        Data Event
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Event</label>
                                        <input type="text" class="form-control" placeholder="Nama"
                                               name="event_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <select class="form-control select2" name="location">
                                            <option selected="selected" value="DKI Jakarta">DKI Jakarta</option>
                                            <option value="Bogor">Bogor</option>
                                            <option value="Depok">Depok</option>
                                            <option value="Tangerang">Tangerang</option>
                                            <option value="Bekasi">Bekasi</option>
                                            <option value="Bandung">Bandung</option>
                                            <option value="Semarang">Semarang</option>
                                            <option value="Jogja">Jogja</option>
                                            <option value="Solo">Solo</option>
                                            <option value="Surabaya">Surabaya</option>
                                            <option value="Malang">Malang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal event</label>
                                        <input type="text" class="form-control pull-right" id="reservationtime"
                                               name="tanggal" onchange="setTime()">
                                    </div>
                                    <!--<div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal selesai</label>
                                        <input type="text" class="form-control datePicker" placeholder="dd-mm-yyyy"
                                               name="date_end">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga Tiket</label>
                                        <input type="text" class="form-control" placeholder="Rp ...." name="htm"
                                               id="rupiah">
                                    </div>
                                    <div class="timeline-item">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Poster</label>
                                            <input type="file" class="form-control" name="poster"
                                                   onchange="readURL(this)">
                                        </div>
                                        <div class="timeline-body">
                                            <img src="http://via.placeholder.com/300x300" alt="..." class="margin"
                                                 id="preview"
                                                 style="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-primary">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <div class="box-header with-border"
                                     style="background-color: #337ab7; border-color: #2e6da4; color: white">
                                    <h4 class="box-title">
                                        Data Bintang Tamu
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="box-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pilih bintang tamu</label>

                                            <div class="input-group date">
                                                <input type="hidden" id="artist-id-1" name="artist_id[]">
                                                <input type="text" id="artist-name-1"
                                                       class="form-control pull-left artist" name="artist[]"
                                                       onclick="showModal(1)">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> &nbsp; </label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control timepicker" name="show[]">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                    <div id="artist-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> &nbsp; </label>

                                                <div class="input-group date">
                                                    <input type="hidden" id="artist-id-2" name="artist_id[]">
                                                    <input type="text" id="artist-name-2"
                                                           class="form-control pull-left artist" name="artist[]"
                                                           onclick="showModal(2)">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> &nbsp; </label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control timepicker" name="show[]">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-clock-o"></i>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="addArtist" class="btn btn-block btn-primary"
                                                onclick="addElem()">Tambah bintang tamu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submitTeacher" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('event') ?>" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>

<!--Modal artist-->
<div class="modal fade" id="modal_artist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modal_alert_label" class="text-left">Silahkan Pilih</h4>
            </div>
            <div class="modal-body" id="modal_alert_content">
                <div class="table-responsive">
                    <table id="dtDef" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nama Artist</th>
                            <th>Asal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($artists as $row) { ?>
                            <tr>
                                <td><?= $row['artist_name']; ?></td>
                                <td><?= $row['country_of_origin']; ?></td>
                                <td>
                                    <button class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                            title="Pilih"
                                            onclick="pilih('<?= $row['artist_id'] ?>', '<?= $row['artist_name'] ?>')">
                                        <i class="fa fa-check-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue btn-ok" data-dismiss="modal"><i class="fa fa-check"></i>
                    OK
                </button>
            </div>
        </div>
    </div>
</div>