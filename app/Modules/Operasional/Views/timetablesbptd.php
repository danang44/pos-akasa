<?php $session = \Config\Services::session(); ?>
<div class="col-xl-12">
    <div class="card">
        <?php
        // print_r('<pre>');
        // print_r($session->get()); 
        // print_r('</pre>');
        ?>
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
                    <div class="table-responsive" style="padding:7px;">
                        <!-- filter div -->
                        <div class="row mb-3 align-items-center">
                            <?php
                            // print_r('<pre>');
                            // print_r($session->get());
                            // print_r('</pre>');

                            if ($session->get('role_code') == 'pop' || $session->get('role_code') == 'ppo') {
                            ?>
                                <div class="col-lg-11 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trayek</label>
                                        <select class="form-control select2-container sel2" id="route_id_filter" name="route_id_filter" required aria-required="true"></select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trip</label>
                                        <select class="form-control select2-container sel2" id="trip_id_filter" name="trip_id_filter" required aria-required="true"></select>
                                    </div>
                                </div> -->
                                <div class="col-lg-1 col-md-12 mt-4 text-center">
                                    <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                                </div>
                            <?php } else if ($session->get('role_code') == 'bpw') { ?>
                                <div class="col-lg-5 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter PO</label>
                                        <select class="form-control select2-container sel2" id="operator_id_filter" name="operator_id_filter" required aria-required="true"></select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trayek</label>
                                        <select class="form-control select2-container sel2" id="route_id_filter" name="route_id_filter" required aria-required="true"></select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trip</label>
                                        <select class="form-control select2-container sel2" id="trip_id_filter" name="trip_id_filter" required aria-required="true"></select>
                                    </div>
                                </div> -->
                                <div class="col-lg-1 col-md-12 mt-4 text-center">
                                    <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-3 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter BPTD</label>
                                        <select class="form-control select2-container sel2" id="filter_bptd_id" name="filter_bptd_id" required aria-required="true"></select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter PO</label>
                                        <select class="form-control select2-container sel2" id="operator_id_filter" name="operator_id_filter" required aria-required="true"></select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trayek</label>
                                        <select class="form-control select2-container sel2" id="route_id_filter" name="route_id_filter" required aria-required="true"></select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-3 col-md-12">
                                    <div class="mb-3">
                                        <label>Filter Trip</label>
                                        <select class="form-control select2-container sel2" id="trip_id_filter" name="trip_id_filter" required aria-required="true"></select>
                                    </div>
                                </div> -->
                                <div class="col-lg-1 col-md-12 mt-4 text-center">
                                    <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <table id="datatable" class="table table-theme table-row v-middle table-hover" data-plugin="dataTable" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th><span>#</span></th>
                                    <?php if ($session->get('role_code') == 'pop' || $session->get('role_code') == 'ppo') { ?>
                                        <th><span>Kode Trayek</span></th>
                                        <th><span>Jenis</span></th>
                                        <th><span>Rit ke</span></th>
                                        <th><span>Trip A</span></th>
                                        <th><span>Waktu</span></th>
                                        <th><span>Trip B</span></th>
                                        <th><span>Waktu</span></th>
                                        <th class="column-2action"></th>
                                    <?php } else if ($session->get('role_code') == 'sad' || $session->get('role_code') == 'daj') { ?>
                                        <th><span>BPTD</span></th>
                                        <th><span>Nama PO</span></th>
                                        <th><span>Kode Trayek</span></th>
                                        <th><span>Jenis</span></th>
                                        <th><span>Rit ke</span></th>
                                        <th><span>Trip A</span></th>
                                        <th><span>Waktu</span></th>
                                        <th><span>Trip B</span></th>
                                        <th><span>Waktu</span></th>
                                        <th class="column-2action"></th>
                                    <?php } else { ?>
                                        <th><span>Nama PO</span></th>
                                        <th><span>Kode Trayek</span></th>
                                        <th><span>Jenis</span></th>
                                        <th><span>Rit ke</span></th>
                                        <th><span>Trip A</span></th>
                                        <th><span>Waktu</span></th>
                                        <th><span>Trip B</span></th>
                                        <th><span>Waktu</span></th>
                                        <th class="column-2action"></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($rules->i == "1") { ?>
                    <div class="tab-pane" id="tab-form" role="tabpanel">
                        <div class="card-body">
                            <form data-plugin="parsley" data-option="{}" id="form-bptd">
                                <input type="hidden" class="form-control" id="timetable_code" name="timetable_code" value="" required />
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Perusahaan</label>
                                            <select class="form-control select2-container sel2" id="operator_id" name="operator_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Trayek</label>
                                            <select class="form-control select2-container sel2" id="route_id" name="route_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Rit Ke-</label>
                                            <select class="form-control" id="ritke" name="ritke" required aria-required="true">
                                                <option value="" disabled selected>Pilih Rit Ke-</option>
                                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="trip">
                                    <div class="row" id="trip_a">
                                        <input type="hidden" id="id_a" name="id_a" />
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Trip</label>
                                                <input type="text" class="form-control" id="trip_name_a" name="trip_name_a" required readonly />
                                                <input type="text" class="form-control" id="trip_id_a" name="trip_id_a" required hidden />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Berangkat</label>
                                                <input type="time" class="form-control" id="time_start_a" name="time_start_a" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Tiba</label>
                                                <input type="time" class="form-control" id="time_end_a" name="time_end_a" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="trip_b">
                                        <input type="hidden" id="id_b" name="id_b" />
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Trip</label>
                                                <input type="text" class="form-control" id="trip_name_b" name="trip_name_b" required readonly />
                                                <input type="text" class="form-control" id="trip_id_b" name="trip_id_b" required hidden />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Berangkat</label>
                                                <input type="time" class="form-control" id="time_start_b" name="time_start_b" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Tiba</label>
                                                <input type="time" class="form-control" id="time_end_b" name="time_end_b" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center my-4">
                                    <div class="text-center">
                                        <button type="submit" id="submit_ttbptd" class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-dark" type="reset">Reset</button>
                                    </div>
                                </div>
                                <h6 class="text-center">Catatan : Time Tables Rute PP</h6>
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

    var role_code = '<?= $session->get('role_code') ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEventsPage;

    const select2Array = [{
            id: 'operator_id',
            url: '/po_select_get',
            placeholder: 'Pilih Perusahaan Operator',
            params: null
        },
        {
            id: 'route_id',
            url: '/route_id_select_get',
            placeholder: 'Pilih Rute Trayek',
            params: null
        },
        {
            id: 'trip_id',
            url: '/trip_id_select_get',
            placeholder: 'Pilih Rute Trip',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                },
            }
        },
        {
            id: 'operator_id_filter',
            url: '/po_select_get',
            placeholder: 'Pilih Perusahaan Operator',
            params: null
        },
        {
            id: 'route_id_filter',
            url: '/filter_route_id_select_get',
            placeholder: 'Pilih Rute Trayek',
            params: null
        },
        {
            id: 'trip_id_filter',
            url: '/trip_id_select_get',
            placeholder: 'Pilih Rute Trip',
            params: {
                route_id: function() {
                    return $('#route_id_filter').val()
                },
            }
        },
        {
            id: 'filter_bptd_id',
            url: '/bptd_select_get',
            placeholder: 'Pilih BPTD',
            params: null
        },
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
            placeholder: 'Berhasil menyimpan timetables',
            afterAction: function(result) {}
        }

        coreEventsPage.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                var data = result.data;

                if (data[0].operator_id != null) {
                    $('#operator_id').select2("trigger", "select", {
                        data: {
                            id: data[0].operator_id,
                            text: data[0].operator_name
                        }
                    });
                }
                if (data[0].route_id != null) {
                    $('#route_id').select2("trigger", "select", {
                        data: {
                            id: data[0].route_id,
                            text: data[0].route_name
                        }
                    });
                }
                $('#ritke').val(data[0].ritke);
                $('.trip').show();

                if (data[0].trip_id != null) {
                    $('#timetable_code').val(data[0].timetable_code);
                    $('#id_a').val(data[0].id);
                    $('#trip_name_a').val(data[0].trip_name);
                    $('#trip_id_a').val(data[0].trip_id);
                    $('#time_start_a').val(data[0].time_start);
                    $('#time_end_a').val(data[0].time_end);
                }

                if (data[1].trip_id != null) {
                    $('#id_b').val(data[1].id);
                    $('#trip_name_b').val(data[1].trip_name);
                    $('#trip_id_b').val(data[1].trip_id);
                    $('#time_start_b').val(data[1].time_start);
                    $('#time_end_b').val(data[1].time_end);
                }



            }

        }

        coreEventsPage.deleteHandler = {
            placeholder: 'Berhasil menghapus timetables',
            afterAction: function() {}
        }

        coreEventsPage.resetHandler = {
            action: function() {}
        }

        select2Array.forEach(function(x) {
            coreEventsPage.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('.trip').hide();
        $('#route_id').on('select2:select', function() {
            $('#ritke').val('');
            $('.trip').hide();
            $('#trip_name_a').val('');
            $('#trip_id_a').val('');
            $('#trip_name_b').val('');
            $('#trip_id_b').val('');
            $.ajax({
                url: url_ajax + '/trip_select_get',
                type: 'POST',
                dataType: 'json',
                data: {
                    route_id: $(this).val(),
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function(rs) {
                    if (rs.success) {
                        console.log(rs.data);
                        $('#ritke').on('change', function() {
                            $('.trip').show();
                            if (typeof rs.data[0] !== 'undefined') {
                                $('#trip_name_a').val(rs.data[0].text);
                                $('#trip_id_a').val(rs.data[0].id);
                            } else {
                                $('#submit_ttbptd').prop('disabled', true);
                                $('#trip_name_a').val('Trip A tidak ada');
                                $('#trip_id_a').val('');
                                $('#time_start_a').attr('disabled', true);
                                $('#time_end_a').attr('disabled', true);
                            }

                            if (typeof rs.data[1] !== 'undefined') {
                                $('#trip_name_b').val(rs.data[1].text);
                                $('#trip_id_b').val(rs.data[1].id);
                            } else {
                                $('#submit_ttbptd').prop('disabled', true);
                                $('#trip_name_b').val('Trip B tidak ada');
                                $('#trip_id_b').val('');
                                $('#time_start_b').attr('disabled', true);
                                $('#time_end_b').attr('disabled', true);
                            }



                            // $('.trip').show();
                            // $('#trip_name_a').val(rs.data[0].text);
                            // $('#trip_id_a').val(rs.data[0].id);
                            // $('#trip_name_b').val(rs.data[1].text);
                            // $('#trip_id_b').val(rs.data[1].id);
                        });

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    $('.trip').hide();
                    $('#trip_name_a').val('');
                    $('#trip_id_a').val('');
                    $('#trip_name_b').val('');
                    $('#trip_id_b').val('');
                }
            });
        });

        $(document).on('select2:select', '#filter_bptd_id', function() {
            var bptd_id = $(this).val();
            var operator_id = $('#operator_id_filter').val();
            var route_id = $('#route_id_filter').val();
            var trip_id = $('#trip_id_filter').val();

            coreEventsPage.select2Init('#operator_id_filter', '/po_select_get', 'Pilih Perusahaan Operator', {
                bptd_id: function() {
                    return bptd_id
                },
            });
            coreEventsPage.select2Init('#route_id_filter', '/filter_route_id_select_get', 'Pilih Rute Trayek', {
                bptd_id: function() {
                    return bptd_id
                },
                operator_id: function() {
                    return operator_id
                },
            });
            coreEventsPage.select2Init('#trip_id_filter', '/trip_id_select_get', 'Pilih Rute Trip', {
                route_id: function() {
                    return route_id
                },
            });

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                trip_id: trip_id,
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#operator_id_filter', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $(this).val();
            var route_id = $('#route_id_filter').val();
            var trip_id = $('#trip_id_filter').val();

            coreEventsPage.select2Init('#route_id_filter', '/filter_route_id_select_get', 'Pilih Rute Trayek', {
                bptd_id: function() {
                    return bptd_id
                },
                operator_id: function() {
                    return operator_id
                },
            });
            coreEventsPage.select2Init('#trip_id_filter', '/trip_id_select_get', 'Pilih Rute Trip', {
                route_id: function() {
                    return route_id
                },
            });

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                trip_id: trip_id,
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#route_id_filter', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $('#operator_id_filter').val();
            var route_id = $(this).val();
            var trip_id = $('#trip_id_filter').val();

            coreEventsPage.select2Init('#trip_id_filter', '/trip_id_select_get', 'Pilih Rute Trip', {
                route_id: function() {
                    return route_id
                },
            });

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                trip_id: trip_id,
            };

            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('select2:select', '#trip_id_filter', function() {
            var bptd_id = $('#filter_bptd_id').val();
            var operator_id = $('#operator_id_filter').val();
            var route_id = $('#route_id_filter').val();
            var trip_id = $(this).val();

            coreEventsPage.filter = {
                bptd_id: bptd_id,
                operator_id: operator_id,
                route_id: route_id,
                trip_id: trip_id,
            };

            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        })

        $('#reset-filter').on('click', function() {
            $('#filter_bptd_id').val(null).trigger('change');
            $('#operator_id_filter').val(null).trigger('change');
            $('#route_id_filter').val(null).trigger('change');
            $('#trip_id_filter').val(null).trigger('change');

            coreEventsPage.filter = null;
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#form-bptd').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            Swal.fire({
                title: "Simpan data ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url + '_save',
                        type: 'POST',
                        dataType: 'json',
                        data: data,
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Mohon Tunggu',
                                html: 'Sedang menyimpan data',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(rs) {
                            if (rs.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: rs.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                coreEventsPage.table.ajax.reload();

                                $('#tab a[href="#tab-data"]').tab('show');
                                $('#form-bptd')[0].reset();
                                $('#route_id').val('').trigger('select2:select');
                                $('#operator_id').val('').trigger('select2:select');
                                $('#ritke').prop('selectedIndex', 0);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: rs.message.includes('Duplicate entry') ? 'Data sudah ada' : rs.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.responseText)
                            var msg = xhr.responseText;
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseText,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data Batal disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }).on('reset', function() {
            $('#id_a').val(null);
            $('#id_b').val(null);
            $('#timetable_code').val(null);

            $('#route_id').val(null).trigger('change');
            $('#trip_id').val(null).trigger('change');
            $('#operator_id').val(null).trigger('change');
            $('#ritke').prop('selectedIndex', 0);
        });

        coreEventsPage.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEventsPage.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEventsPage.placeholder = 'Cari Timetables...';
        coreEventsPage.columnDefs = [{
            "className": "text-center",
            "targets": [0, 2, 4, 5, 6]
        }];

        coreEventsPage.load(null, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

    function datatableColumn() {
        if (role_code == 'pop' || role_code == 'ppo') {
            var columns = [{
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        return dataStart + index.row + 1
                    }
                },
                {
                    data: "kor",
                    orderable: false,
                    width: 5
                },
                {
                    data: "jenroute",
                    orderable: false,
                    width: 5
                },
                {
                    data: "ritke",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        return "Rit Ke-" + data.ritke
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[0] === undefined ? "-" : trip[0];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[0] === undefined ? "-" : time[0];
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[1] === undefined ? "-" : trip[1];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[1] === undefined ? "-" : time[1];
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        let button = ''

                        if (auth_edit == "1") {
                            button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.timetable_code + '" title="Edit">\
                                        <i class="fa fa-edit"></i>\
                                    </button>\
                                    ';
                        }

                        if (auth_delete == "1") {
                            button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.timetable_code + '" title="Delete">\
                                            <i class="bx bx-trash-alt"></i>\
                                        </button>';
                        }


                        button += (button == '') ? '' : ''

                        return "<div class='action-button'>" + button + "</div>";
                    }
                }
            ];
        } else if (role_code == 'daj' || role_code == 'sad') {
            var columns = [{
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        return dataStart + index.row + 1
                    }
                },
                {
                    data: "user_web_name",
                    orderable: false,
                    width: 100
                },
                {
                    data: "po_name",
                    orderable: false,
                    width: 100
                },
                {
                    data: "kor",
                    orderable: false,
                    width: 5
                },
                {
                    data: "jenroute",
                    orderable: false,
                    width: 5
                },
                {
                    data: "ritke",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        return "Rit Ke-" + data.ritke
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[0] === undefined ? "-" : trip[0];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[0] === undefined ? "-" : time[0];
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[1] === undefined ? "-" : trip[1];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[1] === undefined ? "-" : time[1];
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        let button = ''

                        if (auth_edit == "1") {
                            button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.timetable_code + '" title="Edit">\
                                        <i class="fa fa-edit"></i>\
                                    </button>\
                                    ';
                        }

                        if (auth_delete == "1") {
                            button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.timetable_code + '" title="Delete">\
                                            <i class="bx bx-trash-alt"></i>\
                                        </button>';
                        }


                        button += (button == '') ? "<b style='color:red;'><i class='bx bx-block font-size-16 align-middle'></i></b>" : ""

                        return "<div class='action-button'>" + button + "</div>";
                    }
                }
            ];
        } else {
            var columns = [{
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        return dataStart + index.row + 1
                    }
                },
                {
                    data: "po_name",
                    orderable: false,
                    width: 100
                },
                {
                    data: "kor",
                    orderable: false,
                    width: 5
                },
                {
                    data: "jenroute",
                    orderable: false,
                    width: 5
                },
                {
                    data: "ritke",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        return "Rit Ke-" + data.ritke
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[0] === undefined ? "-" : trip[0];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[0] === undefined ? "-" : time[0];
                    }
                },
                {
                    data: "timetable_name",
                    orderable: true,
                    width: 100,
                    render: function(a, type, data, index) {
                        let trip = data.timetable_name.split("|")

                        return trip[1] === undefined ? "-" : trip[1];
                    }

                },
                {
                    data: "trip_time",
                    orderable: true,
                    width: 5,
                    render: function(a, type, data, index) {
                        let time = data.trip_time.split("|")

                        return time[1] === undefined ? "-" : time[1];
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    width: 5,
                    render: function(a, type, data, index) {
                        let button = ''

                        if (auth_edit == "1") {
                            button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.timetable_code + '" title="Edit">\
                                        <i class="fa fa-edit"></i>\
                                    </button>\
                                    ';
                        }

                        if (auth_delete == "1") {
                            button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.timetable_code + '" title="Delete">\
                                            <i class="bx bx-trash-alt"></i>\
                                        </button>';
                        }


                        button += (button == '') ? "<b style='color:red;'><i class='bx bx-block font-size-16 align-middle'></i></b>" : ""

                        return "<div class='action-button'>" + button + "</div>";
                    }
                }
            ];
        }
        return columns;
    }
</script>