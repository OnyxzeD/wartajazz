<table class="table table-bordered table-striped">
    <tr>
        <td class="col-md-4">Username</td>
        <td class="col-md-8"><?= $data['Name']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">E-Mail</td>
        <td class="col-md-8"><?= $data['Email']; ?></td>
    </tr>
    <tr>
		<?php $type = ["Developer", "Pemilik", "Manajer Outlet", "Customer"]; ?>
        <td class="col-md-4">Type</td>
        <td class="col-md-8"><?= $type[$data['Type']]; ?></td>
    </tr>
    <tr>
<!--        <td class="col-md-4">Nama Usaha</td>-->
<!--        <td class="col-md-8">--><?//= $data['Telp']; ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="col-md-4">Alamat</td>-->
<!--        <td class="col-md-8">--><?//= $data['Alamat']; ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="col-md-4">No Rekening</td>-->
<!--        <td class="col-md-8">--><?//= $data['Rekening']; ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="col-md-4">Bank</td>-->
<!--        <td class="col-md-8">--><?//= $data['Bank_Nama']; ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="col-md-4">Tanggal Bergabung</td>-->
<!--        <td class="col-md-8">--><?//= convertDate($data['join_date'], 'indo'); ?><!--</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="col-md-4">Kontrak Berakhir</td>-->
<!--        <td class="col-md-8">--><?//= convertDate($expDate, 'indo'); ?><!--</td>-->
<!--    </tr>-->
</table>
