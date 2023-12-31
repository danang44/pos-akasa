<?php $session = \Config\Services::session();?>

<?php echo view('App\Modules\Main\Views\partials\head-main') ?>

<head>
    <?= $title_meta ?>
    <link href="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <?php echo view('App\Modules\Main\Views\partials\head-css') ?>
</head>

<?php echo view('App\Modules\Main\Views\partials\body') ?>


<div id="layout-wrapper">
    <?php echo view('App\Modules\Main\Views\partials\menu-page') ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?php
                if (isset($load_view)) {

                    echo $page_titles;
                    echo view($load_view);
                } else {
                    echo view('App\Modules\Main\Views\dashboard_bptd');
                }
                ?>
            </div>
        </div>
        <?php echo view('App\Modules\Main\Views\partials\footer') ?>
    </div>
</div>

<?php echo view('App\Modules\Main\Views\partials\right-sidebar') ?>
<?php echo view('App\Modules\Main\Views\partials\vendor-scripts') ?>


<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js" defer="defer"></script>

<!-- Plugins js-->
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js" defer="defer"></script>
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js" defer="defer"></script>

<!-- dashboard init -->
<script src="<?= base_url() ?>/assets/js/pages/dashboard.init.js" defer="defer"></script>

<!-- App js -->
<script>
    <?php
    if (isset($js_file)) {
        echo $js_file;
    }
    ?>
</script>
<!-- End dashboard init -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/js/app.js" defer="defer"></script>
</body>

</html>