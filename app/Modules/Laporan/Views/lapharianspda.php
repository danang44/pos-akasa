<style>
    #datatable {
        width: 100% !important;
    }

    .button-cover:before {
        counter-increment: button-counter;
        content: counter(button-counter);
        position: absolute;
        right: 0;
        bottom: 0;
        color: #d7e3e3;
        font-size: 12px;
        line-height: 1;
        padding: 5px;
    }

    .button-cover,
    .knobs,
    .layer {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .button {
        position: relative;
        top: 50%;
        width: 110px;
        height: 36px;
        margin: 0px auto 0 auto;
        overflow: hidden;
    }

    .button.r,
    .button.r .layer {
        border-radius: 100px;
    }

    .button.b2 {
        border-radius: 2px;
    }

    .checkbox {
        position: relative;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 3;
    }

    .knobs {
        z-index: 2;
    }

    .layer {
        width: 100%;
        background-color: #ebf7fc;
        transition: 0.3s ease all;
        z-index: 1;
    }

    /* Button 17 */
    #button-17 .knobs:before,
    #button-17 .knobs span {
        content: "BUS";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 50px;
        height: 28px;
        color: #fff;
        font-size: 10px;
        font-weight: bold;
        text-align: center;
        line-height: 1;
        padding: 9px 4px;
    }

    #button-17 .knobs:before {
        transition: 0.3s ease all, left 0.5s cubic-bezier(0.18, 0.89, 0.35, 1.15);
        z-index: 2;
    }

    #button-17 .knobs span {
        background-color: #03a9f4;
        border-radius: 2px;
        transition: 0.3s ease all, left 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15);
        z-index: 1;
    }

    #button-17 .checkbox:checked+.knobs:before {
        content: "TRAYEK";
        left: 55px;
    }

    #button-17 .checkbox:checked+.knobs span {
        left: 55px;
        background-color: #f44336;
    }

    #button-17 .checkbox:checked~.layer {
        background-color: #fcebeb;
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
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="tab-data" role="tabpanel">
                    <div class="row">
                        <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                            <input type="hidden" class="form-control" id="id" name="id" value="" required>
                            <?= csrf_field(); ?>
                            <div class="d-flex flex-wrap align-items-center">
                                <h5 class="card-title me-2">Filter Data</h5>
                                <div class="ms-auto">
                                    <!-- <div>
                                        <label class="switch">
                                            <input type="checkbox" id="togBtn">
                                            <div class="slider round">
                                                <span class="on fw-bolder">TRAYEK <i class="fas fa-route"></i></span>
                                                <span class="off fw-bolder"><i class="fas fa-bus"></i> BUS</span>
                                            </div>
                                        </label>
                                    </div> -->
                                    <div class="button b2" id="button-17">
                                        <input type="checkbox" class="checkbox" id="togBtn" />
                                        <div class="knobs">
                                            <span></span>
                                        </div>
                                        <div class="layer"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="dng">
                                    <div class="col-md-12">
                                        <div class="mb-3 field2" style="display: block;">
                                            <label>Pilih Bus</label>
                                            <select class="form-control sel2" id="id_select_get_bus" name="id_select_get_bus"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Dari Tanggal</label>
                                        <input type="date" class="form-control" name="spda_date_start" id="spda_date_start" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" class="form-control" name="spda_date_end" id="spda_date_end" required="true">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label>Status Verifikasi</label>
                                        <select class="form-control" id="sts_verif" name="sts_verif">
                                            <option value="" selected disabled>Pilih Status Verifikasi</option>
                                            <option value="99">Semua</option>
                                            <option value="0">Masih Perjalanan</option>
                                            <option value="1">Belum Verifikasi</option>
                                            <option value="2">Sudah Verifikasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <!-- button export pdf -->
                                <button type="button" class="btn btn-info" id="export-pdf"><i class="fas fa-file-pdf"></i> Export PDF</button>
                                <button type="submit" class="btn btn-primary" id="cari"><i class="fas fa-search"></i> Cari</button>
                                <button type="button" class="btn btn-secondary" id="reset"><i class="fas fa-sync"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="table-responsive" style="padding:7px;">
                            <table id="datatable-laporan" class="table table-theme table-row v-middle table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th><span>#</span></th>
                                        <th><span>Tanggal</span></th>
                                        <th><span>Nama Bus</span></th>
                                        <th><span>Ritase</span></th>
                                        <th><span>Kilometer</span></th>
                                        <th><span>Trip</span></th>
                                        <th><span>Jumlah Penumpang</span></th>
                                        <th><span>Status</span></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <button type="button" class="btn btn-outline-light waves-effect" id="export-excel-table"><i class="fas fa-file-excel"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
</div>
<!-- <form id="form_export_pdf" action="<?= base_url() ?>/laporan/action/lapharianspda_pdf" method="post" target="_blank"> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<?= csrf_field(); ?>
<input type="hidden" name="bus_id" id="bus_id" />
<input type="hidden" name="spda_dat_start" id="spda_dat_start" />
<input type="hidden" name="spda_dat_end" id="spda_dat_end" />
<input type="hidden" name="spda_status" id="spda_status" />
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.11/jquery.csv.min.js"></script>
<script type="text/javascript">
    const auth_insert = '<?= $rules->i ?>';
    const auth_edit = '<?= $rules->e ?>';
    const auth_delete = '<?= $rules->d ?>';
    const auth_otorisasi = '<?= $rules->o ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEvents;

    const select2Array = [{
            id: 'id_select_get_bus',
            url: '/id_select_get_bus',
            placeholder: 'Pilih Bus',
            params: null
        },
        {
            id: 'id_select_get_trayek',
            url: '/id_select_get_trayek',
            placeholder: 'Pilih Trayek',
            params: null
        }
    ];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };

        // coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder: 'Berhasil menyimpan data Perusahaan Operator',
            afterAction: function(result) {
                $(".sel2").val(null).trigger('change');
            }
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                var data = result.data;
                setTimeout(function() {
                    select2Array.forEach(function(x) {
                        $('#' + x.id).select2('trigger', 'select', {
                            data: {
                                id: result.data[x.id],
                                text: result.data[x.id.replace('id', 'nama')]
                            }
                        });
                    });
                }, 100);
            }
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus data Perusahaan Operator',
            afterAction: function() {

            }
        }

        coreEvents.resetHandler = {
            action: function() {
                $(".sel2").val(null).trigger('change');
            }
        }

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#export-pdf').hide();
        $('#form').on('submit', function(e) {
            e.preventDefault();
            trayek_id = $('#id_select_get_trayek').val();
            bus_id = $('#id_select_get_bus').val();
            spda_date_start = $('#spda_date_start').val();
            spda_date_end = $('#spda_date_end').val();
            spda_status = $('#sts_verif').val();

            if ($('#togBtn').is(':checked')) {
                if (trayek_id == null || trayek_id == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Trayek terlebih dahulu!',
                    });
                } else if (spda_date_start == null || spda_date_start == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Tanggal awal terlebih dahulu!',
                    });
                } else if (spda_status == null || spda_status == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Status Verifikasi terlebih dahulu!',
                    });
                } else if (spda_date_end == null || spda_date_end == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Tanggal akhir terlebih dahulu!',
                    });
                } else {
                    $('#export-pdf').show();
                    loadTableLaporan(trayek_id, bus_id, spda_date_start, spda_date_end, spda_status);
                }
            } else if ($('#togBtn').is(':not(:checked)')) {
                if (bus_id == null || bus_id == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Bus terlebih dahulu!',
                    });
                } else if (spda_date_start == null || spda_date_start == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Tanggal awal terlebih dahulu!',
                    });
                } else if (spda_status == null || spda_status == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Status Verifikasi terlebih dahulu!',
                    });
                } else if (spda_date_end == null || spda_date_end == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Pilih Tanggal akhir terlebih dahulu!',
                    });
                } else {
                    $('#export-pdf').show();
                    loadTableLaporan(trayek_id, bus_id, spda_date_start, spda_date_end, spda_status);
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Pilih Trayek atau Bus terlebih dahulu!',
                });
            }

        }).on('click', '#export-pdf', function(e) {
            e.preventDefault();
            let trayek_id = $('#id_select_get_trayek').val();
            let bus_id = $('#id_select_get_bus').val();
            let spda_date_start = $('#spda_date_start').val();
            let spda_date_end = $('#spda_date_end').val();
            let spda_status = $('#sts_verif').val();

            $('#trayek_id').val(trayek_id);
            $('#bus_id').val(bus_id);
            $('#spda_dat_start').val(spda_date_start);
            $('#spda_dat_end').val(spda_date_end);
            $('#spda_status').val(spda_status);
            $('#form_export_pdf').submit();
        });

        $('#reset').on('click', function() {
            $('#export-pdf').hide();
            $(".sel2").val(null).trigger('change');
            $('#spda_date_start').val('');
            $('#spda_date_end').val('');
            $('#sts_verif').val('');
            $('#datatable-laporan tbody').empty();
            $('#export-excel-table').attr('disabled', true);
        });

        $('#togBtn').on('change', function() {
            if ($(this).is(':checked')) {
                $('#trayek_id').val(null).trigger('change');
                $('#bus_id').val(null).trigger('change');
                $('#spda_dat_start').val('');
                $('#spda_date_start').val('');
                $('#spda_dat_end').val('');
                $('#spda_date_end').val('');
                $('#spda_status').val('');
                $('#sts_verif').val('');
                $('#export-pdf').hide();
                $('.col-md-4#dng').html(`<div class="col-md-12">
                                            <div class="mb-3 field1" style="display: block;">
                                                <label>Pilih Trayek</label>
                                                <select class="form-control sel2" id="id_select_get_trayek" name="id_select_get_trayek"></select>
                                            </div>
                                        </div>`);
                coreEvents.select2Init('#id_select_get_trayek', '/id_select_get_trayek', 'Pilih Trayek', null);
                $('#datatable-laporan tbody').html('');
                $('#datatable-laporan tfoot').html('');
                $('#export-excel-table').attr('disabled', true);
            } else {
                $('#trayek_id').val(null).trigger('change');
                $('#bus_id').val(null).trigger('change');
                $('#spda_dat_start').val('');
                $('#spda_date_start').val('');
                $('#spda_dat_end').val('');
                $('#spda_date_end').val('');
                $('#spda_status').val('');
                $('#sts_verif').val('');
                $('#export-pdf').hide();
                $('.col-md-4#dng').html(`<div class="col-md-12">
                                            <div class="mb-3 field2" style="display: block;">
                                                <label>Pilih Bus</label>
                                                <select class="form-control sel2" id="id_select_get_bus" name="id_select_get_bus"></select>
                                            </div>
                                        </div>`);
                coreEvents.select2Init('#id_select_get_bus', '/id_select_get_bus', 'Pilih Bus', null);
                $('#datatable-laporan tbody').html('');
                $('#datatable-laporan tfoot').html('');
                $('#export-excel-table').attr('disabled', true);
            }
        });

        $('#export-excel-table').attr('disabled', true);
        $('#export-excel-table').on('click', function() {
            // Prepare data from the table
            let tableData = [];
            $('#datatable-laporan tbody tr').each(function() {
                let rowData = [];
                $(this).find('td').each(function() {
                    rowData.push($(this).text());
                });
                tableData.push(rowData);
            });

            // Create a new workbook and add a worksheet
            let wb = XLSX.utils.book_new();
            let ws = XLSX.utils.aoa_to_sheet(tableData);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            // Convert the workbook to a Blob object
            let blob = new Blob([XLSX.write(wb, {
                bookType: 'xls',
                type: 'array'
            })], {
                type: 'application/vnd.ms-excel',
            });

            // Create a URL for the Blob object
            let url = URL.createObjectURL(blob);

            // Create a temporary link element for download
            let link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', 'exported_data.xls');
            document.body.appendChild(link);

            // Trigger a click event on the link to initiate download
            link.click();

            // Clean up
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        });

    });
    // end document ready

    function loadTableLaporan(option1, option2, option3, option4, option5) {
        $.ajax({
            url: url + '_load',
            type: 'POST',
            dataType: 'JSON',
            data: {
                trayek_id: option1,
                bus_id: option2,
                spda_date_start: option3,
                spda_date_end: option4,
                spda_status: option5,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memuat data...',
                    allowOutsideClick: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                });
                $('#datatable-laporan tbody').html('');
                $('#datatable-laporan tfoot').html('');
            },
            success: function(res) {
                var data = res.data;
                Swal.close();
                if (res.success) {
                    var table = '';
                    var km = 0;
                    var pnp = 0;

                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            const detail = JSON.parse(data[i].detail);

                            for (var j = 0; j < detail.length; j++) {
                                var status = '';
                                var date = data[i].spda_date;
                                var momentObject = moment(date, 'YYYY-MM-DD');
                                var momentString = momentObject.format('DD-MM-YYYY');

                                km += parseInt(detail[j].trip_dist);
                                pnp += parseInt(detail[j].total_pnp);

                                if (detail[j].spda_status == 0) {
                                    status = '<span class="badge bg-warning">Masih Perjalanan</span>';
                                } else if (detail[j].spda_status == 1) {
                                    status = '<span class="badge bg-danger">Belum Verifikasi</span>';
                                } else if (detail[j].spda_status == 2) {
                                    status = '<span class="badge bg-success">Sudah Verifikasi</span>';
                                } else {
                                    status = '<span class="text-secondary">-</span>';
                                }

                                if (j == 0) {
                                    table += `<tr>
                                        <td rowspan='${detail.length}' style='vertical-align: middle'>${i+1}</td>
                                        <td rowspan='${detail.length}' style='vertical-align: middle'><div style="width:80px;">${momentString}</div></td>
                                       
                                        <td rowspan='${detail.length}' style='vertical-align: middle'>${data[i].bus_name}</td>
                                        <td rowspan='${detail.length}' style='vertical-align: middle'>${data[i].ritke}</td>
                                        <td>${detail[j].trip_dist}</td>
                                        <td>${detail[j].trip_name}</td>
                                        <td>${detail[j].total_pnp}</td>
                                        <td>${status}</td>
                                    </tr>`;
                                } else {
                                    table += `<tr>
                                        <td>${detail[j].trip_dist}</td>
                                        <td>${detail[j].trip_name}</td>
                                        <td>${detail[j].total_pnp}</td>
                                        <td>${status}</td>
                                    </tr>`;
                                }
                            }
                        }
                        $('#export-excel-table').attr('disabled', false);
                    } else {
                        var table = '<tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>';
                        $('#export-excel-table').attr('disabled', true);
                    }

                    const footer = `<tr>
                                        <th colspan="4" class="text-end" style="text-align: right !important;">TOTAL</th>
                                        <th>${km}</th>
                                        <th></th>
                                        <th colspan="2">${pnp}</th>
                                    </tr>`

                    $('#datatable-laporan tbody').html(table);
                    $('#datatable-laporan tfoot').html(footer);
                    $('#export-excel-table').attr('disabled', false);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Data tidak ditemukan',
                    });
                    $('#datatable-laporan tbody').html('<td colspan="8" class="text-center">Data tidak ditemukan</td>');
                    $('#datatable-laporan tfoot').html('');
                    $('#export-excel-table').attr('disabled', true);
                }
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
</script>