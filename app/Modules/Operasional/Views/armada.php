<?php $session = \Config\Services::session(); ?>
<style>
    .blink {
        animation: blink 1s steps(1, end) infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        25% {
            opacity: 0.25;
        }

        50% {
            opacity: 0.5;
        }

        75% {
            opacity: 0.75;
        }

        100% {
            opacity: 1;
        }
    }
</style>
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul id="tab" class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-data" role="tab" aria-selected="false">
                        <span class="d-block d-sm-none"><i class="fas fa-table"></i></span>
                        <span class="d-none d-sm-block">Data</span>
                    </a>
                </li>
                <?php if ($rules->i == "1") { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-form" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="fab fa-wpforms"></i></span>
                            <span class="d-none d-sm-block">Update</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="tab-data" role="tabpanel">
                    <div class="row">
                        <?php
                        // print_r('<pre>');
                        // print_r($session->get());
                        // print_r('</pre>');
                        if ($session->get('role_code') == 'pop' || $session->get('role_code') == 'ppo') {
                        ?>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label>Rute Trayek</label>
                                    <select class="form-control select2-container sel2" id="filter_route_id" name="filter_route_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label>Status Kendaraan</label>
                                    <select class="form-control select2-container sel2" id="filter_status_kendaraan_id" name="filter_status_kendaraan_id" required aria-required="true">
                                        <option value="" selected>Semua</option>
                                        <option value="Beroperasi">Beroperasi</option>
                                        <option value="Tidak Beroperasi">Tidak Beroperasi</option>
                                        <option value="Dalam Perawatan">Dalam Perawatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-12 mt-4 text-center">
                                <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label>BPTD</label>
                                    <select class="form-control select2-container sel2" id="filter_bptd_id" name="filter_bptd_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label>Perusahaan Operator</label>
                                    <select class="form-control select2-container sel2" id="filter_operator_id" name="filter_operator_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label>Rute Trayek</label>
                                    <select class="form-control select2-container sel2" id="filter_route_id" name="filter_route_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label>Status Kendaraan</label>
                                    <select class="form-control" id="filter_status_kendaraan_id" name="filter_status_kendaraan_id" required aria-required="true">
                                        <option value="" selected>Semua</option>
                                        <option value="Beroperasi">Beroperasi</option>
                                        <option value="Tidak Beroperasi">Tidak Beroperasi</option>
                                        <option value="Dalam Perawatan">Dalam Perawatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-12 mt-4 text-center">
                                <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive" style="padding:7px;">
                            <table id="datatable" class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th><span>#</span></th>
                                        <th><span>Nama Perusahaan</span></th>
                                        <th><span>Nama Group</span></th>
                                        <th><span>No. Kendaraan</span></th>
                                        <th><span>Kapasitas Penumpang</span></th>
                                        <th><span>Trayek</span></th>
                                        <th><span>Status Kendaraan</span></th>
                                        <th class="column-2action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if ($rules->i == "1") { ?>
                    <div class="tab-pane" id="tab-form" role="tabpanel">
                        <div class="row" id="alert_armada"></div>
                        <div class="card-body">
                            <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                                <input type="hidden" class="form-control" id="id" name="id" value="" required>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label id="gps_imei_label">GPS IMEI </label>
                                            <input class="form-control" id="gps_sn" name="gps_sn" required aria-required="true" placeholder="GPS IMEI" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>No. Registrasi Kendaraan</label>
                                            <input class="form-control" id="nopol" name="nopol" required aria-required="true" placeholder="Nomor Kendaraan" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Jenis Layanan <span class="badge bg-danger" style="font-size: 8px;">SPIONAM</span></label>
                                            <select class="form-control select2-container sel2" id="jenis_pelayanan" name="jenis_pelayanan"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Nama Group</label>
                                            <select class="form-control sel2" id="group_nm" name="group_nm" required></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Kode Kendaraan <span class="badge bg-danger" style="font-size: 8px;">SPIONAM</span></label>
                                            <input type="text" class="form-control" id="kode_kendaraan" name="kode_kendaraan" placeholder="Kode Kendaraan" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>No. Uji Kendaraan <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input class="form-control" id="no_uji" name="no_uji" required aria-required="true" placeholder="Nomor Uji" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Tanggal Expired Uji <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input type="date" class="form-control" id="tgl_exp_uji" name="tgl_exp_uji" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>No. KPS <span class="badge bg-danger" style="font-size: 8px;">SPIONAM</span></label>
                                            <input class="form-control" id="no_kps" name="no_kps" required aria-required="true" placeholder="Nomor KPS" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Tanggal Expired KPS <span class="badge bg-danger" style="font-size: 8px;">SPIONAM</span></label>
                                            <input type="date" class="form-control" id="tgl_exp_kps" name="tgl_exp_kps" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>No. SRUT <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input class="form-control" id="no_srut" name="no_srut" required aria-required="true" placeholder="Nomor SRUT" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Tanggal SRUT <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input type="date" class="form-control" id="tgl_srut" name="tgl_srut" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>No. Rangka <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input type="text" class="form-control" id="no_rangka" name="no_rangka" placeholder="Nomor Rangka" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>No. Mesin <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input class="form-control" id="no_mesin" name="no_mesin" required aria-required="true" placeholder="Nomor Mesin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Merk <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input type="text" class="form-control" id="merek" name="merek" placeholder="Merk | Ex: Hino" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Jenis Kendaraan <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input type="text" class="form-control" id="jenis_kend" name="jenis_kend" placeholder="Jenis kendaraan | Ex: Mobil Bus Besar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Tahun <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <input class="form-control" id="tahun" name="tahun" required aria-required="true" placeholder="Tahun" maxlength="4" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Kapasitas Penumpang <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="capacity" name="capacity" placeholder="0" />
                                                <span class="input-group-text"> Orang</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Daya Angkut Barang <span class="badge bg-primary" style="font-size: 8px;">BLUe</span></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="barang" name="barang" placeholder="0" />
                                                <span class="input-group-text"> Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Trayek Armada</label>
                                            <select class="form-control select2-container sel2" id="route_id" name="route_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status Kendaraan saat ini</label>
                                            <select class="form-control" id="stskend" name="stskend">
                                                <option value="Beroperasi">Beroperasi</option>
                                                <option value="Tidak Beroperasi">Tidak Beroperasi</option>
                                                <option value="Dalam Perawatan">Dalam Perawatan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center my-5">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-dark" type="reset">Reset</button>
                                    </div>
                                </div>
                                <h6 class="text-center text-danger">Catatan : Data Armada diinputkan sesuai dengan Trayek Armada bekerja.</h6>
                            </form>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
</div>
<script type="text/javascript">
    const auth_insert = '<?= $rules->i ?>';
    const auth_edit = '<?= $rules->e ?>';
    const auth_delete = '<?= $rules->d ?>';
    const auth_otorisasi = '<?= $rules->o ?>';

    const base_url = '<?= base_url() ?>';
    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEventsPage;

    const select2Array = [{
            id: 'operator_id',
            url: '/po_select_get',
            placeholder: 'Pilih Perusahaan',
            params: null
        },
        {
            id: 'route_id',
            url: '/route_id_select_get',
            placeholder: 'Pilih Trayek',
            params: null
        },
        {
            id: 'group_nm',
            url: '/groupnm_select_get',
            placeholder: 'Pilih Group Trayek',
            params: {
                po_id: function() {
                    // return $('#operator_id').val()
                    if ($('#operator_id').val() == '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Pilih Perusahaan terlebih dahulu!',
                            timer: 1500,
                        });
                        return false;
                    } else {
                        return $('#operator_id').val();
                    }
                },
            }
        },
        {
            id: 'jenis_pelayanan',
            url: '/jenis_pelayanan_select_get',
            placeholder: 'Pilih Jenis Layanan Angkutan',
            params: null
        },
        {
            id: 'filter_bptd_id',
            url: '/bptd_select_get',
            placeholder: 'Pilih BPTD',
            params: null
        },
        {
            id: 'filter_operator_id',
            url: '/po_select_get',
            placeholder: 'Pilih Perusahaan',
            params: null
        },
        {
            id: 'filter_route_id',
            url: '/filter_route_id_select_get',
            placeholder: 'Pilih Trayek',
            params: null
        }
    ];

    $(document).ready(function() {
        coreEventsPage = new CoreEvents();
        coreEventsPage.url = url;
        coreEventsPage.ajax = url_ajax;
        coreEventsPage.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEventsPage.tableColumn = datatableColumn();

        coreEventsPage.insertHandler = {
            placeholder: 'Berhasil menyimpan armada',
            afterAction: function(result) {
                // resetForm();
            }
        }

        coreEventsPage.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                //console.log(result);
                var data = result.data;
                if (data.route_id != null) {
                    $('#route_id').select2("trigger", "select", {
                        data: {
                            id: data.route_id,
                            text: data.route_name
                        }
                    });
                }
                if (data.group_nm != null) {
                    $('#group_nm').select2("trigger", "select", {
                        data: {
                            id: data.group_nm,
                            text: data.group_nm
                        }
                    });
                }
                if (data.operator_id != null) {
                    $('#operator_id').select2("trigger", "select", {
                        data: {
                            id: data.operator_id,
                            text: data.operator_name
                        }
                    });
                }
                if (data.jenis_pelayanan != null) {
                    $('#jenis_pelayanan').select2("trigger", "select", {
                        data: {
                            id: data.jenis_pelayanan,
                            text: data.jenis_pelayanan
                        }
                    });
                }
                return false;
            }

        }

        coreEventsPage.deleteHandler = {
            placeholder: 'Berhasil menghapus armada',
            afterAction: function() {
                // resetForm();
            }
        }

        coreEventsPage.resetHandler = {
            action: function() {
                // resetForm();
                // $('#group_nm').val('').trigger('select2:select');
                // $('#route_id').val('').trigger('select2:select');
                // $('#company_nm').val('').trigger('select2:select');
            }
        }

        select2Array.forEach(function(x) {
            coreEventsPage.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $(document).on('select2:select', '#filter_bptd_id', function() {
            var bptd_id = $(this).val();
            var operator_id = $('#filter_operator_id').val();
            var route_id = $('#filter_route_id').val();
            var status_kendaraan_id = $('#filter_status_kendaraan_id').val();

            coreEventsPage.select2Init('#filter_operator_id', '/po_select_get', 'Pilih Perusahaan', {
                bptd_id: bptd_id
            });
            coreEventsPage.select2Init('#filter_route_id', '/filter_route_id_select_get', 'Pilih Trayek', {
                bptd_id: bptd_id,
                operator_id: operator_id
            });

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                stskend: status_kendaraan_id
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#filter_operator_id', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $(this).val();
            var route_id = $('#filter_route_id').val();
            var status_kendaraan_id = $('#filter_status_kendaraan_id').val();

            coreEventsPage.select2Init('#filter_route_id', '/filter_route_id_select_get', 'Pilih Trayek', {
                bptd_id: bptd_id,
                operator_id: operator_id
            });

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                stskend: status_kendaraan_id
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#filter_route_id', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $('#filter_operator_id').val();
            var route_id = $(this).val();
            var status_kendaraan_id = $('#filter_status_kendaraan_id').val();

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                stskend: status_kendaraan_id
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#filter_status_kendaraan_id', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $('#filter_operator_id').val();
            var route_id = $('#filter_route_id').val();
            var status_kendaraan_id = $(this).val();

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                stskend: status_kendaraan_id
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#reset-filter').on('click', function() {
            $('#filter_bptd_id').val(null).trigger('change');
            $('#filter_operator_id').val(null).trigger('change');
            $('#filter_route_id').val(null).trigger('change');
            coreEventsPage.filter = null;
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#nopol').on('keyup', function() {
            this.value = this.value.toUpperCase();
        });

        $(document).on('keyup', '#nopol', delay(function(e) {
            var data = $(this).val();
            if (data.length >= 5) {
                getDataBlue(data);
                getDataSpionam(data);
            }
        }, 1500)).on('keyup', '#gps_sn', delay(function(e) {
            var data = $(this).val();
            if (data.length >= 12) {
                getDataGps(data);
            }
        }, 1500));

        coreEventsPage.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEventsPage.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEventsPage.placeholder = 'Cari data armada...';
        coreEventsPage.columnDefs = [{
            "className": "text-center",
            "targets": [3, 4, 6]
        }];

        coreEventsPage.load(null, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

    function getDataGps(data) {
        data = data.replace(/\s/g, '');
        console.log(data);
        $.ajax({
            url: url_ajax + '/checkGpsSn',
            type: 'POST',
            dataType: 'JSON',
            data: {
                gps_sn: data,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function(req) {
                // req.setRequestHeader("X-NGI-TOKEN", 'dev');
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                });
            },
            success: function(res) {
                Swal.close();
                if (res.success) {
                    var data = res.data;
                    var nopol = data.nopol.replace(/\s/g, '');
                    var jenis_pelayanan = data.company_nm.split('-')[1].trim();

                    $('#gps_imei_label').html(`GPS IMEI <span class="translate-middle blink"> <i class="fas fa-check-circle" style="color: #52cd51;"></i></span>`);
                    $('#nopol').val(nopol);
                    getDataBlue(nopol);
                    getDataSpionam(nopol);
                    $('#operator_id').select2("trigger", "select", {
                        data: {
                            id: data.operator_id,
                            text: data.operator_name
                        }
                    });

                    $('#group_nm').select2("trigger", "select", {
                        data: {
                            id: data.group_nm,
                            text: data.group_nm
                        }
                    });
                    $('#jenis_pelayanan').select2("trigger", "select", {
                        data: {
                            id: jenis_pelayanan,
                            text: jenis_pelayanan
                        }
                    });
                    showAlert('success', 'outline', 'Berhasil!', 'GPS IMEI terkoneksi dengan GPS Tracking.', 5000);
                } else {
                    $('#gps_imei_label').html(`GPS IMEI <span class="translate-middle blink"><i class="fas fa-unlink" style="color: red;"></i></span>`);
                    showAlert('warning', 'outline', 'Perhatian!', 'GPS IMEI belum terkoneksi dengan GPS Tracking!', 5000);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    }

    function getDataBlue(data) {
        data = data.replace(/\s/g, '');
        console.log(data);
        $.ajax({
            url: url_ajax + '/getBlueAPI',
            type: 'POST',
            dataType: 'JSON',
            data: {
                no_registrasi_kendaraan: data,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function(req) {
                req.setRequestHeader("X-NGI-TOKEN", 'dev');
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                });
            },
            success: function(res) {
                Swal.close();
                var currentdate = new Date();
                var datetime = moment(currentdate).format('YYYY-MM-DD HH:mm:ss');
                if (res.status == '1' && res.message == 'Success') {
                    var masa_berlaku = moment(res.data.masa_berlaku, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
                    if (datetime >= masa_berlaku) {
                        showAlert('warning', 'outline', 'Perhatian!', 'Masa Berlaku BLUe sudah expired.', 7000);
                    } else {
                        showAlert('success', 'outline', 'Berhasil!', 'Masa Berlaku masih berlaku.', 7000);
                    }

                    $('#capacity').val(res.data.daya_angkut_orang);
                    $('#no_uji').val(res.data.no_uji_kendaraan);
                    $('#no_srut').val(res.data.no_srut);

                    var tgl_srut = moment(res.data.tgl_srut, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    $('#tgl_srut').val(tgl_srut);

                    var tgl_exp_uji = moment(res.data.masa_berlaku, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    $('#tgl_exp_uji').val(tgl_exp_uji);

                    $('#no_rangka').val(res.data.no_rangka);
                    $('#no_mesin').val(res.data.no_mesin);
                    $('#merek').val(res.data.merk);
                    $('#jenis_kend').val(res.data.jenis_kendaraan);
                    $('#tahun').val(res.data.tahun_rakit);
                    $('#barang').val(res.data.daya_angkut_kg);

                    $('#capacity').prop('readonly', true);
                    $('#no_uji').prop('readonly', true);
                    $('#no_srut').prop('readonly', true);
                    $('#tgl_srut').prop('readonly', true);
                    $('#tgl_exp_uji').prop('readonly', true);
                    $('#no_rangka').prop('readonly', true);
                    $('#no_mesin').prop('readonly', true);
                    $('#merek').prop('readonly', true);
                    $('#jenis_kend').prop('readonly', true);
                    $('#tahun').prop('readonly', true);
                    $('#barang').prop('readonly', true);

                } else {
                    $('#capacity').addClass('border border-warning');
                    $('#no_uji').addClass('border border-warning');
                    $('#no_srut').addClass('border border-warning');
                    $('#tgl_srut').addClass('border border-warning');
                    $('#tgl_exp_uji').addClass('border border-warning');
                    $('#no_rangka').addClass('border border-warning');
                    $('#no_mesin').addClass('border border-warning');
                    $('#merek').addClass('border border-warning');
                    $('#jenis_kend').addClass('border border-warning');
                    $('#tahun').addClass('border border-warning');
                    $('#barang').addClass('border border-warning');
                    showAlert('warning', 'outline', 'Perhatian!', 'Data Kendaraan pada BLUe tidak ditemukan!', 10000);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function getDataSpionam(data) {
        data = data.replace(/\s/g, '');
        console.log(data);
        $.ajax({
            url: url_ajax + '/getSpionamAPI',
            type: 'POST',
            dataType: 'JSON',
            data: {
                no_registrasi_kendaraan: data,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            beforeSend: function(req) {
                req.setRequestHeader("X-NGI-TOKEN", 'dev');
                Swal.fire({
                    title: 'Loading...',
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                });
            },
            success: function(res) {
                Swal.close();
                var currentdate = new Date();
                var datetime = moment(currentdate).format('YYYY-MM-DD HH:mm:ss');
                if (res.status == '1' && res.message == 'Success') {
                    var masa_berlaku = moment(res.data.masa_berlaku, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
                    if (datetime >= masa_berlaku) {
                        showAlert('warning', 'outline', 'Perhatian!', 'Masa Berlaku SPIONAM sudah expired.', 7000);
                    } else {
                        showAlert('success', 'outline', 'Berhasil!', 'Masa Berlaku masih berlaku.', 7000);
                    }

                    var jenis_pelayanan = res.data.jenis_pelayanan;
                    $('#jenis_pelayanan').select2("trigger", "select", {
                        data: {
                            id: jenis_pelayanan,
                            text: jenis_pelayanan
                        }
                    });
                    $('#kode_kendaraan').val(res.data.kode_kendaraan);
                    $('#no_kps').val(res.data.no_kps);
                    var tgl_ex_kps = moment(res.data.tgl_exp_kps, 'YYYY-MM-DD').format('YYYY-MM-DD');
                    $('#tgl_exp_kps').val(tgl_ex_kps);
                    $('#kode_kendaraan').prop('readonly', true);
                    $('#no_kps').prop('readonly', true);
                    $('#tgl_exp_kps').prop('readonly', true);
                } else {
                    // border warning on field
                    $('#kode_kendaraan').addClass('border border-warning');
                    $('#no_kps').addClass('border border-warning');
                    $('#tgl_exp_kps').addClass('border border-warning');

                    showAlert('warning', 'outline', 'Perhatian!', 'Data Kendaraan pada SPIONAM tidak ditemukan!', 10000);
                }
            },
            error: function(err) {
                console.log(err);
            },
        });
    }

    function showAlert(type, icon, title, text, timeout) {
        var alert = `<div class="alert alert-${type} alert-border-left alert-dismissible fade show" role="alert" data-bs-autohide="true" data-timeout="${timeout}">
                        <i class="mdi mdi-alert-${icon} align-middle me-3"></i><strong>${title}</strong> - ${text}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        $('#alert_armada').append(alert);

        let alertList = $('#alert_armada').find('.alert');
        alertList.each(function() {
            let alert = $(this);
            let timeout = alert.data('timeout');
            setTimeout(function() {
                alert.alert('close');
            }, +timeout);
        });

    }

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    function datatableColumn() {
        let columns = [{
                data: "id",
                orderable: false,
                width: 5,
                render: function(a, type, data, index) {
                    return dataStart + index.row + 1
                }
            },
            {
                data: "operator_name",
                orderable: true,
                width: 5,
            },
            {
                data: "group_nm",
                orderable: true,
                width: 5,
            },
            {
                data: "nopol",
                orderable: true,
                width: 5,
            },
            {
                data: "capacity",
                orderable: true,
                width: 5,
            },
            {
                data: "route_name",
                orderable: true,
                width: 100,
            },
            {
                data: "stskend",
                orderable: true,
                width: 5,
                render: function(a, type, data, index) {
                    let status = ''
                    if (data.stskend == 'Beroperasi') {
                        status = '<span class="badge badge-soft-success"><i class="fas fa-check-circle"></i> Beroperasi</span>'
                    } else if (data.stskend == 'Tidak Beroperasi') {
                        status = '<span class="badge badge-soft-danger"><i class="fas fa-times-circle"></i> Tidak Beroperasi</span>'
                    } else if (data.stskend == 'Dalam Perawatan') {
                        status = '<span class="badge badge-soft-warning"><i class="fas fa-cogs"></i> Dalam Perawatan</span>'
                    } else {
                        status = '<span class="badge badge-soft-info"><i class="fas fa-info-circle"></i> Tidak Diketahui</span>'
                    }
                    return status;
                }
            },
            {
                data: "id",
                orderable: false,
                width: 5,
                render: function(a, type, data, index) {
                    let button = ''

                    if (auth_edit == "1") {
                        button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.id + '" title="Edit">\
                                    <i class="fa fa-edit"></i>\
                                </button>\
                                ';
                    }

                    if (auth_delete == "1") {
                        button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.id + '" title="Delete">\
                                        <i class="bx bx-trash-alt"></i>\
                                    </button>';
                    }


                    button += (button == '') ? "<b>Tidak ada aksi</b>" : ""

                    return "<div class='action-button'>" + button + "</div>";
                }
            }
        ];

        return columns;
    }
</script>