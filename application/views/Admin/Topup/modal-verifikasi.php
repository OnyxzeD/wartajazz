<form id="MyForm" method="post">
    <input type="hidden" name="Id" value="<?= $data['Id_Topup']; ?>">
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
            <td class="col-md-8"><?= convertDate($data['confirmed_at'], 'indo'); ?></td>
        </tr>
        <tr>
            <td class="col-md-4">Bukti Transfer</td>
            <td class="col-md-8">
                <img src="<?= base_url('assets/landing/img/bukti/') . $data['Photo'] ?>" alt="">
            </td>
        </tr>
        <tr>
            <td class="col-md-4">Status</td>
            <?php $status = ['Belum Konfirmasi', 'Sukses', 'Siap Verifikasi']; ?>
            <td class="col-md-8"><?= $status[$data['Status']]; ?></td>
        </tr>
        <tr>
            <td>Tindakan</td>
            <td>
                <div style="width:200px">
                    <select name="tindakan" class="form-control">
                        <option value="1" selected>Setujui</option>
                        <option value="2">Tolak</option>
                    </select>
                </div>
            </td>
        </tr>
    </table>
</form>
