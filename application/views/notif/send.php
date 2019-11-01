<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Send Notfication</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="<?= base_url('notif/submit')  ?>" name="registration" method="post"
                  enctype="multipart/form-data">
                <div class="box-body">
                    <?php if ($this->session->flashdata('sukses')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                            <?= $this->session->flashdata('sukses'); ?>
                        </div>
                    <?php } ?>
                    <div class="form-group col-md-10">
                            <label>Tipe</label>
                            <select name="type" class="form-control" style="height: 100%">
                                <option value='all'>Semua Pengguna Mobile</option>
                                <option value='single'>Salah satu</option>
                            </select>
                    </div>
                    <div class="form-group col-md-10" id="userElem" hidden>
                        <label>Pilih pengguna</label>

                        <div class="input-group date">
                            <input type="text" class="form-control pull-left users" name="username" id="username">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group col-md-10">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group col-md-10">
                            <label for="exampleInputEmail1">Isi pesan</label>
                            <input type="text" class="form-control" name="message">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                    <button type="button" class="btn btn-default">Reset</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</div>

<!--Modal artist-->
<div class="modal fade" id="modal_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Fullname</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $row) { ?>
                            <tr>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['fullname']; ?></td>
                                <td>
                                    <button class="btn btn-info" data-toggle="tooltip" data-placement="top"
                                            title="Pilih" onclick="pick('<?= $row['username'] ?>')">
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