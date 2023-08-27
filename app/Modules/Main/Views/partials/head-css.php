<!-- preloader css -->
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/preloader.min.css" type="text/css" />

<!-- Bootstrap Css -->
<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- <script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js" defer="defer"></script> -->
<script src="<?= base_url() ?>/assets/libs/jquery/jquery.min.js"></script>
<link href="<?= base_url() ?>/assets/libs/select2/select2-min.css" rel="stylesheet" />
<script src="<?= base_url() ?>/assets/libs/select2/select2-min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script> -->


<!-- <script src="<?= base_url() ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/feather-icons/feather.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/pace-js/pace.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script> -->
<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 36px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 34px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        position: absolute;
        top: 1px;
        right: 5px;
        width: 20px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 15px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: darkgray;
        opacity: 0.9;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        cursor: pointer;
        float: right;
        font-weight: bold;
        height: 34px;
        margin-right: 26px;
        padding-right: 0px;
    }

    .action-button {
        display: flex;
    }

    .action-button>button {
        margin: 0 2px;
    }
</style>