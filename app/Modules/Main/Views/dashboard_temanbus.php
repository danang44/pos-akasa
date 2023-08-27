<?php $session = \Config\Services::session(); ?>
<!-- style internal -->
<style>
    /* #table-jenis-angkutan {
        width: 100%;
    } */

    .fas:hover {
        /* smooth zoom 1.5s */
        transform: scale(1.5);
        transition: transform 0.5s;
    }

    .fas:not(:hover) {
        /* smooth zoom 1.5s */
        transform: scale(1);
        transition: transform 0.5s;
    }

    /* #jenis-armada-export:hover {
        cursor: pointer;
    } */
</style>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard Fleet Management System</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <!-- <li class="breadcrumb-item active">Dashboard Fleet Management System</li> -->
                    <?php

                    // print_r('<pre>');
                    // print_r($session->get());
                    // print_r('</pre>');

                    if ($session->get('role_code') == 'bpw') {
                        $profile = $session->get('name') . ' (BPTD Wilayah)';
                    } else if ($session->get('role_code') == 'sad') {
                        $profile = $session->get('name') . ' (Admin)';
                    } else if ($session->get('role_code') == 'daj') {
                        $profile = $session->get('name') . ' (Dirjen Angkutan)';
                    } else if ($session->get('role_code') == 'po') {
                        $profile = $session->get('name') . ' (PO)';
                    } else if ($session->get('role_code') == 'ppo') {
                        $profile = $session->get('name') . ' (Petugas PO)';
                    } else {
                        $profile = $session->get('name') . '';
                    }
                    ?>
                    <li class="breadcrumb-item active"><?= $profile ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<!-- start dashboard body -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center ">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Bus</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="99999" id="total_bus">0</span> Bus
                        </h4>
                    </div>
                    <div class="col-6 text-end">
                        <i class="fas fa-bus fa-lg" style="font-size: 3rem;color: #224DDD;"></i>
                    </div>
                </div>
                <div class="row text-nowrap align-self-center" id="detail-bus"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Trayek</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="99999" id="total_rute">0</span> Trayek
                        </h4>
                    </div>
                    <div class="col-6 pb-3 text-end">
                        <i class="fas fa-route fa-lg" style="font-size: 3rem; color: #224DDD;"></i>
                    </div>
                </div>
                <div class="row text-nowrap align-self-center" id="detail-rute"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total User</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="99999" id="total_operator">0</span> User
                        </h4>
                    </div>
                    <div class="col-6 pb-3 text-end">
                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        <i class="fas fa-user-tie fa-lg" style="font-size: 3rem; color: #224DDD;"></i>
                    </div>
                </div>
                <div class="row text-nowrap align-self-center" id="detail-operator">
                    <div class="col align-self-center border-end">
                        <span class="badge bg-soft-info text-info">1</span>
                        <span class="ms-1 text-muted font-size-13">PO</span>
                    </div>
                    <div class="col align-self-center">
                        <span class="badge bg-soft-info text-info">2</span>
                        <span class="ms-1 text-muted font-size-13">Petugas PO</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Total GPS</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="9999" id="total_gps">0</span> GPS
                        </h4>
                    </div>
                    <div class="col-6 pb-3 text-end">
                        <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        <i class="fas fa-location-arrow fa-lg" style="font-size: 3rem; color: #224DDD;"></i>
                    </div>
                </div>
                <div class="row text-nowrap align-self-center">
                    <div class="col align-self-center border-end">
                        <span class="badge bg-soft-success text-success" id="gps_online">0</span>
                        <span class="ms-1 text-muted font-size-13">Online</span>
                    </div>
                    <div class="col align-self-center border-end">
                        <span class="badge bg-soft-warning text-warning" id="gps_idle">0</span>
                        <span class="ms-1 text-muted font-size-13">Idle</span>
                    </div>
                    <div class="col align-self-center">
                        <span class="badge bg-soft-danger text-danger" id="gps_offline">0</span>
                        <span class="ms-1 text-muted font-size-13">Offline</span>
                    </div>
                </div>
                <div class="text-nowrap">
                </div>
                <div class="text-nowrap">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-h-100">
            <div class="card-header p-3">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title me-2 text-uppercase">Performance Management</h5>
                    <div class="ms-auto">
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" id="perf-management-1-hari">Hari Ini</button>
                            <button type="button" class="btn btn-soft-primary btn-sm active" id="perf-management-7-hari">7 Hari</button>
                            <button type="button" class="btn btn-soft-secondary btn-sm" id="perf-management-1-bulan">1 Bulan</button>
                            <button type="button" class="btn btn-soft-secondary btn-sm" id="perf-management-6-bulan">6 Bulan</button>
                            <!-- <button type="button" class="btn btn-soft-secondary btn-sm" id="perf-management-1-tahun">1 Tahun</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4 class="card-title mb-0">SPDA</h4>
                            </div>
                            <div class="card-body" id="card_body_spda_status">
                                <div id="spda_status" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <h4 class="card-title mb-0">LOAD FACTOR</h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center" id="lf-body-status">
                                    <div class="col-xl-4">
                                        <div class="p-4" id="load_factor_list"></div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div id="load_factor_overview-body">
                                            <div id="load_factor_overview" data-colors='["#5156be", "#fd625e", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-xl-12">
        <div class="accordion" id="accordionArmada">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArmada" aria-expanded="true" aria-controls="collapseArmada">MANAGEMENT ARMADA</button>
                </h2>
                <div id="collapseArmada" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionArmada">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">ARMADA KSPN</h4>
                                        <!-- <span data-bs-toggle="tooltip" data-bs-placement="left" title="Export XLS" id="jenis-armada-export"><i class="far fa-file-excel"></i></span> -->
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive px-0 pb-4" data-simplebar>
                                            <table class="table align-middle table-nowrap table-borderless table-hover table-striped" id="table-jenis-armada-kspn">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><span>Rute Bus</span></th>
                                                        <th><span>Plat Nomor</span></th>
                                                        <th><span>Trayek</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-armada-kspn-body"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">ARMADA PERINTIS</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive px-0 pb-4" data-simplebar>
                                            <table class="table align-middle table-nowrap table-borderless table-hover table-striped" id="table-jenis-armada-perintis">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><span>Rute Bus</span></th>
                                                        <th><span>Plat Nomor</span></th>
                                                        <th><span>Trayek</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-armada-perintis-body"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">DATA DRIVER</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive px-0 pb-4" data-simplebar>
                                            <table class="table align-middle table-nowrap table-borderless table-hover table-striped" id="table-driver-armada">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><span>Nama Driver</span></th>
                                                        <th><span>PO Driver</span></th>
                                                        <th><span>Armada</span></th>
                                                        <th><span>Trayek</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-driver-armada-body"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">TOTAL JENIS ARMADA</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="table-responsive px-0 pb-4" data-simplebar>
                                            <table class="table align-middle table-nowrap table-borderless table-hover table-striped" id="table-jenis-angkutan">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><span>Jenis Armada</span></th>
                                                        <th><span>Bus</span></th>
                                                        <th><span>Rute</span></th>
                                                        <th><span>Trip</span></th>
                                                        <th><span>Operator</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-jenis-angkutan-body"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end accordion -->
    </div><!-- end col -->
</div>
<div class="row mb-3">
    <div class="col-xl-12">
        <div class="accordion" id="accordionSpda">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpda" aria-expanded="true" aria-controls="collapseSpda">SPDA METABASE</button>
                </h2>
                <div id="collapseSpda" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionSpda">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header p-3">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title me-2">SPDA PENUMPANG</h5>
                                            <div class="ms-auto">
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="spda-penumpang-1-hari">Hari Ini</button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm active" id="spda-penumpang-7-hari">7 Hari</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="spda-penumpang-1-bulan">1 Bulan</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="spda-penumpang-6-bulan">6 Bulan</button>
                                                    <!-- <button type="button" class="btn btn-soft-secondary btn-sm" id="spda-penumpang-1-tahun">1 Tahun</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row align-items-center">
                                            <div class="col-sm" id="spda-penumpang-body">
                                                <div id="spda-penumpang" data-colors='["#224ddd", "#FFEC51", "#FF674D", "#91a6ee"]' class="apex-charts"></div>
                                            </div>
                                            <div class="col-sm align-self-center">
                                                <div class="mt-4 mt-sm-0 font-size-16">
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2" style="color: #224ddd;"></i>
                                                        Dewasa Laki-laki <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="naik_dl"></strong>
                                                    </p>

                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2" style="color: #FFEC51;"></i>
                                                        Dewasa Perempuan <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="naik_dp"></strong>
                                                    </p>

                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2" style="color: #FF674D;"></i>
                                                        Anak Laki-laki <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="naik_al"></strong>
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-circle align-middle font-size-10 me-2" style="color: #91a6ee;"></i>
                                                        Anak Perempuan <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong id="naik_ap"></strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card h-100">
                                    <div class="card-header p-3">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title me-2">PENUMPANG / JENIS LAYANAN</h5>
                                            <div class="ms-auto">
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm active" id="pnp-jenis-1-hari">Hari Ini</button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm active" id="pnp-jenis-7-hari">7 Hari</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="pnp-jenis-1-bulan">1 Bulan</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="pnp-jenis-6-bulan">6 Bulan</button>
                                                    <!-- <button type="button" class="btn btn-soft-secondary btn-sm" id="pnp-jenis-1-tahun">1 Tahun</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="table-responsive px-0 pb-4" data-simplebar>
                                                <table class="table align-middle table-nowrap table-borderless table-hover table-striped table-sm" id="table-pnp-jenis">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><span>Jenis Armada</span></th>
                                                            <th><span>Total Penumpang</span></th>
                                                            <th><span>Total Kapasitas</span></th>
                                                            <th><span>Load Factor</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-pnp-jenis-body"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-xl-12">
                                <div class="card h-100">
                                    <div class="card-header p-3">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title me-2">TRIP PENUMPANG</h5>
                                            <div class="ms-auto">
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm active" id="trip-pnp-1-hari">Hari Ini</button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm active" id="trip-pnp-7-hari">7 Hari</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="trip-pnp-1-bulan">1 Bulan</button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="trip-pnp-6-bulan">6 Bulan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="table-responsive px-0 pb-4" data-simplebar>
                                                <table class="table align-middle table-nowrap table-borderless table-hover table-striped table-sm" id="table-trip-pnp">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><span>Trip</span></th>
                                                            <th><span>Total Kapasitas</span></th>
                                                            <th><span>Total Penumpang</span></th>
                                                            <th><span>Load Factor</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-trip-pnp-body"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-xl-12">
                                <div class="card h-100">
                                    <div class="card-header p-3">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h5 class="card-title me-2">JAM KEPADATAN PENUMPANG</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label for="route_id_filter">Filter Trayek</label>
                                                    <select class="form-control sel2" style="width: 100%;" name="route_id_filter" id="route_id_filter"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="mb-3">
                                                    <label for="trip_id_filter">Filter Trip</label>
                                                    <select class="form-control sel2" style="width: 100%;" name="trip_id_filter" id="trip_id_filter"></select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="mb-3">
                                                    <label for="tanggal_id_filter">Filter tanggal</label>
                                                    <input type="date" class="form-control date" name="tanggal_id_filter" id="tanggal_id_filter" placeholder="Pilih tanggal">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-12 mt-4 text-center">
                                                <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                                            </div>
                                        </div>
                                        <div class="row align-items-center" id="traffic_pnp_body">
                                            <div id="traffic_pnp" data-colors='["#8bc34a","#9ab02a","#a59d01","#af8800","#b57200","#b95a00","#ba4009","#b71c1c"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end accordion -->
    </div><!-- end col -->
</div>
<!-- end dashboard body -->

<!-- internal dashboard script -->
<script>
    const base_url = '<?= base_url() ?>';
    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const segment = '<?= uri_segment(0) ?>';
    if (segment == 'main') {
        var url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';
    } else {
        var url_ajax = '<?= base_url() . "/main" . "/ajax" ?>';
    }

    const select2Array = [{
            id: 'route_id_filter',
            url: '/get_route',
            placeholder: 'Pilih Trayek',
            params: null
        },
        {
            id: 'trip_id_filter',
            url: '/get_trip',
            placeholder: 'Pilih Trip',
            params: {
                route_id: function() {
                    return $('#route_id_filter').val();
                }
            }
        }
    ];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };

        coreEvents.insertHandler = {}
        coreEvents.editHandler = {}
        coreEvents.deleteHandler = {}
        coreEvents.resetHandler = {}

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#reset-filter').on('click', function() {
            $('#route_id_filter').val(null).trigger('change');
            $('#trip_id_filter').val(null).trigger('change');
        });

        $('#spda-penumpang-1-hari').on('click', function() {
            $('#spda-penumpang-1-hari').addClass('active');
            $('#spda-penumpang-7-hari').removeClass('active');
            $('#spda-penumpang-1-bulan').removeClass('active');
            $('#spda-penumpang-6-bulan').removeClass('active');
            $('#spda-penumpang-1-tahun').removeClass('active');

            $('#spda-penumpang-1-hari').addClass('btn-soft-primary');
            $('#spda-penumpang-1-hari').removeClass('btn-soft-secondary');

            $('#spda-penumpang-7-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-7-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-6-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-6-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-tahun').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-tahun').removeClass('btn-soft-primary');

            loadSpdaPenumpang('<?= date('Y-m-d') ?>');
        });

        $('#spda-penumpang-7-hari').on('click', function() {
            $('#spda-penumpang-1-hari').removeClass('active');
            $('#spda-penumpang-7-hari').addClass('active');
            $('#spda-penumpang-1-bulan').removeClass('active');
            $('#spda-penumpang-6-bulan').removeClass('active');
            $('#spda-penumpang-1-tahun').removeClass('active');

            $('#spda-penumpang-1-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-7-hari').addClass('btn-soft-primary');
            $('#spda-penumpang-7-hari').removeClass('btn-soft-secondary');

            $('#spda-penumpang-1-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-6-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-6-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-tahun').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-tahun').removeClass('btn-soft-primary');
            loadSpdaPenumpang('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        });

        $('#spda-penumpang-1-bulan').on('click', function() {
            $('#spda-penumpang-1-hari').removeClass('active');
            $('#spda-penumpang-7-hari').removeClass('active');
            $('#spda-penumpang-1-bulan').addClass('active');
            $('#spda-penumpang-6-bulan').removeClass('active');
            $('#spda-penumpang-1-tahun').removeClass('active');

            $('#spda-penumpang-1-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-7-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-7-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-bulan').addClass('btn-soft-primary');
            $('#spda-penumpang-1-bulan').removeClass('btn-soft-secondary');

            $('#spda-penumpang-6-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-6-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-tahun').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-tahun').removeClass('btn-soft-primary');
            loadSpdaPenumpang('<?= date('Y-m-d', strtotime('-1 month')) ?>');
        });

        $('#spda-penumpang-6-bulan').on('click', function() {
            $('#spda-penumpang-1-hari').removeClass('active');
            $('#spda-penumpang-7-hari').removeClass('active');
            $('#spda-penumpang-1-bulan').removeClass('active');
            $('#spda-penumpang-6-bulan').addClass('active');
            $('#spda-penumpang-1-tahun').removeClass('active');

            $('#spda-penumpang-1-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-7-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-7-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-6-bulan').addClass('btn-soft-primary');
            $('#spda-penumpang-6-bulan').removeClass('btn-soft-secondary');

            $('#spda-penumpang-1-tahun').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-tahun').removeClass('btn-soft-primary');
            loadSpdaPenumpang('<?= date('Y-m-d', strtotime('-6 month')) ?>');
        });

        $('#spda-penumpang-1-tahun').on('click', function() {
            $('#spda-penumpang-1-hari').removeClass('active');
            $('#spda-penumpang-7-hari').removeClass('active');
            $('#spda-penumpang-1-bulan').removeClass('active');
            $('#spda-penumpang-6-bulan').removeClass('active');
            $('#spda-penumpang-1-tahun').addClass('active');

            $('#spda-penumpang-1-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-7-hari').addClass('btn-soft-secondary');
            $('#spda-penumpang-7-hari').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-1-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-6-bulan').addClass('btn-soft-secondary');
            $('#spda-penumpang-6-bulan').removeClass('btn-soft-primary');

            $('#spda-penumpang-1-tahun').addClass('btn-soft-primary');
            $('#spda-penumpang-1-tahun').removeClass('btn-soft-secondary');
            loadSpdaPenumpang('<?= date('Y-m-d', strtotime('-1 year')) ?>');
        });

        $('#perf-management-1-hari').on('click', function() {
            $('#perf-management-1-hari').addClass('active');
            $('#perf-management-7-hari').removeClass('active');
            $('#perf-management-1-bulan').removeClass('active');
            $('#perf-management-6-bulan').removeClass('active');
            $('#perf-management-1-tahun').removeClass('active');

            $('#perf-management-1-hari').addClass('btn-soft-primary');
            $('#perf-management-1-hari').removeClass('btn-soft-secondary');

            $('#perf-management-7-hari').addClass('btn-soft-secondary');
            $('#perf-management-7-hari').removeClass('btn-soft-primary');

            $('#perf-management-1-bulan').addClass('btn-soft-secondary');
            $('#perf-management-1-bulan').removeClass('btn-soft-primary');

            $('#perf-management-6-bulan').addClass('btn-soft-secondary');
            $('#perf-management-6-bulan').removeClass('btn-soft-primary');

            $('#perf-management-1-tahun').addClass('btn-soft-secondary');
            $('#perf-management-1-tahun').removeClass('btn-soft-primary');
            getSpdaStat('<?= date('Y-m-d') ?>');
            getLoadFactor('<?= date('Y-m-d') ?>');
        });

        $('#perf-management-7-hari').on('click', function() {
            $('#perf-management-1-hari').removeClass('active');
            $('#perf-management-7-hari').addClass('active');
            $('#perf-management-1-bulan').removeClass('active');
            $('#perf-management-6-bulan').removeClass('active');
            $('#perf-management-1-tahun').removeClass('active');

            $('#perf-management-1-hari').addClass('btn-soft-secondary');
            $('#perf-management-1-hari').removeClass('btn-soft-primary');

            $('#perf-management-7-hari').addClass('btn-soft-primary');
            $('#perf-management-7-hari').removeClass('btn-soft-secondary');

            $('#perf-management-1-bulan').addClass('btn-soft-secondary');
            $('#perf-management-1-bulan').removeClass('btn-soft-primary');

            $('#perf-management-6-bulan').addClass('btn-soft-secondary');
            $('#perf-management-6-bulan').removeClass('btn-soft-primary');

            $('#perf-management-1-tahun').addClass('btn-soft-secondary');
            $('#perf-management-1-tahun').removeClass('btn-soft-primary');
            getSpdaStat('<?= date('Y-m-d', strtotime('-7 days')) ?>');
            getLoadFactor('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        });

        $('#perf-management-1-bulan').on('click', function() {
            $('#perf-management-1-hari').removeClass('active');
            $('#perf-management-7-hari').removeClass('active');
            $('#perf-management-1-bulan').addClass('active');
            $('#perf-management-6-bulan').removeClass('active');
            $('#perf-management-1-tahun').removeClass('active');

            $('#perf-management-1-hari').addClass('btn-soft-secondary');
            $('#perf-management-1-hari').removeClass('btn-soft-primary');

            $('#perf-management-7-hari').addClass('btn-soft-primary');
            $('#perf-management-7-hari').removeClass('btn-soft-secondary');

            $('#perf-management-1-bulan').addClass('btn-soft-primary');
            $('#perf-management-1-bulan').removeClass('btn-soft-secondary');

            $('#perf-management-6-bulan').addClass('btn-soft-secondary');
            $('#perf-management-6-bulan').removeClass('btn-soft-primary');

            $('#perf-management-1-tahun').addClass('btn-soft-secondary');
            $('#perf-management-1-tahun').removeClass('btn-soft-primary');
            getSpdaStat('<?= date('Y-m-d', strtotime('-1 month')) ?>');
            getLoadFactor('<?= date('Y-m-d', strtotime('-1 month')) ?>');
        });

        $('#perf-management-6-bulan').on('click', function() {
            $('#perf-management-1-hari').removeClass('active');
            $('#perf-management-7-hari').removeClass('active');
            $('#perf-management-1-bulan').removeClass('active');
            $('#perf-management-6-bulan').addClass('active');
            $('#perf-management-1-tahun').removeClass('active');

            $('#perf-management-1-hari').addClass('btn-soft-secondary');
            $('#perf-management-1-hari').removeClass('btn-soft-primary');

            $('#perf-management-7-hari').addClass('btn-soft-primary');
            $('#perf-management-7-hari').removeClass('btn-soft-secondary');

            $('#perf-management-1-bulan').addClass('btn-soft-secondary');
            $('#perf-management-1-bulan').removeClass('btn-soft-primary');

            $('#perf-management-6-bulan').addClass('btn-soft-primary');
            $('#perf-management-6-bulan').removeClass('btn-soft-secondary');

            $('#perf-management-1-tahun').addClass('btn-soft-secondary');
            $('#perf-management-1-tahun').removeClass('btn-soft-primary');
            getSpdaStat('<?= date('Y-m-d', strtotime('-6 month')) ?>');
            getLoadFactor('<?= date('Y-m-d', strtotime('-6 month')) ?>');
        });

        $('#perf-management-1-tahun').on('click', function() {
            $('#perf-management-1-hari').removeClass('active');
            $('#perf-management-7-hari').removeClass('active');
            $('#perf-management-1-bulan').removeClass('active');
            $('#perf-management-6-bulan').removeClass('active');
            $('#perf-management-1-tahun').addClass('active');

            $('#perf-management-1-hari').addClass('btn-soft-secondary');
            $('#perf-management-1-hari').removeClass('btn-soft-primary');

            $('#perf-management-7-hari').addClass('btn-soft-primary');
            $('#perf-management-7-hari').removeClass('btn-soft-secondary');

            $('#perf-management-1-bulan').addClass('btn-soft-secondary');
            $('#perf-management-1-bulan').removeClass('btn-soft-primary');

            $('#perf-management-6-bulan').addClass('btn-soft-secondary');
            $('#perf-management-6-bulan').removeClass('btn-soft-primary');

            $('#perf-management-1-tahun').addClass('btn-soft-primary');
            $('#perf-management-1-tahun').removeClass('btn-soft-secondary');
            getSpdaStat('<?= date('Y-m-d', strtotime('-1 year')) ?>');
            getLoadFactor('<?= date('Y-m-d', strtotime('-1 year')) ?>');
        });

        $('#pnp-jenis-1-hari').on('click', function() {
            $('#pnp-jenis-1-hari').addClass('active');
            $('#pnp-jenis-7-hari').removeClass('active');
            $('#pnp-jenis-1-bulan').removeClass('active');
            $('#pnp-jenis-6-bulan').removeClass('active');
            $('#pnp-jenis-1-tahun').removeClass('active');

            $('#pnp-jenis-1-hari').addClass('btn-soft-primary');
            $('#pnp-jenis-1-hari').removeClass('btn-soft-secondary');

            $('#pnp-jenis-7-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-7-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-6-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-6-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-tahun').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-tahun').removeClass('btn-soft-primary');
            getPnpJenis('<?= date('Y-m-d') ?>');
        });

        $('#pnp-jenis-7-hari').on('click', function() {
            $('#pnp-jenis-1-hari').removeClass('active');
            $('#pnp-jenis-7-hari').addClass('active');
            $('#pnp-jenis-1-bulan').removeClass('active');
            $('#pnp-jenis-6-bulan').removeClass('active');
            $('#pnp-jenis-1-tahun').removeClass('active');

            $('#pnp-jenis-1-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-7-hari').addClass('btn-soft-primary');
            $('#pnp-jenis-7-hari').removeClass('btn-soft-secondary');

            $('#pnp-jenis-1-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-6-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-6-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-tahun').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-tahun').removeClass('btn-soft-primary');
            getPnpJenis('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        });

        $('#pnp-jenis-1-bulan').on('click', function() {
            $('#pnp-jenis-1-hari').removeClass('active');
            $('#pnp-jenis-7-hari').removeClass('active');
            $('#pnp-jenis-1-bulan').addClass('active');
            $('#pnp-jenis-6-bulan').removeClass('active');
            $('#pnp-jenis-1-tahun').removeClass('active');

            $('#pnp-jenis-1-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-7-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-7-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-bulan').addClass('btn-soft-primary');
            $('#pnp-jenis-1-bulan').removeClass('btn-soft-secondary');

            $('#pnp-jenis-6-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-6-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-tahun').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-tahun').removeClass('btn-soft-primary');
            getPnpJenis('<?= date('Y-m-d', strtotime('-1 month')) ?>');
        });

        $('#pnp-jenis-6-bulan').on('click', function() {
            $('#pnp-jenis-1-hari').removeClass('active');
            $('#pnp-jenis-7-hari').removeClass('active');
            $('#pnp-jenis-1-bulan').removeClass('active');
            $('#pnp-jenis-6-bulan').addClass('active');
            $('#pnp-jenis-1-tahun').removeClass('active');

            $('#pnp-jenis-1-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-7-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-7-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-6-bulan').addClass('btn-soft-primary');
            $('#pnp-jenis-6-bulan').removeClass('btn-soft-secondary');

            $('#pnp-jenis-1-tahun').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-tahun').removeClass('btn-soft-primary');
            getPnpJenis('<?= date('Y-m-d', strtotime('-6 month')) ?>');
        });

        $('#pnp-jenis-1-tahun').on('click', function() {
            $('#pnp-jenis-1-hari').removeClass('active');
            $('#pnp-jenis-7-hari').removeClass('active');
            $('#pnp-jenis-1-bulan').removeClass('active');
            $('#pnp-jenis-6-bulan').removeClass('active');
            $('#pnp-jenis-1-tahun').addClass('active');

            $('#pnp-jenis-1-hari').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-hari').removeClass('btn-soft-primary');

            $('#pnp-jenis-7-hari').addClass('btn-soft-primary');
            $('#pnp-jenis-7-hari').removeClass('btn-soft-secondary');

            $('#pnp-jenis-1-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-1-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-6-bulan').addClass('btn-soft-secondary');
            $('#pnp-jenis-6-bulan').removeClass('btn-soft-primary');

            $('#pnp-jenis-1-tahun').addClass('btn-soft-primary');
            $('#pnp-jenis-1-tahun').removeClass('btn-soft-secondary');
            getPnpJenis('<?= date('Y-m-d', strtotime('-1 year')) ?>');
        });

        $('#trip-pnp-1-hari').on('click', function() {
            $('#trip-pnp-1-hari').addClass('active');
            $('#trip-pnp-7-hari').removeClass('active');
            $('#trip-pnp-1-bulan').removeClass('active');
            $('#trip-pnp-6-bulan').removeClass('active');
            $('#trip-pnp-1-tahun').removeClass('active');

            $('#trip-pnp-1-hari').addClass('btn-soft-primary');
            $('#trip-pnp-1-hari').removeClass('btn-soft-secondary');

            $('#trip-pnp-7-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-7-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-1-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-1-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-6-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-6-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-1-tahun').addClass('btn-soft-secondary');
            $('#trip-pnp-1-tahun').removeClass('btn-soft-primary');
            getTripPnp('<?= date('Y-m-d') ?>');
        });

        $('#trip-pnp-7-hari').on('click', function() {
            $('#trip-pnp-1-hari').removeClass('active');
            $('#trip-pnp-7-hari').addClass('active');
            $('#trip-pnp-1-bulan').removeClass('active');
            $('#trip-pnp-6-bulan').removeClass('active');
            $('#trip-pnp-1-tahun').removeClass('active');

            $('#trip-pnp-1-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-1-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-7-hari').addClass('btn-soft-primary');
            $('#trip-pnp-7-hari').removeClass('btn-soft-secondary');

            $('#trip-pnp-1-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-1-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-6-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-6-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-1-tahun').addClass('btn-soft-secondary');
            $('#trip-pnp-1-tahun').removeClass('btn-soft-primary');
            getTripPnp('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        });

        $('#trip-pnp-1-bulan').on('click', function() {
            $('#trip-pnp-1-hari').removeClass('active');
            $('#trip-pnp-7-hari').removeClass('active');
            $('#trip-pnp-1-bulan').addClass('active');
            $('#trip-pnp-6-bulan').removeClass('active');
            $('#trip-pnp-1-tahun').removeClass('active');

            $('#trip-pnp-1-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-1-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-7-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-7-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-1-bulan').addClass('btn-soft-primary');
            $('#trip-pnp-1-bulan').removeClass('btn-soft-secondary');

            $('#trip-pnp-6-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-6-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-1-tahun').addClass('btn-soft-secondary');
            $('#trip-pnp-1-tahun').removeClass('btn-soft-primary');
            getTripPnp('<?= date('Y-m-d', strtotime('-1 month')) ?>');
        });

        $('#trip-pnp-6-bulan').on('click', function() {
            $('#trip-pnp-1-hari').removeClass('active');
            $('#trip-pnp-7-hari').removeClass('active');
            $('#trip-pnp-1-bulan').removeClass('active');
            $('#trip-pnp-6-bulan').addClass('active');
            $('#trip-pnp-1-tahun').removeClass('active');

            $('#trip-pnp-1-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-1-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-7-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-7-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-1-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-1-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-6-bulan').addClass('btn-soft-primary');
            $('#trip-pnp-6-bulan').removeClass('btn-soft-secondary');

            $('#trip-pnp-1-tahun').addClass('btn-soft-secondary');
            $('#trip-pnp-1-tahun').removeClass('btn-soft-primary');
            getTripPnp('<?= date('Y-m-d', strtotime('-6 month')) ?>');
        });

        $('#trip-pnp-1-tahun').on('click', function() {
            $('#trip-pnp-1-hari').removeClass('active');
            $('#trip-pnp-7-hari').removeClass('active');
            $('#trip-pnp-1-bulan').removeClass('active');
            $('#trip-pnp-6-bulan').removeClass('active');
            $('#trip-pnp-1-tahun').addClass('active');

            $('#trip-pnp-1-hari').addClass('btn-soft-secondary');
            $('#trip-pnp-1-hari').removeClass('btn-soft-primary');

            $('#trip-pnp-7-hari').addClass('btn-soft-primary');
            $('#trip-pnp-7-hari').removeClass('btn-soft-secondary');

            $('#trip-pnp-1-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-1-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-6-bulan').addClass('btn-soft-secondary');
            $('#trip-pnp-6-bulan').removeClass('btn-soft-primary');

            $('#trip-pnp-1-tahun').addClass('btn-soft-primary');
            $('#trip-pnp-1-tahun').removeClass('btn-soft-secondary');
            getTripPnp('<?= date('Y-m-d', strtotime('-1 year')) ?>');
        });

        loadAllAjax();
        loadSpdaPenumpang('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        getSpdaStat('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        getLoadFactor('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        getPnpJenis('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        getTripPnp('<?= date('Y-m-d', strtotime('-7 days')) ?>');
        getTrafficPnp('<?= date('Y-m-d') ?>');

        $(document).on('change', '#tanggal_id_filter', function() {
            var tanggal_id = $(this).val();
            getTrafficPnp(tanggal_id);
        }).on('change', '#trip_id_filter', function() {
            $('#tanggal_id_filter').val('');
            getTrafficPnp('<?= date('Y-m-d') ?>');
        }).on('change', '#route_id_filter', function() {
            $('#tanggal_id_filter').val('');
            $('#trip_id_filter').val(null).trigger('change');
            coreEvents.select2Init('#trip_id_filter', '/get_trip', 'Pilih Trip', {
                route_id: $(this).val()
            });
            getTrafficPnp('<?= date('Y-m-d') ?>');
        });

    });

    function loadAllAjax() {
        var ajaxPromises = [];

        var getAllJenBus = $.ajax({
            url: url_ajax + '/getAllJenBus',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#total_bus').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    // sum all bus
                    var total_bus = 0;
                    for (var i = 0; i < data.length; i++) {
                        total_bus += parseInt(data[i].bus);
                    }
                    $('#total_bus').attr('data-target', total_bus);
                    $('#total_bus').html(total_bus);

                    $('#detail-bus').html('');
                    for (var i = 0; i < data.length; i++) {
                        if (i == (data.length - 1)) {
                            $('#detail-bus').append('<div class="col align-self-center"><span class="badge bg-soft-info text-info font-size-12">' + data[i].bus + ' Bus</span><span class="ms-1 text-muted font-size-13">' + data[i].jenroute + '</span></div>');
                        } else {
                            $('#detail-bus').append('<div class="col align-self-center border-end"><span class="badge bg-soft-secondary text-secondary font-size-12">' + data[i].bus + ' Bus</span><span class="ms-1 text-muted font-size-13">' + data[i].jenroute + '</span></div>');
                        }
                    }
                } else {
                    $('#total_bus').attr('data-target', 0);
                    $('#total_bus').html(0);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllJenBus);

        var getAllJenTrayek = $.ajax({
            url: url_ajax + '/getAllJenTrayek',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#total_rute').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var total_rute = 0;
                    for (var i = 0; i < data.length; i++) {
                        total_rute += parseInt(data[i].route);
                    }
                    $('#total_rute').attr('data-target', total_rute);
                    $('#total_rute').html(total_rute);

                    $('#detail-rute').html('');
                    for (var i = 0; i < data.length; i++) {
                        if (i == (data.length - 1)) {
                            $('#detail-rute').append('<div class="col align-self-center"><span class="badge bg-soft-info text-info font-size-11">' + data[i].route + ' Trayek</span><span class="ms-1 text-muted font-size-12">' + data[i].jenroute + '</span></div>');
                        } else {
                            $('#detail-rute').append('<div class="col align-self-center border-end"><span class="badge bg-soft-secondary text-secondary font-size-11">' + data[i].route + ' Trayek</span><span class="ms-1 text-muted font-size-12">' + data[i].jenroute + '</span></div>');
                        }
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllJenTrayek);

        var getAllUser = $.ajax({
            url: url_ajax + '/getAllUser',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#total_operator').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var total_operator = 0;
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].user_web_role_code == 'bpw') {
                            continue;
                        } else {
                            total_operator += parseInt(data[i].role_count);
                        }
                    }
                    $('#total_operator').attr('data-target', total_operator);
                    $('#total_operator').html(total_operator);

                    $('#detail-operator').html('');
                    for (var i = 0; i < data.length; i++) {

                        if (data[i].user_web_role_code == 'bpw') {
                            continue;
                        } else if (i == (data.length - 1)) {
                            data[i].user_web_role_code = data[i].user_web_role_code.replace('pop', 'PO');
                            data[i].user_web_role_code = data[i].user_web_role_code.replace('ppo', 'Petugas PO');
                            $('#detail-operator').append('<div class="col align-self-center"><span class="badge bg-soft-info text-info font-size-12">' + data[i].role_count + ' User</span><span class="ms-1 text-muted font-size-13">' + data[i].user_web_role_code + '</span></div>');
                        } else {
                            data[i].user_web_role_code = data[i].user_web_role_code.replace('pop', 'PO');
                            data[i].user_web_role_code = data[i].user_web_role_code.replace('ppo', 'Petugas PO');
                            $('#detail-operator').append('<div class="col align-self-center border-end"><span class="badge bg-soft-secondary text-secondary font-size-12">' + data[i].role_count + ' User</span><span class="ms-1 text-muted font-size-13">' + data[i].user_web_role_code + '</span></div>');
                        }
                    }

                } else {
                    $('#total_operator').attr('data-target', 0);
                    $('#total_operator').html(0);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllUser);

        var getAllGps = $.ajax({
            url: url_ajax + '/getAllGps',
            type: 'POST',
            dataType: 'json',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#total_gps').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var total_gps = 0;
                    var total_gps_online = 0;
                    var total_gps_offline = 0;
                    var total_gps_idle = 0;
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].gps_status == '1') {
                            total_gps_online += 1;
                        } else if (data[i].gps_status == '0') {
                            total_gps_offline += 1;
                        } else {
                            total_gps_idle += 1;
                        }
                        total_gps += 1;
                    }
                    $('#total_gps').attr('data-target', total_gps);
                    $('#total_gps').html(total_gps);

                    $('#gps_online').html(total_gps_online);
                    $('#gps_idle').html(total_gps_idle);
                    $('#gps_offline').html(total_gps_offline);


                } else {
                    $('#total_gps').attr('data-target', 0);
                    $('#total_gps').html(0);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllGps);

        var getAllJenAng = $.ajax({
            url: url_ajax + '/getAllJenAng',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('tbody#table-jenis-angkutan-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var total_bus = 0;
                    var total_route = 0;
                    var total_trip = 0;
                    var total_operator = 0;
                    for (var i = 0; i < data.length; i++) {
                        total_bus += parseInt(data[i].bus);
                        total_route += parseInt(data[i].route);
                        total_trip += parseInt(data[i].trip);
                        total_operator += parseInt(data[i].operator);
                    }
                    $('#table-jenis-angkutan').DataTable().destroy();
                    var table = $('#table-jenis-angkutan').DataTable({
                        destroy: true,
                        data: data,
                        searching: true,
                        paging: true,
                        info: true,
                        orderable: false,
                        columns: [{
                                data: 'jenroute',
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'jenroute',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + data + '</span>';
                                }
                            },
                            {
                                data: 'bus',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'route',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'trip',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'operator',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                            "className": "text-center",
                            "targets": [2, 3, 4, 5]
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data Jenis Angkutan'
                        }]
                    });
                } else {
                    $('#table-jenis-angkutan-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllJenAng);

        var getAllJenAngKSPN = $.ajax({
            url: url_ajax + '/getAllJenArmada',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('tbody#table-jenis-armada-kspn-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    $('#table-jenis-armada-kspn').DataTable().destroy();
                    var table = $('#table-jenis-armada-kspn').DataTable({
                        destroy: true,
                        data: data,
                        searching: true,
                        paging: true,
                        info: true,
                        orderable: false,
                        pageLength: 5,
                        language: {
                            searchPlaceholder: "Cari Armada KSPN"
                        },
                        lengthMenu: [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "All"]
                        ],
                        columns: [{
                                data: 'id',
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    // return meta.row + meta.settings._iDisplayStart + 1;
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'rute_group_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + data + '</span>';
                                }
                            },
                            {
                                data: 'nopol',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'rute_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data Armada KSPN'
                        }]
                    });
                } else {
                    $('#table-armada-kspn-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllJenAngKSPN);

        var getAllJenAngPerintis = $.ajax({
            url: url_ajax + '/getAllJenPerintis',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#table-armada-perintis-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    $('#table-jenis-armada-perintis').DataTable().destroy();
                    var table = $('#table-jenis-armada-perintis').DataTable({
                        destroy: true,
                        data: data,
                        searching: true,
                        paging: true,
                        info: true,
                        orderable: false,
                        pageLength: 5,
                        language: {
                            searchPlaceholder: "Cari Armada Perintis"
                        },
                        lengthMenu: [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "All"]
                        ],
                        columns: [{
                                data: 'id',
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    // return meta.row + meta.settings._iDisplayStart + 1;
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'rute_group_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + data + '</span>';
                                }
                            },
                            {
                                data: 'nopol',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'rute_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data Armada Perintis'
                        }]
                    });
                } else {
                    $('#table-armada-perintis-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllJenAngPerintis);

        var getAllDriver = $.ajax({
            url: url_ajax + '/getAllDriver',
            type: 'POST',
            dataType: 'json',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#table-driver-armada-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    $('#table-driver-armada').DataTable().destroy();
                    var table = $('#table-driver-armada').DataTable({
                        destroy: true,
                        data: data,
                        searching: true,
                        paging: true,
                        info: true,
                        orderable: false,
                        pageLength: 5,
                        language: {
                            searchPlaceholder: "Cari Driver"
                        },
                        lengthMenu: [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "All"]
                        ],
                        columns: [{
                                data: 'id',
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'driver_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    let img_driver = '<img src="' + row.driver_pic + '" class="rounded-circle avatar-xs" alt="driver-pic">';
                                    return '<span class="text-dark fw-bolder">' + img_driver + ' ' + data + '</span>';
                                }
                            },
                            {
                                data: 'po_name',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'jenis_pelayanan',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'trayek_name',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                            // "className": "text-center",
                            "targets": [2, 3, 4]
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3,4]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data Driver Armada'
                        }]
                    });
                } else {
                    $('#table-driver-armada-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        ajaxPromises.push(getAllDriver);

        $.when.apply($, ajaxPromises).then(function() {
            for (var i = 0; i < arguments.length; i++) {
                // console.log(arguments[i][2].responseJSON);
            }
        });
    }

    function getTripPnp(date) {
        $.ajax({
            url: url_ajax + '/getTripPnp',
            type: 'POST',
            dataType: 'json',
            data: {
                date: date,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#table-trip-pnp-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var id = 1;
                    $('#table-trip-pnp').DataTable().destroy();
                    var table = $("#table-trip-pnp").DataTable({
                        destroy: true,
                        data: data,
                        searching: true,
                        paging: true,
                        info: true,
                        orderable: false,
                        language: {
                            searchPlaceholder: "Cari Trayek Trip"
                        },
                        lengthMenu: [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "All"]
                        ],
                        columns: [{
                                data: id,
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'routes',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + data + '</span>';
                                }
                            },
                            {
                                data: 'bus_capacity',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'naik_total',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'load_factor',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    let load_factor = Math.floor((row.naik_total / row.bus_capacity) * 100);
                                    return '<span class="text-secondary">' + load_factor + '%</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                            "className": "text-center",
                            "targets": [2, 3, 4]
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3,4]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data Trip PNP'
                        }]
                    });
                } else {
                    $('#table-trip-pnp-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function getPnpJenis(date) {
        $.ajax({
            url: url_ajax + '/getPnpJenis',
            type: 'POST',
            dataType: 'json',
            data: {
                date: date,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#table-pnp-jenis-body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    var data = res.data;
                    var id = 1;
                    $('#table-pnp-jenis').DataTable().destroy();
                    var table = $("#table-pnp-jenis").DataTable({
                        destroy: true,
                        data: data,
                        searching: false,
                        paging: false,
                        info: false,
                        orderable: false,
                        columns: [{
                                data: id,
                                orderable: false,
                                width: 5,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + (meta.row + 1) + '.</span>';
                                }
                            },
                            {
                                data: 'jenroute',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-dark fw-bolder">' + data + '</span>';
                                }
                            },
                            {
                                data: 'naik_total',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'total_bus_capacity',
                                orderable: false,
                                align: 'center',
                                render: function(data, type, row, meta) {
                                    return '<span class="text-secondary">' + data + '</span>';
                                }
                            },
                            {
                                data: 'load_factor',
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    let load_factor = Math.floor((row.naik_total / row.total_bus_capacity) * 100);
                                    return '<span class="text-secondary">' + load_factor + '%</span>';
                                }
                            }
                        ],
                        "order": [
                            // [0, "asc"]
                        ],
                        "columnDefs": [{
                            "targets": [0],
                            "orderable": false,
                            "className": "text-center",
                            "targets": [2, 3, 4]
                        }],
                        "dom": '<"row"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-6"f><"col-sm-12 text-center col-md-1"B>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                        "buttons": [{
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3,4]
                            },
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fa fa-file-excel"></i>',
                            title: 'Data PNP Jenis'
                        }]
                    });
                } else {
                    $('#table-pnp-jenis-body').html('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function getSpdaStat(date) {
        $.ajax({
            url: url_ajax + '/getSpdaStat',
            type: 'POST',
            dataType: 'json',
            data: {
                date: date,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#spda_status').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    $('#card_body_spda_status').html(`<div id="spda_status" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="apex-charts" dir="ltr"></div>`);
                    $('#spda_status').html('');
                    data = res.data;
                    var dataName = [];
                    var sts0 = [];
                    var sts1 = [];
                    var sts2 = [];
                    for (var i = 0; i < data.length; i++) {
                        dataName.push(data[i].name);
                        sts0.push(data[i].sts0);
                        sts1.push(data[i].sts1);
                        sts2.push(data[i].sts2);
                    }
                    var columnColors = getChartColorsArray("#spda_status");
                    var options = {
                        chart: {
                            height: 350,
                            type: 'bar',
                            toolbar: {
                                show: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '45%',
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        series: [{
                            name: 'Dalam Perjalanan',
                            data: sts0
                        }, {
                            name: 'Selesai Perjalanan',
                            data: sts1
                        }, {
                            name: 'Validasi',
                            data: sts2
                        }],
                        colors: columnColors,
                        xaxis: {
                            categories: dataName
                        },
                        yaxis: {
                            title: {
                                text: 'SPDA',
                                style: {
                                    fontWeight: '500',
                                },
                            }
                        },
                        grid: {
                            borderColor: '#f1f1f1',
                        },
                        fill: {
                            opacity: 1

                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " SPDA"
                                }
                            }
                        }
                    }

                    var chart = new ApexCharts(document.querySelector("#spda_status"), options);
                    chart.render();
                } else {
                    $('#card_body_spda_status').html(`<div class="row align-items-center">
                                    <div class="col-xl-12 align-self-center position-relative">
                                        <img src="<?= base_url() ?>/assets/img/dishubdat.png" alt="" class="img-fluid mx-auto d-block mt-3" width="100" style="opacity: 0.05;">
                                        <span class="text-muted mt-3 mb-0 lh-1 d-block text-center position-absolute top-50 start-50 translate-middle" style="font-size: 16px;">Data Tidak Tersedia</span>
                                    </div>
                                </div>`);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function loadSpdaPenumpang(date) {
        $.ajax({
            url: url_ajax + '/getSpdaPenumpang',
            type: 'POST',
            dataType: 'json',
            data: {
                bptd_id: '<?= $_SESSION['bptd_id'] ?>',
                date: date,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#spda-penumpang').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    $('#spda-penumpang').html('');
                    $('#naik_dl').html(res.data[0] + '<span class="text-muted font-size-14 fw-normal"> Orang</span>');
                    $('#naik_dp').html(res.data[1] + '<span class="text-muted font-size-14 fw-normal"> Orang</span>');
                    $('#naik_al').html(res.data[2] + '<span class="text-muted font-size-14 fw-normal"> Orang</span>');
                    $('#naik_ap').html(res.data[3] + '<span class="text-muted font-size-14 fw-normal"> Orang</span>');
                    data = res.data;
                    var pieChartColors = ['#224ddd', '#FFEC51', '#FF674D', '#91a6ee'];
                    var spdaPenumpangApex = {
                        series: data,
                        chart: {
                            width: 300,
                            type: 'pie'
                        },
                        labels: ['Dewasa Laki-laki', 'Dewasa Perempuan', 'Anak Laki-laki', 'Anak Perempuan'],
                        colors: pieChartColors,
                        legend: {
                            show: false
                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    width: 200
                                },
                            }
                        }],
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " Orang"
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true
                        },

                    }

                    var spdaPenumpangChart = new ApexCharts(document.querySelector("#spda-penumpang"), spdaPenumpangApex);
                    spdaPenumpangChart.render();
                } else if (res.data[0] == 0 && res.data[1] == 0 && res.data[2] == 0 && res.data[3] == 0) {
                    $('#spda-penumpang-body').html(`<div class="row align-items-center">
                                    <div class="col-xl-12 align-self-center position-relative">
                                        <img src="<?= base_url() ?>/assets/img/dishubdat.png" alt="" class="img-fluid mx-auto d-block mt-3" width="100" style="opacity: 0.05;">
                                        <span class="text-muted mt-3 mb-0 lh-1 d-block text-center position-absolute top-50 start-50 translate-middle" style="font-size: 16px;">Data Tidak Tersedia</span>
                                    </div>
                                </div>`);
                } else {
                    $('#spda-penumpang-body').html(`<div class="row align-items-center">
                                    <div class="col-xl-12 align-self-center position-relative">
                                        <img src="<?= base_url() ?>/assets/img/dishubdat.png" alt="" class="img-fluid mx-auto d-block mt-3" width="100" style="opacity: 0.05;">
                                        <span class="text-muted mt-3 mb-0 lh-1 d-block text-center position-absolute top-50 start-50 translate-middle" style="font-size: 16px;">Data Tidak Tersedia</span>
                                    </div>
                                </div>`);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function getLoadFactor(date) {
        $.ajax({
            url: url_ajax + '/getLoadFactor',
            type: 'POST',
            dataType: 'json',
            data: {
                date: date,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#load_factor_list').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
                $('#load_factor_overview').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    data = res.data;
                    $('#lf-body-status').html(`<div class="col-xl-4">
                                                    <div class="p-4" id="load_factor_list"></div>
                                                </div>
                                                <div class="col-xl-8">
                                                    <div id="load_factor_overview-body">
                                                        <div id="load_factor_overview" data-colors='["#5156be", "#fd625e", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                                                    </div>
                                                </div>`);
                    let html = '';
                    for (var i = 0; i < data.length; i++) {
                        var loadf = (parseInt(data[i].naik_ttl).toFixed(0) / parseFloat(data[i].load_factor).toFixed(2)) * 100;
                        if (i < 5) {
                            if (i == 0) {
                                html += `<div class="mt-0">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm m-auto">
                                                <span class="avatar-title rounded-circle bg-soft-light text-dark font-size-16">` + (i + 1) + `</span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <span class="font-size-16">` + data[i].name + `</span>
                                            </div>

                                            <div class="flex-shrink-0">
                                                <span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">` + parseFloat(loadf).toFixed(0) + `%</span>
                                            </div>
                                        </div>
                                    </div>`;
                            } else {
                                html += `<div class="mt-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm m-auto">
                                                <span class="avatar-title rounded-circle bg-soft-light text-dark font-size-16">` + (i + 1) + `</span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <span class="font-size-16">` + data[i].name + `</span>
                                            </div>

                                            <div class="flex-shrink-0">
                                                <span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">` + parseFloat(loadf).toFixed(0) + `%</span>
                                            </div>
                                        </div>
                                    </div>`;
                            }
                        }
                    }
                    html += `<div class="mt-4 pt-2">
                                <a href="` + base_url + `/operasional/spda" class="btn btn-primary btn-block waves-effect waves-light w-100">Lihat Semua <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>`;
                    $('#load_factor_list').html(html);
                    // =================================================
                    // $('#load_factor_overview').html('');
                    var spdaDate = [];
                    var dataName = [];
                    var loadFactor = [];
                    var pnp = [];
                    var trip = [];
                    for (var i = 0; i < data.length; i++) {
                        var lf = (parseInt(data[i].naik_ttl).toFixed(0) / parseFloat(data[i].load_factor).toFixed(2)) * 100;
                        spdaDate.push(data[i].spda_date);
                        dataName.push(data[i].name);
                        loadFactor.push(parseFloat(lf).toFixed(0));
                        pnp.push(parseInt(data[i].naik_ttl).toFixed(0));
                        trip.push(parseInt(data[i].ttl_trip).toFixed(0));
                    }
                    // console.log(lf);
                    var lineDashedColors = getChartColorsArray("#load_factor_overview");
                    var options = {
                        chart: {
                            height: 380,
                            type: 'line',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false,
                            }
                        },
                        colors: lineDashedColors,
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: [3, 4, 3],
                            curve: 'straight',
                            dashArray: [0, 8, 5]
                        },
                        series: [{
                                name: "Trip",
                                data: trip
                            },
                            {
                                name: "Penumpang",
                                data: pnp
                            },
                            {
                                name: 'Load Factor',
                                data: loadFactor
                            }
                        ],
                        title: {
                            text: 'SPDA Statistics',
                            align: 'left',
                            style: {
                                fontWeight: '500',
                            },
                        },
                        markers: {
                            size: 0,

                            hover: {
                                sizeOffset: 6
                            }
                        },
                        xaxis: {
                            categories: spdaDate,
                        },
                        tooltip: {
                            y: [{
                                title: {
                                    formatter: function(val) {
                                        return val;
                                    }
                                }
                            }, {
                                title: {
                                    formatter: function(val) {
                                        return val;
                                    }
                                }
                            }, {
                                title: {
                                    formatter: function(val) {
                                        return val + " (%)";
                                    }
                                }
                            }]
                        },
                        grid: {
                            borderColor: '#f1f1f1',
                        }
                    }

                    var chart = new ApexCharts(document.querySelector("#load_factor_overview"), options);
                    chart.render();
                } else {
                    $('#load_factor_list').html('<div class="col-sm-12 text-center">Data tidak ditemukan</div>');
                    $('#load_factor_overview').html('<div class="col-sm-12 text-center">Data tidak ditemukan</div>');
                    $('#lf-body-status').html(`<div class="row align-items-center">
                                    <div class="col-xl-12 align-self-center position-relative">
                                        <img src="<?= base_url() ?>/assets/img/dishubdat.png" alt="" class="img-fluid mx-auto d-block mt-3" width="100" style="opacity: 0.05;">
                                        <span class="text-muted mt-3 mb-0 lh-1 d-block text-center position-absolute top-50 start-50 translate-middle" style="font-size: 16px;">Data Tidak Tersedia</span>
                                    </div>
                                </div>`);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function getTrafficPnp(date) {
        var routeid = $('#route_id_filter').val();
        var tripid = $('#trip_id_filter').val();
        var spda_date = $('#tanggal_id_filter').val();
        $.ajax({
            url: url_ajax + '/getTrafficPnp',
            type: 'POST',
            dataType: 'json',
            data: {
                spda_date: date,
                route_id: routeid,
                trip_id: tripid,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function() {
                $('#traffic_pnp_body').html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
            },
            success: function(res) {
                if (res.success) {
                    $('#traffic_pnp_body').html(`<div id="traffic_pnp" data-colors='["#8bc34a","#9ab02a","#a59d01","#af8800","#b57200","#b95a00","#ba4009","#b71c1c"]' class="apex-charts" dir="ltr"></div>`);
                    var data = res.data;

                    var time_range = [];
                    var created_at = [];
                    var time_interval = [];
                    var total_naik = [];
                    for (var i = 0; i < data.length; i++) {
                        time_range.push(data[i].time_range);
                        created_at.push(data[i].created_at);
                        time_interval.push(data[i].time_interval);
                        total_naik.push(data[i].total_naik);
                    }

                    // var columnDatalabelColors = getChartColorsArray("#traffic_pnp");

                    var options = {
                        series: [{
                            name: "total_naik",
                            data: total_naik
                        }],
                        chart: {
                            height: 350,
                            type: "line",
                            toolbar: {
                                show: true,
                                download: false,
                                selection: false,
                                zoom: true,
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            },
                            dropShadow: {
                                enabled: true,
                                color: "#000",
                                top: 18,
                                left: 7,
                                blur: 8,
                                opacity: 0.2
                            },
                        },
                        markers: {
                            size: 5,
                            colors: '#000',
                            strokeColors: '#fff',
                            strokeWidth: 2,
                            strokeOpacity: 0.9,
                            strokeDashArray: 0,
                            fillOpacity: 1,
                            discrete: [],
                            shape: "circle",
                            radius: 2,
                            offsetX: 0,
                            offsetY: 0,
                            hover: {
                                size: undefined,
                                sizeOffset: 3
                            }
                        },
                        stroke: {
                            width: 5,
                            curve: "smooth"
                        },
                        xaxis: {
                            type: "time",
                            categories: time_range,
                            labels: {
                                formatter: function(val) {
                                    return val;
                                }
                            },
                            tickPlacement: "on"
                        },
                        title: {
                            text: "Passenger",
                            align: "left",
                            style: {
                                fontSize: "16px",
                                color: "#666"
                            }
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "light",
                                gradientToColors: ["#8BC34A"], //hijau
                                inverseColors: false,
                                shadeIntensity: 1,
                                type: "vertical",
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: []
                            }
                        },
                        colors: ['#B71C1C'], //merah
                        yaxis: {
                            min: 0
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#traffic_pnp"), options);
                    chart.render();
                } else {
                    $('#traffic_pnp_body').html('<div class="col-sm-12 text-center">Data tidak ditemukan</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    function getChartColorsArray(chartId) {
        var colors = $(chartId).attr('data-colors');
        var colors = JSON.parse(colors);
        return colors.map(function(value) {
            var newValue = value.replace(' ', '');
            if (newValue.indexOf('--') != -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                if (color) return color;
            } else {
                return newValue;
            }
        });
    }
</script>