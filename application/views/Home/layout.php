<?php
$basedir = dirname($_SERVER["SCRIPT_FILENAME"]) . '/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Tempat.in - Reservasi restoran & cafe jadi mudah</title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('assets/landing/img/core-img/favicon.ico'); ?>">

    <!-- Core Stylesheet -->
    <link href="<?php echo base_url('assets/landing/style.css'); ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/landing/css/modal.css'); ?>" rel="stylesheet" type="text/css">

    <!-- Responsive CSS -->
    <link href="<?php echo base_url('assets/landing/css/responsive.css'); ?>" rel="stylesheet">

    <!-- Accordion css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/landing/css/accordion.css'); ?>"/>
    <link type="text/css" rel="stylesheet"
          href="<?= base_url('assets/office/') ?>bower_components/bootstrap/dist/css/bootstrap.css"/>

	<link href="<?= base_url('assets/landing/css/maps.css'); ?>" type="text/css" rel="stylesheet">

	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDFxhk7tOEjomIkOd1u7DpvvGp81F57N0g&libraries=places&callback=initAutocomplete"
			async defer></script>

    <!-- Hover effect -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/landing/css/hover-effect.css'); ?>"/>

<!--	<link href="--><?//= base_url('assets/landing/css/bootstrap.css'); ?><!--" type="text/css" rel="stylesheet">-->

</head>

<body>
<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="mosh-preloader"></div>
</div>

<!-- ***** Header Area Start ***** -->
<header class="header_area clearfix">
    <?php include 'header.php'; ?>
</header>
<!-- ***** Header Area End ***** -->

<!-- ***** Content section Start***** -->
<?php include $basedir . 'application/views/' . $View . '.php'; ?>
<!-- ***** Content section End ***** -->

<!-- ***** Additional Modal Start ***** -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="googleMap" style="width:100%;height:350px;"></div>

                <form action="" method="post">
                    <input type="text" id="lat" name="lat" value="">
                    <input type="text" id="lng" name="lng" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ***** Additional Modal End ***** -->

<!-- ***** Footer Area Start ***** -->
<footer class="footer-area clearfix">
    <?php include 'footer.php'; ?>
</footer>
<!-- ***** Footer Area End ***** -->

<script src="<?php echo base_url('assets/landing/js/app.js'); ?>"></script>
<!-- jQuery-2.2.4 js -->
<script src="<?php echo base_url('assets/landing/js/jquery-2.2.4.min.js'); ?>"></script>
<!-- Popper js -->
<script src="<?php echo base_url('assets/landing/js/popper.min.js'); ?>"></script>
<!-- Bootstrap js -->
<script src="<?php echo base_url('assets/landing/js/bootstrap.min.js'); ?>"></script>
<!-- All Plugins js -->
<script src="<?php echo base_url('assets/landing/js/plugins.js'); ?>"></script>
<!-- Active js -->
<script src="<?php echo base_url('assets/landing/js/active.js'); ?>"></script>

<script src="<?php echo base_url('assets/landing/js/maps2.js'); ?>"></script>

<script src="<?php echo base_url('assets/landing/js/bootstrap.bundle.js'); ?>"></script>

<!--<script type="text/javascript" src="--><?php //echo base_url('assets/landing/js/modal.js'); ?><!--"></script>-->

<!--Accordion form-->
<!--<script src="--><? //= base_url('assets/landing/js/accordion.js');?><!--"></script>-->
<!--<script src="--><? //= base_url('assets/landing/js/masks.js');?><!--"></script>-->

<script src="<?php echo $JScript ?>"></script>

<!--<script>-->
<!--    var modal = document.getElementById('modal-wrapper');-->
<!--    window.onclick = function (event) {-->
<!--        if (event.target == modal) {-->
<!--            modal.style.display = "none";-->
<!--        }-->
<!--    }-->
<!--</script>-->

</body>

</html>
