<table class="table table-bordered" id="t_aduan" width="100%" >
	<thead>
		<tr>
			<th>No</th>
			<th>User Internal</th>
			<th>Aduan</th>
			<th>Lampiran</th>
		</tr>
	</thead>
</table>	

<script>
	var editor;
    var coreEvents;

	$(document).ready(function(){
		//alert('tet');
		coreEvents = new CoreEvents();
		coreEvents.ajax = '<?=base_url()?>/main/ajax';
		coreEvents.urlMD = 'https://mitradarat.dephub.go.id/';
		coreEvents.action = '<?=base_url()?>/main/action';
		coreEvents.csrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
        
		var n = 0;
		
		var t = $('#t_aduan').DataTable({
			ajax: '<?=base_url()?>/main/ajax/dataaduan',
			columns: [
	            {
	                data: 'id',

	            },
	            {
	                data: 'aduan_email',
	                render:function(data,type,row,meta){
	                	var isloc = row.lat!=null?`<div class="map-this-user-dashboard" data-id="${row.id}" data-posko-id="null" data-satpel-id="${row.lokker_id}" data-lat="${row.lat}" data-lon="${row.lon}" data-item="${row}"><i class="bx bx-map-pin"></i></div>`:``;
	                	return `<div class="box">
	                      <div class="img-wrapper">
	                          <img src="${(row.user_web_photo!=null)?row.user_web_photo:row.user_mobile_photo}" class="rounded-circle avatar-lg" alt="">
	                          <span class="user-status"></span>
	                      </div>
	                      <div class="flex-grow-1 overflow-hidden">
	                          <h5 class="text-truncate font-size-14 mb-1">${row.user_web_name}</h5>
	                          <p class="text-truncate mb-0">${row.status}</p>
	                          <p class="text-truncate mb-0">${row.lokasi_name}</p>
	                          <p class="text-truncate mb-0">Tipe OS : ${row.user_mobile_type}</p>
	                      </div>
	                      <div class="flex-shrink-0">
	                          <div class="call-this-user-dashboard" data-id="${row.user_mobile_id}" data-posko-id="null" data-satpel-id="${row.lokker_id}"><i class="bx bx-phone-call"></i></div>
	                          ${isloc}
	                      </div>
	                  </div>`;
	                }
	            },
	            {
	                data: 'aduan_judul',
	                render: function(data, type, row, meta) {
						return `<div class="box">
			                      <div class="flex-grow-1 overflow-hidden">
			                          <h5 class="text-truncate font-size-14 mb-1">${row.aduan_judul}</h5>
			                          <p class="text-truncate font-size-12 mb-2">${row.created_at+" "+$.timeago(row.created_at)}</p>
			                          <p class="text-truncate mb-0"></p>
			                          <p class="text-truncate mb-0"><i>Aduan :</i></p>
			                          <div class="ctext-wrap-content">
                                        <p class="mb-0">
                                            ${row.aduan_detail}
                                        </p>
                            			</div>
                            			</br>
			                          <p class="text-truncate mb-0"><i>${row.aduan_reply!=null?"Balasan :":""}</i></p>
			                          <div class="ctext-wrap-content">
                                        <p class="mb-0">
                                            ${row.aduan_reply!=null?row.aduan_reply:""}
                                        </p>
                            			</div>
                            			</br>
					                 
			                      </div>

			                      <div class="flex-shrink-0">
			                      	<div id="replay" data-aduan-id="${row.id}" data-aduan-title="${row.aduan_judul}" data-aduan-detail="${row.aduan_detail}" data-aduan-reply="${row.aduan_reply}" data-toggle="modal" data-target="#dialog-reply-aduan">
			                           		<button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Balas Aduan</span> <i class="mdi mdi-message-reply-text float-end"></i></button>
			                        	</div>
			                      </div>
			                  </div>`;
					}
	            },
	            {
	                data: 'aduan_lampiran',
	                render: function(data, type, row, meta) {
	                	if(row.aduan_lampiran!=null){
							return  `<img src="${coreEvents.urlMD}${row.aduan_lampiran}" class="rounded" width="100" />` 
						}else{
							return '';
						}
					}
	            }
            ],
            columnDefs: [
	            {
	                searchable: false,
	                orderable: false,
	                targets: 0,
	            },
	        ],
	        order: [[0, 'desc']],
	        drawCallback: function() {   
	        	n++;
	        }
		});

		t.on('order.dt search.dt', function () {
	        let i = 1;
	 
	        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
	            this.data(i++);
	        });
	    }).draw();

	    $(document).on('click','#replay',function(e){
            $('#dialog-reply-aduan').modal('show');
            var aduan_id = $(this).data('aduan-id');
            var aduan_title = $(this).data('aduan-title');
            var aduan_reply = $(this).data('aduan-reply');
            var aduan_detail = $(this).data('aduan-detail');
            $(".modal-header #title").text(aduan_title);
            $(".modal-body #aduanId").val(aduan_id);
            // $("#dialog-reply-aduan").find('#aduanDetail').text(aduan_detail);
            $(".modal-body #aduanReply").text(aduan_reply);
            $(".modal-body #aduanDetail").text(aduan_detail);
        });

	    $(function() {$('#reply-submit').on('click', function(e) {
			    e.preventDefault();
			    // alert("asdf");
			    $.ajax({
			        method: 'post',
                	url:Dashboard.baseUrl+'/main/action/aduan_update',
                    data: {
                        [Dashboard.csrfName]:Dashboard.csrfHash,
                        aduan_id:$(".modal-body #aduanId").val(),
                        aduan_reply:$(".modal-body #aduanReply").val()
                    },
                    beforeSend:function(request){
                        request.setRequestHeader("X-NGI-TOKEN", 'dev');
                    },
                    success:function(response){
                    	$('#dialog-reply-aduan').modal('hide');
                    	loadAduan();
					}
			    });
			    return false;
			});
		});
	});
	
	function loadAduan(){
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
	}
</script>

<div class="modal fade" id="dialog-reply-aduan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#5156be;">
                <h5 class="modal-title" id="title" name="title" style="color:white;"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
                <input class="form-control" type="hidden" value="" name="aduanId" id="aduanId" readonly>
                <div class="mb-3">
                    <label for="example-text-input" class="form-label">Aduan</label>
                    <textarea class="form-control" rows="3" name="aduanDetail" id="aduanDetail" readonly></textarea>
                    <!-- <input class="form-control" type="text" value="" name="aduanDetail" id="aduanDetail" readonly> -->
                </div>
                <div class="mb-3">
                    <label for="example-text-input" class="form-label">Balasan aduan</label>
                    <textarea class="form-control" rows="3" name="aduanReply" id="aduanReply"></textarea>
                    <!-- <input class="form-control" type="text" value="" name="aduanReply" id="aduanReply"> -->
                </div>
            </div>
            <div class="modal-footer">
                <button id="reply-submit" type="button" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
            </div>
        </div>
    </div>
</div>