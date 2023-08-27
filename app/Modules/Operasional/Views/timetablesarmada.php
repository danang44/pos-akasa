<?php $session = \Config\Services::session(); ?>
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
                    <div class="table-responsive" style="padding:7px;">
                        <table id="datatable" class="table table-theme table-row v-middle">
                            <thead>
                                <tr>
                                    <th><span>#</span></th>
                                    <th><span>Rute Trayek</span></th>
                                    <th><span>Nopol Bus</span></th>
                                    <th><span>Rit ke</span></th>
                                    <th><span>Trip A</span></th>
                                    <th><span>Waktu</span></th>
                                    <th><span>Trip A</span></th>
                                    <th><span>Waktu</span></th>
                                    <th class="column-2action"></th>
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
                            <form data-plugin="parsley" data-option="{}" id="form-armada" novalidate>
                                <input type="hidden" class="form-control" id="timetable_code" name="timetable_code" value="" required />
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Rute Trayek</label>
                                            <select class="form-control select2-container sel2" id="route_id" name="route_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-12">
                                        <div class="mb-3">
                                            <label>Rute Trip</label>
                                            <select class="form-control select2-container sel2" id="trip_id" name="trip_id" required aria-required="true"></select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Armada</label>
                                            <select class="form-control select2-container sel2" id="bus_id" name="bus_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="mb-3">
                                            <label>Rit Ke-</label>
                                            <select class="form-control select2-container sel2" id="ritke" name="ritke"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="trip">
                                    <div class="row" id="trip_a">
                                        <input type="hidden" id="id_a" name="id_a" />
                                        <input type="hidden" id="timetable_id_a" name="timetable_id_a" />
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
                                                <input type="time" class="form-control" id="time_start_a" name="time_start_a" required readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Tiba</label>
                                                <input type="time" class="form-control" id="time_end_a" name="time_end_a" required readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="trip_b">
                                        <input type="hidden" id="id_b" name="id_b" />
                                        <input type="hidden" id="timetable_id_b" name="timetable_id_b" />
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
                                                <input type="time" class="form-control" id="time_start_b" name="time_start_b" required readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="mb-3">
                                                <label>Jam Tiba</label>
                                                <input type="time" class="form-control" id="time_end_b" name="time_end_b" required readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <input type="hidden" class="form-control" id="ritke_save" name="ritke_save">
                                </div>
                                <div class="text-center">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-dark" type="reset" id="reset">Reset</button>
                                    </div>
                                </div>
                                <br><br>
                                <h6 class="text-center">Catatan : Silahkan input Timetable per Trip</h6>
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

    var operator_id = '<?= $session->get('operator_id') ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEventsPage;

    const select2Array = [{
            id: 'timetable',
            url: '/timetable_select_get',
            placeholder: 'Pilih Time Table',
            params: null,
            selection: null
        },
        {
            id: 'route_id',
            url: '/route_id_select_get',
            placeholder: 'Pilih Rute Trayek',
            params: null,
            selection: null
        },
        {
            id: 'bus_id',
            url: '/bus_operator_select_get',
            placeholder: 'Pilih Armada',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                },
            },
            selection: null
        },
        {
            id: 'trip_id',
            url: '/trip_id_select_get',
            placeholder: 'Pilih Trayek Trip',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                },
            },
            selection: null
        },
        {
            id: 'ritke',
            url: '/ritke_tt_armada_select_get',
            placeholder: 'Pilih Rit Ke',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                }
            },
            selection: function(data) {
                $('.trip').show();
                var trip_name = data.trip_name.split(',');
                var trip_id = data.trip_id.split(',');
                var time_start = data.time_start.split(',');
                var time_end = data.time_end.split(',');
                var id = data.id.split(',');

                $('#trip_name_a').val(trip_name[0]);
                $('#trip_id_a').val(trip_id[0]);
                $('#trip_name_b').val(trip_name[1]);
                $('#trip_id_b').val(trip_id[1]);

                $('#timetable_id_a').val(id[0]);
                $('#timetable_id_b').val(id[1]);

                $('#time_start_a').val(time_start[0]);
                $('#time_end_a').val(time_end[0]);
                $('#time_start_b').val(time_start[1]);
                $('#time_end_b').val(time_end[1]);

                $('#ritke_save').val(data.ritke);

            }
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

        // coreEventsPage.insertHandler = {
        //     placeholder: 'Berhasil menyimpan jadwal',
        //     afterAction: function(result) {
        //         $(".sel2").val(null).trigger('change');
        //     }
        // }

        coreEventsPage.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                //console.log(result);
                var data = result.data;
                console.log(data);
                if (data.route_id != null) {
                    $('#route_id').select2("trigger", "select", {
                        data: {
                            id: data.route_id,
                            text: data.route_name
                        }
                    });
                }

                if (data.bus_id != null) {
                    $('#bus_id').select2("trigger", "select", {
                        data: {
                            id: data.bus_id,
                            text: data.bus_nopol
                        }
                    });
                }

                if (data.ritke != null) {
                    $('#ritke').select2("trigger", "select", {
                        data: {
                            id: data.timetable_id,
                            text: data.ritke_timetable,
                            trip_id: data.trip_id,
                            trip_name: data.trip_name,
                            time_start: data.dep_time,
                            time_end: data.arr_time,
                        }
                    });
                }

                setTimeout(function() {
                    $('.trip').show();

                    var trip_name = data.trip_name.split(',');
                    var trip_id = data.trip_id.split(',');
                    var time_start = data.dep_time.split(',');
                    var time_end = data.arr_time.split(',');
                    var timetable_id = data.timetable_id.split(',');
                    var id = data.id.split(',');

                    $('#trip_name_a').val(trip_name[0]);
                    $('#trip_id_a').val(trip_id[0]);
                    $('#trip_name_b').val(trip_name[1]);
                    $('#trip_id_b').val(trip_id[1]);

                    $('#id_a').val(id[0]);
                    $('#id_b').val(id[1]);

                    $('#timetable_id_a').val(timetable_id[0]);
                    $('#timetable_id_b').val(timetable_id[1]);

                    $('#time_start_a').val(time_start[0]);
                    $('#time_end_a').val(time_end[0]);
                    $('#time_start_b').val(time_start[1]);
                    $('#time_end_b').val(time_end[1]);
                    $('#ritke_save').val(data.ritke);

                }, 500);

            }

        }

        coreEventsPage.deleteHandler = {
            placeholder: 'Berhasil menghapus jadwal',
            afterAction: function() {}
        }

        coreEventsPage.resetHandler = {
            action: function() {
                $('#route_id').val(null).trigger('change');
                $('#trip_id').val(null).trigger('change');
                $('#bus_id').val(null).trigger('change');
                $('#ritke').val(null).trigger('change');
                $('#timetable_id_a').val(null);
                $('#timetable_id_b').val(null);
                $('#id_a').val(null);
                $('#id_b').val(null);
                $('#trip_name_a').val(null);
                $('#trip_id_a').val(null);
                $('#trip_name_b').val(null);
                $('#trip_id_b').val(null);
                $('#time_start_a').val(null);
                $('#time_end_a').val(null);
                $('#time_start_b').val(null);
                $('#time_end_b').val(null);
                $('#ritke_save').val(null);
                $('.trip').hide();
            }
        }

        select2Array.forEach(function(x) {
            coreEventsPage.select2Init('#' + x.id, x.url, x.placeholder, x.params, null, x.selection);
        });

        $('#reset').on('click', function() {
            $(".sel2").val(null).trigger('change');
        });

        $('.trip').hide();
        $('form#form-armada').on('submit', function(e) {
            e.preventDefault();
            // route_id = $('#route_id').val();
            // trip_id = $('#trip_id').val();
            // operator_id = operator_id;
            // bus_id = $('#bus_id').val();
            // timetable_id_a = $('#timetable_id_a').val();
            // timetable_id_b = $('#timetable_id_b').val();
            // ritke = $('#ritke_save').val();
            // dep_time = $('#dep_time').val();
            // arr_time = $('#arr_time').val();

            var data = $(this).serializeArray();

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
                                title: 'Mohon tunggu!',
                                html: 'Sedang menyimpan data',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                        },
                        success: function(result) {
                            if (result.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disimpan',
                                    icon: 'success',
                                    timer: 1500,
                                }).then((result) => {
                                    coreEventsPage.table.ajax.reload();
                                    coreEventsPage.resetHandler.action();
                                    $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');

                                    $(".sel2").val(null).trigger('change');
                                });

                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data gagal disimpan',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: xhr.responseText,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Batal!',
                        text: 'Data batal disimpan',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });

        $(document).on('select2:select', '#route_id', function() {
            coreEventsPage.select2Init('#trip_id', '/trip_id_select_get', 'Pilih Trayek Trip', {
                route_id: function() {
                    return $('#route_id').val()
                },
            });
            coreEventsPage.select2Init('#bus_id', '/bus_operator_select_get', 'Pilih Armada', {
                route_id: function() {
                    return $('#route_id').val()
                },
            });
            $('#ritke').text('');
            coreEventsPage.select2Init('#ritke', '/ritke_tt_armada_select_get', 'Pilih Rit Ke', {
                route_id: function() {
                    return $('#route_id').val()
                }
            }, null, function(data) {
                $('.trip').show();
                var trip_name = data.trip_name.split(',');
                var trip_id = data.trip_id.split(',');
                var time_start = data.time_start.split(',');
                var time_end = data.time_end.split(',');
                var id = data.id.split(',');

                $('#trip_name_a').val(trip_name[0]);
                $('#trip_id_a').val(trip_id[0]);
                $('#trip_name_b').val(trip_name[1]);
                $('#trip_id_b').val(trip_id[1]);

                $('#timetable_id_a').val(id[0]);
                $('#timetable_id_b').val(id[1]);

                $('#time_start_a').val(time_start[0]);
                $('#time_end_a').val(time_end[0]);
                $('#time_start_b').val(time_start[1]);
                $('#time_end_b').val(time_end[1]);

                $('#ritke_save').val(data.ritke);
            });
        }).on('select2:select', '#trip_id', function() {
            coreEventsPage.select2Init('#bus_id', '/bus_operator_select_get', 'Pilih Armada', {
                route_id: function() {
                    return $('#route_id').val()
                },
            });

            $('#ritke').text('');
            coreEventsPage.select2Init('#ritke', '/ritke_tt_armada_select_get', 'Pilih Rit Ke', {
                route_id: function() {
                    return $('#route_id').val()
                }
            }, null, function(data) {
                $('.trip').show();
                var trip_name = data.trip_name.split(',');
                var trip_id = data.trip_id.split(',');
                var time_start = data.time_start.split(',');
                var time_end = data.time_end.split(',');
                var id = data.id.split(',');

                $('#trip_name_a').val(trip_name[0]);
                $('#trip_id_a').val(trip_id[0]);
                $('#trip_name_b').val(trip_name[1]);
                $('#trip_id_b').val(trip_id[1]);

                $('#timetable_id_a').val(id[0]);
                $('#timetable_id_b').val(id[1]);

                $('#time_start_a').val(time_start[0]);
                $('#time_end_a').val(time_end[0]);
                $('#time_start_b').val(time_start[1]);
                $('#time_end_b').val(time_end[1]);

                $('#ritke_save').val(data.ritke);
            });
        });

        coreEventsPage.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEventsPage.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEventsPage.placeholder = 'Cari Data';
        coreEventsPage.columnDefs = [{
            "className": "text-center",
            "targets": [0, 3, 4, 5]
        }];

        coreEventsPage.load(null, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

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
                data: "route_name",
                orderable: true,
                width: 100,
            },
            {
                data: "bus_nopol",
                orderable: true,
                width: 5,
            },
            {
                data: "ritke",
                orderable: true,
                width: 5,
            },
            {
                data: "trip_name",
                orderable: true,
                width: 100,
                render: function(a, type, data, index) {
                    let trip = data.trip_name.split("|")

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
                data: "trip_name",
                orderable: true,
                width: 100,
                render: function(a, type, data, index) {
                    let trip = data.trip_name.split("|")

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


                    button += (button == '') ? "<b>Tidak ada aksi</b>" : ""

                    return "<div class='action-button'>" + button + "</div>";
                }
            }
        ];

        return columns;
    }
</script>