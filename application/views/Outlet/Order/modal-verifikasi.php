<form id="MyForm" method="post">
    <input type="hidden" name="Id" value="<?= $Id ?>">
    <table class="table-information maxwidth">
        <colgroup>
            <col style="width:110px"/>
            <col/>
        </colgroup>
        <tbody>
        <tr>
            <td>Kehadiran</td>
            <td>
                <div style="width:200px">
                    <select name="kehadiran" id="kehadirna" class="form-control">
                        <option value="1" selected>Datang</option>
                        <option value="2">Tidak Datang</option>
                    </select>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</form>
