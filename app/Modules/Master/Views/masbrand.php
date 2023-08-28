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
                                    <th><span>Brand</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="jenroute">Jenis Brand</label>
                                            <input type="text" class="form-control" id="brand" name="brand" required autocomplete="off" placeholder="Tentukan nama Brand">
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

    const select2Array = [];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder: 'Berhasil menyimpan brand',
            afterAction: function(result) {}
        }

        coreEvents.editHandler = {
            placeholder: 'Berhasil mengubah brand',
            afterAction: function(result) {}
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus brand',
            afterAction: function() {}
        }

        coreEvents.resetHandler = {
            action: function() {
                $('#brand').html('');
            }
        }

        coreEvents.buttons = [{}];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari kategori';
        coreEvents.columnDefs = [{
            "className": "text-center",
            "targets": [0, 2]
        }];

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons, coreEvents.columnDefs);
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
                data: "brand",
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