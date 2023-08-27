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
                                    <th><span>Jenis Pelayanan</span></th>
                                    <th><span>Nama Perusahaan</span></th>
                                    <th><span>Penanggung Jawab</span></th>
                                    <th><span>Telp. Perusahaan</span></th>
                                    <th><span>Alamat</span></th>
                                    <th><span>Jumlah Kendaraan</span></th>
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Kode Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_code" name="cp_code" maxlength="12" required autocomplete="off" placeholder="12 digit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>NIB Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_nib" name="cp_nib" maxlength="13" required autocomplete="off" placeholder="13 digit NIB">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Tipe Badan Usaha</label>
                                            <select class="form-control" id="cp_type" name="cp_type">
                                                <option value="PT">PT</option>
                                                <option value="CV">CV</option>
                                                <option value="PERUM">PERUM</option>
                                                <option value="KOPERASI">KOPERASI</option>
                                                <option value="KSU">KSU</option>
                                                <option value="KUD">KUD</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Jenis Pelayanan</label>
                                            <select class="form-control" id="jenis_pelayanan" name="jenis_pelayanan">
                                                <option value="AKAP">AKAP</option>
                                                <option value="AJAP">AJAP</option>
                                                <option value="PARIWISATA">PARIWISATA</option>
                                                <option value="ALBN">ALBN</option>
                                                <option value="KSPN">KSPN</option>
                                                <option value="PERINTIS">PERINTIS</option>
                                                <option value="PERINTIS">SEWA UMUM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_name" name="cp_name" maxlength="100" required autocomplete="off" placeholder="Nama Perusahaan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>NPWP Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_npwp" name="cp_npwp" maxlength="16" required autocomplete="off" placeholder="NPWP 16 digit">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Penanggungjawab Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_mngr_name" name="cp_mngr_name" maxlength="100" required autocomplete="off" placeholder="Nama Penanggung Jawab Perusahaan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>NPWP Penanggungjawab</label>
                                            <input type="text" class="form-control" id="cp_npwp_mngr" name="cp_npwp_mngr" maxlength="16" required autocomplete="off" placeholder="NPWP 16 digit">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Status Verisikasi Perusahaan</label>
                                            <select class="form-control" id="cp_sts_verif" name="cp_sts_verif">
                                                <option value="1">Terverifikasi</option>
                                                <option value="0">Belum Terverifikasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Alamat Perusahaan</label>
                                            <textarea class="form-control" id="cp_addr" name="cp_addr" required placeholder="Alamat Perusahaan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Provinsi</label>
                                            <select class="form-control sel2" id="idprov" name="idprov" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Kab / Kota</label>
                                            <select class="form-control sel2" id="idkabkota" name="idkabkota" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Kecamatan</label>
                                            <select class="form-control sel2" id="idkec" name="idkec" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Kelurahan</label>
                                            <select class="form-control sel2" id="idkel" name="idkel" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Kode POS</label>
                                            <input type="text" class="form-control" id="cp_kodepos" name="cp_kodepos" maxlength="5" autocomplete="off" placeholder="5 digit" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email Perusahaan</label>
                                            <input type="email" class="form-control" id="cp_email" name="cp_email" maxlength="100" autocomplete="off" placeholder="email@web.com" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Telepon Perusahaan</label>
                                            <input type="text" class="form-control" id="cp_phone" name="cp_phone" maxlength="15" autocomplete="off" placeholder="081242341958" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Website Perusahaan</label>
                                            <input type="url" class="form-control" id="cp_website" name="cp_website" maxlength="100" placeholder="https://" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Telepon Penanggungjawab</label>
                                            <input type="text" class="form-control" id="cp_mngr_phone" name="cp_mngr_phone" maxlength="15" autocomplete="off" placeholder="081242341957" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Jumlah Kendaraan</label>
                                            <input type="text" class="form-control" id="jml_kend" name="jml_kend" maxlength="3" />
                                        </div>
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
    // const auth_insert = '<?= $rules->i ?>';
    // const auth_edit = '<?= $rules->e ?>';
    // const auth_delete = '<?= $rules->d ?>';
    // const auth_otorisasi = '<?= $rules->o ?>';

    // const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    // const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    // var dataStart = 0;
    // var coreEvents;

    // const select2Array = [{
    //         id: 'idprov',
    //         url: '/idprov_select_get',
    //         placeholder: 'Pilih Provinsi',
    //         params: null
    //     },
    //     {
    //         id: 'idkabkota',
    //         url: '/idkabkota_select_get',
    //         placeholder: 'Pilih Kab / Kota',
    //         params: {
    //             idprov: function() {
    //                 return $('#idprov').val()
    //             }
    //         }
    //     },
    //     {
    //         id: 'idkec',
    //         url: '/id_kec_select_get',
    //         placeholder: 'Pilih Kecamatan',
    //         params: {
    //             idkabkota: function() {
    //                 return $('#idkabkota').val()
    //             }
    //         }
    //     },
    //     {
    //         id: 'idkel',
    //         url: '/id_kel_select_get',
    //         placeholder: 'Pilih Kelurahan',
    //         params: {
    //             idkec: function() {
    //                 return $('#idkec').val()
    //             }
    //         }
    //     }
    // ];

    // $(document).ready(function() {
    //     coreEvents = new CoreEvents();
    //     coreEvents.url = url;
    //     coreEvents.ajax = url_ajax;
    //     coreEvents.csrf = {
    //         "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
    //     };
    //     coreEvents.tableColumn = datatableColumn();

    //     coreEvents.insertHandler = {
    //         placeholder: 'Berhasil menyimpan data Perusahaan Operator',
    //         afterAction: function(result) {
    //             $(".sel2").val(null).trigger('change');
    //         }
    //     }

    //     coreEvents.editHandler = {
    //         placeholder: '',
    //         afterAction: function(result) {
    //             var data = result.data;
    //             if (data.cp_prov_id != null) {
    //                 $('#idprov').select2("trigger", "select", {
    //                     data: {
    //                         id: data.cp_prov_id,
    //                         text: data.prov
    //                     }
    //                 });
    //             }
    //             if (data.cp_kabkota_id != null) {
    //                 $('#idkabkota').select2("trigger", "select", {
    //                     data: {
    //                         id: data.cp_kabkota_id,
    //                         text: data.kabkota
    //                     }
    //                 });
    //             }
    //             if (data.cp_kec_id != null) {
    //                 $('#idkec').select2("trigger", "select", {
    //                     data: {
    //                         id: data.cp_kec_id,
    //                         text: data.kec
    //                     }
    //                 });
    //             }
    //             if (data.cp_kel_id != null) {
    //                 $('#idkel').select2("trigger", "select", {
    //                     data: {
    //                         id: data.cp_kel_id,
    //                         text: data.kel
    //                     }
    //                 });
    //             }

    //             // setTimeout(function () {
    //             //     select2Array.forEach(function (x) {
    //             //         $('#' + x.id).select2('trigger', 'select', {
    //             //             data: {
    //             //                 id: result.data[x.id],
    //             //                 text: result.data[x.id.replace('id', 'nama')]
    //             //             }
    //             //         });
    //             //     });
    //             // }, 100);
    //         }
    //     }

    //     coreEvents.deleteHandler = {
    //         placeholder: 'Berhasil menghapus data Perusahaan Operator',
    //         afterAction: function() {

    //         }
    //     }

    //     coreEvents.resetHandler = {
    //         action: function() {

    //         }
    //     }

    //     coreEvents.load();

    //     select2Array.forEach(function(x) {
    //         coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
    //     });
    // });

    // function datatableColumn() {
    //     let columns = [{
    //             data: "id",
    //             orderable: false,
    //             width: 100,
    //             render: function(a, type, data, index) {
    //                 return dataStart + index.row + 1
    //             }
    //         },
    //         {
    //             data: "jenis_pelayanan",
    //             orderable: true
    //         },
    //         {
    //             data: "cp_name",
    //             orderable: true
    //         },
    //         {
    //             data: "cp_mngr_name",
    //             orderable: true
    //         },
    //         {
    //             data: "cp_phone",
    //             orderable: true
    //         },
    //         {
    //             data: "cp_addr",
    //             orderable: true,
    //             render: function(a, type, data, index) {
    //                 return `<div style="width:200px">${data.cp_addr}${data.kel!=null?', '+data.kel:''}${data.kec!=null?', '+data.kec:''}${data.kabkota!=null?', '+data.kabkota:''}${data.prov!=null?', '+data.prov:''}</div>`;
    //             }

    //         },
    //         {
    //             data: "jml_kend",
    //             orderable: true
    //         },
    //         {
    //             data: "id",
    //             orderable: false,
    //             render: function(a, type, data, index) {
    //                 let button = ''

    //                 if (auth_edit == "1") {
    //                     button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.id + '" title="Edit">\
    //                                 <i class="fa fa-edit"></i>\
    //                             </button>\
    //                             ';
    //                 }

    //                 if (auth_delete == "1") {
    //                     button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.id + '" title="Delete">\
    //                                     <i class="bx bx-trash-alt"></i>\
    //                                 </button>';
    //                 }


    //                 button += (button == '') ? "<b>Tidak ada aksi</b>" : ""

    //                 return "<div class='action-button'>" + button + "</div>";
    //             }
    //         }
    //     ];

    //     return columns;
    // }
</script>