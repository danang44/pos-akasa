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
                <?php if($rules->i=='1'){ ?>
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
                                    <th><span>Kode Rute</span></th>
                                    <th><span>Group Rute</span></th>
                                    <th><span>Nama Rute</span></th>
                                    <th><span>Jenis Rute</span></th>
                                    <th><span>Warna Rute</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($rules->i=='1'){ ?>
                <div class="tab-pane" id="tab-form" role="tabpanel">
                    <div class="card-body">
                        <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                            <input type="hidden" class="form-control" id="id" name="id" value="" required>
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12 mb-3">
                                        <label>Provinsi</label>
                                        <select class="form-control sel2" id="idprov" name="idprov" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="group_nm">Grup Rute</label>
                                        <select class="form-control sel2" id="group_nm" name="group_nm" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="kor">Kode Rute</label>
                                        <input type="text" class="form-control" id="kor" name="kor"
                                            placeholder="Tentukan kode rute" value="" required>
                                        <div class="invalid-feedback">
                                            Tentukan kode rute
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Rute</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Tentukan nama rute" value="" required>
                                        <div class="invalid-feedback">
                                            Tentukan nama rute
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="jenroute">Jenis Rute</label>
                                        <input type="text" class="form-control" id="jenroute" name="jenroute"
                                            placeholder="Tentukan jenis rute" value="" required>
                                        <div class="invalid-feedback">
                                            Tentukan jenis rute
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="color">Warna Rute</label>
                                        <input type="color" class="form-control" id="color" name="color"
                                            placeholder="Tentukan jenis rute" value="" required>
                                        <div class="invalid-feedback">
                                            Tentukan warna rute
                                        </div>
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
    var coreEventsPage;

    const select2Array = [{
        id: 'idprov',
        url: '/idprov_select_get',
        placeholder: 'Pilih Provinsi',
        params: null
    },{
        id: 'group_nm',
        url: '/groupnm_select_get',
        placeholder: 'Pilih Group Rute',
        params: {
            idprov: function () {
                return $('#idprov').val()
            }
        }
    }];

    $(document).ready(function () {
        coreEventsPage = new CoreEvents();
        coreEventsPage.url = url;
        coreEventsPage.ajax = url_ajax;
        coreEventsPage.csrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
        coreEventsPage.tableColumn = datatableColumn();

        coreEventsPage.insertHandler = {
            placeholder: 'Berhasil menyimpan rute',
            afterAction: function (result) {

            }
        }

        coreEventsPage.editHandler = {
            placeholder: '',
            afterAction: function (result) {
                var data = result.data;
                if(data.prov != null) {
                    $('#idprov').select2("trigger", "select", {
                        data: { id: data.idprov, text: data.prov }
                    });
                }
                if(data.group_nm != null) {
                    $('#group_nm').select2("trigger", "select", {
                        data: { id: data.group_nm, text: data.group_nm }
                    });
                }
            }
        }

        coreEventsPage.deleteHandler = {
            placeholder: 'Berhasil menghapus rute',
            afterAction: function () {

            }
        }

        coreEventsPage.resetHandler = {
            action: function () {
                // document.getElementById('form').reset();
                // $('#idprov').val('').trigger('select2:select');
                // $('#group_nm').val('').trigger('select2:select');
            }
        }

        select2Array.forEach(function (x) {
            coreEventsPage.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        // $('#trip_id').on('select2:select',function(e){
        //    let points = e.params.data.points;
        //    $('#routes').val(e.params.data.trip);
        //    //console.log(e);
        //    $.ajax({
        //         type: "get",
        //         url: '<?=base_url()?>/kspn/ajax/jsonGetRoutesfromPoints2/' + points,
        //         dataType: "json",
        //         success: function(response) {
        //             console.log(response);
        //             if(response.status=='1'){
        //                 $('#trip_distance').val((response.data.paths[0].distance/1000).toFixed(0));
        //             }
        //         }
        //     });
            
        // });

        // $('#trip_id').on('select2:clear',function(e){
            
        // });

        $(document).on('select2:select','#idprov',function(e){
            if($('#id').val()==''){
                let data = e.params.data;
                $('#kor').val(data.singkatan+'-');
                $('#group_nm').val(null).trigger('change');
            }
        });

        coreEventsPage.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEventsPage.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEventsPage.placeholder = 'Cari Trayek';

        coreEventsPage.load(null, coreEventsPage.placeholder, coreEventsPage.dom, coreEventsPage.buttons, coreEventsPage.columnDefs);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

    function select2Init(id, url, placeholder, parameter) {
        $(id).select2({
            id: function (e) {
                return e.id
            },
            placeholder: placeholder,
            multiple: false,
            ajax: {
                url: url_ajax + url,
                dataType: 'json',
                quietMillis: 500,
                delay: 500,
                data: function (param) {
                    var def_param = {
                        keyword: param.term, //search term
                        perpage: 5, // page size
                        page: param.page || 0, // page number
                    };

                    return Object.assign({}, def_param, parameter);
                },
                processResults: function (data, params) {
                    params.page = params.page || 0

                    return {
                        results: data.rows,
                        pagination: {
                            more: false
                        }
                    }
                }
            },
            templateResult: function (data) {
                return data.text;
            },
            templateSelection: function (data) {
                if (data.id === '') {
                    return placeholder;
                }

                return data.text;
            },
            escapeMarkup: function (m) {
                return m;
            }
        });
    }

    function datatableColumn() {
        let columns = [
            {
                data: "id", orderable: false, width: 100,
                render: function (a, type, data, index) {
                    return dataStart + index.row + 1
                }
            },
            { data: "kor", orderable: true },
            { data: "group_nm", orderable: true },
            { data: "name", orderable: true },
            { data: "jenroute", orderable: true },
            { data: "color", orderable: true, width: 100,
                render: function (a, type, data, index) {
                    let button =  data.color + '<br><div style="height: 10px; background-color:' + data.color + '"></div>';

                    return button;
                } 
            },
            {
                data: "id", orderable: false, width: 100,
                render: function (a, type, data, index) {
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
                                    </button></div>';
                    }


                    button += (button == '') ? "<b>Tidak ada aksi</b>" : ""

                    return button;
                }
            }
        ];

        return columns;
    }
</script>   