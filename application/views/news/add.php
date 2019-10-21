<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add News</h3>
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
                <form role="form" action="<?= base_url('news/save')?>" name="registration" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" placeholder="Judul" name="title">
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea class="wysiwyg" name="content" placeholder="Place some text here"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Pilih tags"
                                    style="width: 100%;" name="tags[]">
                                <option>News</option>
                                <option>Profile</option>
                                <option>Birthday</option>
                                <option>Festival</option>
                                <option>Interview</option>
                                <option>New Release</option>
                                <option>Style</option>
                                <option>Review</option>
                            </select>
                        </div>
                        <div class="timeline-item">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail" onchange="readURL(this)">
                            </div>
                            <div class="timeline-body">
                                <img src="http://via.placeholder.com/300x300" alt="..." class="margin" id="preview"
                                     style="">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submitTeacher" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url('news')?>" class="btn btn-default">Batal</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>