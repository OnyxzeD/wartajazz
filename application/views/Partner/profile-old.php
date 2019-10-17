<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/office/') ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/office/') ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('assets/office/') ?>dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_url('assets/office/') ?>bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url('assets/office/') ?>bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <?php foreach ($Data as $row) { ?>
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url($row['Logo']) ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $_SESSION['Account']['Name']; ?></h3>

              <p class="text-muted text-center"><?= $row['Bentuk']; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Rating <?= $row['Rating']; ?></b>
                </li>
                <li class="list-group-item">
                  <b><?= $row['Jenis_Tempat']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Join Date <?= $row['join_date']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Alamat <?= $row['Alamat']; ?></b>
                </li>
                <li class="list-group-item">
                  <b><?= $row['nama']; ?></b>
                </li>
                <li class="list-group-item">
                  <b><?= $row['nama']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Telp <?= $row['Telp']; ?></b>
                </li>
              </ul>
              <a href="#" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Rekening</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Nama Bank</b>
                </li>
                <li class="list-group-item">
                  <b>No <?= $row['Rekening']; ?></b>
                </li>
                <li class="list-group-item">
                  <b>Pemilik <?= $row['Pemilik_Rekening']; ?></b>
                </li>
              </ul>
              <a href="#" class="btn btn-primary btn-block"><b>Ganti Rekening</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <?php } ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#outlets" data-toggle="tab">Outlets</a></li>
              <li><a href="Profile/user#users" data-toggle="tab">Users</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="outlets">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Outlets</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Data as $row) { ?>
                      <tr>
                        <td><?= $row['Nama']; ?></td>
                        <td><?= $row['Bentuk']; ?></td>
                        <td><?= $row['Alamat']; ?></td>
                        <td>
                            <!-- <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Admin/Partner/modalDetail/' . $row['ID_Outlet'] ?>"
                                    x-okbtn="false"
                                    x-title="Detail Partner" data-toggle="tooltip" data-placement="top"
                                    title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </button> -->
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="users">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Manager</th>
                        <th>No Telp</th>
                        <th>Alamat Email</th>
                        <th>Outlet</th>
                      </tr>
                    </thead>
                    <tbody>
                    <!-- <?php foreach ($Data as $row) { ?>
                    <tr>
                        <td><?= $row['Nama']; ?></td>
                        <td><?= $row['Telp']; ?></td>
                        <td><?= $row['Email']; ?></td>
                        <td><?= $row['Outlet_Nama']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info x_BM_GetForm_AjaxSubmit"
                                    x-targeturl="<?= 'Admin/Partner/modalDetail/' . $row['Id_Manager'] ?>"
                                    x-okbtn="false"
                                    x-title="Detail Partner" data-toggle="tooltip" data-placement="top"
                                    title="Detail Data">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                      </tr>
                    <?php } ?> -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->  

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
