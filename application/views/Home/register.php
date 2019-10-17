<!-- ***** Breadcumb Area Start ***** -->
<div class="mosh-breadcumb-area"
     style="background-image: url(<?= base_url('assets/landing/img/core-img/breadcumb.png') ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumbContent">
                    <h2>Join Us</h2>
                    <p style="font-size: 14px; color: #FFFFFF; font-family: 'Roboto', sans-serif">Become Our
                        Partners</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Breadcumb Area End ***** -->

<!-- ***** About Us Area Start ***** -->
<section class="mosh-aboutUs-area section_padding_50_0">
<!--    <form style="padding-bottom: 20px;" action="--><?php //echo base_url('Admin/Partner/Join'); ?><!--" method="post">-->
    <?php echo form_open_multipart('Admin/Partner/Join');?>
        <div class="container">
            <div id="accordion">
                <!--BEGIN FIRST CARD-->
                <div class="card border-default mb-3 text-center">
                    <!--                    <div class="card-header" style="background-color: #25499f">-->
                    <div class="card-header" style="background-color: #337ab7; border-color: #2e6da4;">
                        <a class="collapsed card-link text-center" data-toggle="collapse" href="#collapseFIRST">
                            <h5 class="card-title text-white">Profil Perusahaan/Pemilik</h5>
                            <h6 class="card-subtitle mb-2 text-white">Informasi Pemilik Usaha</h6>
                        </a>
                    </div>
                    <div id="collapseFIRST" class="collapse show" data-parent="#accordion">
                        <div class="card-body text-left">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Nama Perusahaan/Pemilik</label>
                                    <input type="text" class="form-control" name="pemilik">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Bentuk Badan Usaha</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="badan_usaha" value="Company">
                                            Company
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="badan_usaha" value="Personal">
                                            Personal
                                        </label>
                                    </div>
                                </div>
                            </div>
							<div class="row from-group">
								<div class="col-md-12">
									<label>Kategori</label>
									<select class="form-control" style="height: 35px;" name="kategori">
										<option value="">- Kategori -</option>
										<option value="rt">Rumah Makan</option>
										<option value="cf">Kafe</option>
									</select><br>
								</div>
							</div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Email Perusahaan/Pemilik</label>
                                    <input type="email" class="form-control" name="email_pemilik"/>
                                    <span class="help-block">Pastikan alamat email valid. contoh : cs@tempat.in</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Telpon Perusahaan/Pemilik</label>
                                    <input type="text" class="form-control" onkeydown='validateNumber(event)'
                                           pattern="\d*" maxlength="12" name="telp_pemilik"/>
                                    <span class="help-block">Pastikan nomor yang tertera aktif. contoh : 08123456789</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Provinsi : </label>
                                    <select name="prov_pemilik" class="form-control" id="provinsi" style="height: 35px">
                                        <option>- Pilih Provinsi -</option>
                                        <?php foreach ($provinsi as $prov) {
                                            echo '<option value="' . $prov->id . '">' . $prov->nama . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Kabupaten/Kota : </label>
                                    <select name="kabkot_pemilik" class="form-control" id="kabupaten"
                                            style="height: 35px">
                                        <option value=''>- Pilih Kabupaten -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Alamat Perusahaan/Pemilik</label><br>
                                    <textarea rows="4" cols="50" class="form-control" type="text"
                                              name="alamat_pemilik"></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>Jenis Identitas</label>
                                    <select class="form-control" style="height: 35px;" name="identitas_pemilik">
                                        <option value="">- Jenis Identitas -</option>
                                        <option value="ktp">Kartu Tanda Penduduk</option>
                                        <option value="passport">Passport</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Nomor Identitas</label>
                                    <input type="text" class="form-control" onkeydown='validateNumber(event)'
                                           pattern="\d*" maxlength="16" name="nomor_identitas">
                                    <span class="help-block">16 digit unik sesuai kartu identitas</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Upload Identitas Pemilik</label><br>
                                <div class="row">
                                    <div class="col-md-4" id="preview">
                                        <img src="<?= base_url('assets/landing/img/personal/ktp.png'); ?>"
                                             style='float: left;'/>
                                    </div>
                                    <div class="col-md-4 view third-effect" id="effect">
                                        <img id="img-preview" />
                                        <div class="mask">
                                            <a href="#" onclick="removeImage()" class="info">Hapus</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Pilih file scan/foto kartu identitas Anda.</p>
                                        <p>Foto Identitas yang dilampirkan masih berlaku saat ini, tidak boleh terpotong
                                            di
                                            sisi manapun, harus terbaca dan tidak blur.</p>
                                        <p>Maksimal 3MB per file.</p>
                                        <input type="file" class="form-control btn-sm btn-info" name="foto_identitas" id="foto_identitas"
                                               onchange="readURL(this)">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--END FIRST CARD-->

                <input type="hidden" name="jumlah-outlet" id="jumlah-outlet" value="1">
                <!--BEGIN SECOND CARD-->
                <div class="card border-default mb-3 text-center" id="outlet-1">
                    <div class="card-header" style="background-color: #337ab7; border-color: #2e6da4;">
                        <a class="collapsed card-link text-center" data-toggle="collapse" href="#outlet-collapse-1">
                            <h5 class="card-title text-white">Data Outlet #1</h5>
                            <h6 class="card-subtitle mb-2 text-white">Informasi Tempat Usaha</h6>
                        </a>
                    </div>
                    <div id="outlet-collapse-1" class="collapse" data-parent="#accordion">
                        <div class="card-body text-left">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Nama Outlet</label>
                                    <input type="text" class="form-control" name="outlet-nama-1">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10">
                                    <label>Alamat Outlet</label>
                                    <input type="text" class="form-control" name="outlet-alamat-1">
                                </div>
                                <div class="col-md-2">
                                    <label></label><br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                        Pilih Lokasi
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="width:500px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="width:100%;height:380px;">
                                                    <input id="pac-input" class="controls" type="text"
                                                           placeholder="Search Box">
                                                    <div id="map"></div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Telp Outlet</label>
                                    <input type="text" class="form-control" onkeydown="validateNumber(event)"
                                           pattern="\d*" maxlength="12" name="outlet-telp-1"/>
                                </div>
                            </div>
                            <div class="row form-group" id="add-outlet-1">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary col-md-12" onclick="addOutlet()">
                                        <span><i class='fa fa-plus'></i>&nbsp;</span> Tambah Outlet
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--END SECOND CARD-->

                <!--BEGIN THIRD CARD-->
                <div class="card border-default mb-3 text-center">
                    <div class="card-header" style="background-color: #337ab7; border-color: #2e6da4;">
                        <a class="collapsed card-link text-center" data-toggle="collapse" href="#collapse3">
                            <h5 class="card-title text-white">Data Pembayaran</h5>
                            <h6 class="card-subtitle mb-2 text-white">Informasi Pembayaran</h6>
                        </a>
                    </div>
                    <div id="collapse3" class="collapse" data-parent="#accordion">
                        <div class="card-body text-left">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Nama Bank</label>
                                    <select name="bank" class="form-control" id="bank" style="height: 35px">
                                        <option>- Pilih Bank -</option>
                                        <?php foreach ($bank as $bk) {
                                            echo '<option value="' . $bk->kode . '">' . $bk->nama . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control" onkeydown='validateNumber(event)'
                                           name="no_rekening">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Nama Pemilik Rekening</label>
                                    <input type="text" class="form-control" name="an_rekening"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Upload Scan Buku Tabungan</label><br>
                                <div class="row">
                                    <div class="col-md-4" id="preview-bank">
                                        <img src="<?= base_url('assets/landing/img/personal/tabungan.png'); ?>"
                                             style='float: left;'/>
                                    </div>
                                    <div class="col-md-4 view third-effect" id="effect-bank">
                                        <img id="img-preview-bank" />
                                        <div class="mask">
                                            <a href="#" onclick="removeImage()" class="info">Hapus</a>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <p>Informasi rekening dapat diambil dari Foto halaman pertama dan kedua buku
                                            tabungan atau eBanking yang mencakup informasi Nomor Rekening.</p>
                                        <p>Nama Pemilik rekening (harus sama dengan nama pemilik store), dan Informasi
                                            bank (nama bank & cabang). Foto tidak blur.</p>
                                        <p>Maksimal 3MB per file.</p>

                                        <input type="file" class="form-control btn-sm btn-info" name="foto_rekening" id="foto_rekening"
                                               onchange="readURL(this, 'bank')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END THIRD CARD-->

                <!--BEGIN THIRD CARD-->
                <div class="card border-default mb-3 text-center">
                    <button class="btn col-md-12 btn-default" type="submit" value="simpan">
                        Daftar
                    </button>
                </div>
                <!--END THIRD CARD-->
            </div>
        </div>
    </form>
</section>
