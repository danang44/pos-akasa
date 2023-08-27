<?php
$session = \Config\Services::session();
#$mainModel = model('App\Modules\Main\Models\MainModel');
#echo "<pre>";
#print_r($session->get());
#echo "</pre>";
?>
<div class="col-xl-12">
    <div class="card">

        <div class="card-body">
            <!-- Nav tabs -->
            <ul id="tab" class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-form" role="tab" aria-selected="true">
                        <span class="d-block d-sm-none"><i class="fab fa-wpforms"></i></span>
                        <span class="d-none d-sm-block">Update Password</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="tab-form" role="tabpanel">
                    <div class="card-body">
                        <form data-plugin="parsley" data-option="{}" id="form" novalidate>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?=$session->get('id')?>">
                            <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" id="user_web_name" name="user_web_name"
                                                required autocomplete="off" placeholder="Nama lengkap user" value="<?=$session->get('name')?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="user_web_email"
                                                name="user_web_email" required autocomplete="off" placeholder="email user" value="<?=$session->get('email')?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Username</label>
                                            <input type="text" class="form-control" id="user_web_username"
                                                name="user_web_username" required autocomplete="off"
                                                placeholder="username user untuk login" value="<?=$session->get('username')?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="user_web_password"
                                                name="user_web_password" required autocomplete="off"
                                                placeholder="password user untuk login">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Update Password</button>
                        </form>
                    </div>
                </div>
                

            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
</div>
<script type="text/javascript">
	const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    
    var coreEvents;

	

    
    
    $(document).ready(function(){
        coreEvents = new CoreEvents();
		coreEvents.url = url;
		coreEvents.ajax = url_ajax;
		coreEvents.csrf = { "<?= csrf_token() ?>": "<?= csrf_hash() ?>" };
		
		coreEvents.insertHandler = {
            placeholder: 'Berhasil update password',
            afterAction: function (result) {
                
            }
        }

        coreEvents.load();

        
        

    });
   
    
</script>