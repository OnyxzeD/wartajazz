<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <?php
            for ($i = 1; $i <= 40; $i++) { ?>

                <div class="col-md-2">
                    <button type="button" class="btn col-md-10 btn-info x_BM_GetForm_AjaxSubmit" style="margin-top: 10px;"
                            x-targeturl="<?= 'Partner/Outlet/modalCreate' ?>"
                            x-submiturl="<?= 'Partner/Outlet/create' ?>"
                            x-title="Tambah Outlet" x-presubmit="cekInput"
                            x-onshown="" x-postsubmit="Postsubmit">
                        <?php echo $i ?>
                    </button>
                </div>
                <div class="col-md-1">
                    &nbsp;
                </div>
            <?php } ?>
        </div>
    </div>
</div>
