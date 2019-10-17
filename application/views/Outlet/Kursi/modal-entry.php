<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['ID_Outlet']) ? $data['ID_Outlet'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label for="inputNama">Nama</label>
            <input type="text" class="form-control" id="inputNama" name="outlet-nama"
                   value="<?= (isset($data['Nama']) ? $data['Nama'] : "") ?>">
        </div>
    </div>
	<div class="row form-group">
        <div class="col-md-10">
            <label>Telp Outlet</label>
            <input type="text" class="form-control" onkeydown="validateNumber(event)"
                   pattern="\d*" maxlength="12" name="outlet-telp"
                   value="<?= (isset($data['Telp']) ? $data['Telp'] : "") ?>">
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
