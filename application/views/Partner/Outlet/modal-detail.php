<table class="table table-bordered table-striped">
    <tr>
        <td class="col-md-4">Pemilik Bisnis</td>
        <td class="col-md-8"><?= $data['Nama_Pemilik']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Nama Outlet</td>
        <td class="col-md-8"><?= $data['Nama']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Alamat</td>
        <td class="col-md-8"><?= $data['Alamat']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">No Telpon</td>
        <td class="col-md-8"><?= $data['Telp']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Jumlah Kursi</td>
        <td class="col-md-8"><?= (int)$data['Jumlah_Kursi']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Kursi Tersedia</td>
        <td class="col-md-8"><?= (int)$data['Kursi_Tersedia']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Berdiri Sejak</td>
        <td class="col-md-8"><?= convertDate($data['Berdiri_Sejak'], 'indo'); ?></td>
    </tr>
</table>