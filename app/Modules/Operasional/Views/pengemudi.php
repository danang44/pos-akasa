<?php $session = \Config\Services::session(); ?>
<style type="text/css">
    #preview {
        margin-top: 20px;
        width: 400px;
        height: 400px;
        object-fit: contain;
        display: none;
    }

    .preview-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 40px;
        text-align: center;
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
                            <div class="col-lg-11">
                                <div class="mb-3">
                                    <label>Rute Trayek</label>
                                    <select class="form-control select2-container sel2" id="filter_route_id" name="filter_route_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-12 mt-4 text-center">
                                <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                            </div>
                        <?php } else { ?>
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label>Rute Trayek</label>
                                    <select class="form-control select2-container sel2" id="filter_route_id" name="filter_route_id" required aria-required="true"></select>
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
                                        <th><span>Nama Pengemudi</span></th>
                                        <th><span>No. KTP</span></th>
                                        <th><span>No. SIM</span></th>
                                        <th><span>E-mail Pengemudi</span></th>
                                        <th><span>No. Telp</span></th>
                                        <th><span>PO</span></th>
                                        <th><span>Trayek</span></th>
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
                        <div class="card-body">
                            <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                                <input type="hidden" class="form-control" id="id" name="id" value="" required>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Nama Pengemudi</label>
                                            <input class="form-control" id="driver_name" name="driver_name" required aria-required="true" placeholder="Nama Lengkap" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>E-mail Pengemudi</label>
                                            <input class="form-control" id="driver_email" name="driver_email" required aria-required="true" placeholder="Email Pengemudi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label>No. KTP</label>
                                            <input class="form-control" id="ktp_no" name="ktp_no" required aria-required="true" placeholder="Nomor KTP" maxlength="17" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label>No. SIM</label>
                                            <input class="form-control" id="sim_no" name="sim_no" required aria-required="true" placeholder="Nomor SIM" maxlength="14" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="phone_no">No. Telp Pengemudi</label>
                                            <div class="input-group">
                                                <div class="input-group-text">+62</div>
                                                <input class="form-control" id="phone_no" name="phone_no" placeholder="Nomor Telepon" pattern="/(7|8|9)\d{9}/" maxlength="15">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Rute Trayek</label>
                                            <select class="form-control select2-container sel2" id="route_id" name="route_id" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Alamat Pengemudi</label>
                                            <textarea class="form-control" id="driver_addr" name="driver_addr" placeholder="Alamat Pengemudi"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($session->get('role_code') == 'pop' || $session->get('role_code') == 'ppo') { ?>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label>Foto Pengemudi</label>
                                                <input type="file" class="form-control upload-pic" accept="image/*" data-folder="img/driver/" required>
                                                <input type="hidden" name="driver_pic" id="driver_pic">
                                                <img id="preview" />
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Foto Pengemudi</label>
                                                <input type="file" class="form-control upload-pic" accept="image/*" data-folder="img/driver/" required>
                                                <input type="hidden" name="driver_pic" id="driver_pic">
                                                <img id="preview" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="operator_id">Perusahaan Operator</label>
                                                <select class="form-control select2-container sel2" id="operator_id" name="operator_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="text-center mt-5">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-dark" type="reset">Reset</button>
                                    </div>
                                </div>
                                <br><br>
                                <h6 class="text-center text-danger">Catatan: Data Pengemudi diinputkan sesuai dengan Rute Pengemudi bekerja</h6>
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

    const role_code = '<?= $session->get('role_code') ?>';
    const operator_id = '<?= $session->get('operator_id') ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';
    const url_upload = '<?= base_url() . "/main/action/uploadFiles" ?>';

    var dataStart = 0;
    var coreEventsPage;

    const select2Array = [{
            id: 'route_id',
            url: '/route_id_select_get',
            placeholder: 'Pilih Trayek',
            params: null
        },
        {
            id: 'operator_id',
            url: '/po_select_get',
            placeholder: 'Pilih Perusahaan',
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
        coreEventsPage.upload = url_upload;
        coreEventsPage.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEventsPage.tableColumn = datatableColumn();

        coreEventsPage.insertHandler = {
            placeholder: 'Berhasil menyimpan pengemudi',
            afterAction: function(result) {}
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

                if (data.operator_id != null) {
                    $('#operator_id').select2("trigger", "select", {
                        data: {
                            id: data.operator_id,
                            text: data.operator_name
                        }
                    });
                }

                $('#preview').attr('src', data.driver_pic);
                $('#preview').show();
            }
        }

        coreEventsPage.deleteHandler = {
            placeholder: 'Berhasil menghapus pengemudi',
            afterAction: function() {

            }
        }

        coreEventsPage.resetHandler = {
            action: function() {
                // $('.upload-pic').attr('required', true);
                $('#preview').attr('src', '');
                $('#preview').hide();
            }
        }

        coreEventsPage.uploadHandler = {
            afterAction: function(response) {
                $('#preview').attr('src', response.url);
                $('#preview').show();

                $('#driver_pic').val(response.url);
            }
        }

        select2Array.forEach(function(x) {
            coreEventsPage.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#phone_no').on('keyup', function() {
            var phone_no = $(this).val();
            if (phone_no.length >= 12) {
                if (phone_no.substring(0, 3) == '+62') {
                    $(this).val('' + phone_no.substring(3, 15));
                } else if (phone_no.substring(0, 2) == '62') {
                    $(this).val('' + phone_no.substring(2, 14));
                } else if (phone_no.substring(0, 1) == '0') {
                    $(this).val('' + phone_no.substring(1, 12));
                }
            }
        });

        $('#filter_bptd_id').on('select2:select', function() {
            coreEventsPage.select2Init('#filter_operator_id', '/po_select_get', 'Pilih Perusahaan', {
                bptd_id: $(this).val()
            });

            coreEventsPage.select2Init('#filter_route_id', '/filter_route_id_select_get', 'Pilih Trayek', {
                bptd_id: function() {
                    if ($('#filter_bptd_id').val() != '') {
                        return $('#filter_bptd_id').val();
                    } else {
                        return bptd_id;
                    }
                }
            });

            coreEventsPage.filter = {
                bptd_id: $(this).val()
            };

            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#filter_operator_id').on('select2:select', function() {
            coreEventsPage.select2Init('#filter_route_id', '/filter_route_id_select_get', 'Pilih Trayek', {
                operator_id: function() {
                    if ($('#filter_operator_id').val() != '') {
                        return $('#filter_operator_id').val();
                    } else {
                        return operator_id;
                    }
                }
            });

            coreEventsPage.filter = {
                bptd_id: $('#filter_bptd_id').val(),
                operator_id: $(this).val()
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#filter_route_id').on('select2:select', function() {
            coreEventsPage.filter = {
                bptd_id: $('#filter_bptd_id').val(),
                operator_id: $('#filter_operator_id').val(),
                route_id: $(this).val()
            };
            coreEventsPage.load(coreEventsPage.filter, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons);
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

        coreEventsPage.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEventsPage.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEventsPage.placeholder = 'Cari Pengemudi';

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
                data: "driver_name",
                orderable: true,
                width: 5,
                render: function(a, type, data, index) {
                    return '<div style="width:fit-content">\
                                <img class="preview-img" src="' + data.driver_pic + '"></img>\
                                <div style="text-align:center;margin-top:8px;width:80px;"><b>' + data.driver_name + '</b></div>\
                            </div>';
                }
            },
            {
                data: "ktp_no",
                orderable: true,
                width: 5
            },
            {
                data: "sim_no",
                orderable: true,
                width: 5
            },
            {
                data: "driver_email",
                orderable: true,
                width: 5
            },
            {
                data: "phone_no",
                orderable: true,
                width: 5
            },
            {
                data: "operator_name",
                orderable: true,
                width: 100
            },
            {
                data: "route_name",
                orderable: true,
                width: 100
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