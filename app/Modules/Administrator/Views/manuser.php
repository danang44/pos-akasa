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
                    <div class="row">
                        <?php
                        if ($session->get('role_code') != 'pop' && $session->get('role_code') != 'ppo') {
                        ?>
                            <div class="col-lg-11">
                                <div class="mb-3">
                                    <label for="jenuser">Jenis User</label>
                                    <select class="form-control" id="filter_jenuser_id" name="filter_jenuser_id">
                                        <option></option>
                                        <?php
                                        foreach ($jenisusers as $jenisuser) {
                                            if ($jenisuser->user_web_role_code == 'tbs') {
                                                continue;
                                            }
                                            echo '<option value="' . $jenisuser->id . '" data-code="' . $jenisuser->user_web_role_code . '">' . $jenisuser->user_web_role_name . '</option>';
                                        }
                                        ?>
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
                                        <th><span>Nama User</span></th>
                                        <th><span>Email User</span></th>
                                        <th><span>Username</span></th>
                                        <th><span>Jenis User</span></th>
                                        <th></th>
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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" id="user_web_name" name="user_web_name" required autocomplete="off" placeholder="Nama lengkap user">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="user_web_email" name="user_web_email" required autocomplete="off" placeholder="email user">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" class="form-control" id="user_web_username" name="user_web_username" required autocomplete="off" placeholder="username user untuk login">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="user_web_password" name="user_web_password" required autocomplete="off" placeholder="password user untuk login">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Jenis User</label>
                                            <select class="form-control" id="user_web_role_id" name="user_web_role_id" required>
                                                <option></option>
                                                <?php
                                                foreach ($jenisusers as $jenisuser) {
                                                    if($jenisuser->user_web_role_code == 'tbs') {
                                                        continue;
                                                    }
                                                    echo '<option value="' . $jenisuser->id . '" data-code="' . $jenisuser->user_web_role_code . '">' . $jenisuser->user_web_role_name . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 select_" id="bptd_select" style="display: none;">
                                        <div class="mb-3">
                                            <label>BPTD</label>
                                            <select class="form-control" id="bptd_id" name="bptd_id"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 select_" id="satpel_select" style="display: none;">
                                        <div class="mb-3">
                                            <label>Satuan Pelayanan</label>
                                            <select class="form-control" id="satpel_id" name="satpel_id"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 select_" id="po_select" style="display: none;">
                                        <div class="mb-3">
                                            <label>PO</label>
                                            <select class="form-control" id="operator_id" name="operator_id"></select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <button class="btn btn-dark" type="reset">Reset</button>
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

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEvents;

    const select2Array = [{
        id: 'filter_jenuser_id',
        url: '/user_web_role_select_get',
        placeholder: 'Pilih Jenis User',
        params: null
    }];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder: 'Berhasil menyimpan user',
            afterAction: function(result) {}
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                $('#user_web_role_id').val(result.data.user_web_role_id).trigger('change');

                const kode = result.data.user_web_role_code;

                switch (kode) {
                    case 'bpw':
                        coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {});
                        $('#bptd_id').select2("trigger", "select", {
                            data: {
                                id: result.data.lokker_id,
                                text: result.data.lokker_name
                            }
                        });
                        $('#bptd_select').show();
                        break;
                    case 'stp':
                        coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {});
                        $('#bptd_id').select2("trigger", "select", {
                            data: {
                                id: result.data.bptd_id,
                                text: result.data.bptd_name
                            }
                        });
                        $('#bptd_select').show();

                        coreEvents.select2Init('#satpel_id', '/satpel_select_get', 'Pilih Lokasi Satuan Pelayanan', {}, null, function(data) {});
                        $('#satpel_id').select2("trigger", "select", {
                            data: {
                                id: result.data.lokker_id,
                                text: result.data.lokker_name
                            }
                        });
                        $('#satpel_select').show();
                        break;
                    case 'pop':
                        coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                            'bptd_id': '<?= $session->get('bptd_id') ?>'
                        }, null, function(data) {});

                        if (result.data.lokker_id != null) {
                            $('#bptd_id').select2("trigger", "select", {
                                data: {
                                    id: result.data.lokker_id,
                                    text: result.data.lokker_name
                                }
                            });
                        }
                        $('#bptd_select').show();

                        coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                            'bptd_id': '<?= $session->get('bptd_id') ?>'
                        }, null, function(data) {});
                        $('#operator_id').select2("trigger", "select", {
                            data: {
                                id: result.data.po_id,
                                text: result.data.po_name
                            }
                        });
                        $('#po_select').show();
                        break;
                    case 'ppo':
                        coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                            'bptd_id': '<?= $session->get('bptd_id') ?>'
                        }, null, function(data) {});

                        if (result.data.lokker_id != null) {
                            $('#bptd_id').select2("trigger", "select", {
                                data: {
                                    id: result.data.lokker_id,
                                    text: result.data.lokker_name
                                }
                            });
                        }
                        $('#bptd_select').show();

                        coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                            'bptd_id': '<?= $session->get('bptd_id') ?>'
                        }, null, function(data) {});
                        $('#operator_id').select2("trigger", "select", {
                            data: {
                                id: result.data.po_id,
                                text: result.data.po_name
                            }
                        });
                        $('#po_select').show();
                        break;
                    default:
                        break;
                }
            }
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus user',
            afterAction: function() {}
        }

        coreEvents.resetHandler = {
            action: function() {
                $('.select_').hide();
                $('#user_web_role_id').val("").trigger('change');
                coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {});
                coreEvents.select2Init('#satpel_id', '/satpel_select_get', 'Pilih Lokasi Satuan Pelayanan', {}, null, function(data) {});
                coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {}, null, function(data) {});
            }
        }

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#user_web_role_id').select2({
            placeholder: "Pilih jenis user",
            width: '100%'
        }).on('select2:select', function(e) {
            $('.select_').hide();
            const kode = $("#user_web_role_id").select2().find(":selected").data("code");
            console.log(kode);

            switch (kode) {
                case 'bpw':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {});
                    $('#bptd_select').show();
                    break;
                case 'stp':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {
                        coreEvents.select2Init('#satpel_id', '/satpel_select_get', 'Pilih Lokasi Satuan Pelayanan', {
                            'bptd_id': data.id
                        }, null, function(data) {});
                        $('#satpel_select').show();
                    });
                    $('#bptd_select').show();
                    break;
                case 'pop':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#bptd_select').show();
                    coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#po_select').show();
                    break;
                case 'ppo':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#bptd_select').show();
                    coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#po_select').show();
                    break;
                default:
                    break;
            }
        });

        $('#filter_jenuser_id').select2({
            placeholder: "Pilih jenis user",
            width: '100%'
        }).on('select2:select', function(e) {
            $('.select_').hide();
            const kode = $("#filter_jenuser_id").select2().find(":selected").data("code");

            switch (kode) {
                case 'bpw':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {});
                    break;
                case 'stp':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {}, null, function(data) {
                        coreEvents.select2Init('#satpel_id', '/satpel_select_get', 'Pilih Lokasi Satuan Pelayanan', {
                            'bptd_id': data.id
                        }, null, function(data) {});
                        $('#satpel_select').show();
                    });
                    $('#bptd_select').show();
                    break;
                case 'pop':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#bptd_select').show();
                    coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#po_select').show();
                    break;
                case 'ppo':
                    coreEvents.select2Init('#bptd_id', '/bptd_select_get', 'Pilih Lokasi BPTD', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#bptd_select').show();
                    coreEvents.select2Init('#operator_id', '/po_select_get', 'Pilih PO', {
                        'bptd_id': '<?= $session->get('bptd_id') ?>'
                    }, null, function(data) {});
                    $('#po_select').show();
                    break;
                default:
                    break;
            }
        });

        $(document).on('change', '#filter_jenuser_id', function() {
            coreEvents.filter = {
                role_id : $(this).val()
            };
            coreEvents.load(coreEvents.filter, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $('#reset-filter').on('click', function() {
            $('#filter_jenuser_id').val(null).trigger('change');
            coreEvents.filter = null;
            coreEvents.load(coreEvents.filter, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        coreEvents.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari User...';

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

    function datatableColumn() {
        let columns = [{
                data: "id",
                orderable: false,
                width: 100,
                render: function(a, type, data, index) {
                    return dataStart + index.row + 1
                }
            },
            {
                data: "user_web_name",
                orderable: true
            },
            {
                data: "user_web_email",
                orderable: true
            },
            {
                data: "user_web_username",
                orderable: true
            },
            {
                data: "user_web_role_name",
                orderable: true
            },
            {
                data: "id",
                orderable: false,
                width: 100,
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