<!-- ***** Breadcumb Area Start ***** -->
<div class="mosh-breadcumb-area"
     style="background-image: url(<?= base_url('assets/landing/img/core-img/breadcumb.png') ?>);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumbContent">
                    <h2>Visit Us</h2>
                    <p style="font-size: 14px; color: #FFFFFF; font-family: 'Roboto', sans-serif">Come and enjoy our
                        partner's place</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Breadcumb Area End ***** -->

<section class="mosh-portfolio-area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mosh-projects-menu">
                    <div class="portfolio-menu">
                        <p class="active" data-filter="*">All</p>
                        <p data-filter=".rt">Restaurant</p>
                        <p data-filter=".cf">Cafe</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    <div class="single_gallery_item rt">-->
    <!--        <img src="--><? //= $path ?><!--img/partners/site-nelongso.png" alt="">-->
    <!--        <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">-->
    <!--            <div class="port-hover-text text-center">-->
    <!--                <h4>Ayam Goreng Nelongso</h4>-->
    <!--                <a href="#">Brand Identity</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <div class="mosh-portfolio">
        <?php
        foreach ($partners as $p) {
            ?>
            <!-- Single gallery Item Start -->
            <div class="single_gallery_item <?= $p['Jenis_Tempat'] ?>">
                <img src="<?= $path . $p['Logo'] ?>" onerror="this.src='<?= "../assets/landing/img/partners/default.jpg" ?>';" alt="">
                <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
                    <div class="port-hover-text text-center">
                        <h4><?= $p['Nama']; ?></h4>
                        <a href="#">Brand Identity</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- Single gallery Item Start -->
    </div>
</section>