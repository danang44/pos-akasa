<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm" style="overflow: hidden;">
                        <img src="<?= base_url() ?>/assets/img/logo.svg" alt="" height="15">
                    </span>
                    <span class="logo-lg" style="overflow: hidden;">
                        <img src="<?= base_url() ?>/assets/img/logo.svg" alt="" height="15">
                        <!-- <span class="logo-txt">FMS HUBDAT</span> -->
                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm" style="overflow: hidden;">
                        <img src="<?= base_url() ?>/assets/img/logo.svg" alt="" height="15">
                    </span>
                    <span class="logo-lg" style="overflow: hidden;">
                        <img src="<?= base_url() ?>/assets/img/logo.svg" alt="" height="15">
                        <!-- <span class="logo-txt">FMS HUBDAT</span> -->
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <?php
            $session = \Config\Services::session();
            $lang = $session->get('lang');
            $role_code = $session->get('role_code');
            $menu = $session->get('menu');
            for ($i = 0; $i < count($menu); $i++) {
                if ($menu[$i]->menu_id = '49' && $menu[$i]->id = '112') {
                    $operasional_view = $menu[$i]->v;
                    $operasional_insert = $menu[$i]->i;
                    $operasional_edit = $menu[$i]->e;
                    $operasional_deleted = $menu[$i]->d;
                    $operasional_otorisasi = $menu[$i]->o;

                    $operasional_user_web_role_id = $menu[$i]->user_web_role_id;
                } else {
                    $operasional_view = 0;
                    $operasional_insert = 0;
                    $operasional_edit = 0;
                    $operasional_deleted = 0;
                    $operasional_otorisasi = 0;

                    $operasional_user_web_role_id = '';
                }
            }
            if ($role_code == 'bpw') {
            ?>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell" class="icon-lg"></i>
                        <span class="badge bg-danger rounded-pill" id="noti-count1"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifikasi Validasi SPDA </h6>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;" id="noti-data" data-simplebar-auto-hide="true"></div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="<?= base_url('operasional/spda') ?>">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> <span><?= lang('Files.View_More') ?>..</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } else if ($role_code == 'pop' || $role_code == 'ppo') { ?>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell" class="icon-lg"></i>
                        <span class="badge bg-danger rounded-pill" id="noti-count1"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifikasi SPDA </h6>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;" id="noti-data" data-simplebar-auto-hide="true"></div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="<?= base_url('operasional/spda') ?>">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> <span><?= lang('Files.View_More') ?>..</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="dropdown d-inline-block mt-l" style="float:right;">
                <button type="button" class="btn header-item" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" style="background-color: transparent; height: 40px;" src="<?= base_url() ?>/assets/img/DISHUB-Logo.png" alt="Header Avatar">

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="rounded-circle header-profile-user" style="background-color: transparent; height: 40px;" src="<?= base_url() ?>/assets/img/DISHUB-Logo.png" alt="Header Avatar">
                            <h5 class="card-title"><?= $session->get('name') ?></h5>
                            <span class="text-muted"><?= $session->get('username') ?></span>
                        </div>
                    </div>
                    <a class="dropdown-item" href="<?= base_url() ?>/main/userprofile">
                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                        <?= lang('Files.Change_Password') ?>
                    </a>
                    <!-- manual book -->
                    <a class="dropdown-item" href="<?= base_url() ?>/main/manualbook">
                        <i class="mdi mdi-book-open-variant font-size-16 align-middle me-1"></i>
                        <?= lang('Files.Manual_Book') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url() ?>/auth/action/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                        <?= lang('Files.Logout') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if ($role_code == 'bpw' && $operasional_insert == '1') { ?>
    <style>
        #sig-canvas,
        #sig-canvas-manager,
        #bptd-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
            /* disable scroll when touch */
            touch-action: none;
        }
    </style>
    <div class="modal fade" id="verifikasi-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form id="form-verifikasi" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi SPDA</h5>
                    </div>
                    <div class="modal-body">
                        <div id="verifikasi-modal-body">

                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <p><b>Pegawai BPTD</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <canvas id="bptd-canvas"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center mb-3">
                                    <div class="btn btn-info btn-sm" id="bptd-submitBtn">Simpan Tanda Tangan</div>
                                    <div class="btn btn-default btn-sm" id="bptd-clearBtn">
                                        <i class="fa fa-eraser"></i> Hapus
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mb-3">
                                    <i class="fa fa-check" id="bptd-check" style="display:none; color: green;"> Tanda Tangan Tersimpan</i>
                                </div>
                                <div hidden>
                                    <div class="col-md-12">
                                        <textarea id="bptd-dataUrl" name="bptd-dataUrl" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="bptdSubmit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <?php if ($operasional_otorisasi == "1") { ?>
            <script src="<?= base_url() ?>/assets/js/sig-bptd.js"></script>
        <?php } ?>
    </div>
<?php } else if ($role_code == 'pop' || $role_code == 'ppo') { ?>
    <div class="modal fade" id="spda-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="form-spda-detail" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail SPDA</h5>
                    </div>
                    <div class="modal-body" id="spda-detail-modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
<form id="form_export_pdf" action="<?= base_url() ?>/main/action/spda_pdf" method="post" target="_blank">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_pdf" id="id_pdf" />
</form>

<!-- INTERNAL SCRIPT -->
<script src="<?= base_url() ?>/assets/js/moment-with-locales.js"></script>
<script type="text/javascript">
    const topbar_base_url = '<?= base_url() ?>';
    const topbar_url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const topbar_segment = '<?= uri_segment(0) ?>';

    $(document).ready(function() {

        if (<?= $role_code == 'bpw' ? 'true' : 'false' ?>) {
            getSpdaPending();
        } else if (<?= $role_code == 'pop' || $role_code == 'ppo' ? 'true' : 'false' ?>) {
            getSpdaPending();
        }

        // function ajax submit verifikasi spda
        $('#form-verifikasi').submit(function(e) {
            e.preventDefault();
            let $this = $(this);
            var data = $this.serialize();
            data += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";

            Swal.fire({
                title: "Verifikasi SPDA ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function(result) {
                var bptdUrl = $('#bptd-dataUrl').val();
                if (result.value && bptdUrl != '') {
                    Swal.fire({
                        title: "",
                        icon: "info",
                        text: "Proses menyimpan data, mohon ditunggu...",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    });

                    $.ajax({
                        headers: {
                            'customref': '<?= base_url('operasional/spda') ?>'
                        },
                        url: "<?= base_url('operasional/action/spda_saveverif') ?>",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            Swal.close();
                            if (result.success) {
                                var bptdCanvas = document.getElementById('bptd-canvas');
                                bptdCanvas.width = bptdCanvas.width;

                                $('#bptd-dataUrl').val('');
                                $('#verifikasi-modal').modal('hide');
                                getSpdaPending();

                                // Swal.fire('Sukses', 'Berhasil menyelesaikan SPDA', 'success');
                                Swal.fire({
                                    title: "Berhasil memverifikasi SPDA. Export PDF ?",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonText: "Export",
                                    cancelButtonText: "Tutup",
                                    reverseButtons: true
                                }).then(function(result) {
                                    if (result.value) {
                                        $('#form_export_pdf').submit();
                                    }
                                });
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                } else {
                    Swal.fire('Perhatian!', 'Tanda tangan belum diisi', 'warning');
                }
            });
        }).on('reset', function() {
            var bptdCanvas = document.getElementById('bptd-canvas');
            bptdCanvas.width = bptdCanvas.width;

            $('#bptd-dataUrl').val('');
            $('#bptd-dataUrl').html('');
            document.getElementById("bptd-check").style.display = "none";
        });
    });

    // function ajax get notif spda pending
    function getSpdaPending() {
        $.ajax({
            url: "<?= base_url('operasional/ajax/getSpdaPending') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(rs) {
                if (rs.success) {
                    data = rs.data;
                    var count = Object.keys(data).length;
                    if (count > 0) {
                        $('#noti-count1').html(count);
                        $('#noti-count2').html('Belum divalidasi (' + count + ')');
                        $('#noti-data').find('.simplebar-content').html('');
                    } else {
                        $('#noti-count1').html('0');
                        $('#noti-count2').html('Belum divalidasi (0)');
                        $('#noti-data').find('.simplebar-content').html('<p class="text-center">Tidak ada data</p>');
                    }

                    for (let i = 0; i < count; i++) {
                        created_at = data[i].created_at; //2023-07-27 15:20:30
                        fromNow = moment(created_at, "YYYY-MM-DD HH:mm:ss").fromNow();

                        spdastatus = data[i].spda_status;
                        if (spdastatus == '0') {
                            var spda_status = '<span class="badge bg-danger">Dalam Perjalanan</span>';
                        } else if (spdastatus == '1') {
                            var spda_status = '<span class="badge bg-warning">Belum Verifikasi</span>';
                        } else if (spdastatus == '2') {
                            var spda_status = '<span class="badge bg-success">Sudah Verifikasi</span>';
                        }

                        if (<?= $role_code == 'bpw' ? 'true' : 'false' ?>) {
                            var btnRoleNotif = `<a class="text-reset notification-item" data-id="` + data[i].id + `" onclick="spdaOtorisasi(` + data[i].id + `)">`;
                        } else {
                            var btnRoleNotif = `<a class="text-reset notification-item" data-id="` + data[i].id + `" onclick="spdaDetail(` + data[i].id + `)">`;
                        }
                        var notif_data = ``;
                        notif_data = `
                        ${btnRoleNotif}
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="<?= base_url() ?>/assets/img/DISHUB-Logo.png" class="rounded-circle avatar-sm" alt="user-pic" style="height: 35px;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">` + data[i].po_name + `</h6>
                                    ` + spda_status + `
                                    <div class="font-size-13 text-muted">
                                        <p class="mb-1"><strong>Trayek : </strong>` + data[i].route_name + `</p>
                                        <p class="mb-1"><strong>Trip : </strong>` + data[i].trip_name + `</p>
                                        <p class="mb-1"><strong>Pengemudi : </strong>` + data[i].driver_name + `</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>` + fromNow + `</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        `;

                        $('#noti-data').find('.simplebar-content').append(notif_data);

                    }
                } else {
                    $('#noti-count1').html('');
                    $('#noti-count2').html('Belum divalidasi (0)');
                    $('#noti-data').find('.simplebar-content').html('<p class="text-center">Tidak ada data</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error get data from ajax');
            }
        });
    }

    function spdaDetail(id) {
        let $this = $(this);
        let data = {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }

        Swal.fire({
            title: "",
            icon: "info",
            text: "Proses mengambil data, mohon ditunggu...",
            didOpen: function() {
                Swal.showLoading()
            }
        });

        $.ajax({
            headers: {
                'customref': '<?= base_url('operasional/spda') ?>'
            },
            url: "<?= base_url('operasional/action/spda_detail') ?>",
            type: 'POST',
            data: data,
            dataType: 'html',
            success: function(result) {
                Swal.close();
                $('#spda-detail-modal-body').html(result);
                $('#spda-detail-modal').modal('show');
            },
            error: function() {
                Swal.close();
                Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
            }
        });
    }

    function spdaOtorisasi(id) {
        let $this = $(this);
        let data = {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }
        $('#id_pdf').val(id);
        Swal.fire({
            title: "",
            icon: "info",
            text: "Proses mengambil data, mohon ditunggu...",
            didOpen: function() {
                Swal.showLoading()
            }
        });

        $.ajax({
            headers: {
                'customref': '<?= base_url('operasional/spda') ?>'
            },
            url: "<?= base_url('operasional/action/spda_detail') ?>",
            type: 'POST',
            data: data,
            dataType: 'html',
            success: function(result) {
                Swal.close();
                $('#verifikasi-modal-body').html(result);
                $('#verifikasi-modal').modal('show');
            },
            error: function() {
                Swal.close();
                Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
            }
        });
    }

    function exportPDF() {
        $('#form_export_pdf').submit(function(e) {
            e.preventDefault();
            let $this = $(this);
            var data = $this.serialize();
            data += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function() {
                    Swal.showLoading()
                }
            });

            $.ajax({
                headers: {
                    'customref': '<?= base_url('operasional/spda') ?>'
                },
                url: "<?= base_url('operasional/action/spda_pdf') ?>",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(result) {
                    Swal.close();
                    if (result.success) {
                        Swal.fire({
                            title: "Berhasil export PDF",
                            icon: "success",
                            showCancelButton: true,
                            confirmButtonText: "Download",
                            cancelButtonText: "Tutup",
                            reverseButtons: true
                        }).then(function(result) {
                            if (result.value) {
                                window.open(result.url, '_blank');
                            }
                        });
                    } else {
                        Swal.fire('Error', result.message, 'error');
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        });
        $('#form_export_pdf').submit();
    }
</script>