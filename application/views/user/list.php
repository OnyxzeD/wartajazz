<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<!--        <div style="margin-bottom: 10px">-->
<!--            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"-->
<!--                    x-targeturl="--><?//= 'Admin/Users/modalCreate' ?><!--"-->
<!--                    x-submiturl="--><?//= 'Admin/Users/create' ?><!--"-->
<!--                    x-title="Tambah Users" x-presubmit="cekInput"-->
<!--                    x-onshown="" x-postsubmit="x_BM_PostSubmit_Default">-->
<!--                <i class="fa fa-plus"></i> &nbsp; Tambah-->
<!--            </button>-->
<!--        </div>-->
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Alamat Email</th>
                    <th>Type</th>
                    <th>Nama Usaha</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
<!--                --><?php
//                $type = ["Developer", "Pemilik", "Manajer Outlet", "Customer"];
//                $status = ["Daftar Baru", "Aktif", "Dokumen Belum Lengkap"];
//                foreach ($Data as $row) { ?>
<!--                    <tr>-->
<!--                        <td>--><?//= $row['Name']; ?><!--</td>-->
<!--                        <td>--><?//= $row['Email']; ?><!--</td>-->
<!--                        <td>--><?//= $type[$row['Type']]; ?><!--</td>-->
<!--                        <td>--><?//= $row['Office']; ?><!--</td>-->
<!--                        <td>--><?//= $status[$row['Status']]; ?><!--</td>-->
<!--                        <td>-->
<!--                            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"-->
<!--                                    x-targeturl="--><?//= 'Admin/User/modalDetail/' . $row['Id'] ?><!--"-->
<!--                                    x-okbtn="false"-->
<!--                                    x-title="Detail User" data-toggle="tooltip" data-placement="top"-->
<!--                                    title="Detail Data">-->
<!--                                <i class="fa fa-eye"></i>-->
<!--                            </button> &nbsp;-->
<!--                            <button class="btn btn-danger x_BM_GetForm_AjaxSubmit"-->
<!--                                    x-targeturl="--><?//= 'Admin/User/modalDelete/' . $row['Id'] ?><!--"-->
<!--                                    x-submiturl="--><?//= 'Admin/User/delete/' . $row['Id'] ?><!--"-->
<!--                                    x-title="Hapus Data" x-width="600px"-->
<!--									x-postsubmit="x_BM_PostSubmit_Default" data-toggle="tooltip" data-placement="top"-->
<!--                                    title="Hapus Data">-->
<!--                                <i class="fa fa-trash"></i>-->
<!--                            </button>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                --><?php //} ?>
            </table>
        </div>
    </div>
</div>
