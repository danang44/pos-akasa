<?php echo view('App\Modules\Main\Views\partials\head-main') ?>

<head>
    <?= $title_meta ?>
    <link href="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <?php echo view('App\Modules\Main\Views\partials\head-css') ?>
</head>

<?php echo view('App\Modules\Main\Views\partials\body') ?>

<!-- Begin page -->
<div id="layout-wrapper">
<?php echo view('App\Modules\Main\Views\partials\menu-page') ?>
<!-- ============================================================== -->
<!--                  Start right Content here                      -->
<!-- ============================================================== -->
<?php
if (isset($load_view)) {
    //echo $title_meta;
    echo $page_titles;
    ?>
    <!-- Begin page -->
    <div class="row" height="100%">
        <?= view($load_view); ?>
    </div>
    <div class="row">
        <?= view('App\Modules\Main\Views\dashboard_bptd'); ?>
    </div>
    <?php
} else {
    echo view('App\Modules\Main\Views\dashboard');
}
?>

<?php echo view('App\Modules\Main\Views\partials\footer') ?>
</div>
<!-- END layout-wrapper -->
<?php echo view('App\Modules\Main\Views\partials\right-sidebar') ?>

<?php echo view('App\Modules\Main\Views\partials\vendor-scripts') ?>

<!-- apexcharts -->
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