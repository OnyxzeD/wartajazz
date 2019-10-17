<table class="table table-bordered table-striped">
    <tr>
        <td class="col-md-4">Nama</td>
        <td class="col-md-8"><?= $data['Nama']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Kode</td>
        <td class="col-md-8"><?= $data['Code']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Nominal</td>
        <td class="col-md-8"><?= $data['Nominal']; ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Tgl Transaksi</td>
        <td class="col-md-8"><?= convertDate($data['Tgl_Transaksi'], 'indo'); ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Tgl Konfirmasi</td>
        <td class="col-md-8"><?= ($data['confirmed_at'] == null ? '-' : convertDate($data['confirmed_at'], 'indo')); ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Tgl Verifikasi</td>
        <td class="col-md-8"><?= ($data['verified_at'] == null ? '-' : convertDate($data['verified_at'], 'indo')); ?></td>
    </tr>
    <tr>
        <td class="col-md-4">Bukti Transfer</td>
        <td class="col-md-8">
            <img src="<?= base_url('assets/landing/img/bukti/') . $data['Photo'] ?>" alt="">
        </td>
    </tr>
    <tr>
        <td class="col-md-4">Status</td>
        <?php $status = ['Belum Konfirmasi', 'Sukses', 'Siap Verifikasi', 'Ditolak']; ?>
        <td class="col-md-8"><?= $status[$data['Status']]; ?></td>
    </tr>
</table>
