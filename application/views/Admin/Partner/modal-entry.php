<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['ID_Partner']) ? $data['ID_Partner'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label for="inputNama">Nama</label>
            <input type="text" class="form-control" id="inputNama" name="pemilik"
                   value="<?= (isset($data['Nama']) ? $data['Nama'] : "") ?>">
        </div>
    </div>
    <div class="row from-group">
        <div class="col-md-10">
            <label>Kategori Outlet</label>
            <select class="form-control" style="height: 35px;" name="badan_usaha">
                <option value="">- Badan Usaha -</option>
                <option value="Company" <?= ((isset($data['Bentuk']) && $data['Bentuk'] == "Company") ? "selected" : "") ?> >
                    Company
                </option>
                <option value="Personal" <?= ((isset($data['Bentuk']) && $data['Bentuk'] == "Personal") ? "selected" : "") ?> >
                    Personal
                </option>
            </select><br>
        </div>
    </div>
    <div class="row from-group">
        <div class="col-md-10">
            <label>Kategori Outlet</label>
            <select class="form-control" style="height: 35px;" name="kategori">
                <option value="">- Kategori -</option>
                <option value="rt" <?= ((isset($data['Jenis_Tempat']) && $data['Jenis_Tempat'] == "rt") ? "selected" : "") ?> >
                    Rumah Makan
                </option>
                <option value="cf" <?= ((isset($data['Jenis_Tempat']) && $data['Jenis_Tempat'] == "cf") ? "selected" : "") ?> >
                    Kafe
                </option>
            </select><br>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Telp Outlet</label>
            <input type="text" class="form-control" onkeydown="validateNumber(event)"
                   pattern="\d*" maxlength="12" name="telp_pemilik"
                   value="<?= (isset($data['Telp']) ? $data['Telp'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label for="inputAlamat">Alamat</label>
            <input type="text" class="form-control" id="inputAlamat" name="alamat_pemilik"
                   value="<?= (isset($data['Alamat']) ? $data['Alamat'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nama Bank</label>
            <select name="bank_kode" class="form-control" style="height: 35px">
                <option>- Pilih Bank -</option>
                <?php foreach ($bank as $bk) {
                    if ($data['Kode_Bank'] == $bk->kode) {
                        echo '<option value="' . $bk->kode . '" selected>' . $bk->nama . '</option>';
                    } else {
                        echo '<option value="' . $bk->kode . '">' . $bk->nama . '</option>';
                    }
                } ?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nomor Rekening</label>
            <input type="text" class="form-control" onkeydown="validateNumber(event)"
                   pattern="\d*" name="no_rekening"
                   value="<?= (isset($data['Rekening']) ? $data['Rekening'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Pemilik Rekening</label>
            <input type="text" class="form-control" name="pemilik_rekening"
                   value="<?= (isset($data['Pemilik_Rekening']) ? $data['Pemilik_Rekening'] : "") ?>">
        </div>
    </div>
</form>

<script>
    <?php
    //    $date = date_create($data['Persetujuan_Tgl']);
    //    date_sub($date, date_interval_create_from_date_string("1 days"));
    //    $start = date_format($date, "Y-m-d");
    ?>
    //startDate = new Date('<?//= $start; ?>//');
</script>
