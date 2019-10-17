<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['Partner_Id']) ? $data['Partner_Id'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nama Outlet</label>
            <select name="outlet-id" class="form-control" style="height: 35px">
                <option value='pilih'>- Pilih Outlet -</option>
                <?php foreach ($outlet as $out) {
                    $selected = "";
                    if (isset($data['Outlet_Id']) && ($out['ID_Outlet'] == $data['Outlet_Id'])) {
                        $selected = "selected";
                    }
                    echo '<option value="' . $out['ID_Outlet'] . '" ' . $selected . '>' . $out['Nama'] . '</option>';
                } ?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label for="inputNama">Username</label>
            <input type="text" class="form-control" id="inputNama" name="manager-username"
                   value="<?= (isset($data['Name']) ? $data['Name'] : "") ?>">
        </div>
    </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nama Manager</label>
            <input type="text" class="form-control" name="manager-fullname"
                   value="<?= (isset($data['Nama']) ? $data['Nama'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Telp Manager</label>
            <input type="text" class="form-control" onkeydown="validateNumber(event)"
                   pattern="\d*" maxlength="12" name="manager-phone"
                   value="<?= (isset($data['Telp']) ? $data['Telp'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Email</label>
            <input type="text" class="form-control" name="manager-email" id="inputEmail"
                   value="<?= (isset($data['Email']) ? $data['Email'] : "") ?>">
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
