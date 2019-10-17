<table class="table table-bordered table-striped">
    <tr>
        <td class="col-md-4">Pemilik Bisnis</td>
        <td class="col-md-8"><?= $data['Nama']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Bentuk Usaha</td>
        <td class="col-md-8"><?= $data['Bentuk']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Jenis Tempat</td>
        <td class="col-md-8"><?= (($data['Jenis_Tempat'] == "rt") ? "Rumah Makan" : "Kafe"); ?></td>
    </tr>
    <tr>
        <td class="col-md-4">No Telpon</td>
        <td class="col-md-8"><?= $data['Telp']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Alamat</td>
        <td class="col-md-8"><?= $data['Alamat']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">No Rekening</td>
        <td class="col-md-8"><?= $data['Rekening']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Bank</td>
        <td class="col-md-8"><?= $data['Bank_Nama']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Tanggal Bergabung</td>
        <td class="col-md-8"><?= convertDate($data['created_at'], 'indo'); ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Kontrak Berakhir</td>
        <td class="col-md-8"><?= convertDate($expDate, 'indo'); ?></td>
    </tr>
</table>