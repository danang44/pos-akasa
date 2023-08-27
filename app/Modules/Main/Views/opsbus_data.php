<table class="table table-bordered" id="opsbus" width="100%" >
	<thead>
		<tr>
			<th>No</th>
			<th>GPS SN</th>
			<th>No. Kendaraan</th>
			<th>Group</th>
			<th>Company Name</th>
			<th>Rute</th>
		</tr>
	</thead>
</table>	

<script>
	var editor;
    var coreEvents;

	$(document).ready(function(){
		coreEvents = new CoreEvents();
		coreEvents.ajax = '<?=base_url()?>/main/ajax';
		coreEvents.action = '<?=base_url()?>/main/action';
		coreEvents.csrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
		

        
		var n = 0;
		var placeholder = '<span style="font-size:16px;margin-top:1px;"><i class="mdi mdi-map-marker-distance" style="color:blue;"></i></span> <span style="font-size:14px;padding-left:4px;">Cari Rute</span>';
		var t = $('#opsbus').DataTable({
			ajax: '<?=base_url()?>/main/ajax/databusload',
			columns: [
	            {
	                data: 'gps_sn',

	            },
	            {
	                data: 'gps_sn',
	            },
	            {
	                data: 'nopol',
	            },
	            {
	                data: 'group_nm',
	            },
	            {
	                data: 'company_nm',
	            },
	            {
	                data: 'route_id',
	                width: '300px',
	                render: function(data, type, row, meta) {

						return  '<select name="route_id2" class="select2edit" data-gps_sn="'+row.gps_sn+'" data-nopol="'+row.nopol+'" data-id="'+row.route_id+'" data-text="'+row.route_name+'" style="width:100%"></select><span style="display:none">'+row.route_name+'</span>';
					},
	            },
            ],
            columnDefs: [
	            {
	                searchable: false,
	                orderable: false,
	                targets: 0,
	            },
	        ],
	        order: [[1, 'asc']],
	        drawCallback: function() {   
	        	n++;
	        	coreEvents.select2Init('select[name="route_id2"]', '/route_select_get', placeholder, null,'#bus-modal');
	        	$('select[name="route_id2"]').on('select2:select',function(e){
	        		//console.log($(this).data('gps_sn'));
	        		var gps_sn = $(this).data('gps_sn');
	        		//console.log(e.params.data);
	        		
	        		
	        		Swal.fire({
	        			title: "Konfirmasi",
		                text: "Apakah benar armada "+$(this).data('nopol')+" bekerja di Rute "+e.params.data.text+" ?",
		                icon: "question",
						showConfirmButton:true,
						showCancelButton: true,
						confirmButtonText: 'Simpan',
						cancelButtonText: 'Batal',
						focusConfirm:true,
		            }).then(function(result) {
		            	if(result.value) {
		                    Swal.fire({
		                        title: "",
		                        icon: "info",
		                        text: "Proses menyimpan data, mohon ditunggu...",
		                        didOpen: function() {
		                            Swal.showLoading()
		                        }
		                    });

		                    //alert(coreEvents.ajax);
		                    let data = { 
	                        	gps_sn : gps_sn,
	                        	route_id : e.params.data.id,		                        	
		                    }
            				$.extend(data, coreEvents.csrf);

		                    $.ajax({
		                        url : coreEvents.action + '/bus_update',
		                        type : 'post',
		                        data : data,
		                        dataType : 'json',
		                        success: function(result){
		                            Swal.close();
		                            if(result.success){
		                                Swal.fire('Sukses', result.message, 'success');
		                            }else{
		                                Swal.fire('Error', result.message, 'error');
		                            }
		                        },
		                        error: function(){
		                            Swal.close();
		                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
		                        }
		                    });
		                }
		            });
		            $('.swal2-confirm').focus();
	        		//console.log($(this).select2('data'));
	        	});
	        	
	        }
		});



		t.on('order.dt search.dt', function () {
	        let i = 1;
	 
	        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
	            this.data(i++);
	        });
	    }).draw();

	    $('.select2edit').select2();

	    $('#opsbus').on( 'click', 'tbody td:nth-child(3),tbody td:nth-child(4),tbody td:nth-child(5)', function (e) {
	        $(this).attr('contenteditable',true);
	    } );

	    $(document).on('keydown','[contenteditable="true"]',function(e){
	    	
	    	if(e.keyCode==13){
	    		e.preventDefault();
	    		alert('simpan');
	    	}
	    });
		
	});
</script>