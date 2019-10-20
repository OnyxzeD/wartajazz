<form id="MyForm" method="post" role="form">
    <input type="hidden" name="Id" value="<?= (isset($data['username']) ? $data['username'] : ""); ?>">
    <div class="row form-group">
        <?php if (isset($data['username'])) { ?>
            <div class="col-md-10">
                <label>Username</label>
                <input type="text" class="form-control" name="username"
                       value="<?= $data['username'] ?>" readonly>
            </div>
        <?php } else { ?>
            <div class="col-md-10">
                <label>Username</label>
                <input type="text" class="form-control" name="username"
                       value="">
            </div>
        <?php } ?>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password">
                <span class="input-group-addon toggle-password"><i class="fa fa-eye"></i></span>
            </div>
            <?php if (isset($data['username'])) { ?>
                <p class="help-block">Kosongkan jika tidak berubah</p>
            <?php } ?>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Password Confirmation</label>
            <div class="input-group">
                <input type="password" class="form-control" name="confirm_password">
                <span class="input-group-addon toggle-password"><i class="fa fa-eye"></i></span>
            </div>
            <?php if (isset($data['username'])) { ?>
                <p class="help-block">Kosongkan jika tidak berubah</p>
            <?php } ?>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nama Pengguna</label>
            <input type="text" class="form-control" name="fullname"
                   value="<?= (isset($data['fullname']) ? $data['fullname'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Email</label>
            <input type="email" class="form-control" name="email"
                   value="<?= (isset($data['email']) ? $data['email'] : "") ?>">
        </div>
    </div>
    <div class="row from-group">
        <div class="col-md-10">
            <label>Role</label>
            <select name="role" class="form-control" style="height: 35px">
                <option value='' disabled>- Pilih Role -</option>
                <?php foreach ($roles as $out) {
                    $selected = "";
                    if (isset($data['role_id']) && ($out['role_id'] == $data['role_id'])) {
                        $selected = "selected";
                    }
                    echo '<option value="' . $out['role_id'] . '" ' . $selected . '>' . $out['role_name'] . '</option>';
                } ?>
            </select>
        </div>
    </div>
</form>

<script>
    $('.toggle-password').click(function () {
        // console.log('clicked');
        thisPassword = $(this).parent().find('input');
        if (thisPassword != null && thisPassword != undefined) {
            if (thisPassword.attr('type') == 'password') {
                $(this).html('<i class="fa fa-eye-slash"></i>');
                thisPassword.attr('type', 'text');
            } else {
                $(this).html('<i class="fa fa-eye"></i>');
                thisPassword.attr('type', 'password');
            }
        }
    });
</script>
