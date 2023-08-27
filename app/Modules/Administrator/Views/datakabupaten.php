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
                        <table id="datatable" class="table table-theme table-row v-middle table-hover">
                            <thead>
                                <tr>
                                    <th><span>#</span></th>
                                    <th><span>Provinsi</span></th>
                                    <th><span>Kab / Kota</span></th>
                                    <th><span>Ibukota</span></th>
                                    <th><span>Kode</span></th>
                                    <th><span>Group Rute</span></th>
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
                            <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                                <input type="hidden" class="form-control" id="id" name="id" value="" required>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Provinsi</label>
                                        <select class="form-control sel2" id="idprov" name="idprov" required>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Kab / Kota</label>
                                        <input type="text" class="form-control" id="kabkota" name="kabkota" maxlength="100" required autocomplete="off" placeholder="Tentukan nama kab / kota">
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Ibu Kota</label>
                                        <input type="text" class="form-control" id="ibukota" name="ibukota" maxlength="100" required autocomplete="off" placeholder="Ibukota">
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode" maxlength="100" required autocomplete="off" placeholder="3 karakter">
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Group Rute</label>
                                        <input type="text" class="form-control" id="group_nm" name="group_nm" maxlength="100" required autocomplete="off" placeholder="Group Rute">
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
        id: 'idprov',
        url: '/idprov_select_get',
        placeholder: 'Pilih Provinsi',
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
            placeholder: 'Berhasil menyimpan data kabupaten / kota',
            afterAction: function(result) {
                $(".sel2").val(null).trigger('change');
            }
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
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
            placeholder: 'Berhasil menghapus data kabupaten / kota',
            afterAction: function() {

            }
        }

        coreEvents.resetHandler = {
            action: function() {

            }
        }

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        coreEvents.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari data kabupaten / kota';
        coreEvents.columnDefs = [{
            "className": "text-center",
            "targets": [0, 4, 6]
        }];

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons, coreEvents.columnDefs);
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
                data: "namaprov",
                orderable: true,
                width: 50,
            },
            {
                data: "kabkota",
                orderable: true,
                width: 50,
            },
            {
                data: "ibukota",
                orderable: true,
                width: 50,
            },
            {
                data: "kode",
                orderable: true,
                width: 5,
            },
            {
                data: "group_nm",
                orderable: true,
                width: 30,
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