<?php
$session = \Config\Services::session();
$mainModel = model('App\Modules\Main\Models\MainModel');
?>

<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet-contextmenu.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet.fullscreen.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/MarkerCluster.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/MarkerCluster.Default.css" />
<link href="https://mitradarat-fms.dephub.go.id/assets/libs/select2/select2-min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/L.Icon.Pulse.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/slick/slick.css?v2022" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/slick/slick-theme.css?v2022" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.css?t=<?=date('YmdHis')?>" />

<style>
.leaflet-popup-content p{
    margin:0;
}

.box {
  display: flex;
  align-items: stretch;
}

.box div.img-wrapper{
    padding-left: 5px;
    padding-right: 16px;
    padding-top: 2px;
}

.call-this-user-dashboard,.map-this-user-dashboard{
    cursor: pointer;
}

.bx-map-pin{
    color:blue;
}

.bx-phone-call{
    color:darkgreen;
}
.hubdatsearch-frame{
    position: absolute;
    top: 50px;
    left: 22px;
    bottom: 0;
    width: 332px;
    background-color: white;
    z-index: -1;
    height: calc(100vh - 200px);
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;
    overflow-y: auto;
}

.poi-detail {
    top: -16px !important;
    left: 0 !important;
    height: calc(100vh - 40px) !important;
    width: 360px !important;
    padding: 0 !important;
}

div.poi-item:hover{
    background-color: #F5F5F5;
}

.jp-0{
    position: absolute;
    top: 0;
    left: -20px;
    bottom: 0;
    width: 0px;
    background-color: white;
    z-index: 9999;
    height: calc(100vh - 53px);
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;
    overflow-y: auto;
}

.jp-0-close{
    float:right;
}

.widget-box{
    resize: both;overflow: auto;
    overflow-y:auto;position: absolute;top:65px;left:20px;z-index: 999;display: none;
}

#map .sidenav {
    background-color: #fff;
    -webkit-box-shadow: 0 0 24px 0 rgba(0,0,0,.06), 0 1px 0 0 rgba(0,0,0,.02);
    box-shadow: 0 0 24px 0 rgba(0,0,0,.06), 0 1px 0 0 rgba(0,0,0,.02);
    display: block;
    position: fixed;
    -webkit-transition: all .2s ease-out;
    transition: all .2s ease-out;
    width: 0px;
    z-index: 9999;
    top:0;
    left:-20px;
    bottom: 0;
    /*padding-left:20px;*/
}

div.rise-shake, .rise-shake {
  animation: jump-shaking 0.83s infinite;
}

@keyframes jump-shaking {
  0% { transform: translateX(0); color:green; }
  25% { transform: translateY(-9px);color:green; }
  35% { transform: translateY(-9px) rotate(17deg); color:green; }
  55% { transform: translateY(-9px) rotate(-17deg); color:blue; }
  65% { transform: translateY(-9px) rotate(17deg); color:blue; }
  75% { transform: translateY(-9px) rotate(-17deg); color:blue; }
  100% { transform: translateY(0) rotate(0);color:blue; }
}

#map .sidenav .closebtn-nav {
    position: absolute;
    top: 12px;
    right:20px;
}

.select2-container--default .select2-selection--single .select2-selection__clear{
    height: 46px;
}

#btn-sidenav{
    font-size: x-large;
}

.call-this-user{
    cursor: pointer;
    color:blue;
    font-size: large;
}

@media screen and (max-height: 450px) {
.sidenav {padding-top: 15px;}
.sidenav a {font-size: 18px;}
}

</style>

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

<script src="https://stream.nginovasi.id:5002/socket.io/socket.io.js"></script>
<script src="https://gps.brtnusantara.com:5758/socket.io/socket.io.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/libs/leaflet/index.umd.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Path.Drag.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/Leaflet.Editable.js"></script>

<?php // echo view('App\Modules\Main\Views\partials\topbar'); ?>

<div style="display: none">
    <div id="form-hidden-rute">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Rute</h4>
            </div>
            <div class="card-body">
                <form>
                    <input type="hidden" id="id" name="id" />
                    <div>
                        <label class="form-label" for="default-input">Nama Rute</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Nama Rute">
                    </div>
                    <div>
                        <label class="form-label" for="form-sm-input">Origin</label>
                        <input class="form-control" type="text" id="origin" name="origin" placeholder="Origin">
                    </div>
                    <div>
                        <label class="form-label" for="form-lg-input">Toward</label>
                        <input class="form-control" type="text" id="toward" name="toward" placeholder="destination">
                    </div>
                    <div>
                        <label class="form-label" for="form-lg-input">Rute Color</label>
                        <input class="form-control form-control-color" type="color" id="color" name="color" />
                    </div>
                    <div class="mt-4">
                        <button id="btn-update-rute" class="btn btn-primary w-md">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="form-hidden-busstop">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Bus Stop</h4>
            </div>
            <div class="card-body">
                <form>
                    <input type="hidden" id="bs_id" name="bs_id" />
                    <div>
                        <label class="form-label" for="default-input">Nama Bus Stop</label>
                        <input class="form-control" type="text" id="bs_nm" name="bs_nm" placeholder="Nama Bus Stop">
                    </div>
                    <div>
                        <label class="form-label" for="form-lg-input">Koordinat (latitude,longitude)</label>
                        <input class="form-control" type="text" id="bs_lat" name="bs_lat" placeholder="Latitude" readonly="">
                        <input class="form-control" type="text" id="bs_lng" name="bs_lng" placeholder="Longitude" readonly="">
                    </div>
                   
                    <div class="mt-4">
                        <button id="btn-update-busstop" class="btn btn-primary w-md">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="form-hidden-bus">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Bus</h4>
            </div>
            <div class="card-body">
                <form>
                    <input type="hidden" id="gps_sn" name="gps_sn" />
                    <div>
                        <label class="form-label" for="default-input">Nomor Lambung / Nopol</label>
                        <input class="form-control" type="text" id="nopol" name="nopol" placeholder="Nomor Lambung / Nopol">
                    </div>
                    <div>
                        <label class="form-label" for="form-sm-input">Group Name</label>
                        <input class="form-control" type="text" id="group_nm" name="group_nm" placeholder="Group Name">
                    </div>
                    <div>
                        <label class="form-label" for="form-lg-input">Company Name</label>
                        <input class="form-control" type="text" id="company_nm" name="company_nm" placeholder="Company Name">
                    </div>
                    <div>
                        <label class="form-label" for="form-lg-input">Rute</label>
                        <select class="form-control" style="width: 100%;" id="route_id" name="route_id"></select>
                    </div>
                    <div class="mt-4">
                        <button id="btn-update-bus" class="btn btn-primary w-md">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div style="width:auto;height:400px;" id="widget-01" class="widget-box">
    <div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move" id="widget-01-header">
            <h4 class="card-title mb-0 flex-grow-1">Operasional Armada</h4>
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <table id="datatable" class="table table-theme table-row v-middle" width="100%">
                        <thead>
                            <tr>
                                <th><span>#</span></th>
                                <th><span>SN</span></th>
                                <th><span>Group Name</span></th>
                                <th><span>No. Kendaraan</span></th>
                                <th><span>Route ID</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>

<div style="width:auto;height:400px;" id="widget-02" class="widget-box">
    
    <div class="card">
        <div class="card-header align-items-center d-flex" id="widget-02-header">
            <h4 class="card-title mb-0 flex-grow-1">Rute Perintis & KSPN</h4>
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <table id="datatable2" class="table table-theme table-row v-middle" width="100%">
                        <thead>
                            <tr>
                                <th><span>#</span></th>
                                <th><span>Jenis Rute</span></th>
                                <th><span>Rute</span></th>
                                <th><span>Origin</span></th>
                                <th><span>Toward</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                    
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>

<div style="width:auto;height:400px;" id="widget-03" class="widget-box" style="display: none">
    <div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move" id="widget-03-header">
            <h4 class="card-title mb-0 flex-grow-1">Monitoring Bus Status</h4>
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <table id="datatable3" class="table table-theme table-row v-middle" width="100%">
                        <thead>
                            <tr>
                                <th><span>#</span></th>
                                <th><span>Route Group</span></th>
                                <th><span>Total</span></th>
                                <th><span>Today Inactive</span></th>
                                <th><span>Today Active</span></th>
                                <th><span> < 1 min</span></th>
                                <th><span> +- 1 min</span></th>
                                <th><span> < 1 hour</span></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button type="button" class="btn btn-success w-md" id="reload-monroute">Refresh</button>
                    </div>
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>

<div style="width:730px;height:400px;" id="widget-04" class="widget-box">
    <div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move" id="widget-04-header">
            <h4 class="card-title mb-0 flex-grow-1">Tambah Rute</h4>
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <div class="card-body">
            <form>
                <div class="tab-content">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Nama Group</label>
                            <input class="form-control" type="text" value="" name="group_nm" id="group_nm">
                        </div>
                        <div class="mb-3">
                            <div class="row" style="overflow:auto">
                                <div class="col">
                                    <label for="jenroute">Jenis Rute</label>
                                    <select class="form-control jenroute" style="width: 100%;" name="jenroute" id="jenroute">
                                      <option value=""></option>
                                      <option value="Perintis">Perintis</option>
                                      <option value="KSPN">KSPN</option>
                                      <option value="AKAP">AKAP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">                            
                            <div class="row" style="overflow:auto">
                                <div class="col">
                                    <label for="start_point">Start Point</label>
                                    <select class="form-control" style="width: 100%;" name="start_point" id="start_point"></select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">                            
                            <div class="row" style="overflow:auto">
                                <div class="col">
                                    <label for="end_point">End Point</label>
                                    <select class="form-control" style="width: 100%;" name="end_point" id="end_point"></select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Color</label>
                            <input class="form-control" type="color" value="" name="color" id="color">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save-trayek">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo view('App\Modules\Main\Views\partials\right-sidebar'); ?>

<div class="content">
    <div id="map"></div>
    <div class="jp-0">
        <div style="display: block;margin-bottom: 20px">
            <a href="javascript:void(0);" class="jp-0-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <?php 
            echo view('App\Modules\Main\Views\partials\sidebar'); 
        ?>

    </div>
</div>

<script src='https://devel2.nginovasi.id/external_api.js'></script>
<script>
    //salafm, 18 april 2023
    var sourceSatpelData = {
        "Terminal" : {
            "nama" : "Terminal Tipe A",
            "icon" : "bus-terminal-a",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-terminal" data-badge="'+cluster4.getChildCount()+' Terminal"></div>' });
                }
            })
        },
        "Pelabuhan Penyeberangan" : {
            "nama" : "Pelabuhan",
            "icon" : "pelabuhan",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-pelabuhan" data-badge="'+cluster4.getChildCount()+' Pelabuhan"></div>' });
                }
            })
        },
        "UPPKB" : {
            "nama" : "UPPKB",
            "icon" : "uppkb",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-uppkb" data-badge="'+cluster4.getChildCount()+' UPPKB"></div>' });
                }
            })
        },
        "Satuan Kerja" : {
            "nama" : "Satuan Kerja",
            "icon" : "satker",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-satuan-kerja" data-badge="'+cluster4.getChildCount()+' SatKer"></div>' });
                }
            })
        },
        "BPTD" : {
            "nama" : "BPTD",
            "icon" : "satker",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-satuan-kerja" data-badge="'+cluster4.getChildCount()+' BPTD"></div>' });
                }
            })
        },
        "Perhubungan Laut" : {
            "nama" : "Perhubungan Laut",
            "icon" : "hubla",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-perhubungan-laut" data-badge="'+cluster4.getChildCount()+' HubLa"></div>' });
                }
            })
        },
        "Perhubungan Udara" : {
            "nama" : "Perhubungan Udara",
            "icon" : "hubud",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-perhubungan-udara" data-badge="'+cluster4.getChildCount()+' Hubud"></div>' });
                }
            })
        },
        "Perkeretaapian" : {
            "nama" : "Perkeretaapian",
            "icon" : "ka",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-perkeretaapian" data-badge="'+cluster4.getChildCount()+' KeretaApi"></div>' });
                }
            })
        },
        "Satuan Pelayanan" : {
            "nama" : "Satuan Pelayanan",
            "icon" : "satpel",
            "layer" : L.markerClusterGroup({
                showCoverageOnHover:true,
                iconCreateFunction: function(cluster4) {
                  return L.divIcon({ 
                    html: '<div class="data-badge-satuan-pelayanan" data-badge="'+cluster4.getChildCount()+' SatPel"></div>' });
                }
            })
        }
    }

    var layerGroupRestarea = L.markerClusterGroup({
        showCoverageOnHover:true,
        iconCreateFunction: function(cluster3) {
          return L.divIcon({ 
            html: '<div class="data-badge-restarea" data-badge="'+cluster3.getChildCount()+' Rest Area"></div>' });
        }
    });

    var layerGroupPosko = L.markerClusterGroup({
        showCoverageOnHover:true,
        iconCreateFunction: function(cluster4) {
          return L.divIcon({ 
            html: '<div class="data-badge-posko" data-badge="'+cluster4.getChildCount()+' Lokasi Pantau"></div>' });
        }
    });

    var layerGroupWisata = L.markerClusterGroup({
        showCoverageOnHover:true,
        iconCreateFunction: function(cluster4) {
          return L.divIcon({ 
            html: '<div class="data-badge-wisata" data-badge="'+cluster4.getChildCount()+' Wisata"></div>' });
        }
    });

    var layerGroupAduan = L.markerClusterGroup({
        showCoverageOnHover:true,
        iconCreateFunction: function(cluster4) {
          return L.divIcon({ 
            html: '<div class="data-badge-aduan" data-badge="'+cluster4.getChildCount()+' Aduan"></div>' });
        }
    });

    var layerGroupKuliner = L.markerClusterGroup({
        showCoverageOnHover:true,
        iconCreateFunction: function(cluster4) {
          return L.divIcon({ 
            html: '<div class="data-badge-kuliner" data-badge="'+cluster4.getChildCount()+' Kuliner"></div>' });
        }
    });

    const debounce = (func, delay) => {
        let debounceTimer
        return function() {
            const context = this
            const args = arguments
                clearTimeout(debounceTimer)
                    debounceTimer
                = setTimeout(() => func.apply(context, args), delay)
        }
    }

    const addListCall = (item, posko_id,type) => {
        console.log('add list call');
        console.log(item);
        if(type==0){
            return `<li class="active">
              <a href="#">
                  <div class="d-flex align-items-start">
                      <div class="flex-shrink-0 user-img ${item.status=="offline"?"":"online"} align-self-center me-3">
                          <img src="${item.pic}" class="rounded-circle avatar-sm" alt="">
                          <span class="user-status"></span>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                          <h5 class="text-truncate font-size-14 mb-1">${item.name}</h5>
                          <p class="text-truncate mb-0">${item.status}</p>
                      </div>
                      <div class="flex-shrink-0">
                          <div class="call-this-user-dashboard" data-id="${item.id}" data-posko-id="${posko_id}" data-satpel-id="null"><i class="bx bx-phone-call"></i></div>
                      </div>
                  </div>
              </a>
            </li>`;
        }else{
            return `<li class="active">
              <a href="#">
                  <div class="d-flex align-items-start">
                      <div class="flex-shrink-0 user-img ${item.status=="offline"?"":"online"} align-self-center me-3">
                          <img src="${item.pic}" class="rounded-circle avatar-sm" alt="">
                          <span class="user-status"></span>
                      </div>
                      <div class="flex-grow-1 overflow-hidden">
                          <h5 class="text-truncate font-size-14 mb-1">${item.name}</h5>
                          <p class="text-truncate mb-0">${item.status}</p>
                      </div>
                      <div class="flex-shrink-0">
                          <div class="call-this-user-dashboard" data-id="${item.id}" data-posko-id="null" data-satpel-id="${posko_id}"><i class="bx bx-phone-call"></i></div>
                      </div>
                  </div>
              </a>
            </li>`;
        }
    }

    const onMarkerTap = (marker) => {
        Map_.removeMarker(map);
        $('.hubdatsearch-frame').addClass('poi-detail');
        $('#widget-03').hide();
        $('.poi-item').remove();
        $('.poi-item-detail').remove();
        let element = ''
        let data = marker.target.options.data;
        switch(data.type){
            case 'singgah':
                element = `<div class="poi-item-detail" data-searchid=${data.id}>
                    <img alt="" src="https://mitradarat.dephub.go.id/${data.tempat_singgah_photo_path}" style="width: 100%"> 
                    <div style="padding: 12px">
                        <h5 style="font-weight: 400; padding-bottom: 12px">${data.tempat_singgah_name}</h5>
                        <div>
                            ${data.tempat_singgah_description ? data.tempat_singgah_description : '-' }
                        </div>
                    </div>
                </div>`;
            break;
            case 'terminal':
                var petugas = JSON.parse(data.petugas);
                var petugasEl = '';
                petugas.forEach(function(item,index){
                    petugasEl += addListCall(item, data.id,1);
                });
                element = `<div class="poi-item-detail" data-searchid=${data.id}>
                    <img alt="" src="https://mitradarat.dephub.go.id/${data.terminal_photo_path}" style="width: 100%"> 
                    <div style="padding: 12px">
                        <h5 style="font-weight: 400; padding-bottom: 12px">${data.terminal_name}</h5>
                        <div>
                            ${data.terminal_address ? data.terminal_address+''+data.instansi_detail_name : '-' }
                        </div>
                        <ul class="list-unstyled chat-list" style="padding-right: 12px">
                            ${petugasEl}
                        </ul>
                    </div>
                </div>`;
            break;
            default:
                var petugas = JSON.parse(data.petugas);
                var petugasEl = '';
                petugas.forEach(function(item,index){
                    petugasEl += addListCall(item, data.id,0);
                });

                element = `<div class="poi-item-detail" data-searchid=${data.id}>
                            <img src="https://mitradarat.dephub.go.id/${data.posko_mudik_img}" style="width: 100%"> 
                            <div style="padding: 12px">
                                <h5 style="font-weight: 400; padding-bottom: 12px">${data.posko_mudik_name}</h5>
                                <div style="padding-bottom: 12px">
                                    ${data.posko_mudik_about ? data.posko_mudik_about : '-' }
                                </div>
                                <ul class="list-unstyled chat-list" style="padding-right: 12px">
                                    ${petugasEl}
                                </ul>
                            </div>
                        </div>`;
            break;
        }

        $('.hubdatsearch-frame').css('display','block');
        $('.hubdatsearch-frame').append(element);
    }

    const addMarkerPosko = (item) => {
        if( typeof Dashboard.markerPosko === 'undefined' ){
            Dashboard.markerPosko = {};
        }

        Dashboard.markerPosko[item.id] = L.marker(item.posko_mudik_latlong,{
            contextmenu: false,
            icon: Dashboard.myIcon['posko'],
            data: item,
            draggable: false,
        }).on('click', onMarkerTap).addTo(layerGroupPosko);
        
        // layerGroupPosko.addTo(map);
    }

    const addMarkerSinggah = (item) => {
        if(typeof Dashboard.markerKuliner === 'undefined'){
            Dashboard.markerKuliner = {};
        }

        if(typeof Dashboard.markerWisata === 'undefined'){
            Dashboard.markerWisata = {};
        }

        if(typeof Dashboard.markerRestarea === 'undefined'){
            Dashboard.markerRestarea = {};
        }

        if(item.kategori_tempat_id == '2') {
            Dashboard.markerWisata[item.id] = L.marker(item.tempat_singgah_latlong,{
                contextmenu: false,
                icon: Dashboard.myIcon['wisata'],
                data: item,
                draggable: false,
            }).on('click', onMarkerTap).addTo(layerGroupWisata);
        
            // layerGroupWisata.addTo(map);
        }else if(item.kategori_tempat_id == '3'){
            Dashboard.markerRestarea[item.id] = L.marker(item.tempat_singgah_latlong,{
                contextmenu: false,
                icon: Dashboard.myIcon['rest-area'],
                data: item,
                draggable: false,
            }).on('click', onMarkerTap).addTo(layerGroupRestarea);
        
            // layerGroupRestarea.addTo(map);
        }else if(item.kategori_tempat_id == '4'){
            Dashboard.markerKuliner[item.id] = L.marker(item.tempat_singgah_latlong,{
                contextmenu: false,
                icon: Dashboard.myIcon['kuliner'],
                data: item,
                draggable: false,
            }).on('click', onMarkerTap).addTo(layerGroupKuliner);
        
            // layerGroupKuliner.addTo(map);
        }else if(item.kategori_tempat_id == '5'){
            
        }
    }

    const addMarkerSatpel = (item) => {
        if(item.terminal_lat!='NULL'){
            if(item.terminal_lng!='NULL'){
                if(typeof Dashboard.markerTerminal === 'undefined'){
                    Dashboard.markerTerminal = {};
                }

                //salafm, 18 april 2023

                //let satpelData = sourceSatpelData[item.lokker_type];
                let satpelData = sourceSatpelData[item.satpel_type];
                //console.log('addMarkerSatpel foo ');
                //console.log(item);
                //console.log(satpelData);
                let icon = Dashboard.myIcon[satpelData["icon"]];
                let layer = satpelData["layer"];

                Dashboard.markerTerminal[item.id] = L.marker(L.latLng(item.terminal_lat,item.terminal_lng),{
                    contextmenu: false,
                    icon: icon,
                    data: item,
                    draggable: false,
                }).on('click', onMarkerTap).addTo(layer);

                //layer.addTo(map);
                satpelData["layer"] = layer;
            }
       }
    }

    var layerGroupShelter = L.markerClusterGroup({
        showCoverageOnHover:false,
        iconCreateFunction: function(cluster) {
          return L.divIcon({ 
            html: '<div class="data-badge" data-badge="'+cluster.getChildCount()+' stops"></div>' });
        }
    });

    var layerGroupShelterNoRoute = L.markerClusterGroup({
        showCoverageOnHover:false,
        iconCreateFunction: function(cluster) {
          return L.divIcon({ 
            html: '<div class="data-badge" data-badge="'+cluster.getChildCount()+' stops"></div>' });
        }
    });

    $(document).ready(function () {
        try{
            coreEvents = new CoreEvents();
            coreEvents.url = '<?=base_url()?>/main';
            coreEvents.ajax = '<?=base_url()?>/main/ajax/';
            
            Dashboard = new Dashboard();
            Dashboard.load();

            Dashboard.displayName = '';
            Dashboard.roomName = '';
            Dashboard.outer = $('.jp-0').prop('outerHTML');

            const id = makeid(8);
            const domain = 'devel2.nginovasi.id';
            const options = {
                roomName: 'MeetingHubdat' + id,
                width: '100%',
                height: '500px',
                parentNode: document.querySelector('#meet'),
                lang: 'id',
                userInfo: {
                    email: 'admin@mitradarat-fms.dephub.go.id',
                    displayName: '<?=$session->get('name')?>',
                    avatarURL: '<?=base_url()?>/assets/images/Avatar-DitjenHubdat.png',
                }
            };
            Dashboard.routes;
            Dashboard.domain = domain;
            Dashboard.options = options;
            Dashboard.api
            Dashboard.urlGroupCall = '<?=base_url()?>/api/v1/voip';
            Dashboard.urlCall = '<?=base_url()?>/api/v1/voipcall';
            Dashboard.csrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
            
            Dashboard.csrfName = '<?php echo csrf_token() ?>';
            Dashboard.csrfHash = '<?php echo csrf_hash() ?>';
            Dashboard.baseUrl = '<?=base_url()?>';
            
            Dashboard.busIconURL = encodeURI("data:image/svg+xml," + Dashboard.iconPathString2).replaceAll('#','%23');
            Dashboard.currentRoute_id = '';
            Dashboard.vCurLatLng = [-1.3098505,122.4971107];
            Dashboard.vCurLatLngObj = Dashboard.vCurLatLng;
            Dashboard.vCurZoom = 5;
            Dashboard.vCurZoomObj = 5;
            Dashboard.vUrlSocket = 'findhubdatbykor';

            Dashboard.iconCurSize = 50;
            Dashboard.iconAltCurSize = 30;
            
            const socket = io.connect("https://stream.nginovasi.id:5002", { secure: true, transports: ["websocket"] });
            const socket_ptis = io.connect("https://gps.brtnusantara.com:5758", { secure: true, transports: ["websocket"] });

            socket.on('connect', function () {
                console.log('connected!');
                const transport = socket.io.engine.transport.name; // in most cases, "polling"
                socket.io.engine.on("upgrade", () => {
                  const upgradedTransport = socket.io.engine.transport.name; // in most cases, "websocket"
                  console.log(upgradedTransport);
                });
            });

            socket_ptis.on('connect', function () {
                console.log('ptis connected!');
                const transport = socket_ptis.io.engine.transport.name; // in most cases, "polling"
                socket_ptis.io.engine.on("upgrade", () => {
                  const ptis_upgradedTransport = socket_ptis.io.engine.transport.name; // in most cases, "websocket"
                  console.log(ptis_upgradedTransport);
                });
            });

            // Dashboard.streets = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            // });

            Dashboard.streets_de = L.tileLayer('https://{s}.tile.openstreetmap.de/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            Dashboard.positron = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
            });

            Dashboard.streets_fr = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            var baseLayers = {
                "Street FR":Dashboard.streets_fr,
                "Street DE": Dashboard.streets_de,
                "Grayscale": Dashboard.positron
            };

            map = L.map("map", {
              contextmenu: true,
              contextmenuWidth: 300,
              zoom: Dashboard.vCurZoom,
              maxZoom:20,
              center: Dashboard.vCurLatLng,
              layers: [Dashboard.streets_fr],
              editable: true,
              attributionControl: false,
              zoomControl: false,
              editable: true
            });

            // map.addControl(new L.Control.Fullscreen());

            map.on('popupopen', function(e) {
                if (e.target.hasOwnProperty("_popup")) {
                    try{
                        var px = map.project(e.target._popup._latlng); // find the pixel location on the map where the popup anchor is
                        px.y -= e.target._popup._container.clientHeight/2; // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                        map.panTo(map.unproject(px),{animate: true}); // pan to new center
                    }catch(e){}
                }
            });

            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);
            Dashboard.notifContent = `<div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="aduan-btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell icon-lg"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span class="badge bg-danger rounded-pill badge-notif"></span>
                    </button>
                </div>`;

            var topleftControl = L.control.custom({
                position:'topleft',
                content:Dashboard.content1_,
                classes: 'row',
                style:
                {
                    margin: '10px',
                    padding: '0px 0 0 0',
                    cursor: 'pointer',
                    width: '100%'
                }
            }).addTo(map);

            var topRightControl = L.control.custom({
                position:'topright',
                content:Dashboard.notifContent,
                classes: 'row',
                style:
                {
                    margin: '10px',
                    padding: '0px 0 0 0',
                    cursor: 'pointer',
                    marginRight:'6px'
                }
            }).addTo(map);

            $(document).on('click','#aduan-btn',function(e){
                $('#aduan-btn').removeClass('rise-shake');
                $('.badge-notif').html('');
            });

            $('.find_bus').hide();

            // map.on('click',
            //   function mapClickListen(e) {
            //     var pos = e.latlng;
            //     console.log('map click event');
            //     var marker = L.marker(
            //       pos, {
            //         draggable: true
            //       }
            //     );
            //     marker.on('drag', function(e) {
            //       console.log('marker drag event');
            //     });
            //     marker.on('dragstart', function(e) {
            //       console.log('marker dragstart event');
            //       map.off('click', mapClickListen);
            //     });
            //     marker.on('dragend', function(e) {
            //       console.log('marker dragend event');
            //       setTimeout(function() {
            //         map.on('click', mapClickListen);
            //       }, 10);
            //     });
            //     marker.addTo(map);
            //   }
            // );

            

            L.control.custom({
                position: 'bottomright',
                content: ''+
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" id="btn-update-jalur" title="Enable Edit">' +
                  '    <label><i class="fas fa-route"></i></label>' +
                  '</button>' +
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" id="btn-set-rute" title="Tambah Rute Trayek">' +
                  '    <label><i class="mdi mdi-map-marker-distance"></i></label>' +
                  '</button>' +
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" id="btn-widget-call" title="Aktifkan Video Call">' +
                  '    <label><i class="bx bx-video-off"></i></label>' +
                  '</button>'+
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" id="btn-routes-stat" title="Tampilkan Data Rute">' +
                  '    <label><i class="mdi mdi-map-check"></i></label>' +
                  '</button>'+
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" id="btn-bus-stat" title="Tampilkan Data Bus">' +
                  '    <label><i class="bx bx-bus"></i></label>' +
                  '</button>'+
                  '<button type="button" class="btn btn-sm btn-maja" data-toggle="tooltip" title="Center Map" id="btn-center">' +
                  '    <label><i class="bx bx-horizontal-center"></i></label>' +
                  '</button>'
                  ,
                classes: 'btn-group-vertical btn-group-sm',
                style:
                {
                  margin: '10px',
                  padding: '0px 0 0 0',
                  cursor: 'pointer'
                },
                datas: {},
                events:
                {
                  click: function (data) {
                      // console.log('wrapper div element clicked');
                      // console.log(data);
                  },
                  dblclick: function (data) {
                      // console.log('wrapper div element dblclicked');
                      // console.log(data);
                  },
                  contextmenu: function (data) {
                      // console.log('wrapper div element contextmenu');
                      // console.log(data);
                  },
                }
            }).addTo(map);

            map.on('enterFullscreen', function(){
                if(window.console) window.console.log('enterFullscreen');
            });
            map.on('exitFullscreen', function(){
                if(window.console) window.console.log('exitFullscreen');
            });

            map.on('fullscreenchange', function () {
                if (map.isFullscreen()) {
                    
                } else {
                    console.log('exited fullscreen');

                }
            });

            map.on('click',function(e){
                map.contextmenu.hide();
                removeMarkerSearch();
                $('#map #mySidenav .closebtn-nav').trigger('click');
            });

            map.on('rightclick',function(e){
                map.contextmenu.hide();
            });

            map.on('zoomend',function() {
              if(map.getZoom()>=8){
                    if(!map.hasLayer(featureGroup)) {
                      map.addLayer(featureGroup);
                    }
                  
                    // if(!map.hasLayer(layerGroupShelter)){
                    //     map.addLayer(layerGroupShelter);
                    // }
              }
              if(map.getZoom()<8){
                  if(map.hasLayer(featureGroup)) {
                      map.removeLayer(featureGroup);
                  }
                  // if(map.hasLayer(layerGroupShelter)){
                  //     map.removeLayer(layerGroupShelter);
                  // }
              }
            });

            map.contextmenu.addItem({
                text: 'Copy Coordinates',
                callback: getCoordinates,
                index: 0
            });

            map.contextmenu.addItem({
                text: 'Set rute dari sini',
                callback: setStartCoordinates,
                index: 1
            });
            map.contextmenu.addItem({
                text: 'Set rute ke sini',
                callback: setEndCoordinates,
                index: 2
            });
            map.contextmenu.addItem({
                text: 'Tambahkan Bus Stop',
                callback: addBusStop,
                index: 3
            });

            const featureGroup = L.featureGroup();
            const featureHubdatGroup = L.featureGroup();
            const vehicleMarkersGroup = L.featureGroup();
            var opMarkersGroup = L.markerClusterGroup();
            var layerGroupBus = L.layerGroup();
            var layerGroupWaypoints = L.layerGroup();

            Dashboard.myIcon = {};
            var opMarkers = {}; 
            var vehicleMarkers = {}; 
            var opMarker = {};
            var opMarkerData = {};
            var polyline = {};
            var polylineData = {};
            var polylineHubdatData = {};
            
            var indexPoly,indexMarker = 0;
            var vColor = "#0061c1";
            var numDeltas = 100;
            var delay = 10; //milliseconds
            var theBus_i = new Array();
            var theBusPosition = new Array();
            var theBusDeltaLat = new Array();
            var theBusDeltaLng = new Array();
            var busIconPath = {};
            var colorGroup = {};

            Dashboard.html_logobus = '<span style="font-size:12px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span>';
            Dashboard.myIcon['bus-terminal'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/bus-terminal.svg',
              iconSize:     [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
              shadowSize:   [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
              iconAnchor:   [(Dashboard.iconAltCurSize/2), Dashboard.iconAltCurSize],
              shadowAnchor: [2, Dashboard.iconAltCurSize],
              popupAnchor:  [0, -(Dashboard.iconAltCurSize)]
            });  

            Dashboard.myIcon['bus-terminal-a'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-TerminalTipeA.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            }); 

            Dashboard.myIcon['pelabuhan'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-PelabuhanPenyebrangan.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });  

            Dashboard.myIcon['uppkb'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-UPPKB.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['satker'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-SatuanKerja.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['hubla'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-PerhubunganLaut.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['hubud'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-PerhubunganUdara.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['ka'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-Perkeretaapian.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['satpel'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-SatuanPelayanan.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });

            Dashboard.myIcon['rest-area'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-RestAreaTOL.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });  

            Dashboard.myIcon['posko'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-TendaPosko.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            }); 

            Dashboard.myIcon['wisata'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-Pariwisata.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            }); 

            Dashboard.myIcon['kuliner'] = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/pinmarker-icon-Kuliner.svg',
              iconSize:     [Dashboard.iconCurSize, Dashboard.iconCurSize],
              shadowSize:   [Dashboard.iconCurSize, Dashboard.iconCurSize],
              iconAnchor:   [(Dashboard.iconCurSize/2), Dashboard.iconCurSize],
              shadowAnchor: [2, Dashboard.iconCurSize],
              popupAnchor:  [0, -(Dashboard.iconCurSize)]
            });        

            const select2Array = [{
                id: 'find_group_nm',
                url: '/group_nm_select_get',
                placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Area KSPN/Perintis</span>',
                params: null,
                parentNode: null,
            },{
                id: 'find_route',
                url: '/route_select_get',
                placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute KSPN/Perintis</span>',
                params: null,
                parentNode: null,
            }
            // ,{
            //     id: 'rute_mudik',
            //     url: '/mudik_select_get',
            //     placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute Mudik</span>',
            //     params: null,
            //     parentNode: null
            // }
            ,{
                id: 'start_point',
                url: '/bus_stop_select_get',
                placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Start Point</span>',
                params: null,
                parentNode: null
            },{
                id: 'end_point',
                url: '/bus_stop_select_get',
                placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari End Point</span>',
                params: null,
                parentNode: null
            },{
                id: 'edit_trayek',
                url: '/rute_mudik_select_get',
                placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute Trayek</span>',
                params: null,
                parentNode: null
            },];
            // alert(select2Array.length);

            select2Array.forEach(function (x) {
                coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params,x.parentNode);
            });

            $('#rute_mudik').on('select2:select',function(e){
                console.log(e.params.data);
                let id = e.params.data.id;
                $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/jsonmudikbyid',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        clearMap();
                        if(response.length>0){
                            showRuteMudik(response[0]);
                        }
                    }
                });
                
            });

            $('#edit_trayek').on('select2:clear',function(e){
                clearMap();
                Dashboard.centerMap();
            });

            $('#edit_trayek').on('select2:select', function (e) {
                  //console.log($(this).val());
                  var id = $(this).val();
                  //alert(id);
                  Dashboard.currentRoute_id = $(this).val();
                  clearMap();
                  $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/jsonRouteById',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      route_id:id
                    },
                    dataType: "json",
                    success: function(response) {
                        //console.log(response.points.data.paths[0]);
                        alert('test');
                        response.route[0].routepoints = response.points.data.paths[0];
                        console.log(response.route[0]);
                        Dashboard.currentRoute = response.route[0];
                        console.log(Dashboard.currentRoute.routes);
                        loadRoute(Dashboard.currentRoute);
                        centerRoute(Dashboard.currentRoute,polylineData);   
                        loadBusStop(response.bus_stop);
                        loadBus(Dashboard.currentRoute.id);
                        loadBus_ptis(Dashboard.currentRoute.id);
                        if(Dashboard.vCurLatLngObj!=Dashboard.vCurLatLng){
                            map.flyTo(Dashboard.vCurLatLngObj,Dashboard.vCurZoomObj);
                            Dashboard.vCurLatLngObj = Dashboard.vCurLatLng;
                        }
                    }
                });
            });

            $('#rute_mudik').on('select2:clear',function(e){
                clearMap();
                Dashboard.centerMap();
            });

            $('#find_route').on('select2:select', function (e) {
                  //console.log($(this).val());
                  var id = $(this).val();
                  
                  Dashboard.currentRoute_id = $(this).val();
                  clearMap();
                  $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/jsonRouteById',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      route_id:id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        Dashboard.currentRoute = response.route[0];
                        loadRoute(Dashboard.currentRoute);
                        centerRoute(Dashboard.currentRoute,polylineData);   
                        loadBusStop(response.bus_stop);
                        loadBus(Dashboard.currentRoute.id);
                        loadBus_ptis(Dashboard.currentRoute.id);
                    }
                });
            });

            $('#find_route').on('select2:clear', function (e) {
                $('.find_bus').hide();
                clearMap();
                Dashboard.centerMap();
                Dashboard.currentRoute = [];
            });

            $("#find_group_nm option[value='']").remove();

            $('#find_group_nm').on('select2:select', function (e) {
                  //console.log($(this).val());
                  
                  var id = $(this).val();
                  $('#widget-03').hide();
                  Dashboard.currentRoute_id = $(this).val();
                  clearMap();
                  $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/jsonRouteByGroupNm',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      route_id:id
                    },
                    dataType: "json",
                    success: function(response) {
                        Dashboard.currentRoute = response.route;
                        console.log('jpod trace current route');
                        console.log(Dashboard.currentRoute);
                        // Dashboard.currentBusStop = response.bus_stop;
                        // if ($('#find_bus').data('select2')) {
                        //     $("#find_bus").empty().trigger('change');
                        // }
                        // $('#find_bus').val(null).trigger('change');

                        if(Dashboard.currentRoute.length>0){
                            Dashboard.currentRoute.forEach(function(item,index){
                                loadRoute(item);
                                console.log("load bus "+item.route_id);
                                loadBus(item.route_id);
                                loadBusStop($.parseJSON(item.jsonroutes));
                                //console.log(item);
                                //loadBus_ptis(item.id);
                            });
                            // centerRoute(Dashboard.currentRoute,polylineData);
                            map.fitBounds(featureGroup.getBounds());
                               
                            
                        }

                        // console.info('cek polylines now')
                        // console.info(polylines)

                        // loadBusStop(Dashboard.currentBusStop);  
                    }
                });
            });

            $('#find_group_nm').on('select2:clear', function (e) {
                $('.find_bus').hide();
                clearMap();
                Dashboard.centerMap();
                Dashboard.currentRoute = [];
            });

            function removeBusStop(e){
                map.removeLayer(Dashboard.busStopMarker);
            }

            function addBusStop(e){
                if(typeof Dashboard.busStopMarker!='undefined'){
                 map.removeLayer(Dashboard.busStopMarker);
                }
                Dashboard.curlatlng = e.latlng; 
                Dashboard.busStopMarker  = L.marker(e.latlng, {
                  contextmenu: true,
                  contextmenuWidth: 350,
                  contextmenuItems:[
                    {
                        text:'Hapus Bus Stop',
                        callback:removeBusStop,
                    }
                  ],
                  //icon: Dashboard.myIcon['bus-terminal'],
                  draggable: true,
                }).bindPopup('<div id="div-busstop">'+$('#form-hidden-busstop').html()+'</div>',{
                    minWidth:500
                }).addTo(map);
                Dashboard.busStopMarker.openPopup();
                $('#div-busstop #bs_nm').focus(); 
                $('#div-busstop #bs_lat').val(e.latlng.lat);
                $('#div-busstop #bs_lng').val(e.latlng.lng);

                // const select2Array2 = [{
                //     id: 'div-busstop #route_id',
                //     url: '/route_select_get',
                //     placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute</span>',
                //     params: null,
                // }];

                // select2Array2.forEach(function (x) {
                //     coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params,'#div-busstop');
                // });

                Dashboard.busStopMarker.on('dragend',function(e){
                Dashboard.curlatlng = e.target._latlng;
                e.latlng = e.target._latlng;
                alert('update lokasi bus stop')
              });
            }

            function clearMap(){
                featureGroup.clearLayers();
                map.removeLayer(featureGroup);
                layerPolyGroup.clearLayers();
                map.removeLayer(layerPolyGroup);
                layerGroupShelter.clearLayers();
                map.removeLayer(layerGroupShelter);
                vehicleMarkersGroup.clearLayers();
                map.removeLayer(vehicleMarkersGroup);
                layerGroupWaypoints.clearLayers();
                map.removeLayer(layerGroupWaypoints);

                for(i in map._layers) {
                    if(map._layers[i]._path != undefined) {
                        try {
                            map.removeLayer(map._layers[i]);
                        }
                        catch(e) {
                            console.log("problem with " + e + map._layers[i]);
                        }
                    }
                }
            }

            function centerRoute(item,polylineData)
            {
                map.fitBounds(polylineData[item.id].getBounds());
                polylineData[item.id].openPopup();
            }

            function loadBusGps(route_id){
                console.log('load bus route_id :'+route_id);
            }
            
            function loadAllRoutes(){
              $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/jsonroutes',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    dataType: "json",
                    beforeSend:function(request){
                        Dashboard.pageLoading();
                    }
                }).done(function(response){
                    console.log('close swal');
                    Swal.close();
                    var dataStart = 0;
                    Dashboard.routes = response;
                    Dashboard.storeRouteToTable(response);
                });
            }
       
            loadAllRoutes();
            //map.contextmenu.hide();
            //map.contextmenu._items = [];


            function loadRoute(item){
                //item.points = $.parseJSON(item.points);
                console.log('jpod load route');
                console.log(item);
                // console.log('item points');
                //console.log(item.points[0]);
                console.log($.parseJSON(item.points));
                $.each($.parseJSON(item.points),function(index2,point){
                    // console.log(index2);
                    // console.log(point);
                    if(typeof polylineData[item.id]=='undefined') polylineData[item.id] = [];
                    var decodedPoints = L.PolylineUtil.decode(point);
                    console.log(decodedPoints);
                    //var latlng3 = L.PolylineUtil.decode(item.routepoints.points);
                    polylineData[item.id] = L.polyline(decodedPoints, {
                        contextmenu: true,
                        contextmenuWidth: 240,
                        contextmenuItems: [{
                          text: 'Edit Rute',
                          callback: editRute,
                          index:0
                        }],
                        bubblingMouseEvents:false,
                        // color: '#'+Dashboard.getRandomRolor(),
                        color: item.color,
                        data:item
                    }).bindPopup(item.jenroute+'-'+item.group_nm+'<br/>'+item.kor+'<br/>'+item.trayek+'<br/>'+item.origin+'-'+item.toward).on('click',onMarkerClick);
                    //console.log(polylineData[item.id]);
                    featureGroup.addLayer(polylineData[item.id]);

                });       
                // featureGroup.addTo(map);        


            }  

            function checkLiveTraffic2(e){
                var item = e.relatedTarget.options.data;
                //console.log(item);
                //console.log(item.route_from_latlng);
                var pos1 = item.route_from_latlng.split(',');
                var pos2 = item.route_to_latlng.split(',');
                var vStartLatLng = new L.latLng(pos1[0],pos1[1]);
                var vEndLatLng = new L.latLng(pos2[0],pos2[1]);

                liveTrafficFromPoint(vStartLatLng,vEndLatLng,item.text);
            }

            function checkLiveTraffic(e){
                var item = e.relatedTarget.options.data;
                //console.log(item);
                $.ajax({
                    type:'post',
                    url: Dashboard.baseUrl+'/main/ajax/getlivetraffic',
                    data:{ 
                        route_id: item.id,
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                    },
                    success:function(response){
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        var distance = ret.routes[0].legs[0].distance.value / 1000;
                        var duration = ret.routes[0].legs[0].duration.value / 60 / 60;
                        //var duration_in_traffic = ret.routes[0].legs[0].duration_in_traffic.value / 60 / 60;
                        //var trafficStatus = (duration / duration_in_traffic).toFixed(2);

                        var durationText = ret.routes[0].legs[0].duration.text;
                        //var duration_in_trafficText = ret.routes[0].legs[0].duration_in_traffic.text;
                        var distanceText = ret.routes[0].legs[0].distance.text;
                        //console.log('distance ' +distance);
                        //console.log('duration ' +duration);
                        //console.log('duration_in_traffic ' +duration_in_traffic);
                        //console.log('trafficStatus ' +trafficStatus);
                        //console.log('durationText ' +durationText);
                        //console.log('duration_in_trafficText ' +duration_in_trafficText);
                        //console.log('distanceText ' +distanceText);
                        var vRoadName = item.name;
                        ret.routes[0].legs.forEach(function(item,index){
                            //console.log(item);
                            item.steps.forEach(function(item2,index2){
                                // console.log(item2);
                                // console.log(vRoadName + ' index - ' + index2);
                                // console.log(vRoadName + ' index - ' + parseInt(index2) + 1);
                                // console.log(vRoadName + ' length - ' + item.steps.length);
                                var vLatLng = [item2.start_location.lat, item2.start_location.lng];
                                var htmlInstructions = item2.html_instructions;
                                var distance_ = item2.distance.value / 1000;
                                var distance_Text = item2.distance.text;
                                var duration_ = item2.duration.value / 60 / 60;
                                var duration_Text = item2.duration.text;
                                var avgSpeedLegs = (distance_ / duration_).toFixed(2);
                                var vColorLegs = "#0fafff";

                                switch (true) {
                                    case (avgSpeedLegs <= 30 && avgSpeedLegs > 15):
                                        vColorLegs = "#ffa121";
                                        var pulsingIcon = L.icon.pulse({
                                            iconSize: [10, 10],
                                            color: '#ffa121',
                                            fillColor: '#ffa121'
                                        });
                                    break;
                                    case (avgSpeedLegs <= 15):
                                        vColorLegs = "#ff0000";
                                        var pulsingIcon = L.icon.pulse({
                                            iconSize: [10, 10],
                                            color: '#ff0000',
                                            fillColor: '#ff0000'
                                        });
                                    break;
                                }
                                //console.log('hapus jalan ' + index);

                                polylines[index] = L.Polyline.fromEncoded(item2.polyline.points, {
                                    contextmenu: true,
                                    contextmenuWidth: 350,
                                    contextmenuItems: [{
                                        text: 'Hapus Jalan ' + vRoadName,
                                        callback: function() {
                                            return delRoad(vRoadName);
                                        },
                                        index: 4
                                        },
                                        {
                                        text: 'Simpan Rute ini ',
                                        callback: saveRoad,
                                        index: 5
                                        }, {
                                        text: 'Clear Unnamed Rute Jalan',
                                        callback: clearRoad,
                                        index: 8
                                        }
                                    ],
                                    customData: {
                                        roadname: vRoadName,
                                        data: item2
                                    },
                                    stroke: true,
                                    color: vColorLegs,
                                    weight: 6,
                                    fill: false,
                                    // fillColor: 'blue',
                                    fillOpacity: 1
                                }).addTo(map);

                            });
                            // for (index in item.steps) {
                            

                           

                            
                            //     polylines[index].on('mouseover', function(e) {
                            //         var layer = e.target;

                            //         console.log(layer.options.customData);
                            //     });
                            // } // end loop leg[0]
                        });
                    }
                });
            }

            function loadBus(route_id){
                $.ajax({
                  method: 'POST',
                  url:'https://stream.nginovasi.id:5002/api/'+Dashboard.vUrlSocket,
                  data: JSON.stringify({ key:'ngiraya',route_id:route_id }),
                  headers: {
                    "Authorization": "Basic aHViZGF0Ok51c2FudGFyYTQw",
                    "Content-Type": "application/json"
                  },
                  contentType: 'application/json',
                  beforeSend:function(request){
                    // request.setRequestHeader("X-NGI-TOKEN", 'dev');
                  },
                  success:function(response){
                    $('.find_bus').show();
                    $.each(response.data,function(index,item){
                        item.routename = Dashboard.routes.filter(function c(rute){ return rute.id == item.route_id });
                        if(typeof colorGroup[item.group_nm]=='undefined'){
                            var randomColor = Dashboard.getRandomRolor();  
                            colorGroup[item.group_nm] = randomColor;
                            Dashboard.busIconURL = encodeURI("data:image/svg+xml," + Dashboard.iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
                            busIconPath[item.group_nm] = L.icon({
                              iconUrl: Dashboard.busIconURL,
                              iconSize:     [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                              shadowSize:   [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                              iconAnchor:   [(Dashboard.iconAltCurSize/2), Dashboard.iconAltCurSize],
                              shadowAnchor: [2, Dashboard.iconAltCurSize],
                              popupAnchor:  [0, -(Dashboard.iconAltCurSize)]
                            });
                        }
                        createBusMarker(item,colorGroup[item.group_nm],busIconPath[item.group_nm]);
                    });

                    
                    
                    Dashboard.setBusDataSource(response.data);

                    
                    $("#find_bus").select2({
                        placeholder: '<span style="font-size:12px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Armada</span>',
                        allowClear: true,
                        data:Dashboard.vdata_bus.results,
                        escapeMarkup : function(markup) { return markup; }
                    });

                    

                    $('#find_bus').on('select2:select', function (e) {
                          var data = e.params.data;
                          vehicleMarkers[data.id].openPopup();
                          map.flyTo(vehicleMarkers[data.id].getLatLng(),14);
                    });

                    $('#find_bus').on('select2:clear', function (e) {
                        var data = e.params.data;
                        vehicleMarkers[data[0].id].closePopup();
                        centerRoute(Dashboard.currentRoute,polylineData);
                    });


                    socket.on('new hubdat '+route_id, function(ret){
                        var LatLngUpd = [ret.lat,ret.lon];
                        if(ret){
                          if(ret.lat!=null){
                            if(typeof vehicleMarkers[ret.gps_sn]!='undefined'){
                              // pindah lokasi bus
                              try{
                                transition(ret,LatLngUpd,ret.gps_sn);
                                let obj = Dashboard.vdata_bus.results.find((item, index) => {
                                        item.children.forEach(function(item2,index2){
                                            if(item2.id === ret.gps_sn){
                                                item2.text = Dashboard.html_logobus+' '+ret.nopol+' <span style="display:none">'+ret.group_nm+','+ret.gps_sn+'</span><br/><small>'+$.timeago(ret.gps_time)+'x</small>'
                                            }
                                        });
                                });                            
                              }catch(e){
                                console.log(e);
                              }
                            }else{
                              if(typeof colorGroup[ret.group_nm]=='undefined'){
                                    var randomColor = Dashboard.getRandomRolor();      
                                    colorGroup[ret.group_nm] = randomColor;
                                    Dashboard.busIconURL = encodeURI("data:image/svg+xml," + Dashboard.iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
                                    busIconPath[ret.group_nm] = L.icon({
                                      iconUrl: Dashboard.busIconURL,
                                      iconSize:     [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                                      shadowSize:   [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                                      iconAnchor:   [(Dashboard.iconAltCurSize/2), Dashboard.iconAltCurSize],
                                      shadowAnchor: [2, Dashboard.iconAltCurSize],
                                      popupAnchor:  [0, -(Dashboard.iconAltCurSize)]
                                    });
                                }
                                ret.routename = Dashboard.routes.filter(function c(rute){ return rute.id == ret.route_id });
                                createBusMarker(ret,colorGroup[ret.group_nm],busIconPath[ret.group_nm]);
                            }
                          }
                        }
                    });
                    Dashboard.storeBusToTable(response.data);

                  }
                });
            }

            function loadBus_ptis(kor){
                $.ajax({
                  method: 'POST',
                  url:'https://gps.brtnusantara.com:5758/api/'+Dashboard.vUrlSocket,
                  data: JSON.stringify({ key:'ngiraya',kor:kor }),
                  headers: {
                    "Authorization": "Basic aHViZGF0Ok51c2FudGFyYTQw",
                    "Content-Type": "application/json"
                  },
                  contentType: 'application/json',
                  beforeSend:function(request){
                    // request.setRequestHeader("X-NGI-TOKEN", 'dev');
                  },
                  success:function(response){
                    $('.find_bus').show();
                    $.each(response.data,function(index,item){
                        item.routename = item.kor;
                        if(typeof colorGroup[item.group_nm]=='undefined'){
                            var randomColor = Dashboard.getRandomRolor();  
                            colorGroup[item.group_nm] = randomColor;
                            Dashboard.busIconURL = encodeURI("data:image/svg+xml," + Dashboard.iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
                            busIconPath[item.group_nm] = L.icon({
                              iconUrl: Dashboard.busIconURL,
                              iconSize:     [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                              shadowSize:   [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                              iconAnchor:   [(Dashboard.iconAltCurSize/2), Dashboard.iconAltCurSize],
                              shadowAnchor: [2, Dashboard.iconAltCurSize],
                              popupAnchor:  [0, -(Dashboard.iconAltCurSize)]
                            });
                        }
                        createBusMarker(item,colorGroup[item.group_nm],busIconPath[item.group_nm]);
                    });

                    
                    
                    Dashboard.setBusDataSource(response.data);

                    
                    $("#find_bus").select2({
                        placeholder: '<span style="font-size:12px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Armada</span>',
                        allowClear: true,
                        data:Dashboard.vdata_bus.results,
                        escapeMarkup : function(markup) { return markup; }
                    });

                    

                    $('#find_bus').on('select2:select', function (e) {
                          var data = e.params.data;
                          vehicleMarkers[data.id].openPopup();
                          map.flyTo(vehicleMarkers[data.id].getLatLng(),14);
                    });

                    $('#find_bus').on('select2:clear', function (e) {
                        var data = e.params.data;
                        vehicleMarkers[data[0].id].closePopup();
                        centerRoute(Dashboard.currentRoute,polylineData);
                    });


                    socket_ptis.on('new hubdat '+kor, function(ret){
                        var LatLngUpd = [ret.lat,ret.lon];
                        console.log(ret);
                        if(ret){
                          if(ret.lat!=null){
                            if(typeof vehicleMarkers[ret.gps_sn]!='undefined'){
                              // pindah lokasi bus
                              try{
                                transition(ret,LatLngUpd,ret.gps_sn);
                                let obj = Dashboard.vdata_bus.results.find((item, index) => {
                                        item.children.forEach(function(item2,index2){
                                            if(item2.id === ret.gps_sn){
                                                item2.text = Dashboard.html_logobus+' '+ret.nopol+' <span style="display:none">'+ret.group_nm+','+ret.gps_sn+'</span><br/><small>'+$.timeago(ret.gps_time)+'x</small>'
                                            }
                                        });
                                });                            
                              }catch(e){
                                console.log(e);
                              }
                            }else{
                              if(typeof colorGroup[ret.group_nm]=='undefined'){
                                    var randomColor = Dashboard.getRandomRolor();      
                                    colorGroup[ret.group_nm] = randomColor;
                                    Dashboard.busIconURL = encodeURI("data:image/svg+xml," + Dashboard.iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
                                    busIconPath[ret.group_nm] = L.icon({
                                      iconUrl: Dashboard.busIconURL,
                                      iconSize:     [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                                      shadowSize:   [Dashboard.iconAltCurSize, Dashboard.iconAltCurSize],
                                      iconAnchor:   [(Dashboard.iconAltCurSize/2), Dashboard.iconAltCurSize],
                                      shadowAnchor: [2, Dashboard.iconAltCurSize],
                                      popupAnchor:  [0, -(Dashboard.iconAltCurSize)]
                                    });
                                }
                                ret.routename = ret.kor;
                                createBusMarker(ret,colorGroup[ret.group_nm],busIconPath[ret.group_nm]);
                            }
                          }
                        }
                    });
                    Dashboard.storeBusToTable(response.data);

                  }
                });
            }
              
            function onMarkerClick(e){
                // alert('tes');
            }

            function createBusMarker(item,randomColor,busIconPath){

                vehicleMarkers[item.gps_sn] = L.marker([item.lat, item.lon], {
                  contextmenu: true,
                  contextmenuWidth: 300,
                  contextmenuItems: [{
                      text: 'Edit Armada',
                      callback: editVehicles,
                      index: 1
                  }],
                  icon: busIconPath,
                  rotationAngle: parseFloat(item.direction),
                  data:item,
                  bubblingMouseEvents:false,
                }).addTo(vehicleMarkersGroup);

                Dashboard.setBusTooltip(vehicleMarkers[item.gps_sn],item);
                vehicleMarkers[item.gps_sn].on('dblclick', function(e){
                    map.flyTo(e.sourceTarget._latlng,15);
                });
                vehicleMarkers[item.gps_sn].setRotationAngle(item.direction);
                map.addLayer(vehicleMarkersGroup);
                theBusPosition[item.gps_sn] = [parseFloat(item.lat),parseFloat(item.lon)];
            }

            
            function transition(item,LatLngUpd,key){
                theBus_i[key] = 0;
                theBusDeltaLat[key] = (LatLngUpd[0] - theBusPosition[key][0])/numDeltas;
                theBusDeltaLng[key] = (LatLngUpd[1] - theBusPosition[key][1])/numDeltas;
                moveMarker(item,key);
            }

            function moveMarker(item,key){
                theBusPosition[key][0] += theBusDeltaLat[key];
                theBusPosition[key][1] += theBusDeltaLng[key];
                var newLatLng_ = new L.LatLng(theBusPosition[key][0], theBusPosition[key][1]);
                vehicleMarkers[key].setLatLng(newLatLng_).update();

                if(theBus_i[key]!=numDeltas){
                  theBus_i[key]++;
                  setTimeout(moveMarker, delay,item,key);
                }else{
                  vehicleMarkers[item.gps_sn].setRotationAngle(item.direction);
                  Dashboard.setBusTooltip(vehicleMarkers[item.gps_sn],item);
                  map.fireEvent('popupopen');
                }
            }

            function editVehicles(e){
                var data = e.relatedTarget.options.data;
                
                var popup = L.popup(
                {
                    minWidth:500
                })
                .setLatLng([e.latlng.lat,e.latlng.lng])
                .setContent('<div id="div-bus">'+$('#form-hidden-bus').html()+'</div>')
                .openOn(map); 
                $('#div-bus #gps_sn').val(data.id);
                $('#div-bus #nopol').val(data.nopol);
                $('#div-bus #group_nm').val(data.group_nm);
                $('#div-bus #company_nm').val(data.company_nm);
                $('#div-bus #route_id').val(data.route_id);
                if(data.route_id!=null){
                    $('#div-bus #route_id').attr('data-id',data.route_id);
                    $('#div-bus #route_id').attr('data-text',(data.routename.length>0)?data.routename[0].name:'');
                }
                $('#div-bus #nopol').focus();
                const select2Array2 = [{
                    id: 'div-bus #route_id',
                    url: '/route_select_get',
                    placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute</span>',
                    params: null,
                }];

                select2Array2.forEach(function (x) {
                    coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params,'#div-bus');
                });
            }

            function editRute(e){
                var data = e.relatedTarget.options.data;
                var popup = L.popup(
                {
                  minWidth:500
                })
                .setLatLng([e.latlng.lat,e.latlng.lng])
                .setContent('<div id="div-rute">'+$('#form-hidden-rute').html()+'</div>')
                .openOn(map); 
                //map.panTo([e.latlng.lat,e.latlng.lng]);
                $('#div-rute #id').val(data.id);
                $('#div-rute #name').val(data.name);
                $('#div-rute #origin').val(data.origin);
                $('#div-rute #toward').val(data.toward);
                $('#div-rute #color').val(data.color);
                $('#div-rute #name').focus();
                //console.log(e);
            }

            function showRuteMudik(param){
                var latlng3 = L.PolylineUtil.decode(param.route_polyline);
                polylineHubdatData[param.id] = L.polyline(latlng3, {
                    contextmenu: true,
                    contextmenuWidth: 240,
                    contextmenuItems: [{
                        text: 'Edit Rute Hubdat',
                        callback: editRute,
                        index:0
                    },{
                        text: 'Check Live Traffic',
                        callback: checkLiveTraffic2,
                        index:0
                    }],
                    bubblingMouseEvents:false,
                    color: '#'+Dashboard.getRandomRolor(),
                    data:param 
                }).bindPopup(param.text).on('click',onMarkerClick);
                //polylineData[item.name].push(poly_);
                //console.log(polylineHubdatData[param.id]);
                featureHubdatGroup.addLayer(polylineHubdatData[param.id]);
                featureHubdatGroup.addTo(map);
                map.fitBounds(featureHubdatGroup.getBounds());

                if(typeof opMarkerData[param.route_from]=='undefined') opMarkerData[param.route_from] = [];
                var latlngfrom = param.route_from_latlng.split(',');
                var markerContent = `<div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bus Stop</h4>
                        <p class="card-text">`+param.route_from+`</p>
                        
                    </div>
                </div>`;
                var markerContent2 = `<div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bus Stop</h4>
                        <p class="card-text">`+param.route_to+`</p>
                        
                    </div>
                </div>`;                        
                var marker_ = L.marker([latlngfrom[0],latlngfrom[1]],{
                    contextmenu: false,
                    icon: Dashboard.myIcon['bus-terminal'],
                    data:param,
                }).bindPopup(markerContent).on('click',onMarkerClick).addTo(layerGroupShelter);  
                opMarkerData[param.route_from].push(marker_);

                if(typeof opMarkerData[param.route_to]=='undefined') opMarkerData[param.route_to] = [];
                  
                var latlngto = param.route_to_latlng.split(',');
                var marker_ = L.marker([latlngto[0],latlngto[1]],{
                    contextmenu: false,
                    icon: Dashboard.myIcon['bus-terminal'],
                    data:param,
                }).bindPopup(markerContent2).on('click',onMarkerClick).addTo(layerGroupShelter);  
                opMarkerData[param.route_to].push(marker_);    
                layerGroupShelter.addTo(map);
                //alert('show rute');
            }

            function loadBusStop(bus_stop){
                if(bus_stop.length>0){
                    bus_stop.forEach(function(item,index){
                        //console.log(index);
                        //console.log(bus_stop.length);
                        //console.log(item);
                        if(typeof opMarkerData[item.bs_id]=='undefined') opMarkerData[item.bs_id] = [];
                        console.log('check if bus stop is exist');
                        console.log(opMarkerData[item.bs_id].length);
                        if(item.bs_lat!=null && opMarkerData[item.bs_id].length==0){
                            var pos = 'Bus Stop';
                            switch(true){
                                case index==0:
                                    pos = 'Start Point';
                                break;
                                case index==bus_stop.length-1:
                                    pos = 'End Point';
                                break;
                                default:
                                    pos = 'Waypoint';
                                break;
                            }
                            var markerContent = `<div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">`+pos+`</h4>
                                    <p class="card-text">`+item.bs_nm+`</p>
                                    
                                </div>
                            </div>`;   
                            opMarkerData[item.bs_id] = L.marker([item.bs_lat,item.bs_lng],{
                                contextmenu: true,
                                contextmenuWidth: 240,
                                contextmenuItems: [{
                                  text: 'Edit Bus Stop',
                                  callback: editBusstop,
                                  index:0
                                },
                                {
                                  text: 'Set Start Point',
                                  callback: setStartPoint,
                                  index:1
                                },
                                {
                                  text: 'Set Left Point',
                                  callback: setLeftPoint,
                                  index:2
                                },
                                {
                                  text: 'Hapus Bus Stop dari Rute',
                                  callback: delWaypoint,
                                  index:3
                                }],
                                draggable:true,
                                icon: Dashboard.myIcon['bus-terminal'],
                                data:item,
                            }).bindPopup(markerContent).on('click',onMarkerClick).on('dragend',moveBusStop).addTo(layerGroupShelter);  
                        
                        }
                    });
                    map.addLayer(layerGroupShelter);
                }
            }

            function setStartPoint(e){
              Dashboard.currentLeftPoint = e.relatedTarget.options.data;
              console.log(Dashboard.currentLeftPoint);
            }

            function delWaypoint(e){
                
                var dataparam = e.relatedTarget.options.data;
                console.log(dataparam);
                if(dataparam.route_id!=null){
                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Hapus Waypoint "+dataparam.bs_nm+" dari Rute "+dataparam.route_id+" ?",
                        icon: "question",
                        showConfirmButton:true,
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                        focusConfirm:true,
                    }).then(function(willsave) {
                        $.ajax({
                              method: 'post',
                              url:Dashboard.baseUrl+'/main/action/delfromroutesave',
                              data: {
                                  [Dashboard.csrfName]:Dashboard.csrfHash,
                                  route_id:dataparam.route_id,
                                  routes:dataparam.routes,
                                  bs_id:dataparam.bs_id
                              },
                              beforeSend:function(request){
                                  request.setRequestHeader("X-NGI-TOKEN", 'dev');
                                  Dashboard.saveLoading();
                              },
                              success:function(response){
                                  Dashboard.swalClose();
                                  Swal.fire('Sukses', response.message, 'success');
                                  //console.log(Dashboard.currentRoute);
                                  //loadRoute(Dashboard.currentRoute);
                                  Dashboard.vCurLatLngObj = [dataparam.bs_lat,dataparam.bs_lng];
                                  $('#edit_trayek').trigger('select2:select');


                              }
                          });    
                    });
                }else{

                }
            }

            function setLeftPoint(e){
              e.relatedTarget.options.data.route_id = Dashboard.currentRoute.id;
              e.relatedTarget.options.data.routes = Dashboard.currentRoute.routes;  
              Dashboard.currentLeftPoint = e.relatedTarget.options.data;
              console.log(Dashboard.currentLeftPoint);
            }

            function addtoroute(e){
                console.log(e);
                //Dashboard.vCurLatLngObj = e.latlng;
                Dashboard.vCurLatLngObj = [e.relatedTarget.options.data.bs_lat,e.relatedTarget.options.data.bs_lng];
                Dashboard.vCurZoomObj = map.getZoom();
                console.log(map.getZoom());
                if(Dashboard.currentLeftPoint.hasOwnProperty('bs_nm')){
                    Dashboard.currentPoint = e.relatedTarget.options.data;
                    console.log(Dashboard.currentPoint);
                    console.log(Dashboard.currentLeftPoint);
                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Tambahkan Waypoint "+Dashboard.currentPoint.bs_nm+" setelah "+Dashboard.currentLeftPoint.bs_nm+" ?",
                        icon: "question",
                        showConfirmButton:true,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        cancelButtonText: 'Batal',
                        focusConfirm:true,
                    }).then(function(willsave) {

                        $.ajax({
                              method: 'post',
                              url:Dashboard.baseUrl+'/main/action/addtoroutesave',
                              data: {
                                  [Dashboard.csrfName]:Dashboard.csrfHash,
                                  route_id:Dashboard.currentLeftPoint.route_id,
                                  routes:Dashboard.currentLeftPoint.routes,
                                  bs_id_before:Dashboard.currentLeftPoint.bs_id,
                                  bs_id:Dashboard.currentPoint.bs_id
                              },
                              beforeSend:function(request){
                                  request.setRequestHeader("X-NGI-TOKEN", 'dev');
                                  Dashboard.saveLoading();
                              },
                              success:function(response){
                                  Dashboard.swalClose();
                                  Swal.fire('Sukses', response.message, 'success');
                                  //loadRoute(Dashboard.currentRoute);
                                  $('#edit_trayek').trigger('select2:select');




                              }
                          });    
                    });

                }else{
                    Swal.fire('Warning', 'Anda belum menentukan Left Point', 'warning');
                }    
            }

            function editBusstop(e){
                $("#bus-stop-modal").modal("show");
              
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/editbusstop',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash,
                        item:e.relatedTarget.options.data
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        $('#bus-stop-modal .modal-body').html('checking data');
                    },
                    success:function(response){
                        $('#bus-stop-modal .modal-body').html(response);
                    }
                });
            }

            function moveBusStop(e){
                console.log(e);
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Simpan lokasi bus stop terbaru ?",
                    icon: "question",
                    showConfirmButton:true,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                    focusConfirm:true,
                }).then(function(willsave) {

                    var vbs_id = e.target.options.data.bs_id;
                    var vbs_lat = e.target._latlng.lat;
                    var vbs_lng = e.target._latlng.lng;
                    console.log(vbs_lat+','+vbs_lng);
                    
                    if(willsave.value) {
                        Dashboard.vCurZoomObj = map.getZoom();
                        Dashboard.vCurLatLngObj = e.target._latlng;
                        Dashboard.saveLoading();
                        Dashboard.updateLocation(vbs_id,vbs_lat,vbs_lng);
                        // if($('#edit_trayek').val()){    
                        //     $('#edit_trayek').trigger('select2:select');
                            
                        // }
                    }else{
                        opMarkerData[vbs_id].setLatLng([vbs_lat,vbs_lng]); 
                    }
                });
            }
            
            function getDistance(origin, destination) {
                var lon1 = toRadian(origin[1]),
                lat1 = toRadian(origin[0]),
                lon2 = toRadian(destination[1]),
                lat2 = toRadian(destination[0]);

                var deltaLat = lat2 - lat1;
                var deltaLon = lon2 - lon1;

                var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
                var c = 2 * Math.asin(Math.sqrt(a));
                var EARTH_RADIUS = 6371;
                return c * EARTH_RADIUS * 1000;
            }

            function toRadian(degree) {
                return degree*Math.PI/180;
            }

            function isInsideAngle(rad,x){
                var left = rad - 22;
                var right = rad + 22;

                if(left <= -180){
                    return (x >= (360+left) && x <= 180) || (x <= right && x >= -180);
                }else if(right >= 180){
                    return (x >= left && x <= 180) || (x <= (-1 * (360-right)) && x >= -180);
                }else{
                    return x >= left && x <= right;
                }
            }

            function createAndStorePolygon(angle, coorPolygon, addedPolygon, newShelter, oldShelter, cases,grouping){
                if(isInsideAngle(currentAngle,angle) && cases != 'case-2'){
                  console.log('gabung -> '+currentAngle+' '+angle+' ('+x+')');  
                  currentPolygon.splice.apply(currentPolygon, [currentPolygon.length/2, 0].concat(addedPolygon));
                }else{
                  first = currentPolygon[0];
                  last = currentPolygon[currentPolygon.length-1];
                  if(currentPolygon.length>=2){
                      if(first == last){
                      poly = L.polygon(currentPolygon, { color: 'red', data: {"newshelter": newShelter, "oldshelter": oldShelter}}).addTo(layerPolyGroup);

                      poly.bindPopup(cases+' ('+x+')<br/><i class="dotstart"></i> : ' + oldShelter.lat + '<br/><i class="dotstop"></i> : ' + newShelter.lat
                        +'</br>&nbsp;<i class="fa fa-chevron-right angle"></i> : '+currentAngle.toFixed(2)
                        +'</br>&nbsp;<i class="fa fa-chevron-right angle"></i> : '+currentPolygon[0].lat+','+currentPolygon[0].lng+'', {
                          permanent: false, 
                          direction: 'top'
                      });
                  
                      tempPoly[x] = {
                        angle:currentAngle.toFixed(0), 
                        lat:currentPolygon[0].lat,
                        lng:currentPolygon[0].lng,
                        'polygon': currentPolygon.map(function(x){ return x.lat+' '+x.lng; }).join(', '),
                        os:oldShelter.lat,
                        ns:newShelter.lat,
                        toward:[newShelter.lat,newShelter.lng],
                      };
                      x++;
                    }else{
                      poly = L.polygon(currentPolygon, { color: 'purple', data: {"newshelter": newShelter, "oldshelter": oldShelter}}).addTo(layerPolyGroup);

                      poly.bindPopup(cases+' ('+x+')<br/><i class="dotstart"></i> : ' + oldShelter.lat + '<br/><i class="dotstop"></i> : ' + newShelter.lat
                        +'</br>&nbsp;<i class="fa fa-chevron-right angle"></i> : '+currentAngle.toFixed(2)
                        +'</br>&nbsp;<i class="fa fa-chevron-right angle"></i> : '+currentPolygon[0].lat+','+currentPolygon[0].lng+'', {
                          permanent: false, 
                          direction: 'top'
                      });
                      map.flyTo(currentPolygon[0],18);
                    }
                    //console.log(oldShelter);
                  }
                  currentAngle = angle;
                  currentPolygon = coorPolygon;
                }
            }

            function makeid(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                  result += characters.charAt(Math.floor(Math.random() * charactersLength));
                  counter += 1;
                }

                return result;
            }
    
            var polygenap = [];
            var xx = 0;
            var x = 0;
            var first;
            var last;
            var poly;
            var currentAngle = 360;
            var currentPolygon = [];
            var tempPoly = [];
            var layerPolyGroup = L.layerGroup();

            function createAutoZone(e){
              console.log(e.relatedTarget.options.data);

              polygenap = [];
              xx = 0;
              x = 0;
              currentAngle = 360;
              currentPolygon = [];
              tempPoly = [];
              layerGroup = L.layerGroup();
              var stops_ = e.relatedTarget.options.data;
              // console.log(stops_);
              var ret = e.relatedTarget;
              var itot = (ret._latlngs.length-1);
              $.each(ret._latlngs,function(index,item){
                console.log(index+' dari '+itot);
                console.log('latlng ke '+index+' : '+ret._latlngs[index]);


              });
              map.addLayer(layerPolyGroup);
            }
            
            // Dashboard.monitoringRoute();
       
       

            $(document).on('click','#btn-update-rute',function(e){
                e.preventDefault();
                var $form = $("#div-rute").find('form');
                var dataparam = Dashboard.getFormData($form);
                $.ajax({
                      type: "POST",
                      url: Dashboard.baseUrl+'/api/v1/updateroute',
                      data: {
                        dataparam
                      },
                      beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.saveLoading();
                      },
                      success: function(response) {
                          var ret = $.parseJSON(response);
                          if(ret.success==true){
                                Swal.close();
                                Swal.fire("sukses",ret.message,"sukses");
                                polylineData[dataparam.id].options.data.name = dataparam.name;
                                polylineData[dataparam.id].bindPopup(dataparam.name);
                                map.closePopup();
                          }
                      }
                });
                return false;
            });

            $("#widget-04 .jenroute").select2({
                placeholder: '<span style="font-size:12px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Jenis Rute</span>',
                allowClear: true,
                // data:Dashboard.vdata_bus.results,
                escapeMarkup : function(markup) { return markup; }
            });

            // $('#find_bus').on('select2:select', function (e) {
            //       var data = e.params.data;
            //       vehicleMarkers[data.id].openPopup();
            //       map.flyTo(vehicleMarkers[data.id].getLatLng(),14);
            // });

            // $('#find_bus').on('select2:clear', function (e) {
            //     var data = e.params.data;
            //     vehicleMarkers[data[0].id].closePopup();
            //     centerRoute(Dashboard.currentRoute,polylineData);
            // });

            $(document).on('change', '#widget-04 #start_point', function(e) {
                $.ajax({
                    type:'post',
                    url: Dashboard.baseUrl+'/main/ajax/jsonbusstopbyid',
                    data:{ 
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      id: this.value
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                    },
                    success:function(response){
                        var ret = JSON.parse(response)

                        var preview = $("#widget-04 #end_point option:selected" ).text();

                        if($('#widget-04 .mb-3').hasClass("preview")) {
                            $('#widget-04 .preview').html('')

                            $('#widget-04 #end_point').closest('.mb-3').after(`
                                <div class="mb-3 preview">
                                    <label for="example-text-input" class="form-label">Rute</label>
                                    <input class="form-control" type="text" value="${ret.bs_nm} - ${preview}" name="" id="preview" disabled>
                                </div>
                            `)
                        } else {
                            $('#widget-04 #end_point').closest('.mb-3').after(`
                                <div class="mb-3 preview">
                                    <label for="example-text-input" class="form-label">Rute</label>
                                    <input class="form-control" type="text" value="${ret.bs_nm}" name="" id="preview" disabled>
                                </div>
                            `)
                        }
                    }
                });
            });

            $(document).on('change', '#widget-04 #end_point', function(e) {
                $.ajax({
                    type:'post',
                    url: Dashboard.baseUrl+'/main/ajax/jsonbusstopbyid',
                    data:{ 
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      id: this.value
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                    },
                    success:function(response){
                        var ret = JSON.parse(response)

                        var preview = $("#widget-04 #start_point option:selected" ).text();

                        if($('#widget-04 .mb-3').hasClass("preview")) {
                            $('#widget-04 .preview').html('')

                            $('#widget-04 #end_point').closest('.mb-3').after(`
                                <div class="mb-3 preview">
                                    <label for="example-text-input" class="form-label">Rute</label>
                                    <input class="form-control" type="text" value="${preview} - ${ret.bs_nm}" name="" id="preview" disabled>
                                </div>
                            `)
                        } else {
                            $('#widget-04 #end_point').closest('.mb-3').after(`
                                <div class="mb-3 preview">
                                    <label for="example-text-input" class="form-label">Rute</label>
                                    <input class="form-control" type="text" value="${ret.bs_nm}" name="" id="preview" disabled>
                                </div>
                            `)
                        }
                    }
                });
            });

            $(document).on('click','#btn-save-trayek',function(e){
                e.preventDefault();
                var $form = $("#widget-04").find('form');
                var dataparam = Dashboard.getFormData($form);

                console.info('party time')

                 $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/action/addtrayeksave',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash,
                        dataparam
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.saveLoading();
                    },
                    success:function(response){
                        Dashboard.swalClose();

                        var ret = $.parseJSON(response);

                        if(ret.success==true){
                            $('#widget-04 form').trigger('reset')
                            $('#widget-04 #start_point').val("").trigger("change")
                            $('#widget-04 #end_point').val("").trigger("change")

                            if($('#widget-04 .mb-3').hasClass("preview")) {
                                $('#widget-04 .preview').html('')
                            }

                            $('#widget-04').hide(); 

                            Swal.fire('Sukses', ret.message, 'success');
                        } else {
                            Swal.fire('Warning', ret.message, 'warning');
                        }
                    }, error: function(xhr, status, error) {
                        Dashboard.swalClose();

                        var err = eval("(" + xhr.responseText + ")");

                        var message = err.message
                        if(message.includes('Duplicate entry')) {
                            Swal.fire('Warning', 'Data sudah terinput sebelumnya', 'warning')
                        } else {
                            Swal.fire('Warning', err.message, 'warning')
                        }
                    }
              });    
            });

            $(document).on('click','#btn-update-bus',function(e){
                e.preventDefault();
                var $form = $("#div-bus").find('form');
                var dataparam = Dashboard.getFormData($form);
                $.ajax({
                      type: "POST",
                      url: Dashboard.baseUrl+'/api/v1/updatebus',
                      data: {
                        dataparam
                      },
                      beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.saveLoading();
                      },
                      success: function(response) {
                          var ret = $.parseJSON(response);
                          if(ret.success==true){
                                Swal.close();
                                Swal.fire("sukses",ret.message,"sukses");
                                vehicleMarkers[dataparam.gps_sn].options.data.route_id = dataparam.route_id;
                                vehicleMarkers[dataparam.gps_sn].options.data.routename = Dashboard.routes.filter(function c(rute){ return rute.id == dataparam.route_id });
                                Dashboard.setBusTooltip(vehicleMarkers[dataparam.gps_sn],vehicleMarkers[dataparam.gps_sn].options.data);
                                map.closePopup();
                          }
                      }
                  });
                return false;
            });

            $(document).on('click','#btn-update-busstop',function(e){
                e.preventDefault();
                var $form = $("#div-busstop").find('form');
                var dataparam = Dashboard.getFormData($form);
                $.ajax({
                      type: "POST",
                      url: Dashboard.baseUrl+'/main/action/savebusstop',
                      data: {
                        dataparam,
                        [Dashboard.csrfName]:Dashboard.csrfHash
                      },
                      beforeSend: function(request) {
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.saveLoading();
                      },
                      success: function(response) {
                          var ret = $.parseJSON(response);
                          if(ret.success==true){
                                Swal.close();
                                Swal.fire("sukses",ret.message,"sukses");
                                map.removeLayer(Dashboard.busStopMarker);
                                loadBusStopNoRoute();
                          }
                      }
                });
                return false;
            });

            

            $(document).on("click","#btn-update-jalur",function() {
                // $(this).toggleClass('active');
                // if($(this).hasClass('active')){
                  // $('.leaflet-container').css('cursor','initial');  
                  // try{
                    console.info(polylineData);
                    //console.log(polylineData.length);
                    $('.leaflet-container').css('cursor','initial'); 
                    for(index in polylineData){
                        polylineData[index].enableEdit();
                    }
                    
                    // polylineData.enableEdit();
                  // }catch(e){
                    // alert('No Routes Appear');
                  // }
                // }else{
                //   $('.leaflet-container').css('cursor','grab');
                //   try{
                //     polyline.disableEdit();
                //   }catch(e){
                //     alert('No Routes Appear');
                //   }
                  
                // }
                // return false;
              });        
        

            var pulsingIcon = L.icon.pulse({iconSize:[10,10],color:'#FF0000',fillColor:'#FF0000'});
            var myIconCircle = L.icon({
              iconUrl: Dashboard.baseUrl+'/assets/images/Circle.svg',
              iconSize:     [16, 16],
              //shadowSize:   [12, 12],
              iconAnchor:   [8, 9],
              shadowAnchor: [0, 0],
              popupAnchor:  [0, 0]
            }); 
            var vStartLatLng,vEndLatLng;
            var vCreateMarker;
            var vCreateMarker2;
            var polylines = [];
            var waypoints = [];

            function getCoordinates(e){
                navigator.clipboard.writeText(e.latlng.lat+','+e.latlng.lng);
            }

            function setStartCoordinates(e){
              vStartLatLng = e.latlng;
              console.info("diyar mamen " + vStartLatLng)
              vCreateMarker  = L.marker(e.latlng, {
                  contextmenu: false,
                  contextmenuWidth: 350,
                  contextmenuItems:[
                    {
                        text:'Hapus Rute Awal',
                        callback:removeStartPoint,
                    }
                  ],
                  icon: myIconCircle,
                  draggable: true,
                  //rotationAngle: ret.angle,
                  //kor:ret.kor,
                  //data:
                  }).addTo(map);
              vCreateMarker.on('dragend',function(e){
                //console.log(e);
                vStartLatLng = e.target._latlng;
              });
            }

            function addCCTV(e){  
              $('#cctv-modal').modal('show');
              $('#cctv_latlng').val(e.latlng.lat+' '+e.latlng.lng);
              $('#cctv_name').focus();
            }

            function removeStartPoint(e){
            alert(e);
        }

        function loadBusStopNoRoute(){
            $.ajax({
                type:'post',
                url: Dashboard.baseUrl+'/main/ajax/busstopnoroute_data',
                data:{ 
                  [Dashboard.csrfName]:Dashboard.csrfHash
                },
                beforeSend: function(request) {
                    request.setRequestHeader("X-NGI-TOKEN", 'dev');
                },
                success:function(response){
                    var ret = $.parseJSON(response);
                    ret.bus_stop.forEach(function(item,index){
                        loadMarkerNoroute(item);
                    });
                }
            });
        }

        function loadMarkerNoroute(item){
          if( typeof Dashboard.busStopMarkerNoRoute === 'undefined' ){
                Dashboard.busStopMarkerNoRoute = {};
          }

          var markerContent = `<div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bus Stop No Rute</h4>
                                <p class="card-text">`+item.bs_nm+`</p>
                                
                            </div>
                        </div>`;
          Dashboard.busStopMarkerNoRoute[item.bs_id] = L.marker([item.bs_lat,item.bs_lng],{
              contextmenu: true,
              contextmenuWidth:359,
              contextmenuItems:[
                {
                    text:'Hapus Bus Stop ini',
                    callback:deletBusStop,
                },
                {
                    text:'Tambahkan ke Rute',
                    callback:addtoroute,
                }
              ],
              icon: Dashboard.myIcon['bus-terminal'],
              data:item,
              draggable:true,
          }).bindPopup(markerContent).on('click',onMarkerClick).addTo(layerGroupShelterNoRoute);  
          
          Dashboard.busStopMarkerNoRoute[item.bs_id].on('dragend',function(e){
                Swal.fire({
                    title: "Konfirmasi",
                    text: "Pindah lokasi Bus Stop ?",
                    icon: "question",
                    showConfirmButton:true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    focusConfirm:true,
                }).then(function(willsave) 
                    {
                        var vbs_id = e.target.options.data.bs_id;
                        var vbs_lat = e.target._latlng.lat.toFixed(6);
                        var vbs_lng = e.target._latlng.lng.toFixed(6);
                        Dashboard.vCurLatLngObj = e.target._latlng;
                        if(willsave.value) {
                            Dashboard.saveLoading();
                            Dashboard.updateLocation(vbs_id,vbs_lat,vbs_lng);
                            if($('#edit_trayek').val()){
                                $('#edit_trayek').trigger('select2:select');
                            }
                        }else{
                            Dashboard.busStopMarkerNoRoute[item.bs_id].setLatLng([item.bs_lat,item.bs_lng]);
                            
                        }
                    }
                );
          })
          //layerGroupShelterNoRoute.addTo(map);
        }

        function deletBusStop(e){
            console.log(e);
            console.log(e.relatedTarget.options.data.bs_id);
        }

        // ditutup dulu ya mas buat demo posko dan vcall
        loadBusStopNoRoute();

        function saveRoad(e){
            // $("#road-modal").modal("show");
            // $('#latlng_start').val(vStartLatLng.lat+' '+vStartLatLng.lng);
            // $('#latlng_end').val(vEndLatLng.lat+' '+vEndLatLng.lng);
            // $('#road_name').focus(); 

            $("#trayek").modal("show");

            console.info(vStartLatLng.lat+' '+vStartLatLng.lng)
            console.info(vEndLatLng.lat+' '+vEndLatLng.lng)
            console.info($('#road_name').focus())

            $.ajax({
                method: 'post',
                url:Dashboard.baseUrl+'/main/action/addtrayeksave',
                data: {
                    [Dashboard.csrfName]:Dashboard.csrfHash,
                    or_lat: vStartLatLng.lat,
                    or_lng: vStartLatLng.lng,
                    tw_lat: vEndLatLng.lat,
                    tw_lng: vEndLatLng.lng
                    // route_id:Dashboard.currentLeftPoint.route_id,
                    // routes:Dashboard.currentLeftPoint.routes,
                    // bs_id_before:Dashboard.currentLeftPoint.bs_id,
                    // bs_id:Dashboard.currentPoint.bs_id
                },
                beforeSend:function(request){
                    request.setRequestHeader("X-NGI-TOKEN", 'dev');
                    Dashboard.saveLoading();
                },
                success:function(response){
                    Dashboard.swalClose();
                    Swal.fire('Sukses', response.message, 'success');
              }
          });    
        }

        // $(document).on('click','#btn-save-trayek',function(e){
        //     e.preventDefault();
        //     var $form = $("#trayek").find('form');
        //     var dataparam = Dashboard.getFormData($form);
        //     console.info("oke diyar mamen")
        //     console.info(dataparam)
        //     // $.ajax({
        //     //       type: "POST",
        //     //       url: Dashboard.baseUrl+'/main/action/savebusstop',
        //     //       data: {
        //     //         dataparam,
        //     //         [Dashboard.csrfName]:Dashboard.csrfHash
        //     //       },
        //     //       beforeSend: function(request) {
        //     //         request.setRequestHeader("X-NGI-TOKEN", 'dev');
        //     //         Dashboard.saveLoading();
        //     //       },
        //     //       success: function(response) {
        //     //           var ret = $.parseJSON(response);
        //     //           if(ret.success==true){
        //     //                 Swal.close();
        //     //                 Swal.fire("sukses",ret.message,"sukses");
        //     //                 map.removeLayer(Dashboard.busStopMarker);
        //     //                 loadBusStopNoRoute();
        //     //           }
        //     //       }
        //     // });
        //     return false;
        // });

        function setEndCoordinates(e){
          vEndLatLng = e.latlng; 
          vCreateMarker2  = L.marker(e.latlng, {
              contextmenu: false,
              contextmenuWidth: 350,
              contextmenuItems:[
                {
                    text:'Hapus Rute Awal',
                    callback:removeStartPoint,
                }
              ],
              icon: myIconCircle,
              draggable: true,
              }).addTo(map);
          vCreateMarker2.on('dragend',function(e){
            vEndLatLng = e.target._latlng;
            e.latlng = e.target._latlng;
            setEndCoordinates(e);
          });
         
         if(vStartLatLng.lat && vEndLatLng.lat){
            console.info('oke diyar mamen ' + vStartLatLng.lat + ' ' + vEndLatLng.lat)
            liveTrafficFromPoint(vStartLatLng,vEndLatLng,'Unnamed');
         }
        }

        function clearRoad(e){
            map.removeLayer(vCreateMarker);
            map.removeLayer(vCreateMarker2);
            for(index in polylines){
               map.removeLayer(polylines[index]);
            }
            for(index in waypoints){
               map.removeLayer(waypoints[index]);
            }
        }

        function liveTrafficFromPoint(vStartLatLng,vEndLatLng,vRoadName){
            $.ajax({
                type:'post',
                url: Dashboard.baseUrl+'/api/v1/getlivetraffic',
                data:{ 
                  origin: vStartLatLng.lat+','+vStartLatLng.lng,
                  destination: vEndLatLng.lat+','+vEndLatLng.lng,
                  road_name:vRoadName,
                  [Dashboard.csrfName]:Dashboard.csrfHash
                },
                beforeSend: function(request) {
                    request.setRequestHeader("X-NGI-TOKEN", 'dev');
                },
                success:function(response){
                  //try{
                  

                  
                  console.log('output...');

                  
                  var ret = $.parseJSON(response);
                  console.log(ret);
                  //console.log(ret);
                  var distance = ret.routes[0].legs[0].distance.value/1000;
                  var duration = ret.routes[0].legs[0].duration.value/60/60;
                  var duration_in_traffic = ret.routes[0].legs[0].duration_in_traffic.value/60/60;
                  var trafficStatus = (duration/duration_in_traffic).toFixed(2);

                  var durationText = ret.routes[0].legs[0].duration.text;
                  var duration_in_trafficText = ret.routes[0].legs[0].duration_in_traffic.text;
                  var distanceText = ret.routes[0].legs[0].distance.text;

                  for(index in ret.routes[0].legs[0].steps){
                      //console.log(vRoadName+' index - '+index);
                      //console.log(vRoadName+' index - '+parseInt(index)+1);
                      //console.log(vRoadName+' length - '+ret.routes[0].legs[0].steps.length);
                      var vLatLng = [ret.routes[0].legs[0].steps[index].start_location.lat,ret.routes[0].legs[0].steps[index].start_location.lng];
                      var htmlInstructions = ret.routes[0].legs[0].steps[index].html_instructions;
                      var distance_ = ret.routes[0].legs[0].steps[index].distance.value/1000;
                      var distance_Text = ret.routes[0].legs[0].steps[index].distance.text;
                      var duration_ = ret.routes[0].legs[0].steps[index].duration.value/60/60;
                      var duration_Text = ret.routes[0].legs[0].steps[index].duration.text;
                      var avgSpeedLegs = (distance_/duration_).toFixed(2);
                      var vColorLegs = "#0fafff";

                      switch(true){
                        case (avgSpeedLegs<=30 && avgSpeedLegs>15):
                          vColorLegs = "#ffa121";
                          var pulsingIcon = L.icon.pulse({iconSize:[10,10],color:'#ffa121',fillColor:'#ffa121'});
                        break;
                        case (avgSpeedLegs<=15):
                          vColorLegs = "#ff0000";
                          var pulsingIcon = L.icon.pulse({iconSize:[10,10],color:'#ff0000',fillColor:'#ff0000'});
                        break;

                      }
                      console.log('hapus jalan '+index);
                      
                      polylines[index] = L.Polyline.fromEncoded(ret.routes[0].legs[0].steps[index].polyline.points,{ 
                        contextmenu: true,
                        contextmenuWidth: 350,
                        contextmenuItems:[{
                              text:'Hapus Jalan '+vRoadName,
                              callback:function(){ return delRoad(vRoadName); },
                              index:4
                        },
                        {
                              text:'Simpan Rute ini ',
                              callback:saveRoad,
                              index:5
                        },{
                              text: 'Clear Unnamed Rute Jalan',
                              callback: clearRoad,
                              index: 8
                        }],
                        customData:{
                          roadname: vRoadName,
                          data: ret.routes[0].legs[0].steps
                        },
                        stroke: true,
                        color:vColorLegs,
                        weight:6
                        //fill:true,
                        //fillColor:,
                        //fillOpacity:1                        
                      }).addTo(map);
                      // polylines[index].on('mouseover', function(e) {
                      //   var layer = e.target;

                      //   console.log(layer.options.customData);
                      // });

                      waypoints[index] = L.marker(vLatLng, {
                        contextmenu: false,
                        icon: myIconCircle,
                        //rotationAngle: ret.angle,
                        //kor:ret.kor,
                        //data:
                        }).addTo(layerGroupWaypoints).bindTooltip(htmlInstructions+'<br/>Distance '+distance_Text
                        +'<br/> Duration '+duration_Text
                        +'<br/> AVG Speed '+(distance_/duration_).toFixed(2)+' km/hr',{permanent:false});

                     if((parseInt(index)+1)==ret.routes[0].legs[0].steps.length){
                        //console.log(vRoadName);
                        var avgSpeed = (parseFloat(distance)/(parseFloat(duration_in_traffic))).toFixed(2);
                        var vLatLng2 = [ret.routes[0].legs[0].steps[index].end_location.lat,ret.routes[0].legs[0].steps[index].end_location.lng];

                        switch(true){
                          case (avgSpeed<=30 && avgSpeed>15):
                            //vColorLegs = "#ffa121";
                            var pulsingIcon = L.icon.pulse({iconSize:[10,10],color:'#ffa121',fillColor:'#ffa121'});
                          break;
                          case (avgSpeed<=15):
                            //vColorLegs = "#ff0000";
                            var pulsingIcon = L.icon.pulse({iconSize:[10,10],color:'#ff0000',fillColor:'#ff0000'});
                          break;

                        }

                        waypoints[ret.routes[0].legs[0].steps.length] = L.marker(vLatLng2, {
                        contextmenu: false,
                        icon: ((avgSpeed<=30)?pulsingIcon:myIconCircle),
                        //rotationAngle: ret.angle,
                        //kor:ret.kor,
                        //data:
                        }).addTo(layerGroupWaypoints).bindTooltip(vRoadName
                        +'<br/>Distance : '+distanceText
                        +'<br/>Duration in traffic : '+duration_in_trafficText
                        +'<br/>Normal Duration : '+durationText
                        +'<br/>Avg Speed : '+avgSpeed+' km/hr',{permanent:false});
                        layerGroupWaypoints.addTo(map);
                        var x = parseFloat(avgSpeed).toFixed(0);
                        saveLog(vRoadName,x,durationText,duration_in_trafficText);
                        //console.log(x);
                        switch(true){
                          case (x>0 && x<=16):
                              //console.log('slow');
                              if(vRoadName!='Unnamed'){
                                
                                // sendtoBot('_<?=date('d m Y H:i:s')?>_\r*'+vRoadName+'*'
                                // +'\rDistance : '+distanceText.replace(".", "\\.")
                                // +'\rDuration : '+duration_in_trafficText.replace(".", "\\.")
                                // +'\rAvg Speed : '+String(avgSpeed).replace(".", "\\.")+' km/hr\rTerpantau *sangat padat* \r [Link to Open](https://www.google.com/maps/dir/'+
                                // vStartLatLng.lat+','+vStartLatLng.lng+'/'+vEndLatLng.lat+','+vEndLatLng.lng+')');
                                
                              }
                          break;
                          case (x>16 && x<=25):
                              if(vRoadName!='Unnamed'){
                                
                                // sendtoBot('_<?=date('d m Y H:i:s')?>_\r*'+vRoadName+'*'
                                // +'\rDistance : '+distanceText.replace(".", "\\.")
                                // +'\rDuration : '+duration_in_trafficText.replace(".", "\\.")
                                // +'\rAvg Speed : '+String(avgSpeed).replace(".", "\\.")+' km/hr\rTerpantau *padat* \r [Link to Open](https://www.google.com/maps/dir/'+
                                // vStartLatLng.lat+','+vStartLatLng.lng+'/'+vEndLatLng.lat+','+vEndLatLng.lng+')');
                                
                              }
                          break;
                          default:
                            if(vRoadName!='Unnamed'){
                              
                              // sendtoBot('_<?=date('d m Y H:i:s')?>_\r*'+vRoadName+'*'
                              //   +'\rDistance : '+distanceText.replace(".", "\\.")
                              //   +'\rDuration : '+duration_in_trafficText.replace(".", "\\.")
                              //   +'\rAvg Speed : '+String(avgSpeed).replace(".", "\\.")+' km/hr\rTerpantau *lancar* \r [Link to Open](https://www.google.com/maps/dir/'+
                              //   vStartLatLng.lat+','+vStartLatLng.lng+'/'+vEndLatLng.lat+','+vEndLatLng.lng+')');
                                
                            }
                          
                          break;
                        }
                        if(parseFloat(avgSpeed)<40){
                            
                        }

                     }   

                  }
                  //console.log(vRoadName+' '+duration[0]+' '+duration_in_traffic[0]+' '+trafficStatus);
                  
                }
              });
            }

            function saveLog(road_names,avg_speeds,durations,duration_in_traffics){
                //console.log(e);
                // $.ajax({
                //     type:'post',
                //     url:Dashboard.baseUrl+'main/action/saveLog',
                //     data:{ 
                //       [Dashboard.csrfName]:Dashboard.csrfHash,
                //       road_name:road_names,
                //       avg_speed:avg_speeds,
                //       duration:durations,
                //       duration_in_traffic:duration_in_traffics
                //     },
                //     beforeSend:function(){
                      
                //     },
                //     success:function(response){
                //       var ret = $.parseJSON(response);
                //       console.log(ret);
                //     }
                // });
                
            }


            function delRoad(vRoadName){
                //console.log(e);
                if(confirm('Yakin Hapus Jalan '+vRoadName)){
                    $.ajax({
                      type:'post',
                        url:Dashboard.baseUrl+'main/page/delRoad',
                        data:{ 
                          [Dashboard.csrfName]:Dashboard.csrfHash,
                          road_name:vRoadName
                        },
                        beforeSend:function(){
                          
                        },
                        success:function(response){
                          var ret = $.parseJSON(response);
                          alert(ret.text);
                          for(index in polylines){
                              map.removeLayer(polylines[index]);
                          }
                          $('#a-roadlist').trigger('click');
                          loadRoadDataIntoMap();
                        }
                    });
                }
            }

            function noThing(){}

            function sendtoBot(vChat){
                $.ajax({
                type:'post',
                  url:Dashboard.baseUrl+'api/sendtobot',
                  data:{ 
                    [Dashboard.csrfName]:Dashboard.csrfHash,
                    chat:vChat
                  },
                  beforeSend:function(){
                    
                  },
                  success:function(response){
                  }
                });
            }

            var markerSearch;

            function createMarkerSearch(latlngs){
               // var data = e.relatedTarget.options.data;
                

                markerSearch = L.marker(latlngs,{
                    contextmenu: true,
                    contextmenuWidth: 350,
                    contextmenuItems:[
                        {
                        text:'Jadikan Bus Stop',
                        callback:addBusStop,
                        }
                    ],
                    draggable:true,

                })
                .bindPopup($('#hubdatsearch').val()).on('click',onMarkerClick); 
                
                markerSearch.addTo(map);
            }

            function removeMarkerSearch(){
                try{
                    map.removeLayer(markerSearch);
                }catch(e){

                }
            }
       
            //$('.hubdatsearch-frame').css('display','none');
            $('#widget-03').css('display', 'none');
            $('#widget-03').hide();
            $('.search-wrap').after('<div class="hubdatsearch-frame"></div>');
            $('.hubdatsearch-frame').css('display','none');

            $(window).on('keyup',function(e){
                if(e.keyCode==27){
                    $('#widget-03').hide();
                    $('.hubdatsearch-frame').css('display','none');
                }
            });

            $('#hubdatsearch').on('keyup', debounce(function(e){
                let $this = $(this);
                if($(this).val()==''){
                    $('.hubdatsearch-frame').css('display','none');
                }else{
                    $('.hubdatsearch-frame').css('display','block');
                    $('#widget-03').css('display', 'none');
                    $('.poi-item').remove();

                    $.ajax({
                        method: 'post',
                        url:Dashboard.baseUrl+'/main/ajax/jsonSearchAll',
                        data: {
                            [Dashboard.csrfName]:Dashboard.csrfHash,
                            paramName: $this.val()
                        },
                        success:function(result){
                            $('.hubdatsearch-frame').css('display','block');
                            $('.hubdatsearch-frame').removeClass('poi-detail');
                            $('.poi-item-detail').remove();

                            var ret = $.parseJSON(result);
                            console.log(ret.length);
                            ret.forEach(function(item,index){
                                let element = `<div class="poi-item" style="padding: 10px;" data-searchid=${item.place_id} data-category=${item.place_category}>
                                                    <img alt="" jstcache="61" src="//maps.gstatic.com/consumer/images/icons/2x/place_grey650.png" class="hCgzhd" jsan="7.hCgzhd,8.src,0.alt" style="width: 20px"> 
                                                    ${item.place_name}
                                                </div>`;

                                $('.hubdatsearch-frame').append(element);
                            });

                        },
                        error: function(){

                        }
                    });
                }            
            }, 500));

            $(document).on('click', '.poi-item', function(){
                let $this = $(this);

                $.ajax({
                    url : Dashboard.baseUrl + '/main/ajax/jsonSearchById',
                    type : 'post',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash,
                        id : $this.data('searchid'),
                        category : $this.data('category'),
                    },                
                    dataType: 'json',
                    success: function(result){
                        Map_.removeMarker(map);
                        $('.poi-item').remove();
                        $('.hubdatsearch-frame').addClass('poi-detail');
                        var petugasEl = '';
                        if(result.hasOwnProperty('petugas')){
                            var petugas = JSON.parse(result.petugas);
                            
                            petugas.forEach(function(item,index){
                                petugasEl += addListCall(item, result.id,result.type);
                            });
                        }else{

                        }
                        let element = `<div class="poi-item-detail" data-searchid=${result.id}>
                                                <img alt="" jstcache="61" src="https://mitradarat.dephub.go.id/${result.place_img}" class="hCgzhd" jsan="7.hCgzhd,8.src,0.alt" style="width: 100%"> 
                                                <div style="padding: 12px">
                                                    <h5 style="font-weight: 400; padding-bottom: 12px">${result.place_name}</h5>
                                                    <div style="padding-bottom: 12px">
                                                        ${result.place_about ? result.place_about : '-' }
                                                    </div>
                                                    <ul class="list-unstyled chat-list" style="padding-right: 12px">
                                                        ${petugasEl}
                                                    </ul>
                                                </div>
                                            </div>`;

                        $('.hubdatsearch-frame').append(element);

                        var _pos = result.place_latlong.split(",");
                        var location = new L.latLng(_pos[0],_pos[1]);

                        Map_.marker = L.marker(location, {
                            contextmenu: false,
                            draggable: false,
                        }).addTo(map);

                        map.flyTo(location,14);

                    },
                    error: function(){

                    }
                });
            })

            $('#bus-modal').on('shown.bs.modal', function() {
                $(document).off('focusin.modal');
            });

            $(document).on('click','#edit-bus',function(e){
                $("#bus-modal").modal("show");
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/api/v1/loadopsbus',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        $('#bus-modal .modal-body').html('checking data');
                    },
                    success:function(response){
                        $('#bus-modal .modal-body').html(response);

                    }
                });
            });

            $(document).on('click','#aduan-btn',function(e){
                $("#aduan-modal").modal("show");
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/api/v1/loadaduan',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        $('#aduan-modal .modal-body').html('checking data');
                    },
                    success:function(response){
                        $('#aduan-modal .modal-body').html(response);

                    }
                });
            });

            function dragElement(elmnt) {
              var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
              if (document.getElementById(elmnt.id + "-header")) {
                /* if present, the header is where you move the DIV from:*/
                document.getElementById(elmnt.id + "-header").onmousedown = dragMouseDown;
                console.log('dragMouseDown');
              } else {
                /* otherwise, move the DIV from anywhere inside the DIV:*/
                elmnt.onmousedown = dragMouseDown;
                console.log('dragMouseDown');
              }

              function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY;
                console.log(pos3+' '+pos4);
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                
                elmnt.style.top = ((elmnt.offsetTop - pos2)<65?65:(elmnt.offsetTop - pos2)) + "px";
                elmnt.style.left = ((elmnt.offsetLeft - pos1)<20?20:(elmnt.offsetLeft - pos1)) + "px";
                console.log(elmnt.style.top);
                console.log(elmnt.style.left);
              }

              function closeDragElement() {
                /* stop moving when mouse button is released:*/
                document.onmouseup = null;
                document.onmousemove = null;
              }
            }

            dragElement(document.getElementById('widget-01'));
            dragElement(document.getElementById('widget-02'));
            dragElement(document.getElementById('widget-03'));
            dragElement(document.getElementById('widget-04'));

            

            function loadposko(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonposko',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.pageLoading('loading posko');
                    },
                    success:function(response){
                        Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            
                            var _pos = item.posko_mudik_latlong.split(",");
                            item.posko_mudik_latlong = new L.latLng(_pos[0],_pos[1]);
                            //console.log(item);
                            // loadMarkerPosko(item);
                            addMarkerPosko(item);
                        });
                    }
                });
            }

            function loadsinggah(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonsinggah',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        // Dashboard.pageLoading('loading posko');
                    },
                    success:function(response){
                        // Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            var _pos = item.tempat_singgah_latlong.split(",");
                            item.tempat_singgah_latlong = new L.latLng(_pos[0],_pos[1]);
                            //console.log(item);
                            // loadMarkerPosko(item);
                            addMarkerSinggah(item);
                        });
                    }
                });
            }

            function loadterminal(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonterminal',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        // Dashboard.pageLoading('loading posko');
                    },
                    success:function(response){
                        // Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            addMarkerSatpel(item);
                        });
                    }
                });
            }

            function loadpelabuhan(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonpelabuhan',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        // Dashboard.pageLoading('loading posko');
                    },
                    success:function(response){
                        // Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            // var _pos = item.tempat_singgah_latlong.split(",");
                            // item.tempat_singgah_latlong = new L.latLng(_pos[0],_pos[1]);
                            // //console.log(item);
                            // loadMarkerPosko(item);
                            addMarkerPelabuhan(item);
                        });
                    }
                });
            }

            function loaduppkb(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonuppkb',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        // Dashboard.pageLoading('loading posko');
                    },
                    success:function(response){
                        // Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            // var _pos = item.tempat_singgah_latlong.split(",");
                            // item.tempat_singgah_latlong = new L.latLng(_pos[0],_pos[1]);
                            // //console.log(item);
                            // loadMarkerPosko(item);
                            addMarkerUppkb(item);
                        });
                    }
                });
            }

            function loadrestarea(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonrestarea',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.pageLoading('loading rest area');
                    },
                    success:function(response){
                        Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            
                            var _pos = item.rest_area_latlong_nominatim.split(",");
                            item.rest_area_latlong_nominatim = new L.latLng(_pos[0],_pos[1]);
                            //console.log(item);
                            loadMarkerRestarea(item);

                            
                        });
                        map.fitBounds(layerGroupRestarea.getBounds(),14);

                    }
                });
            }

            function loadwisata(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonwisata',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.pageLoading('loading wisata');
                    },
                    success:function(response){
                        Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            
                            var _pos = item.wisata_mudik_latlong.split(",");
                            item.wisata_mudik_latlong = new L.latLng(_pos[0],_pos[1]);
                            //console.log(item);
                            loadMarkerWisata(item);
                        });
                    }
                });
            }

            function loadresto(){
                $.ajax({
                    method: 'post',
                    url:Dashboard.baseUrl+'/main/ajax/jsonresto',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                        Dashboard.pageLoading('loading kuliner');
                    },
                    success:function(response){
                        Swal.close();
                        var ret = $.parseJSON(response);
                        //console.log(ret);
                        ret.forEach(function(item,index){
                            
                            var _pos = item.resto_mudik_latlong.split(",");
                            item.resto_mudik_latlong = new L.latLng(_pos[0],_pos[1]);
                            //console.log(item);
                            loadMarkerKuliner(item);
                        });
                    }
                });
            }


            function loadMarkerPosko(item){
                if( typeof Dashboard.markerPosko === 'undefined' ){
                    Dashboard.markerPosko = {};
                }

                var markerContent = `<div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Posko</h4>
                                    <p class="card-text">`+item.posko_mudik_name+`</p>
                                </div>
                                </div>`;
                Dashboard.markerPosko[item.id] = L.marker(item.posko_mudik_latlong,{
                    contextmenu: false,
                    icon: Dashboard.myIcon['posko'],
                    data:item,
                    draggable:true,
                }).bindPopup(markerContent).on('click', onMarkerClick).addTo(layerGroupPosko);
                
                // layerGroupPosko.addTo(map);
            }

            function loadMarkerRestarea(item){
              if( typeof Dashboard.markerRestarea === 'undefined' ){
                    Dashboard.markerRestarea = {};
              }

              var markerContent = `<div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Rest Area</h4>
                                    <p class="card-text">`+item.rest_area_name+`</p>
                                    
                                </div>
                            </div>`;
              Dashboard.markerRestarea[item.id] = L.marker(item.rest_area_latlong_nominatim,{
                  contextmenu: false,
                  icon: Dashboard.myIcon['rest-area'],
                  data:item,
                  draggable:true,
              }).bindPopup(markerContent).on('click',onMarkerClick).addTo(layerGroupRestarea);  

              // layerGroupRestarea.addTo(map);
            }

            function loadMarkerWisata(item){
              if( typeof Dashboard.markerWisata === 'undefined' ){
                    Dashboard.markerWisata = {};
              }

              var markerContent = `<div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Wisata</h4>
                                    <p class="card-text">`+item.wisata_mudik_name+`</p>
                                    
                                </div>
                            </div>`;
              Dashboard.markerWisata[item.id] = L.marker(item.wisata_mudik_latlong,{
                  contextmenu: false,
                  icon: Dashboard.myIcon['wisata'],
                  data:item,
                  draggable:true,
              }).bindPopup(markerContent).on('click',onMarkerClick).addTo(layerGroupWisata);  

              // layerGroupWisata.addTo(map);
            }

            function loadMarkerKuliner(item){
              if( typeof Dashboard.markerKuliner === 'undefined' ){
                    Dashboard.markerKuliner = {};
              }

              var markerContent = `<div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Rest Area</h4>
                                    <p class="card-text">`+item.resto_mudik_name+`</p>
                                    
                                </div>
                            </div>`;
              Dashboard.markerKuliner[item.id] = L.marker(item.resto_mudik_latlong,{
                  contextmenu: false,
                  icon: Dashboard.myIcon['kuliner'],
                  data:item,
                  draggable:true,
              }).bindPopup(markerContent).on('click',onMarkerClick).addTo(layerGroupKuliner);  
              
              // layerGroupKuliner.addTo(map);
            }

            // loadrestarea();
            // loadwisata();
            // loadresto();
            function loadMarkerAduanById(id){
                $.ajax({
                    type: "POST",
                    url: Dashboard.baseUrl+'/main/ajax/dataaduanbyid',
                    data: {
                      [Dashboard.csrfName]:Dashboard.csrfHash,
                      id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if(response.data.length>0){
                        layerGroupAduan.clearLayers();
                        map.removeLayer(layerGroupAduan);
                        $('#aduan-modal').modal('hide');
                        var item = response.data[0];
                        if( typeof Dashboard.markerAduan === 'undefined' ){
                            Dashboard.markerAduan = {};
                        }
                        var aduanContent = `<div class="card" style="width:560px">
                                        <div class="card-body">
                                            <h4 class="card-title">Aduan</h4>
                                            <hr>
                                                <div class="box">
                                                  <div class="img-wrapper">
                                                      <img src="${(item.user_web_photo!=null)?item.user_web_photo:item.user_mobile_photo}" class="rounded-circle avatar-sm" alt="">
                                                      <span class="user-status"></span>
                                                  </div>
                                                  <div class="flex-grow-1 overflow-hidden">
                                                      <h5 class="text-truncate mb-0">${item.user_web_name}</h5>
                                                      <p class="text-truncate mb-0">${item.status}</p>
                                                      <p class="text-truncate mb-0">${item.lokasi_name}</p>
                                                  </div>
                                                  <div class="flex-shrink-0">
                                                      <div class="call-this-user-dashboard" data-id="${item.user_mobile_id}" data-posko-id="null" data-satpel-id="${item.lokker_id}"><i class="bx bx-phone-call"></i></div>
                                                  </div>
                                              </div>
                                              <hr>
                                            <p class="card-text"><b>${item.aduan_judul}</b></p>
                                            <p class="card-text">${item.aduan_detail}</p>
                                            <p class="card-text"><img src="${Dashboard.base_url_md}${item.aduan_lampiran}" height="200"/></p>
                                            
                                        </div>
                                    </div>`;
                        Dashboard.markerAduan[item.id] = L.marker(L.latLng(item.lat, item.lon),{
                            contextmenu: false,
                            icon: Dashboard.pulseIcon,
                            data: item,
                            draggable: false,
                        }).bindPopup(aduanContent,{ maxWidth: 560 }).addTo(layerGroupAduan);
                        layerGroupAduan.addTo(map);
                        map.flyTo(L.latLng(item.lat, item.lon),10);
                        }
                    }
                });
            }

            $(document).on('click','.map-this-user-dashboard',function(e){
                loadMarkerAduanById($(this).data('id'));
                
            })

            Dashboard.base_url_md = 'https://mitradarat.dephub.go.id/';
            Dashboard.pulseIcon = L.icon.pulse({iconSize:[10,10],color:vColor,fillColor:vColor});
            var n_notif = 0;
            if($('.badge-notif').html()==''){ 
                n_notif = 0;
            }else{
                n_notif = parseInt($('.badge-notif').text());
            }

            socket.on('t_aduan', function(item){
                console.log(item);
                n_notif++;
                $('.badge-notif').html(n_notif);
                $('#aduan-btn').addClass('rise-shake');
                // if( typeof Dashboard.markerAduan === 'undefined' ){
                //     Dashboard.markerAduan = {};
                // }
                // var aduanContent = `<div class="card">
                //                 <div class="card-body">
                //                     <h4 class="card-title">Aduan</h4>
                //                     <p class="card-text">`+item.aduan_email+`</p>
                //                     <p class="card-text">`+item.aduan_judul+`</p>
                //                     <p class="card-text">`+item.aduan_detail+`</p>
                //                     <p class="card-text"><img src="`+Dashboard.base_url_md+item.aduan_lampiran+`" width="200"/></p>
                                    
                //                 </div>
                //             </div>`;
                // Dashboard.markerAduan[item.id] = L.marker(L.latLng(-7.015539327673328, 110.47844084232959),{
                //     contextmenu: false,
                //     icon: Dashboard.pulseIcon,
                //     data: item,
                //     draggable: false,
                // }).bindPopup(aduanContent).addTo(layerGroupAduan);
                // layerGroupAduan.addTo(map);
                // map.flyTo(L.latLng(-7.015539327673328, 110.47844084232959),16);

            });

            loadposko();
            loadsinggah();
            loadterminal();
            //loadpelabuhan();
            //loaduppkb();
            var overlays = {};

            function isOverlays(set){
                var newArray = set.filter(function (el) {
                  return el.UPPKB.includes('UPPKB') 
                });
            }

            //salafm, 18 april 2023
            var overlays = {};
            var layerArray = [layerGroupPosko,layerGroupRestarea,layerGroupWisata,layerGroupKuliner,layerGroupShelterNoRoute] //layerGroupTerminal,layerGroupPelabuhan,layerGroupUppkb
            for(var key in sourceSatpelData){
                if (sourceSatpelData.hasOwnProperty(key)) {
                    layerArray.push(sourceSatpelData[key]["layer"]);
                }
            }

            var layerGroupAll = L.layerGroup(layerArray);
            $(document).ajaxStop(function() {
                // place code to be executed on completion of last outstanding ajax call here
                //alert(overlays.length);
                // var allLayers = layerGroupPosko.getLayers().length+layerGroupRestarea.getLayers().length+layerGroupWisata.getLayers().length+layerGroupKuliner.getLayers().length
                // +layerGroupShelterNoRoute.getLayers().length+layerGroupTerminal.getLayers().length+layerGroupPelabuhan.getLayers().length+layerGroupUppkb.getLayers().length;

                if(Object.keys(overlays).length==0){
                    overlays = {
                        //["All ("+allLayers+")"]:layerGroupAll,
                        ["Bus Stop Tanpa Rute ("+layerGroupShelterNoRoute.getLayers().length+")"]:layerGroupShelterNoRoute,
                        ["Pos Pantau ("+layerGroupPosko.getLayers().length+")"]:layerGroupPosko,
                        ["Rest Area ("+layerGroupRestarea.getLayers().length+")"]:layerGroupRestarea,
                        ["Pariwisata ("+layerGroupWisata.getLayers().length+")"]:layerGroupWisata,
                        ["Kuliner ("+layerGroupKuliner.getLayers().length+")"]:layerGroupKuliner,
                        // ["Terminal Tipe A ("+layerGroupTerminal.getLayers().length+")"]:layerGroupTerminal,
                        // ["Pelabuhan Penyeberangan ("+layerGroupPelabuhan.getLayers().length+")"]:layerGroupPelabuhan,
                        // ["UPPKB ("+layerGroupUppkb.getLayers().length+")"]:layerGroupUppkb,
                    }

                    for(var key in sourceSatpelData){
                        if (sourceSatpelData.hasOwnProperty(key)) {
                            Object.assign(overlays, {[`${sourceSatpelData[key]["nama"]} (${sourceSatpelData[key]["layer"].getLayers().length})`]: sourceSatpelData[key]["layer"]});
                        }
                    }

                    var layerControlTopRight = L.control.layers(baseLayers,overlays).addTo(map);
                }

                $('#widget-03').css('display','none');
            });
        }catch(e){
            alert(e);
        }
    //variable Call_ dan Map_ ada di dashboard.js
  });
</script>


<!-- Modal -->
<div class="modal fade" id="bus-modal" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Operasinal Bus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="aduan-modal" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Manajemen Aduan Internal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" id="bus-stop-modal" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Rename Bus Stop</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="call-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Mitra Darat Video Meeting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-8" id="meet"></div>
            <div class="col-md-4">
                <div class="chat-leftsidebar-nav">
                            <ul class="nav nav-pills nav-justified bg-soft-light p-1">
                                <li class="nav-item">
                                    <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block"><input type="text" class="form-control form-control-sm" placeholder="Cari User" id="cariuser" name="cariuser"></span>
                                    </a>
                                </li>

                            </ul>
                            <div><span style="margin-left:4px">Total</span>&nbsp;<span class="tot-user"></span> user</div>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="chat">
                                    <div class="chat-message-list" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -20px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                        <div class="pt-3">
                                            <ul class="list-unstyled chat-list" id="list-petugas">
                                                
                                               
                                            </ul>
                                        </div>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 686px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
                                </div>

                                
                            </div>
                        </div>

            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="page-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">-</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="page-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dialog-reply-aduan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title" name="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="example-text-input" class="form-label">Aduan</label>
                    <input class="form-control" type="text" value="" name="aduanDetail" id="aduanDetail" readonly>
                </div>
                <div class="mb-3">
                    <label for="example-text-input" class="form-label">Balasan aduan</label>
                    <input class="form-control" type="text" value="" name="aduanReply" id="aduanReply">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="trayek" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title" name="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <input type="hidden" id="id" name="id" />
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama Group</label>
                        <input class="form-control" type="text" value="" name="group_nm" id="group_nm">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nama</label>
                        <input class="form-control" type="text" value="" name="name" id="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save-trayek">Kirim</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
