<?php $session = \Config\Services::session(); ?>

<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet-contextmenu.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet.fullscreen.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/MarkerCluster.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/MarkerCluster.Default.css" />
<link href="https://mitradarat-fms.dephub.go.id/assets/libs/select2/select2-min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/L.Icon.Pulse.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/slick/slick.css?v2022" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/slick/slick-theme.css?v2022" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.css?t=<?= date('YmdHis') ?>" />
<link rel="stylesheet" type="text/css" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<style type="text/css">
    div.main-content {
        margin-left: 250px !important;
    }

    body[data-sidebar-size=sm] .main-content {
        margin-left: 70px !important;
    }

    #map {
        z-index: 1 !important;
        left: 0px !important;
        right: 0 !important;
        bottom: 0px !important;
        top: 0px !important;
        height: auto !important;
        width: auto !important;
    }

    .widget-box {
        margin: 5px;
        padding: 10px;
        overflow: auto;
        overflow-y: auto;
        height: auto;
        width: fit-content;
        z-index: 1;
    }

    #widget-add-trayek {
        padding: 20px;
        background-color: white;
        position: absolute;
        left: 5px;
        top: 5px;
    }

    #widget-add-trayek-header {
        display: flex;
        align-content: space-between;
        justify-content: space-between;
        align-items: center;
    }

    #info-header {
        font-size: 12px;
    }

    .list-point {
        margin-bottom: 10px;
    }

    .sortable-point {
        max-height: 250px;
        overflow-y: scroll;
    }

    .form-in {
        margin-bottom: 10px;
    }

    .form-in input {
        width: 100%;
    }

    .form-submit {
        margin-top: 20px;
        float: right;
    }

    .sortable {
        margin-bottom: 0;
        padding-left: 0;
        cursor: default;
        list-style-type: none;
    }

    .item {
        padding: 6px 10px;
        height: fit-content;
        align-items: center;
    }

    .item-point:hover {
        background-color: #fafafa;
    }

    .item-point:hover .hidden {
        display: block;
    }

    .item-point.dragging :where(.item-point-details) {
        opacity: 0;
    }

    .item-point-details {
        display: flex;
        /*align-content: space-between;
        justify-content: space-between;*/
        align-items: center;
        flex-wrap: wrap;
    }

    .bullet {
        margin-left: 10px;
        font-size: 10px;
        background-color: #224DDD;
        color: white;
        padding: 3px 7px;
        border-radius: 50%;
    }

    .bullet-outline {
        margin-left: 10px;
        font-size: 10px;
        background-color: white;
        color: white;
        padding: 2px 6px;
        border-radius: 50%;
        border: 2px #224DDD solid;
    }

    .bullet-map {
        font-size: 10px;
        background-color: #224DDD;
        color: white;
        padding: 3px 7px;
        border-radius: 50%;
    }

    .bullet-outline-map {
        font-size: 10px;
        background-color: white;
        color: white;
        height: 12px;
        width: 12px;
        /*padding: 2px 6px;*/
        border-radius: 50%;
        border: 2px #224DDD solid;
    }

    .waypoint-map {
        height: 18px;
        width: 18px;
        font-size: 10px;
        background-color: white;
        border-radius: 50%;
        border: solid 1px #c0c0c0;
        display: flex;
        align-items: center;
        text-align: center;
    }

    .waypoint-map i {
        font-size: 16px;
    }

    .item-point-details input.input-point {
        margin-left: 10px;
        width: 200px;
    }

    .item-point-details span {
        margin-left: 10px;
        font-size: 13px;
        display: none;
        text-align: left;
        font-weight: 400;
        width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-point-details i {
        font-size: 14px;
    }

    .item-point-details .action-point {
        margin-left: 10px;
        display: flex;
        align-items: center;
    }

    .item-point-details .action-point .checkbox-point {
        font-size: 16px !important;
        margin-right: 5px;
    }

    .item-point-details .action-point .edit-point i {
        font-size: 16px !important;
        color: #303030;
    }

    .item-point-details .action-point .remove-point i {
        font-size: 20px !important;
        color: #303030;
    }

    .dropdown-select {
        background-color: white;
        position: absolute;
        height: fit-content;
        width: 400px;
        top: 0;
        left: 0;
        z-index: 1;
        display: none;
        border: solid 1px #c0c0c0;
    }

    .dropdown-items {
        padding: 8px;
        height: fit-content;
        white-space: unset;
    }

    .dropdown-items .name {
        font-weight: 500;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dropdown-items .type {
        font-size: 12px;
        height: fit-content;
    }

    .dropdown-items .address {
        font-size: 11px;
        height: fit-content;
    }

    #add-point {
        margin-left: 10px;
    }

    .custom-icon {
        border-radius: 50%;
    }

    .hidden {
        display: none;
    }
</style>

<div class="col-xl-12">
    <ul id="tab" class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab-data" role="tab" aria-selected="false">
                <span class="d-block d-sm-none"><i class="fas fa-table"></i></span>
                <span class="d-none d-sm-block">Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-form" role="tab" aria-selected="true">
                <span class="d-block d-sm-none"><i class="fab fa-wpforms"></i></span>
                <span class="d-none d-sm-block">Update</span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content p-3 text-muted">
        <div class="tab-pane" id="tab-form" role="tabpanel">
            <div class="card-body" style="position: relative;min-height: 800px !important;">
                <div id="map"></div>
                <div id="widget-add-trayek" class="widget-box">
                    <div id="widget-add-trayek-header">
                        <h5>AKAP</h5>
                        <?php if ($rules->i == "1") { ?>
                            <div id="info-header">Tambah baru</div>
                        <?php } ?>
                    </div>
                    <hr>
                    <input id="id" type="hidden" value="">
                    <div class="form-in">
                        <label class="form-label">Kode Rute</label>
                        <select class="form-control" style="width: 100%;" name="input-route-code" id="input-route-code" <?= ($rules->i != "1" ? "disabled" : "") ?>></select>
                    </div>
                    <div class="form-in">
                        <label class="form-label">Nama Grup Rute</label>
                        <input id="input-group-name" type="text" class="form-control" placeholder="Nama grup, ex: AMB-Ambon" disabled>
                    </div>
                    <div class="form-in">
                        <label class="form-label">Warna Rute</label>
                        <input id="input-color" type="color" class="form-control" placeholder="Nama grup, ex: AMB-Ambon" disabled>
                    </div>
                    <div class="form-in">
                        <label class="form-label">Nama Rute</label>
                        <input id="input-route-name" type="text" class="form-control" placeholder="Nama rute, ex: Langgur - Tetoat" <?= ($rules->i != "1" ? "disabled" : "") ?>>
                    </div>
                    <div class="list-point">
                        <label class="form-label">Rute</label>
                        <ul class="sortable sortable-point">
                            <li class="item item-point" draggable="true">
                                <div class="item-point-details">
                                    <i class="uil uil-draggabledots"></i>
                                    <div class="blt bullet">A</div>
                                    <input class="input-point" type="" name="">
                                    <span></span>
                                    <div class="action-point">
                                        <input type="checkbox" class="checkbox-point hidden" title="Titik Bus Stop?" checked>
                                        <a href="#" class="edit-point hidden"><i class="uil uil-edit"></i></a>
                                        <a href="#" class="remove-point hidden"><i class="uil uil-times"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="item item-point" draggable="true">
                                <div class="item-point-details">
                                    <i class="uil uil-draggabledots"></i>
                                    <div class="blt bullet">B</div>
                                    <input class="input-point" type="" name="">
                                    <span></span>
                                    <div class="action-point">
                                        <input type="checkbox" class="checkbox-point hidden" title="Titik Bus Stop?" checked>
                                        <a href="#" class="edit-point hidden"><i class="uil uil-edit"></i></a>
                                        <a href="#" class="remove-point hidden"><i class="uil uil-times"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php if ($rules->i == "1") { ?>
                        <div class="form-in">
                            <a href="#" id="add-point">Tambahkan Titik</a>
                        </div>
                        <div class="form-submit">
                            <a href="#" class="btn btn-dark" id="reset-trayek">Reset</a>
                            <a href="#" class="btn btn-primary" id="save-trayek">Simpan</a>
                        </div>
                    <?php } ?>
                </div>
                <div class="dropdown-select hide">
                    <ul class="sortable">

                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="tab-data" role="tabpanel">
            <div class="row">
                <?php
                if ($session->get('role_code') == 'sad' || $session->get('role_code') == 'daj') { ?>
                    <div class="col-lg-5 col-md-12">
                        <div class="mb-3">
                            <label for="bptd_id_filter">BPTD</label>
                            <select class="form-control sel2" style="width: 100%;" name="bptd_id_filter" id="bptd_id_filter"></select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            <label for="route_id_filter">Trayek</label>
                            <select class="form-control sel2" style="width: 100%;" name="route_id_filter" id="route_id_filter"></select>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-12 mt-4 text-center">
                        <button class="btn" id="reset-filter"><i class="fa fa-sync"></i><br>Reset</button>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-11 col-md-12">
                        <div class="mb-3">
                            <label for="route_id_filter">Trayek</label>
                            <select class="form-control sel2" style="width: 100%;" name="route_id_filter" id="route_id_filter"></select>
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
                                <th><span>ID TRIP</span></th>
                                <th><span>NAMA TRIP</span></th>
                                <th><span>KODE RUTE</span></th>
                                <!-- <th><span>JENIS RUTE</span></th> -->
                                <th><span>NAMA GROUP</span></th>
                                <th><span>ASAL</span></th>
                                <th><span>TUJUAN</span></th>
                                <th><span>TRIP</span></th>
                                <th class="column-2action"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://mitradarat-fms.dephub.go.id/assets/libs/select2/select2-min.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet.js"></script>

<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet.rotatedMarker.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-contextmenu.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-custom.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Polyline.encoded.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/geometry.util.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/L.Icon.Pulse.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet.markercluster.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-markercluster-list.src.js"></script>
<script src="<?= base_url() ?>/assets/libs/slick/slick.js"></script>
<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
<script src="https://timeago.yarp.com/jquery.timeago.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Leaflet.fullscreen.min.js"></script>

<!-- <script src="<?= base_url() ?>/assets/js/coreevents.js"></script> -->
<script src="https://stream.nginovasi.id:5002/socket.io/socket.io.js"></script>
<script src="https://gps.brtnusantara.com:5758/socket.io/socket.io.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/libs/leaflet/index.umd.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Path.Drag.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Leaflet.Editable.js"></script>
<script src="<?= base_url() ?>/assets/js/trayek.js?ts=<?= date('YmdHis') ?>"></script>
<script type="text/javascript">
    $(function() {
        Dashboard = new Dashboard();
        Dashboard.load();

        Dashboard.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        Dashboard.csrfName = '<?php echo csrf_token() ?>';
        Dashboard.csrfHash = '<?php echo csrf_hash() ?>';
        Dashboard.baseUrl = '<?= base_url() ?>';

        Dashboard.vCurLatLng = [-1.3098505, 122.4971107];
        Dashboard.vCurLatLngObj = Dashboard.vCurLatLng;
        Dashboard.vCurZoom = 5;
        Dashboard.vCurZoomObj = 5;

        Dashboard.streets_fr = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
            if ($(this).text().includes('Update')) {
                T.map.invalidateSize();
            }
        })

        T.load(Dashboard);
        T.map = L.map("map", {
            contextmenu: true,
            contextmenuWidth: 300,
            zoom: Dashboard.vCurZoom,
            maxZoom: 20,
            center: Dashboard.vCurLatLng,
            layers: [Dashboard.streets_fr, T.layerGroup],
            editable: true,
            attributionControl: false,
            zoomControl: false,
            editable: true
        });

        // map.on("mouseover", function(e){
        //     if(markerWaypoint!=null){ layerGroup.removeLayer(markerWaypoint); }
        // });

        T.map.on('popupopen', function(e) {
            if (e.target.hasOwnProperty("_popup")) {
                try {
                    var px = map.project(e.target._popup._latlng); // find the pixel location on the map where the popup anchor is
                    px.y -= e.target._popup._container.clientHeight / 2; // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                    map.panTo(map.unproject(px), {
                        animate: true
                    }); // pan to new center
                } catch (e) {}
            }
        });

        $(document).on('click', 'body:not(.dropdown-items)', function() {
                $(".dropdown-select").hide();
            })

            .on('click', '#add-point', function(e) {
                e.preventDefault();
                const allData = $('.bullet').length;

                $(".sortable-point").append(T.form(allData));
                T.points.push([]);
            })

            .on('click', '.remove-point', function(e) {
                e.preventDefault();
                const remove = $('.remove-point');
                const index = remove.index($(this));

                if (remove.length < 3) {
                    if (T.points[index] !== undefined) {
                        $(this).closest('.item-point').find('input.input-point').addClass('edited');
                    }

                    $(this).closest('.item-point').find('input').show();
                    $(this).closest('.item-point').find('span').hide();
                } else {
                    if (T.points[index] !== undefined) {
                        T.layerGroup.removeLayer(T.points[index].marker);
                        T.points.splice(index, 1);

                        T.getRoutes();
                    }

                    $(this).closest('li').remove();
                    $(".bullet").each(function(index) {
                        $(this).html(T.alphabet[index]);
                    });
                }
            })

            .on('click', '.edit-point', function(e) {
                e.preventDefault();
                const edit = $('.edit-point');
                const index = edit.index($(this));

                if (T.points[index] !== undefined) {
                    $(this).closest('.item-point').find('input.input-point').addClass('edited');
                }

                $(this).closest('.item-point').find('input').show();
                $(this).closest('.item-point').find('span').hide();
            })

            .on('change', '.checkbox-point', function(e) {
                e.preventDefault();
                const checkbox = $('.checkbox-point');
                const index = checkbox.index($(this));
                let checked = $(this).is(':checked');

                $(this).closest('.item-point').find('.bullet, .bullet-outline').toggleClass('bullet bullet-outline');

                if (T.points[index]) {
                    if (T.points[index].hasOwnProperty('data')) {
                        T.points[index].data.bs_stop = $(this).is(':checked') ? '1' : '0';
                    }
                }

                $(".bullet").each(function(index) {
                    $(this).html(T.alphabet[index]);
                });
                T.reMarker();
            })

            .on('keyup', '.input-point', T.debounce(function() {
                T.formActive = $(this);
                const inout = $(this).val();
                const widget_position = $("#widget-add-trayek").position();
                const input_position = $(this).position();
                const input_height = $(this).height();

                T.getBusStop(inout, function(response) {
                    if (response.bus_stop && response.bus_stop.length > 0) {
                        T.dropdownItem = [];
                        $('.dropdown-select .sortable').html("");

                        response.bus_stop.forEach((element, index) => {
                            T.dropdownItem.push(element);

                            const item = T.dropdown_item(element, index);
                            $('.dropdown-select .sortable').append(item);
                        });

                        $(".dropdown-select").show();
                        $(".dropdown-select").css('top', widget_position.top + input_position.top + input_height + 15)
                        $(".dropdown-select").css('left', widget_position.left + input_position.left + 15)
                    } else {
                        T.dropdownItem = [];
                        $('.dropdown-select .sortable').html("");

                        const item = `<li class="dropdown-item dropdown-items" data-index="-1">
                        <div class="name">Data tidak ditemukan</div>
                    </li>`
                        $('.dropdown-select .sortable').append(item);

                        $(".dropdown-select").show();
                        $(".dropdown-select").css('top', widget_position.top + input_position.top + input_height + 15)
                        $(".dropdown-select").css('left', widget_position.left + input_position.left + 15)
                    }
                })
            }, 500))

            .on('click', '.dropdown-items', function(e) {
                e.preventDefault();
                const index = $(this).data('index');
                if (index != -1) {
                    const item = T.dropdownItem[index];
                    const forms = $('.input-point');
                    const formIndex = forms.index($(T.formActive));
                    const pointIndex = T.points.findIndex(point => {
                        return point.hasOwnProperty('data') && point.data.enc == item.enc
                    });

                    if (!T.points.some(point => {
                            return point.hasOwnProperty('data') && point.data.enc == item.enc
                        }) || ($(T.formActive).hasClass('edited') && formIndex == pointIndex)) {
                        const item_details = $(T.formActive).closest('.item-point-details');
                        const alpha = item_details.find(".bullet").html();
                        const icon = T.marker_icon(alpha, item.bs_stop);
                        const marker = L.marker([item.bs_lat, item.bs_lng], {
                            icon: icon,
                            draggable: true
                        }).on("dragend", T.moveBusStop).bindPopup(T.info_window(item), {
                            offset: L.point(-5, -5)
                        }).bindTooltip(T.info_window(item), {
                            offset: L.point(-5, -20),
                            direction: 'top'
                        }).addTo(T.layerGroup);

                        const span = item_details.find("span");
                        span.data('restore', item.enc);
                        span.html(item.bs_nm);
                        span.show();
                        T.formActive.val(item.bs_nm);
                        T.formActive.hide();

                        item_details.find('.blt').each(function(index) {
                            $(this).removeClass('bullet bullet-outline');
                            $(this).addClass(item.bs_stop == "1" ? 'bullet' : 'bullet-outline');
                        });

                        item_details.find('input.checkbox-point').attr('checked', item.bs_stop == "1");
                        $(".bullet").each(function(index) {
                            $(this).html(T.alphabet[index]);
                        });

                        const data = [];
                        data.data = item;
                        data.marker = marker

                        if ($(T.formActive).hasClass('edited')) {
                            T.layerGroup.removeLayer(T.points[formIndex].marker);
                            T.points[formIndex] = data;
                        } else {
                            // T.points.push(data);
                            T.points[formIndex] = data;
                        }

                        // console.log(T.points);
                        // console.log(T.points.every(point => { return point.hasOwnProperty('data') }));
                        if (T.points.length > 1 && T.points.every(point => {
                                return point.hasOwnProperty('data')
                            })) {
                            T.getRoutes();
                        } else {
                            T.map.flyToBounds(T.layerGroup.getBounds(), {
                                duration: 0.5,
                                maxZoom: 13
                            });
                        }
                    } else {
                        alert("Lokasi sudah ada dalam map")
                    }
                }
            })
    });

    const saveForm = (data) => {
        data[Dashboard.csrfName] = Dashboard.csrfHash

        $.ajax({
            type: "POST",
            url: Dashboard.baseUrl + '/akap/action/mantrayek_save',
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    resetForm();
                    Swal.fire('Sukses', "Berhasil menyimpan trayek", 'success');
                    coreEvents.table.ajax.reload();
                } else {
                    Swal.fire('Error', "Gagal menyimpan trayek", 'error');
                }
            }
        });
    }

    const resetForm = () => {
        T.reset();

        $(".sortable-point").html("");
        $(".sortable-point").append(T.form(0));
        $(".sortable-point").append(T.form(1));

        $('#info-header').html('Tambah baru');
        $('#id').val("");
        $("#input-route-code").select2("trigger", "select", {
            data: {
                id: "",
                text: ""
            }
        });
        $("#input-color").val("#000000");
        $("#input-group-name").val("");
        $("#input-route-name").val("");

        T.map.flyTo(Dashboard.vCurLatLng, 5, {
            animate: 0.1
        });
    }

    const editData = (data) => {
        // console.log(data);
        resetForm();

        let color = data.color == null ? '#000000' : data.color;
        $('#info-header').html('Edit data');
        $('#id').val(data.id);

        if (data.kor != null) {
            $('#input-route-code').select2("trigger", "select", {
                data: {
                    id: data.kor,
                    text: data.text
                }
            });
        }

        setTimeout(function() {
            $('#input-group-name').val(data.group_nm);
            $('#input-color').val(color);
            if (T.polyline != null) {
                T.polyline.setStyle({
                    color: color
                });
            }
        }, 500);

        $('#input-route-name').val(data.name);
        $('.sortable-point').html('');

        T.points = [];
        T.pointsBusStop = data.routes.filter(x => {
            return x.bs_stop == '1'
        });
        data.routes.forEach((el, index) => {
            if (el.bs_lat != null && el.bs_lng != null) {
                const data = [];
                const ind = T.pointsBusStop.findIndex(x => {
                    return x == el
                });
                $('.sortable-point').append(T.waypoint_form(ind, el));

                const icon = T.marker_icon(T.alphabet[ind], el.bs_stop);
                data.marker = L.marker([el.bs_lat, el.bs_lng], {
                    icon: icon,
                    draggable: true
                }).on("dragend", T.moveBusStop).bindPopup(T.info_window(el), {
                    offset: L.point(-5, -5)
                }).bindTooltip(T.info_window(el), {
                    offset: L.point(-5, -20),
                    direction: 'top'
                }).addTo(T.layerGroup);
                data.data = el;

                T.points.push(data);
            }
        });

        if (T.points.length > 1 && T.points.every(point => {
                return point.hasOwnProperty('data')
            })) {
            T.getRoutes();
        } else {
            T.polyline = L.Polyline.fromEncoded(data.points, {
                stroke: true,
                color: color,
                weight: 4,
                fill: false,
                fillOpacity: 1
            }).addTo(T.layerGroup);

            T.polyLatLng = L.PolylineUtil.decode(data.points);
            T.waypointLatLng = [T.polyLatLng[0], T.polyLatLng[T.polyLatLng.length - 1]];

            T.polyline.on('mouseover', function(e) {
                const icon = T.waypoint_icon();
                // if(map.getZoom()>14){                        
                if (T.markerWaypoint === null) {
                    T.markerWaypoint = L.marker(e.latlng, {
                        icon: icon,
                        draggable: true
                    }).on('dragstart', T.wpDragStart).on('dragend', T.wpDragEnd).addTo(T.layerGroup);
                } else {
                    T.markerWaypoint.setLatLng(e.latlng);
                }
                // }
            })

            T.map.flyToBounds(T.layerGroup.getBounds(), {
                duration: 0.5,
                maxZoom: 13
            });
        }
    }
</script>

<script type="text/javascript">
    const auth_insert = '<?= $rules->i ?>';
    const auth_edit = '<?= $rules->e ?>';
    const auth_delete = '<?= $rules->d ?>';
    const auth_otorisasi = '<?= $rules->o ?>';

    const role_code = '<?= $session->role_code ?>';
    const bptd_id = '<?= $session->bptd_id ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEvents;
    var filter = {};

    const select2Array = [{
            id: 'bptd_id_filter',
            url: '/bptd_select_get',
            placeholder: 'Pilih BPTD',
            params: null
        },
        {
            id: 'route_id_filter',
            url: '/trayek_id_select_get',
            placeholder: 'Pilih Trayek',
            params: {
                bptd_id: function() {
                    if (role_code == 'sad' || role_code == 'daj') {
                        if ($('#bptd_id_filter').val() == null || $('#bptd_id_filter').val() == "") {
                            Swal.fire('Peringatan', "Pilih BPTD terlebih dahulu", 'warning');
                        } else {
                            return $('#bptd_id_filter').val();
                        }
                    } else {
                        return bptd_id;
                    }
                }
            }
        }
    ];

    $(document).ready(function() {
        coreEvents = new CoreEvents();
        coreEvents.url = url;
        coreEvents.ajax = url_ajax;
        coreEvents.csrf = {
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };
        coreEvents.tableColumn = datatableColumn();

        coreEvents.insertHandler = {
            placeholder: 'Berhasil menyimpan data Trip Trayek',
            afterAction: function(result) {}
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                //console.log(result);
                result.data.routes = JSON.parse(result.data.routes);
                result.data.points = JSON.parse(result.data.points);
                result.data.points = result.data.points[0];
                // console.log(result.data);
                editData(result.data);
            }
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus data Trip Trayek',
            afterAction: function() {

            }
        }

        coreEvents.resetHandler = {}

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $(document).on('click', '#save-trayek', function(e) {
            e.preventDefault();
            if ($('#input-route-code').val() == "" || $('#input-route-code').val() == null) {
                Swal.fire('Peringatan', "Kode rute harus terisi", 'warning');
            } else if ($('#input-route-name').val() == "") {
                Swal.fire('Peringatan', "Nama rute harus terisi", 'warning');
            } else if (T.points.length > 1 && T.points.every(point => {
                    return point.hasOwnProperty('data')
                })) {
                const postData = {
                    "id": $('#id').val(),
                    "kor": $('#input-route-code').val(),
                    "name": $('#input-route-name').val(),
                    "origin": T.points[0].data.bs_nm,
                    "or_lat": T.points[0].data.bs_lat,
                    "or_lng": T.points[0].data.bs_lng,
                    "toward": T.points[T.points.length - 1].data.bs_nm,
                    "tw_lat": T.points[T.points.length - 1].data.bs_lat,
                    "tw_lng": T.points[T.points.length - 1].data.bs_lng,
                    "points": T.polyline.encodePath(),
                    "routes": T.points.map(point => {
                        return point.data;
                    })
                }

                saveForm(postData);
            } else {
                Swal.fire('Peringatan', "Dua atau lebih titik dibutuhkan untuk membuat trayek", 'warning');
            }
        }).on('click', '#reset-trayek', function(e) {
            e.preventDefault();
            resetForm();
        }).on('click', '.details', function() {
            let $this = $(this);
            let data = {
                id: $this.data('id')
            }
            $.extend(data, coreEvents.csrf);

            Swal.fire({
                title: "",
                icon: "info",
                text: "Proses mengambil data, mohon ditunggu...",
                didOpen: function() {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: coreEvents.url + "_detail",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(result) {
                    Swal.close();
                    if (result.success) {
                        $('#form').trigger("reset");
                        for (var keyy in result.data) {
                            $('#' + keyy).val(result.data[keyy]);
                        }

                        $('.nav-tabs li:contains(Update) a').tab('show');
                        coreEvents.editHandler.afterAction(result);
                    } else {
                        Swal.fire('Error', result.message, 'error');
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            })
        }).on('change', '#bptd_id_filter', function() {
            $('#route_id_filter').val('').trigger('select2:select');
            coreEvents.select2Init('#route_id_filter', '/trayek_id_select_get', 'Pilih Trayek', {
                bptd_id: function() {
                    if (role_code == 'sad' || role_code == 'daj') {
                        if ($('#bptd_id_filter').val() == null || $('#bptd_id_filter').val() == "") {
                            Swal.fire('Peringatan', "Pilih BPTD terlebih dahulu", 'warning');
                        } else {
                            return $('#bptd_id_filter').val();
                        }
                    }
                }
            });
            var filter = {
                bptd_id: $(this).val(),
                route_id: $('#route_id_filter').val()
            }
            coreEvents.load(filter, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        }).on('change', '#route_id_filter', function() {
            var filter = {
                bptd_id: $('#bptd_id_filter').val(),
                route_id: $(this).val()
            }
            coreEvents.load(filter, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        $("#input-route-code").select2({
            id: function(e) {
                return e.id
            },
            placeholder: "Pilih kode rute",
            ajax: {
                url: Dashboard.baseUrl + '/akap/ajax/kor_select_get',
                dataType: 'json',
                quietMillis: 500,
                delay: 500,
                data: function(param) {
                    var def_param = {
                        keyword: param.term, //search term
                        perpage: 5, // page size
                        page: param.page || 0, // page number
                    };

                    return Object.assign({}, def_param, {});
                },
                processResults: function(data, params) {
                    params.page = params.page || 0
                    return {
                        results: data.rows,
                        pagination: {
                            more: false
                        }
                    }
                }
            },
            templateResult: function(data) {
                return data.text;
            },
            templateSelection: function(data) {
                if (data.id == '') {
                    return "Pilih kode rute";
                }

                $('#input-color').val(data.color);
                $('#input-group-name').val(data.group_nm);
                if (T.polyline != null) {
                    T.polyline.setStyle({
                        color: data.color
                    });
                }
                return data.text;
            },
            escapeMarkup: function(m) {
                return m;
            }
        });
        
        $('#reset-filter').on('click', function() {
            $('#bptd_id_filter').val(null).trigger('change');
            $('#route_id_filter').val(null).trigger('change');

            coreEvents.filter = null;
            coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
            $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
        });

        coreEvents.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari Trip Trayek';

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
                data: "id",
                orderable: true
            },
            {
                data: "name",
                orderable: true
            },
            {
                data: "kor",
                orderable: true
            },
            // {
            //     data: "jenroute",
            //     orderable: true
            // },
            {
                data: "group_nm",
                orderable: true
            },
            {
                data: "origin",
                orderable: true
            },
            {
                data: "toward",
                orderable: true
            },
            {
                data: "trip",
                orderable: true
            },
            {
                data: "id",
                orderable: false,
                render: function(a, type, data, index) {
                    let button = ''

                    if (auth_edit == "1") {
                        button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.id + '" title="Edit">\
                                    <i class="fa fa-edit"></i>\
                                </button>\
                                ';
                    } else if (auth_edit != "1" && auth_insert != "1") {
                        button += '<button class="btn btn-sm btn-outline-info details" data-id="' + data.id + '" title="Delete">\
                                        <i class="fa fa-eye"></i>\
                                    </button>';
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