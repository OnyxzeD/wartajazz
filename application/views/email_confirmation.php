<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Email</title>
    <!-- Core Stylesheet -->
    <link href="<?= base_url('assets/landing/style.css'); ?>" rel="stylesheet">

    <link href="<?= base_url('assets/landing/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
    <!-- Responsive CSS -->
    <link href="<?= base_url('assets/landing/css/responsive.css'); ?>" rel="stylesheet">
</head>
<body>
<div class="container">
    <img src="<?= base_url('assets/landing/img/logo_e.png'); ?>" style="margin-top: 30px; margin-bottom: 30px;">
    <p style="color: black;">
        Hai Pengguna Tempat.in
    </p>
    <p style="color: black;">
        Terima kasih telah mendaftar menjadi partner Tempat.in.
    </p>
    <p style="color: black;">
        Kami telah menerima pendaftaran akun anda di Tempat.in Berikut adalah detail login akun Tempat.in anda :
    </p>
    <p style="color: black;">
        Username : <?= $user['name']; ?>
        <br>
        Password : <?= $user['password']; ?>
    </p>
    <p style="color: black;">
        Untuk mengkonfirmasi pendaftaran akun Anda, silakan klik link di bawah ini.
    </p>
    <a href="<?= $user['link']; ?>" target="_blank">
        <?= $user['link']; ?>
    </a>
    <br>

    <p style="color: black;">
        Segala bentuk informasi seperti nomor kontak, alamat e-mail atau password anda bersifat rahasia. Jangan
        menginformasikan data-data tersebut kepada siapapun, termasuk kepada pihak yang mengatasnamakan Tempat.in
    </p>
    <p style="color: black;">
        Terima kasih,
        <br>
        <a href="www.tempat.in">Tempat.in</a>
    </p>
</div>
</body>
</html>