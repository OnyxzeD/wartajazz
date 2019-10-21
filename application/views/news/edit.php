<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit News</h3>
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
                <form role="form" action="<?= base_url('news/update') ?>" name="registration" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="hidden" name="url" value="<?= $data['url'] ?>">
                            <input type="text" class="form-control" placeholder="Judul" name="title"
                                   value="<?= $data['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea class="wysiwyg" name="content" placeholder="Place some text here"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                <?= $data['content']; ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Pilih tags"
                                    style="width: 100%;" name="tags[]">
                                <option <?= (in_array('News', $tags) == 1 ? 'selected' : ''); ?> >News</option>
                                <option <?= (in_array('Profile', $tags) == 1 ? 'selected' : ''); ?> >Profile</option>
                                <option <?= (in_array('Birthday', $tags) == 1 ? 'selected' : ''); ?> >Birthday</option>
                                <option <?= (in_array('Festival', $tags) == 1 ? 'selected' : ''); ?> >Festival</option>
                                <option <?= (in_array('Interview', $tags) == 1 ? 'selected' : ''); ?> >Interview
                                </option>
                                <option <?= (in_array('New Release', $tags) == 1 ? 'selected' : ''); ?> >New Release
                                </option>
                                <option <?= (in_array('Style', $tags) == 1 ? 'selected' : ''); ?> >Style</option>
                                <option <?= (in_array('Review', $tags) == 1 ? 'selected' : ''); ?> >Review</option>
                            </select>
                        </div>
                        <div class="timeline-item">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" class="form-control" name="thumbnail" onchange="readURL(this)" value="empty">
                            </div>
                            <div class="timeline-body">
                                <img src="<?= base_url('assets/images/news/') . $data['thumbnail'] ?>" alt="..."
                                     class="margin" id="preview"
                                     style="width: 300px; height: auto">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submitTeacher" class="btn btn-primary">Ubah</button>
                        <a href="<?= base_url('news') ?>" class="btn btn-default">Batal</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>