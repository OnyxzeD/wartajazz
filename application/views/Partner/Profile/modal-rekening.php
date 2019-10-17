<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['ID_Partner']) ? $data['ID_Partner'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label>Bank</label>
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
            <label>No Rekening</label>
            <input type="text" class="form-control" onkeydown="validateNumber(event)"
                   pattern="\d*" maxlength="12" name="no_rekening"
                   value="<?= (isset($data['Rekening']) ? $data['Rekening'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Pemilik Rekening</label>
            <input type="text" class="form-control" maxlength="50" name="pemilik_rekening"
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
