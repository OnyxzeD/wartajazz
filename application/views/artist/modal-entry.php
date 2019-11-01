<form id="MyForm" method="post" role="form">
    <input type="hidden" name="id" value="<?= (isset($data['artist_id']) ? $data['artist_id'] : ""); ?>">
    <div class="row form-group">
        <div class="col-md-10">
            <label>Nama Artis / Group</label>
            <input type="text" class="form-control" name="artist_name"
                   value="<?= (isset($data['artist_name']) ? $data['artist_name'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Asal</label>
            <input type="text" class="form-control" name="country_of_origin"
                   value="<?= (isset($data['country_of_origin']) ? $data['country_of_origin'] : "") ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-10">
            <label>Detil</label>
            <textarea name="artist_detail" class="form-control"
                      rows="8"><?= (isset($data['artist_detail']) ? $data['artist_detail'] : "") ?></textarea>
        </div>
    </div>
</form>