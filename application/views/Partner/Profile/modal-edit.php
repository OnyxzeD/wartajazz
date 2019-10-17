<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['ID_Partner']) ? $data['ID_Partner'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label for="inputNama">Nama</label>
            <input type="text" class="form-control" id="inputNama" name="pemilik"
                   value="<?= (isset($data['Nama']) ? $data['Nama'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <label>Bentuk Badan Usaha</label>
            <div class="radio">
                <label>
                    <input type="radio" name="badan_usaha"
                           value="Company" <?= ($data['Bentuk'] == "Company" ? "checked" : "") ?> >
                    Company
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="badan_usaha"
                           value="Personal" <?= ($data['Bentuk'] == "Personal" ? "checked" : "") ?>>
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
                <option value="rt" <?= ($data['Jenis_Tempat'] == "rt" ? "selected" : "") ?> >Rumah Makan</option>
                <option value="cf" <?= ($data['Jenis_Tempat'] == "cf" ? "selected" : "") ?>>Kafe</option>
            </select><br>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat_pemilik"
                   value="<?= (isset($data['Alamat']) ? $data['Alamat'] : "") ?>">
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
</form>
