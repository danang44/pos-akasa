<?php
$session = \Config\Services::session();
$mainModel = model('App\Modules\Main\Models\MainModel');
#$dataStatOP = $mainModel->statOP();
#$pathMaja = $mainModel->pathMaja();
#$percent = array();
?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet.css" />
<link rel="stylesheet" href="<?= base_url() ?>/assets/libs/leaflet/leaflet-contextmenu.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen@latest/Control.FullScreen.css" />

<style>

    .leaflet-control-zoom.leaflet-bar.leaflet-control{
        border:1px solid white;
    }
    .leaflet-control-zoom-in,
    .leaflet-control-zoom-out {
        background-color: darkgreen !important;
        color: floralwhite !important;
    }

    .leaflet-bar a, .leaflet-bar a:hover{
        border-bottom: 1px solid #fffff;
    }

    button.btn-maja {
        width: 33px !important;
        height: 32px !important;
        !;
        line-height: 19px;
        background-color: darkgreen;
        border-color: floralwhite;
        color: white;
    }

    button.btn-maja:hover {
        color: lightgreen !important;
    }

    .btn-group-vertical>.btn,
    .btn-group-vertical>.btn-group {
        width: auto;
    }

    button.unselected img{
      filter: grayscale(100%);
    }

    .vertical-menu{

    }

    div.main-content{
    	margin-left:0px;
    }
    footer.footer{
    	left:0px;
    }

    div.extend-size i{
      font-size: 20px;
      margin-top:7px;
    }

    div.leaflet-div-icon{
      background: transparent !important;
      border: none;
      min-width: 20px;
      min-height: 20px;
    }

    div.data-badge {
      display: inline-block;
      min-width: 20px;
      height: 20px;
      vertical-align: top;
      text-align: center;
      line-height: 1;
      padding: 5px;
      background: url('<?=base_url()?>/assets/images/bus-terminal.svg');
      background-size: 100%;
    }

    [data-badge]:after {
      position: absolute;
      right: -40px;
      top: -8px;
      min-width: 50px;
      height: 16px;
      line-height: 1;
      padding: 2px;
      color: #fff;
      background-color: #bf1f1f;
      font-size: 10px;
      border-radius: 5px;
      content: attr(data-badge);
      border: solid 1px #c93a3a;
    }

    /* select2 custom */

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 36px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 34px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
        position: absolute;
        top: 1px;
        right: 5px;
        width: 20px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 15px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: darkgray;
        opacity: 0.9;
        display:flex;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear {
        cursor: pointer;
        float: right;
        font-weight: bold;
        height: 34px;
        margin-right: 26px;
        padding-right: 0px;
    }

    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    

	.navbar1{
		/*background: rgba(0,0,0,0.1);*/
	}

	.navbar2{
		/*background: rgba(0,0,0,0.1);	*/
	}

	
	@media screen and (max-width: 600px) {
	    .navbar1{
		``top:-3px;
		}

		.navbar2{
			top:71px;
		}
	}

	#map{
	    position: absolute;
	    top:0px;
	    width: 100%;
	    height: -moz-calc(100% - (20px + 30px));
	    height: -webkit-calc(100% - (20px + 30px));
	    height: calc(100% - (20px + 30px));
	    display:block;
	    z-index: 399;
	}

</style>
<style>
    
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
<link href="https://mitradarat-fms.dephub.go.id/assets/libs/select2/select2-min.css" rel="stylesheet" />
<script src="https://mitradarat-fms.dephub.go.id/assets/libs/select2/select2-min.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet.rotatedMarker.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-contextmenu.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-custom.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/polyline.encoded.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/geometry.util.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
<script src="<?= base_url() ?>/assets/libs/leaflet/leaflet-markercluster-list.src.js"></script>


<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
<script src="https://timeago.yarp.com/jquery.timeago.js"></script>
<script src="https://unpkg.com/leaflet.fullscreen@latest/Control.FullScreen.js"></script>
<script src="https://socketdevel.nginovasi.id:5002/socket.io/socket.io.js"></script>
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>

<div style="display: none">
<?php echo view('App\Modules\Main\Views\partials\topbar'); ?>
</div>
<div style="width:50%;height:-webkit-calc(100% - (20px + 130px));overflow-y:auto;position: absolute;top:100px;z-index: 999;" id="widget-call" draggable="true">
    <div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move">
            <h4 class="card-title mb-0 flex-grow-1">Group Call</h4>
            <!-- <div class="flex-shrink-0">
                <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Bus</a>
                    </li>
                </ul>
            </div> -->
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="meet" role="tabpanel" style="min-height:500px">
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>

<div style="width:50%;height:-webkit-calc(100% - (20px + 130px));overflow-y:auto;position: absolute;top:100px;z-index: 999;" id="widget-01" draggable="true">
	<div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move">
            <h4 class="card-title mb-0 flex-grow-1">Operasional Armada</h4>
            <!-- <div class="flex-shrink-0">
                <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Bus</a>
                    </li>
                </ul>
            </div> -->
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                	<table id="datatable" class="table table-theme table-row v-middle">
                        <thead>
                            <tr>
                                <th><span>#</span></th>
                                <th><span>Nama Rute</span></th>
                                <th><span>Total Armada</span></th>
                                <!-- <th><span>Aktif hari ini</span></th>
                                <th><span>Non Aktif</span></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button type="button" class="btn btn-success w-md">Export</button>
                    </div>
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>
<div style="width:50%;height:-webkit-calc(100% - (20px + 130px));overflow-y:auto;position: absolute;top:100px;z-index: 999;" id="widget-02" draggable="true">
	<div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move">
            <h4 class="card-title mb-0 flex-grow-1">Rute Perintis & KSPN</h4>
            <!-- <div class="flex-shrink-0">
                <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Bus</a>
                    </li>
                </ul>
            </div> -->
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                	<table id="datatable2" class="table table-theme table-row v-middle">
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
                    <div class="text-right">
                        <button type="button" class="btn btn-success w-md">Export</button>
                    </div>
                </div>
                <!-- end tab pane -->
                
            </div>
            <!-- end tab content -->
        </div>
        <!-- end card body -->
    </div>
</div>

<div style="width:80%;height:-webkit-calc(100% - (20px + 130px));overflow-y:auto;position: absolute;top:100px;z-index: 999;" id="widget-03" draggable="true">
    <div class="card">
        <div class="card-header align-items-center d-flex" style="cursor: move">
            <h4 class="card-title mb-0 flex-grow-1">Monitoring Bus Status</h4>
            <!-- <div class="flex-shrink-0">
                <ul class="nav nav-tabs-custom card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#buy-tab" role="tab">Bus</a>
                    </li>
                </ul>
            </div> -->
            <a href="javascript:void(0);" class="wg-close right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="buy-tab" role="tabpanel">
                    <table id="datatable3" class="table table-theme table-row v-middle">
                        <thead>
                            <tr>
                                <th><span>#</span></th>
                                <th><span>Route Group</span></th>
                                <th><span>Total</span></th>
                                <th><span>Today Inactive</span></th>
                                <th><span>Today Active</span></th>
                                <th><span>Today less than min</span></th>
                                <th><span>Today about a minuted</span></th>
                                <th><span>Today less than hour</span></th>
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
<?php echo view('App\Modules\Main\Views\partials\right-sidebar'); ?>
<div id="map"></div>
<?php
/*
$db2 = db_connect('hubdat');
$query = $db2->query("select * from m_trayek limit 0,10");
echo "<pre>";
print_r($query->getResult());
echo "</pre>";
*/
?>
<script src='https://devel2.nginovasi.id/external_api.js'></script>

<script>
  $(document).ready(function () {
    try{
        // load video conference

        function uuidv4() {
          return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
          );
        }
        var uuid = uuidv4();
        var displayName = '';
        var roomName = '';
        
        // $(document).on('click','#btn-call',function(e){
        //     if(displayName!=''){
        //         makeGroupCall();
        //     }else{
                // const api = new JitsiMeetExternalAPI(domain, options);

                // api.addEventListener('videoConferenceJoined',function(e){
                //      console.log(e);
                //      displayName = e.displayName;
                //      roomName = e.roomName;
                // });
        //     }
        // });

        // const domain = 'devel2.nginovasi.id';
        // const options = {
        //     roomName: 'AdminHubdat',
        //     width: '100%',
        //     height: '500px',
        //     parentNode: document.querySelector('#meet'),
        //     lang: 'id',
        //     userInfo: {
        //         email: 'admin@mitradarat-fms.dephub.go.id',
        //         displayName: 'Admin Mitra Darat'
        //     }
        // };
        

        function makeGroupCall(){
            $.ajax({
                  type: "POST",
                  url: baseUrl+'/api/v1/voip',
                  data: {
                    [csrfName]:csrfHash,
                    sender: displayName, room: roomName
                  },
                  beforeSend: function(request) {
                    request.setRequestHeader("X-NGI-TOKEN", 'dev');
                  },
                  success: function(response) {
                      $('#widget-call').show();
                      console.log(response);
                  }
              });
        }


        // const api = new JitsiMeetExternalAPI(domain, options);

        // api.addEventListener('videoConferenceJoined',function(e){
        //      console.log(e);
        //      displayName = e.displayName;
        //      roomName = e.roomName;
        //      makeGroupCall();
        // });

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

        // $("#find_route").select2({
        //       placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute</span>',
        //       allowClear: true,
        //       data: {},
        //       escapeMarkup : function(markup) { return markup; }
        //        // need to override the changed default
        //   });


    	$('#widget-01,#widget-02,#widget-03,#widget-call').hide();
    	$(document).on('click','#btn-bus-stat',function(){
    		if($('#widget-01').is(":hidden")){
    			$('#widget-01').show();	
    			$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    		}else{
    			$('#widget-01').hide();	
    		}
    	});

    	$(document).on('click','#btn-routes-stat',function(){
    		if($('#widget-02').is(":hidden")){
    			$('#widget-02').show();	
    			$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    		}else{
    			$('#widget-02').hide();	
    		}
    	});

        $(document).on('click','#reload-monroute',function(){
            $('#datatable3').DataTable().clear().destroy();
            monitoringRoute();
        });

    	$(document).on('click','.wg-close',function(e){

    		$(this).closest("[draggable=true]").hide();
    	});

		var datacsrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
		var csrfName = '<?php echo csrf_token() ?>',
		csrfHash = '<?php echo csrf_hash() ?>',
		baseUrl = '<?=base_url()?>';
		var buttonUserAccount = $('#page-topbar').prop('innerHTML');

		var iconPath = 'M409.133 109.203c-19.608 -33.592 -46.205 -60.189 -79.798 -79.796C295.736 9.801 259.058 0 219.273 0c-39.781 0 -76.47 9.801 -110.063 29.407c-33.595 19.604 -60.192 46.201 -79.8 79.796C9.801 142.8 0 179.489 0 219.267c0 39.78 9.804 76.463 29.407 110.062c19.607 33.592 46.204 60.189 79.799 79.798c33.597 19.605 70.283 29.407 110.063 29.407s76.47 -9.802 110.065 -29.407c33.593 -19.602 60.189 -46.206 79.795 -79.798c19.603 -33.596 29.403 -70.284 29.403 -110.062C438.533 179.485 428.732 142.795 409.133 109.203zM361.74 259.517l-29.123 29.129c-3.621 3.614 -7.901 5.424 -12.847 5.424c-4.948 0 -9.236 -1.81 -12.847 -5.424l-87.654 -87.653l-87.646 87.653c-3.616 3.614 -7.898 5.424 -12.847 5.424c-4.95 0 -9.233 -1.81 -12.85 -5.424l-29.12 -29.129c-3.617 -3.607 -5.426 -7.898 -5.426 -12.847c0 -4.942 1.809 -9.227 5.426 -12.848l129.62 -129.616c3.617 -3.617 7.898 -5.424 12.847 -5.424s9.238 1.807 12.846 5.424L361.74 233.822c3.613 3.621 5.424 7.905 5.424 12.848C367.164 251.618 365.357 255.909 361.74 259.517z';

		var iconPathHalte = 'M132,409.6c-6.6,0-12-5.4-12-12V336h72v61.6c0,6.6-5.4,12-12,12H132z M204,72h-36v48h48V84C216,77.4,210.6,72,204,72z M144,72h-36c-6.6,0-12,5.4-12,12v36h48V72z M96,216h120v-72H96V216z M168,180c0,6.6,5.4,12,12,12s12-5.4,12-12c0-6.6-5.4-12-12-12S168,173.4,168,180z M120,180c0,6.6,5.4,12,12,12s12-5.4,12-12c0-6.6-5.4-12-12-12S120,173.4,120,180z M276,0H36C16.1,0,0,16.1,0,36v240c0,19.9,16.1,36,36,36h240c19.9,0,36-16.1,36-36V36C312,16.1,295.9,0,276,0z M240,84c0-19.9-16.1-36-36-36h-96c-19.9,0-36,16.1-36,36v144c0,6.6,5.4,12,12,12h12v12c0,6.6,5.4,12,12,12s12-5.4,12-12v-12h72v12c0,6.6,5.4,12,12,12s12-5.4,12-12v-12h12c6.6,0,12-5.4,12-12V84z';

		// var iconPathString = "<svg xmlns='http://www.w3.org/2000/svg' width='1000' height='1000'><path d='"+iconPath+"' fill='#000000'/></svg>";

		var iconPathString2 = '<svg width="152" height="427" viewBox="0 0 152 427" xmlns="http://www.w3.org/2000/svg">\
		<path d="M3.81409 407.709C3.81409 407.709 3.81409 407.709 3.81409 407.709L3.81409 19.5686C3.81409 19.0194 3.95767 18.4919 4.30452 18.0662C7.01398 14.7403 22.0491 0.029855 76.0287 0.029855C130.008 0.029855 145.043 14.7403 147.753 18.0662C148.1 18.4919 148.243 19.0194 148.243 19.5685L148.243 407.709C148.243 407.709 148.243 407.709 148.243 407.709C148.243 407.709 148.243 426.671 76.0287 426.671C3.81409 426.671 3.81409 407.709 3.81409 407.709Z" fill="#FF1744"/>\
		<path d="M12.4857 417.298C11.5515 417.089 10.7232 416.552 10.1513 415.784L3.81396 407.277L3.81396 394.349H25.4853V420.206L12.4857 417.298Z" fill="#C4C4C4"/>\
		<path d="M139.569 417.3C140.504 417.091 141.332 416.554 141.904 415.786L148.241 407.28V394.351H126.57V420.208L139.569 417.3Z" fill="#C4C4C4"/>\
		<path d="M25.4762 420.207V413.743C25.4762 413.743 25.4762 420.207 76.0264 420.207C126.577 420.207 126.577 413.743 126.577 413.743V420.207C126.577 420.207 126.577 426.671 76.0264 426.671C25.4762 426.671 25.4762 420.207 25.4762 420.207Z" fill="#C4C4C4"/>\
		<path d="M34.4527 397.79C33.449 397.674 32.6986 396.823 32.6986 395.813V393.378C32.6986 392.177 33.736 391.244 34.9293 391.381C41.6365 392.151 62.0201 394.35 76.0274 394.35C90.0346 394.35 110.418 392.151 117.125 391.381C118.319 391.244 119.356 392.177 119.356 393.378V395.813C119.356 396.823 118.606 397.674 117.602 397.79C111.44 398.504 90.3845 400.815 76.0274 400.815C61.6703 400.815 40.6143 398.504 34.4527 397.79Z" fill="white"/>\
		<path d="M23.2114 65.4032C25.054 71.1147 26.8952 80.6278 28.2752 88.7074C28.9655 92.7484 29.5406 96.4328 29.9433 99.1068C30.1446 100.444 30.3027 101.528 30.4106 102.279C30.4645 102.654 30.5059 102.945 30.5337 103.143L30.5624 103.348L30.8177 103.317C31.0493 103.289 31.3911 103.248 31.8323 103.196C32.7147 103.092 33.9946 102.944 35.5845 102.765C38.7643 102.409 43.1842 101.934 48.1452 101.458C58.0658 100.508 70.1538 99.5565 78.812 99.5565C87.4707 99.5565 98.5156 100.508 107.393 101.458C111.833 101.934 115.731 102.409 118.52 102.766C119.914 102.944 121.031 103.092 121.8 103.196C122.184 103.248 122.481 103.289 122.682 103.317L122.889 103.346L122.917 103.143C122.945 102.945 122.986 102.654 123.04 102.279C123.148 101.528 123.306 100.444 123.508 99.1069C123.91 96.4328 124.485 92.7484 125.175 88.7074C126.555 80.6278 128.396 71.1147 130.239 65.4032C131.594 61.2013 130.478 57.4527 127.68 54.1833C124.878 50.9097 120.392 48.1201 115.022 45.8559C104.284 41.328 90.0487 38.9164 78.812 38.9163C67.5749 38.9163 52.2951 41.328 40.5118 45.857C34.6193 48.1218 29.6108 50.9126 26.418 54.1881C23.2287 57.46 21.8576 61.2069 23.2114 65.4032Z" fill="white" stroke="#E0E0E0" stroke-width="0.2"/>\
		<rect x="11.0387" y="381.421" width="226.249" height="14.4476" rx="2" transform="rotate(-90 11.0387 381.421)" fill="white"/>\
		<line x1="11.0386" y1="310.064" x2="25.4861" y2="310.064" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="11.0386" y1="284.207" x2="25.4861" y2="284.207" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="11.0386" y1="258.35" x2="25.4861" y2="258.35" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="11.0386" y1="232.494" x2="25.4861" y2="232.494" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="11.0386" y1="206.637" x2="25.4861" y2="206.637" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="11.0386" y1="180.778" x2="25.4861" y2="180.778" stroke="#E0E0E0" stroke-width="0.5"/>\
		<rect x="126.577" y="381.421" width="226.249" height="14.4476" rx="2" transform="rotate(-90 126.577 381.421)" fill="white"/>\
		<line x1="126.577" y1="310.064" x2="141.024" y2="310.064" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="126.577" y1="284.207" x2="141.024" y2="284.207" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="126.577" y1="258.35" x2="141.024" y2="258.35" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="126.577" y1="232.494" x2="141.024" y2="232.494" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="126.577" y1="206.637" x2="141.024" y2="206.637" stroke="#E0E0E0" stroke-width="0.5"/>\
		<line x1="126.577" y1="180.778" x2="141.024" y2="180.778" stroke="#E0E0E0" stroke-width="0.5"/>\
		<path d="M12.5118 142.243C11.6607 142.243 10.979 141.544 11.0063 140.694C11.1529 136.13 11.5148 122.478 10.9529 113.154C10.3953 103.901 8.42314 90.5312 7.69661 85.8018C7.55641 84.8892 8.26216 84.0647 9.18551 84.0647H20.2767C21.0049 84.0647 21.626 84.5794 21.7478 85.2972C22.4092 89.1923 24.4279 101.478 25.0635 109.922C25.8587 120.486 25.3196 136.074 25.1253 140.821C25.0926 141.62 24.4342 142.243 23.6338 142.243H12.5118Z" fill="white"/>\
		<line y1="-0.25" x2="15.8278" y2="-0.25" transform="matrix(0.912797 -0.408413 0.48777 0.872972 11.0364 109.921)" stroke="#E0E0E0" stroke-width="0.5"/>\
		<path d="M139.546 142.243C140.397 142.243 141.079 141.544 141.051 140.694C140.905 136.13 140.543 122.478 141.105 113.154C141.662 103.901 143.634 90.5312 144.361 85.8018C144.501 84.8892 143.795 84.0647 142.872 84.0647H131.781C131.053 84.0647 130.432 84.5794 130.31 85.2972C129.648 89.1923 127.63 101.478 126.994 109.922C126.199 120.486 126.738 136.074 126.932 140.821C126.965 141.62 127.623 142.243 128.424 142.243H139.546Z" fill="white"/>\
		<line y1="-0.25" x2="15.8278" y2="-0.25" transform="matrix(-0.912797 -0.408413 -0.48777 0.872972 141.021 109.921)" stroke="#E0E0E0" stroke-width="0.5"/>\
		<ellipse rx="13.7556" ry="9.4858" transform="matrix(-0.74509 0.666964 -0.74509 -0.666964 17.3169 20.2612)" fill="white"/>\
		<path d="M124.151 10.788C120.244 14.285 121.662 21.2236 127.317 26.2859C132.973 31.3483 140.724 32.6173 144.631 29.1204C148.537 25.6234 147.12 18.6848 141.464 13.6225C135.809 8.56012 128.058 7.2911 124.151 10.788Z" fill="white"/>\
		<path d="M3.81409 25.8857L3.81409 19.4214C3.81409 19.4214 6.05017 14.1877 11.0355 9.72502C18.257 3.26076 50.3021 0.477207 76.0287 0.0286293C100.161 -0.392145 134.483 3.87208 141.022 9.72502C147.56 15.578 148.243 19.4214 148.243 19.4214V25.8857C148.243 25.8857 143.277 16.4579 137.411 12.9572C126.579 6.49289 100.165 4.47353 76.0287 4.47353C51.892 4.47353 22.467 7.86533 14.6463 12.9572C6.82559 18.049 3.81409 25.8857 3.81409 25.8857Z" fill="#C4C4C4"/>\
		<path d="M32.6986 17.2676V12.9581C32.6986 12.9581 64.6589 9.72594 76.0274 9.72594C87.3958 9.72594 118.808 12.9581 118.808 12.9581V17.2676C118.808 17.2676 87.3958 14.0354 76.0274 14.0354C64.6589 14.0354 32.6986 17.2676 32.6986 17.2676Z" fill="#BDBDBD"/>\
		</svg>';
		var busIconURL = encodeURI("data:image/svg+xml," + iconPathString2).replaceAll('#','%23');

		var vCurLatLng = [-1.3098505,122.4971107];
		var vCurZoom = 5;
		var vCurrentColor = '#000000';
		var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
		  '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
		  'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		  mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

		var streets = L.tileLayer(mbUrl, { id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: null }),
		  tilek = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' });


		map = L.map("map", {
		  contextmenu: false,
		  zoom: vCurZoom,
		  maxZoom:20,
		  //minZoom:6,
		  center: vCurLatLng,
		  layers: [streets],
		  zoomControl: true,
		  editable: true,
		  attributionControl: false,
		  zoomControl: false
		});

		map.invalidateSize(true);
		// var draggable = new L.Draggable($('#widget-01'));
		// console.log(draggable);

		var vUrlSocket = 'findAll';
		var theBusMarker = [];

		//const socket = io.connect("https://socketdevel.nginovasi.id", { secure: true, transports:["websocket"] });
		const socket = io.connect("https://socketdevel.nginovasi.id:5002", { secure: true, transports: ["websocket"] });

		socket.on('connect', function () {
		console.log('connected!');
		//alert('connected');
		//socket.emit('greet', { message: 'Hello Mr.Server!' });
		const transport = socket.io.engine.transport.name; // in most cases, "polling"
		console.log(transport);
		socket.io.engine.on("upgrade", () => {
		  const upgradedTransport = socket.io.engine.transport.name; // in most cases, "websocket"
		  console.log(upgradedTransport);
		});
		});

		var draggableControl = L.control.custom({
				position:'topright',
				content:buttonUserAccount,
				classes:'navbar1',
				draggable:true
		}).addTo(map);





		L.control.zoom({
		 position: 'bottomright'
		}).addTo(map);

		L.control.custom({
			position:'topleft',
			content:'<div style="display:inline-block;width:50%"><select class="form-control" style="width: 100%;" id="find_bus"></select></div>'+
			'<div style="display:inline-block;width:50%"><select class="form-control" style="width: 100%;display:none" id="find_route"></select></div>',
			classes: 'navbar2',
			style:
			{
			    margin: '10px',
			    padding: '0px 0 0 0',
			    cursor: 'pointer',
			    width: '500px'
			}
		}).addTo(map);

		L.control.custom({
          position: 'bottomright',
          content: ''+
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

      
      const featureGroup = L.featureGroup();
      const vehicleMarkersGroup = L.featureGroup();
      //var layerGroupShelter = L.markerClusterGroup();


    var myIcon = {};
    var opMarkers = {};
    var vehicleMarkers = {};
    var opMarker = {};
    var opMarkerData = {};
    var polyline = {};
    var polylineData = {};
    var iconCurSize = 20;
    var indexPoly = 0;
    var indexMarker = 0;
    var vColor = "#0061c1";
    var opMarkersGroup = L.markerClusterGroup();
    var layerGroupBus = L.layerGroup();
    var numDeltas = 100;
    var delay = 10; //milliseconds
    var theBus_i = new Array();
    var theBusPosition = new Array();
    var theBusDeltaLat = new Array();
    var theBusDeltaLng = new Array();

      myIcon['bus-terminal'] = L.icon({
          iconUrl: '<?=base_url()?>/assets/images/bus-terminal.svg',
          iconSize:     [iconCurSize, iconCurSize],
          shadowSize:   [31, 40],
          iconAnchor:   [9, 10],
          shadowAnchor: [2, 31],
          popupAnchor:  [-1, -31]
        });  


      var layerGroupShelter = L.markerClusterGroup({
        showCoverageOnHover:false,
        iconCreateFunction: function(cluster) {
          return L.divIcon({ 
            html: '<div class="data-badge" data-badge="'+cluster.getChildCount()+' stops"></div>' });
        }
      });

      function getRandomRolor() {
          var color = '';
          for (var i = 0; i < 6; i++) {
              color += Math.floor(Math.random() * 10);
          }
          return color;
      }

      var busIconPath = {};
      var colorGroup = {};
      var html_logobus = '<span style="font-size:16px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span>';

      function loadBus(){
            $.ajax({
              method: 'POST',
              url:'https://socketdevel.nginovasi.id:5002/api/'+vUrlSocket,
              data: JSON.stringify({ key:'ngiraya' }),
              contentType: 'application/json',
              beforeSend:function(){
                
              },
              success:function(response){
                var ret = response;
                
                $.each(ret.data,function(index,item){
                    //console.log(item);

                    if(typeof colorGroup[item.group_nm]=='undefined'){
                        var randomColor = getRandomRolor();      
                        colorGroup[item.group_nm] = randomColor;
                        // var busIconURL = encodeURI("data:image/svg+xml," + iconPathString.replace('#000000','#'+randomColor)).replace('#','%23');
				        busIconURL = encodeURI("data:image/svg+xml," + iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
				        busIconPath[item.group_nm] = L.icon({
				          iconUrl: busIconURL,
				          iconSize:     [iconCurSize+3, iconCurSize+3],
				          shadowSize:   [31, 40],
				          iconAnchor:   [6, 17],
				          shadowAnchor: [2, 31],
				          popupAnchor:  [-1, -31]
				        });
				        //console.log(busIconPath);
                    }
                    createVehicleMarker(item,colorGroup[item.group_nm],busIconPath[item.group_nm]);
                });
                // $.each(vehicleMarkers,function(index,item){
                //  //console.log('vehicleMarkers index : '+index);
                // });

                //let results = [];
                var vdataz = {};
                vdataz.results = [];
                var objtype = [];
                objtype.push('-');
                var ng = 0;
                $.each(response.data, function (index,obj) {
                    if (objtype[objtype.length-1]!=obj.group_nm){
                      vdataz.results.push({ text: obj.group_nm });
                      ng = 1;
                      vdataz.results[vdataz.results.length-1].children =[{ id:obj.gps_sn, text:html_logobus+' '+obj.nopol+' <span style="display:none">'+obj.group_nm+','+obj.gps_sn+'</span><br/><small>'+$.timeago(obj.gps_time)+'</small>', gps_time:obj.gps_time}];
                    }else{
                      vdataz.results[vdataz.results.length-1].children.push({ id:obj.gps_sn, text:html_logobus+' '+obj.nopol+' <span style="display:none">'+obj.group_nm+','+obj.gps_sn+'</span><br/><small>'+$.timeago(obj.gps_time)+'</small>', gps_time:obj.gps_time});
                    }
                    ng++;
                    objtype.push(obj.group_nm);
                    return obj;
                });
               vdataz.pagination = { more:true };
               //console.log(vdataz.results.length);
               $.each(vdataz.results,function(index,item){
                  vdataz.results[index].text = item.text+' ('+item.children.length+' armada)';
               });
               console.log(vdataz.results);
               
                $("#find_bus").select2({
                    placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Armada</span>',
                    allowClear: true,
                    data:vdataz.results,
                    escapeMarkup : function(markup) { return markup; }
                     // need to override the changed default
                });

                $('#find_bus').val(null).trigger('change');

                $('#find_bus').on('select2:select', function (e) {
                      var data = e.params.data;
                      //map.flyTo(vLatLng,10);
                      vehicleMarkers[data.id].openPopup();
                      //console.log(data);
                      map.flyTo(vehicleMarkers[data.id].getLatLng(),10);
                });
                var pisan = false;
                socket.on('update_hubdat', function(ret){
                    // console.log(ret);
                     var LatLngUpd = [ret.lat,ret.lon];
                    if(ret){
                      if(ret.lat!=null){
                        if(typeof vehicleMarkers[ret.gps_sn]!='undefined'){
                          // pindah lokasi bus
                          try{
                            //console.log('move to last update location '+ret.gps_sn+' '+ret.gps_time);
                            transition(ret,LatLngUpd,ret.gps_sn);
                            //console.log(vdataz.results);
                            let obj = vdataz.results.find((item, index) => {
                                //if(pisan==false){
                                    item.children.forEach(function(item2,index2){
                                        if(item2.id === ret.gps_sn){
                                            //console.log(ret);
                                            item2.text = html_logobus+' '+ret.nopol+' <span style="display:none">'+ret.group_nm+','+ret.gps_sn+'</span><br/><small>'+$.timeago(ret.gps_time)+'x</small>'
                                            //console.log(item2);
                                            //console.log(vdataz.results);
                                            //console.log($('#find_bus').select2('data'));
                                            //$('#find_bus').trigger('change.select2');

                                        }
                                    });
                                    
                                    pisan = true;
                                //}
                            });


                            
                          }catch(e){
                            console.log(e);
                          }
                        }else{
                          //console.log('bus baru '+ret.gps_sn);  
                          if(typeof colorGroup[ret.group_nm]=='undefined'){
		                        var randomColor = getRandomRolor();      
		                        colorGroup[ret.group_nm] = randomColor;
		                        // var busIconURL = encodeURI("data:image/svg+xml," + iconPathString.replace('#000000','#'+randomColor)).replace('#','%23');
						        busIconURL = encodeURI("data:image/svg+xml," + iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
						        busIconPath[ret.group_nm] = L.icon({
						          iconUrl: busIconURL,
						          iconSize:     [iconCurSize+3, iconCurSize+3],
						          shadowSize:   [31, 40],
						          iconAnchor:   [6, 17],
						          shadowAnchor: [2, 31],
						          popupAnchor:  [-1, -31]
						        });

						        //console.log(busIconPath);

		                    }
                          	createVehicleMarker(ret,colorGroup[ret.group_nm],busIconPath[ret.group_nm]);
                        }
                      }
                    }

                });



                
                var dataStart = 0;

                $('#datatable').dataTable( {
				    "data": vdataz.results,
				    "pageLength": 5,
				    "columns": [
				        { 
				        	"data": "id", orderable: true,
			                render: function (a, type, data, index) {
			                    return dataStart + index.row + 1
			                }
		            	},
				        { "data": "text", width: 200 },
				        { "data": "children.length" },
				        
				    ],
				    scrollY:        "300px",
			        scrollX:        true,
			        scrollCollapse: true,
			        //paging:         false,
			        columnDefs: [
			            { width: '30%', targets: 1 }
			        ],
			        fixedColumns: true
				} );


              }
            });
      }

     loadBus();


      function onMarkerClick(){

      }

      $('#btn-center').click(function(){
          map.setView(vCurLatLng,5);
      });

      $('#btn-vehicles').click(function(){
          getVehiclesLastPosition();
      });


      var objto = new Array();

      $('#btn-saveroutes').click(function(){
          //var json = JSON.stringify(polyline); 
          var jenroute = prompt("Input Jenis Rute (Ex: KSPN, Perintis)");
          objto = [];
          // while(objto.length > 0) {
          //     objto.pop();
          // }
          //objto.push(datacsrf);
          $.each(polyline,function(index,item){
              //item[0].options.points = L.PolylineUtil.encode(item[0]._latlngs);
              //console.log('polyline dan marker index : '+index);
              console.log(polyline[index]);

              
              //console.log(polyline[index]);
              var data = {};  
              var point_ = {};
              var waypoint_ = [];
              
              $.each(polyline[index],function(index2,item2){
                  point_[index2]= L.PolylineUtil.encode(item2._latlngs);
                  //point_[index2]= item2._latlngs;
                  
              });
              data.origin = null;
              data.or_lat = null;
              data.or_lng = null;
              data.toward = null;
              data.tw_lat = null;
              data.tw_lng = null;
              
              $.each(opMarker[index],function(index2,item2){
                  if(index2==0){
                    data.origin = item2.options.data;
                    data.or_lat = item2._latlng.lat;
                    data.or_lng = item2._latlng.lng;
                  }else if(index2==opMarker[index].length-1){
                    data.toward = item2.options.data;
                    data.tw_lat = item2._latlng.lat;
                    data.tw_lng = item2._latlng.lng;
                  }else{
                    //console.log(item2);
                    waypoint_.push({"name":item2.options.data,"lat":item2._latlng.lat,"lng":item2._latlng.lng });
                  }
              });
              
              
              data.name = polyline[index][0].options.data;
              data.jenroute = jenroute;
              data.color = polyline[index][0].options.color;
              // data.toward = opMarker[index][1].options.data;
              // data.tw_lat = opMarker[index][1]._latlng.lat;
              // data.tw_lng = opMarker[index][1]._latlng.lng;
              //data.points = L.PolylineUtil.encode(item[0]._latlngs);
              const waypoint_obj = Object.assign({}, waypoint_);

              data.points = JSON.stringify(point_);
              data.waypoints = JSON.stringify(waypoint_obj);
              //polyline[index][0].options.data = data;

              //console.log(polyline[index]);
              //console.log(item);
              objto.push(data);
              

          });
          //console.log(JSON.stringify(objto));
          
          $.ajax({
              type: "POST",
              url: baseUrl+'/main/ajax/saveroutes',
              data: {
                [csrfName]:csrfHash,
                jsondata: JSON.stringify(objto)
              },
              //contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(msg) {
                  alert('In Ajax');
              }
          });
          
      });

      

      $('#kmlfile').change(function(e) {
        //handleFile(e.target.files);
        for(var indexFile=0;indexFile<e.target.files.length;indexFile++){
          let file = e.target.files[indexFile];
          //console.log(e.target.files[indexFile]);
          //var randomColor = Math.floor(Math.random()*16777215).toString(16);

          //console.log(e.target.files[indexFile].name);
          //console.log('File ke - '+indexFile);
          var fileName = e.target.files[indexFile].name.replace(/ /gm,'-').replace(/.kml/gm,'').replace(/--/gm,'-').replace(/\(|\)/gm,'');
          
          function handleFile(file,indexFile,fileName){
            let reader = new FileReader();
            var readXml;
            reader.onload = async function(e) {
                   readXml=e.target.result;
                   var parser = new DOMParser();
                   var doc = await parser.parseFromString(readXml, "application/xml");
                   var xall = doc.getElementsByTagName("Placemark");
                   try{
                     var vcolor = doc.getElementsByTagName('color')[0].textContent;
                   }catch(e){
                      var vcolor = '000000';
                   }
                   vcolor = '#'+vcolor.substr(vcolor.length-6);
                   //console.log('color ke - '+indexFile+' - '+vcolor);
                   for(var i=0;i<xall.length;i++){
                      if($(xall[i]).find('LineString').length>0){
                          //console.log('polyline ke - '+indexFile+' - '+i);
                          if(vcolor=='000000'){
                              console.log(fileName);
                          }else{
                            createPolyline(xall,indexFile,i,vcolor,fileName);
                          }
                      }else{
                          if($(xall[i]).find('coordinates').length>0){
                              //console.log('marker ke - '+indexFile+' - '+i);
                              if(vcolor=='000000'){
                                  console.log(fileName);
                              }else{
                                  createMarker(xall,indexFile,i,vcolor,fileName);
                              }
                          }
                      }
                   }
                   map.fitBounds(featureGroup.getBounds());
                   map.addLayer(opMarkersGroup);

            }

            reader.readAsText(file);
          }
          handleFile(file,indexFile,fileName);
          //console.log(readXml);
         
        }    
        
    });   

    function createPolyline(xall,indexFile,i,vcolor,fileName){
        var vname = $(xall[i]).find('name')[0].textContent.replace(/^\s+|\s+$|\n+|\n+$/gm,'');
        var latlngs_ = $(xall[i]).find('LineString').find('coordinates')[0].textContent.replace(/^\s+|\s+$/gm,'');
        //console.log(latlngs_);
        var latlngs_1 = latlngs_.split(",0\n");
        var latlngs = [];
        for(i2 in latlngs_1){
          if(isNaN(parseFloat(latlngs_1[i2].split(',')[1]))){
          }else{
            latlngs.push([parseFloat(latlngs_1[i2].split(',')[1]),parseFloat(latlngs_1[i2].split(',')[0])]);
          }
        }
        //console.log(latlngs);
        if(typeof polyline[fileName]=='undefined') polyline[fileName] = [];
        //polyline[fileName] = {};
        var poly_ = L.polyline(latlngs, {color: vcolor, data:vname }).bindPopup(vname).on('click',onMarkerClick).addTo(map);
        polyline[fileName].push(poly_);
        // zoom the map to the polyline
       // console.log(L.PolylineUtil.encode(latlngs));

        featureGroup.addLayer(poly_);
        featureGroup.addTo(map);
        
        //console.log(polyline);
        indexPoly++;
    }

    

    function createMarker(xall,indexFile,i,vcolor,fileName){
        //console.log(xall[i]);
        
        var vname = $(xall[i]).find('name')[0].textContent.replace(/^\s+|\s+$|\n+|\n+$/gm,'');
        //console.log(vname);
        
        var latlngs_ = $(xall[i]).find('coordinates')[0].textContent.replace(/^\s+|\s+$|\n+|\n+$| /gm,'');
        //console.log(latlngs_);
        var latlngs_1 = latlngs_.split(",");

        //console.log(latlngs_1);
        var latlngs = [parseFloat(latlngs_1[1]),parseFloat(latlngs_1[0])];
        
        //console.log(indexFile);
        if(typeof opMarker[fileName]=='undefined') opMarker[fileName] = [];
        try{      
          var marker_ = L.marker(latlngs,{
          contextmenu: false,
          icon: myIcon['bus-terminal'],
          data:vname,

          }).bindPopup(vname).on('click',onMarkerClick);  
          opMarkersGroup.addLayer(marker_);
          console.log(opMarkersGroup);
          opMarker[fileName].push(marker_);
          //console.log(opMarker);
          indexMarker++;
        }catch(e){
          console.log('bermasalah--->'+fileName);
          //console.log(e);
        }
        
    }

    function getVehiclesLastPosition(){

        $.ajax({
            type:'POST',
            url: baseUrl+'/main/ajax/vehiclesLastPosition0',
            data:datacsrf,
            success:function(response){
                var ret = $.parseJSON(response);
                var randomColor = Math.floor(Math.random()*16777215).toString(16);

                if(ret.ResponseCode==1){
                    ret.Data.forEach(function(item,index){
                        console.log(index);
                        console.log(item);
                        if(vehicleMarkers.hasOwnProperty(item.gps_sn)){
                            console.log('move vehicle marker');
                        }else{
                            console.log('new vechicle marker');
                            if(typeof colorGroup[item.group_nm]=='undefined'){
		                        var randomColor = getRandomRolor();      
		                        colorGroup[item.group_nm] = randomColor;
		                        // var busIconURL = encodeURI("data:image/svg+xml," + iconPathString.replace('#000000','#'+randomColor)).replace('#','%23');
						        busIconURL = encodeURI("data:image/svg+xml," + iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
						        busIconPath[item.group_nm] = L.icon({
						          iconUrl: busIconURL,
						          iconSize:     [iconCurSize+3, iconCurSize+3],
						          shadowSize:   [31, 40],
						          iconAnchor:   [6, 17],
						          shadowAnchor: [2, 31],
						          popupAnchor:  [-1, -31]
						        });
						        //console.log(busIconPath);
		                    }
                            createVehicleMarker(item,randomColor,busIconPath[item.group_nm]);
                            console.log(item.company_nm);
                        }
                    });
                }
            }
        });
        $.ajax({
            type:'POST',
            url: baseUrl+'/main/ajax/vehiclesLastPosition1',
            data:datacsrf,
            success:function(response){
                var ret = $.parseJSON(response);
                var randomColor = Math.floor(Math.random()*16777215).toString(16);

                if(ret.ResponseCode==1){
                    ret.Data.forEach(function(item,index){
                        console.log(index);
                        console.log(item);
                        if(vehicleMarkers.hasOwnProperty(item.gps_sn)){
                            console.log('move vehicle marker');
                        }else{
                            console.log('new vechicle marker');
                             if(typeof colorGroup[item.group_nm]=='undefined'){
		                        var randomColor = getRandomRolor();      
		                        colorGroup[item.group_nm] = randomColor;
		                        // var busIconURL = encodeURI("data:image/svg+xml," + iconPathString.replace('#000000','#'+randomColor)).replace('#','%23');
						        busIconURL = encodeURI("data:image/svg+xml," + iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
						        busIconPath[item.group_nm] = L.icon({
						          iconUrl: busIconURL,
						          iconSize:     [iconCurSize+3, iconCurSize+3],
						          shadowSize:   [31, 40],
						          iconAnchor:   [6, 17],
						          shadowAnchor: [2, 31],
						          popupAnchor:  [-1, -31]
						        });
						        //console.log(busIconPath);
		                    }
                            createVehicleMarker(item,randomColor,busIconPath[item.group_nm]);
                            console.log(item.company_nm);
                        }
                    });
                }
            }
        });
        $.ajax({
            type:'POST',
            url: baseUrl+'/main/ajax/vehiclesLastPosition2',
            data:datacsrf,
            success:function(response){
                var ret = $.parseJSON(response);
                var randomColor = Math.floor(Math.random()*16777215).toString(16);

                if(ret.ResponseCode==1){
                    ret.Data.forEach(function(item,index){
                        console.log(index);
                        console.log(item);
                        if(vehicleMarkers.hasOwnProperty(item.gps_sn)){
                            console.log('move vehicle marker');
                        }else{
                            console.log('new vechicle marker');
                            if(typeof colorGroup[item.group_nm]=='undefined'){
		                        var randomColor = getRandomRolor();      
		                        colorGroup[item.group_nm] = randomColor;
		                        // var busIconURL = encodeURI("data:image/svg+xml," + iconPathString.replace('#000000','#'+randomColor)).replace('#','%23');
						        busIconURL = encodeURI("data:image/svg+xml," + iconPathString2.replaceAll('#FF1744','#'+randomColor)).replaceAll('#','%23');
						        busIconPath[item.group_nm] = L.icon({
						          iconUrl: busIconURL,
						          iconSize:     [iconCurSize+3, iconCurSize+3],
						          shadowSize:   [31, 40],
						          iconAnchor:   [6, 17],
						          shadowAnchor: [2, 31],
						          popupAnchor:  [-1, -31]
						        });
						        //console.log(busIconPath);
		                    }
                            createVehicleMarker(item,randomColor,busIconPath[item.group_nm]);
                            console.log(item.company_nm);
                        }
                    });
                }
            }
        });
    }

    function createVehicleMarker(item,randomColor,busIconPath){
        

        

        
        //console.log(item);
        //Date.parse(item.gps_time)
        vehicleMarkers[item.gps_sn] = L.marker([item.lat, item.lon], {
          contextmenu: 'true',
          contextmenuWidth: 300,
          hideOnSelect: 'true',
          contextmenuItems: [{
              //icon: baseUrl+'assets/img/halte2.png',
              text: 'Edit Vehicles',
              callback: editVehicles,
              index: 1
          }],
          icon: busIconPath,
          rotationAngle: parseFloat(item.direction),
          data:item
        }).addTo(vehicleMarkersGroup);

        setBusTooltip(vehicleMarkers[item.gps_sn],item);
        vehicleMarkers[item.gps_sn].on('dblclick', function(e){
            map.flyTo(e.sourceTarget._latlng,15);
        });
        vehicleMarkers[item.gps_sn].setRotationAngle(item.direction);
        map.addLayer(vehicleMarkersGroup);
        theBusPosition[item.gps_sn] = [parseFloat(item.lat),parseFloat(item.lon)];

        
        
    }

    function setBusTooltip(busMarker,item){
      const batt_level = item.battery_percent.toFixed(0);
        var batt_color = 'green';
        switch(true){
          case batt_level<15:
              batt_color = 'red';
          break;
          case batt_level<20:
              batt_color = 'orange';
          break;
          case batt_level>20:
              batt_color = 'green';
          break;
        }
      var infoVehicle = '<table>'+
        '<tr><td>Jenis</td><td>'+item.company_nm+'</td></tr>'+
        '<tr><td>Grup</td><td>'+item.group_nm+'</td></tr>'+
        '<tr><td>GPS SN</td><td>'+item.gps_sn+'</td></tr>'+
        '<tr><td>No. Kendaraan</td><td>'+item.nopol+'</td></tr>'+
        '<tr><td>No. Aset</td><td>'+((item.no_aset=='undefined')?item.no_aset:'-')+'</td></tr>'+
        '<tr><td>Tipe</td><td>'+((item.car_type=='undefined')?item.car_type:'-')+'</td></tr>'+
        '<tr><td>acc</td><td>'+item.acc+'</td></tr>'+
        '<tr><td>Angle</td><td>'+item.direction+'</td></tr>'+
        '<tr><td>Nama Driver</td><td>'+((item.driver_nm==='undefined')?item.driver_nm:'-')+'</td></tr>'+
        '<tr><td>Speed</td><td>'+item.speed+' km/h</td></tr>'+
        '<tr><td>Battery</td><td><div style="border:1px solid black"><div style="background-color:'+batt_color+';width:'+item.battery_percent.toFixed(0)+'%">'+item.battery_percent.toFixed(2)+'</div></div></td></tr>'+
        '<tr><td>Last Updated</td><td>'+$.timeago(item.gps_time)+' <br/>'+item.gps_time+'</td></tr>'+
        '</table>';
        busMarker.bindPopup(infoVehicle);
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
        //var latlng = new google.maps.LatLng(position[0], position[1]);
        var newLatLng_ = new L.LatLng(theBusPosition[key][0], theBusPosition[key][1]);
        // if($('#caribus').select2('val')==key){
        //   map.panTo(newLatLng_,17);
        // }
        vehicleMarkers[key].setLatLng(newLatLng_).update();
        //marker.setPosition(latlng);
        if(theBus_i[key]!=numDeltas){
          theBus_i[key]++;
          //console.log(theBus_i[key]);
          setTimeout(moveMarker, delay,item,key);
        }else{
          vehicleMarkers[item.gps_sn].setRotationAngle(item.direction);
          setBusTooltip(vehicleMarkers[item.gps_sn],item);
        }
      }

    function editVehicles(){

    }

    function loadAllRoutes(){
      $.ajax({
            type: "POST",
            url: baseUrl+'/main/ajax/jsonroutes',
            data: {
              [csrfName]:csrfHash
            },
            //contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(response) {
                //var ret = $.parseJSON(response);
                //console.log(response);
                //let results = [];
               //  var vroutes = {};
               //  vroutes.results = [];
               //  var objRoutetype = [];
               //  objRoutetype.push('-');
               //  var ng = 0;
               //  $.each(response.data, function (index,obj) {
               //      if (objtype[objtype.length-1]!=obj.group_nm){
               //        vdataz.results.push({ text: obj.group_nm });
               //        ng = 1;
               //        vdataz.results[vdataz.results.length-1].children =[{ id:obj.gps_sn, text:ng+'. '+obj.nopol+' <span style="display:none">'+obj.group_nm+','+obj.gps_sn+'</span>', lat:obj.lat,lon:obj.lon}];
               //      }else{
               //        vdataz.results[vdataz.results.length-1].children.push({ id:obj.gps_sn, text:ng+'. '+obj.nopol+' <span style="display:none">'+obj.group_nm+','+obj.gps_sn+'</span>', lat:obj.lat,lon:obj.lon});
               //      }
               //      ng++;
               //      objtype.push(obj.group_nm);
               //      return obj;
               //  });
               // vdataz.pagination = { more:true };
               // //console.log(vdataz.results.length);
               // $.each(vdataz.results,function(index,item){
               //    vdataz.results[index].text = item.text+' ('+item.children.length+' armada)';
               // });
               // //console.log(vdataz.results);
               
               //  $("#find_bus").select2({
               //      placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="bx bx-bus" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Armada</span>',
               //      allowClear: true,
               //      data:vdataz.results,
               //      escapeMarkup : function(markup) { return markup; }
               //       // need to override the changed default
               //  });

                var dataStart = 0;

                $('#datatable2').dataTable( {
				    "data": response,
				    "pageLength": 5,
				    "columns": [
				        { 
				        	"data": "id", orderable: true,
			                render: function (a, type, data, index) {
			                    return dataStart + index.row + 1
			                }
		            	},
				        { "data": "jenroute" },
				        { "data": "name" },
				        { "data": "origin" },
				        { "data": "toward" }
				    ],
				    scrollY:        "300px",
			        scrollX:        true,
			        scrollCollapse: true,
			        //paging:         false,
			        columnDefs: [
			            { width: '30%', targets: 1 }
			        ],
			        fixedColumns: true
				});

                $.each(response,function(index,item){
                    loadRoute(item);
                });
                console.log(polylineData);
                map.fitBounds(featureGroup.getBounds());
                if(map.hasLayer(featureGroup)) {
                    map.removeLayer(featureGroup);
                }

                if(map.hasLayer(layerGroupShelter)){
                    map.removeLayer(layerGroupShelter);
                }
            }
        });
    }

    loadAllRoutes();

    function loadRoute(item){
         $.each($.parseJSON(item.points),function(index2,point){
             if(typeof polylineData[item.name]=='undefined') polylineData[item.name] = [];
             var latlng3 = L.PolylineUtil.decode(point);
             polylineData[item.name] = L.polyline(latlng3, {
              contextmenu: true,
              contextmenuWidth: 240,
              contextmenuItems: [{
                  text: 'Create Auto Zone',
                  callback: createAutoZone,
              }],
              color: '#'+getRandomRolor(),
              data:item 
             }).bindPopup(item.name).on('click',onMarkerClick);
             //polylineData[item.name].push(poly_);
             featureGroup.addLayer(polylineData[item.name]);
             //console.log(poly_);
         });
         

         

         if(typeof opMarkerData[item.name]=='undefined') opMarkerData[item.name] = [];
          try{      
            if(item.or_lat!=null){
              var marker_ = L.marker([item.or_lat,item.or_lng],{
              contextmenu: false,
              icon: myIcon['bus-terminal'],
              data:item.origin,

              }).bindPopup(item.origin).on('click',onMarkerClick).addTo(layerGroupShelter);  
              opMarkerData[item.name].push(marker_);
            }
            if(item.tw_lat!=null){
              var marker_ = L.marker([item.tw_lat,item.tw_lng],{
              contextmenu: false,
              icon: myIcon['bus-terminal'],
              data:item.toward,

              }).bindPopup(item.toward).on('click',onMarkerClick).addTo(layerGroupShelter);  
              opMarkerData[item.name].push(marker_);
            }

          }catch(e){
            console.log(e);
          }
          map.addLayer(layerGroupShelter);
         featureGroup.addTo(map);
        
    }

  function getDistance(origin, destination) {
    // return distance in meters
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
      //console.log(e.relatedTarget.options.data);

      polygenap = [];
      xx = 0;
      x = 0;
      currentAngle = 360;
      currentPolygon = [];
      tempPoly = [];
      layerGroup = L.layerGroup();
      var stops_ = e.relatedTarget.options.data;
      console.log(stops_);
      var ret = e.relatedTarget;
      $.each(ret._latlngs,function(index,item){
        //console.log(index);
        if(index===0){ // identify the first lat lng
            var distance = 0;
            console.log(index);
            console.log(item);
            // lets create start point to first lat lng;    
            L.circle(item, {color: 'green', weight: 16, fillOpacity: 0.9}).bindPopup(distance+' ['+index+']').addTo(map);
        }else{
            if(index===ret._latlngs.length-1){ // idenfity the last lat lng
                console.log(index);
                console.log(item);
                // lets create stop point to last lat lng
                L.circle(item, {color: 'red', weight: 16, fillOpacity: 0.9}).bindPopup(distance+' ['+index+']').addTo(map);
            }
            var oldShelter = ret._latlngs[0];
            var newShelterLatLng = ret._latlngs[ret._latlngs.length-1];

            var oldLatLng = ret._latlngs[index-1];
            var newLatLng = item;
            var distance = getDistance([oldLatLng.lat,oldLatLng.lng],[newLatLng.lat,newLatLng.lng]).toFixed(2);
            var distanceToShelter = getDistance([oldLatLng.lat,oldLatLng.lng],[newShelterLatLng.lat,newShelterLatLng.lng]);
            var distanceLeftShelter = getDistance([newLatLng.lat,newLatLng.lng],[newShelterLatLng.lat,newShelterLatLng.lng]);
            var ag1 = L.GeometryUtil.bearing(oldLatLng,newLatLng);
            var ag2 = L.GeometryUtil.bearing(newLatLng,newShelterLatLng);
            var aGap = Math.abs(ag1-ag2);

            if(distanceToShelter < distance) {
                var angle2 = L.GeometryUtil.bearing(oldLatLng,newLatLng);
                var vangleR2 = angle2-90;
                var vangleL2 = angle2+90;

                var angle = L.GeometryUtil.bearing(oldLatLng,newLatLng);
                var vangleRB = (angle-180);
                var newShelterLatLngLeft = L.GeometryUtil.destination(newLatLng,vangleRB,distanceLeftShelter);

                var vangleR = angle-90;
                var vangleL = angle+90;
                var L1 = L.GeometryUtil.destination(oldLatLng,vangleR,20);
                var L2 = L.GeometryUtil.destination(oldLatLng,vangleL,20);
                var L3 = L.GeometryUtil.destination(newShelterLatLngLeft,vangleR,20);
                var L4 = L.GeometryUtil.destination(newShelterLatLngLeft,vangleL,20);
                var coorPolygon = [L1,L3,L4,L2,L1];
                var addedPolygon = [L3,L4];
                console.log('case-1');
                createAndStorePolygon(angle, coorPolygon, addedPolygon, item, ret._latlngs[ret.latlngs_.length-1],'case-1',index>4);

                // counter++;

                var L1s = L.GeometryUtil.destination(newShelterLatLngLeft,vangleR2,20);
                var L2s = L.GeometryUtil.destination(newShelterLatLngLeft,vangleL2,20);
                var L3s = L.GeometryUtil.destination(newLatLng,vangleR2,20);
                var L4s = L.GeometryUtil.destination(newLatLng,vangleL2,20);
                var coorPolygon2 = [L1s,L3s,L4s,L2s,L1s];
                var addedPolygon2 = [L3s,L4s];
                console.log('case-2');
                createAndStorePolygon(angle2, coorPolygon2, addedPolygon2, newShelter, oldShelter,'case-2',index>4);
            }else{
                var angle = L.GeometryUtil.bearing(oldLatLng,newLatLng);
                //console.log(oldLatLng.lat+','+oldLatLng.lng+','+angle.toFixed(2)+','+distance);
                var vangleR = angle-90;
                var vangleL = angle+90;

                var L1 = L.GeometryUtil.destination(oldLatLng,vangleR,20);
                var L2 = L.GeometryUtil.destination(oldLatLng,vangleL,20);
                var L3 = L.GeometryUtil.destination(newLatLng,vangleR,20);
                var L4 = L.GeometryUtil.destination(newLatLng,vangleL,20);
                //L.circle(L1,{weight:5}).bindPopup('L1').addTo(map);
                // L.circle(L1, {color: 'brown', radius: 1, fillOpacity: 0.9}).bindPopup('L1 ').addTo(map);
                // L.circle(L2, {color: 'green', radius: 1, fillOpacity: 0.9}).bindPopup('L2 ').addTo(map);
                // L.circle(L3, {color: 'blue', radius: 1, fillOpacity: 0.9}).bindPopup('L3 ').addTo(map);
                // L.circle(L4, {color: 'orange', radius: 1, fillOpacity: 0.9}).bindPopup('L4 ').addTo(map);
                var coorPolygon = [L1,L3,L4,L2,L1];
                var addedPolygon = [L3,L4];
                var newShelter = ret._latlngs[ret._latlngs.length-1];
                //console.log('last shelter '+newShelter);
                //console.log('before last shelter '+oldShelter);
                //console.log('case-3 > '+counter+' --- '+ret.routesPoint.length);
                // if(counter==(ret.routesPoint.length-2)){
                // oldShelter = ret.routesPoint[counter]; 
                // newShelter = ret.routesPoint[counter+1];
                // //console.log('last true > '+oldShelter+' to '+newShelter);
                // }else{
                // //console.log('last false > '+oldShelter+' to '+newShelter);
                // }
                console.log('case-3');
                createAndStorePolygon(angle, coorPolygon, addedPolygon, newShelter, oldShelter,'case-3',index>4);
                // L.circle(polyline._latlngs[i], {radius: 5,fillColor:'green'}).bindPopup(currentAngle+' ['+i+'],'+angle).addTo(map);
            }                    
        }

      });
      map.addLayer(layerPolyGroup);

      // define rectangle geographical bounds
    //var bounds = [[54.559322, -5.767822], [56.1210604, -3.021240]];

    // create an orange rectangle
    //L.rectangle(bounds, {color: "#ff7800", weight: 1}).addTo(map);

    // zoom the map to the rectangle bounds
    //map.fitBounds(bounds);

    }


    $('.right-bar-toggle').on('click', function (e) {
        $('body').toggleClass('right-bar-enabled');
    });

    $(document).on('click', 'body', function (e) {
        if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
            return;
        }
        $('body').removeClass('right-bar-enabled');
        return;
    });

    layerGroupShelter.on('clustermouseover', function(e) {
      // your custom L.MarkerCluster extended with function highlight()
      //console.log(e.layer);
    });

    map.on('zoomend',function() {
      //alert(map.getZoom());
      if(map.getZoom()>=8){
            if(!map.hasLayer(featureGroup)) {
              map.addLayer(featureGroup);
            }
          
            if(!map.hasLayer(layerGroupShelter)){
                map.addLayer(layerGroupShelter);
            }
      }
      if(map.getZoom()<8){
          if(map.hasLayer(featureGroup)) {
              map.removeLayer(featureGroup);
          }
          if(map.hasLayer(layerGroupShelter)){
              map.removeLayer(layerGroupShelter);
          }
      }
    });
    
    var $dragging = null;

    $(document.body).on("mousemove", function(e) {
        if ($dragging) {
        	if(e.pageY<70) e.pageY = 70;
        	if(e.pageX<0) e.pageX = 0;
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        }
    });


    $(document.body).on("mousedown", "[draggable=true]", function (e) {
    	//console.log(e);
        $dragging = $(e.currentTarget);
    });

    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });

    function monitoringRoute(){
        $.ajax({
              type: "POST",
              url: baseUrl+'/main/ajax/jsonmonroute',
              data: {
                [csrfName]:csrfHash,
              },
              //contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(response) {
                    var dataStart = 0;

                    $('#datatable3').dataTable( {
                        "data": response,
                        "pageLength": 5,
                        "columns": [
                            { 
                                "data": "id", orderable: true,
                                render: function (a, type, data, index) {
                                    return dataStart + index.row + 1
                                }
                            },
                            { "data": "group_nm" },
                            { "data": "jml" },
                            { "data": "today_inactive" },
                            { "data": "today_active" },
                            { "data": "today_active_less_minute" },
                            { "data": "today_active_minute" },
                            { "data": "today_active_less_hour" },
                        ],
                        scrollY:        "300px",
                        scrollX:        true,
                        scrollCollapse: true,
                        //paging:         false,
                        columnDefs: [
                            { width: '30%', targets: 1 }
                        ],
                        fixedColumns: true
                    });
              }
          });
      }

        monitoringRoute();
        $("#find_route").show();

        const url_ajax = '<?= base_url() . "/main/ajax" ?>';

        const select2Array = [{
            id: 'find_route',
            url: '/route_select_get',
            placeholder: '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute</span>',
            params: null
        }];

        select2Array.forEach(function (x) {
            select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#find_route').on('select2:select', function (e) {
              var data = e.params.data;
              console.log(polylineData[data.name]);
              
              map.fitBounds(polylineData[data.name].getBounds());
              polylineData[data.name].openPopup();
        });
	

	}catch(e){
		alert(e);
	}

    
  });
</script>
