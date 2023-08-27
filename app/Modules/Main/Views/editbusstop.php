<?php
$request = \Config\Services::request();
#print_r($request->getPost());
?>
<form id="form-edit-bus-stop" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="id" name="id" value="<?= $request->getPost('item')['bs_id'] ?>" />
	<div>
	    <label class="form-label" for="default-input">Nama Bus Stop</label>
	    <input class="form-control" type="text" id="bs_nm" name="bs_nm" placeholder="Bus Stop Name" value="<?= $request->getPost('item')['bs_nm'] ?>">
	</div>
	<div class="mt-4">
	    <button id="btn-update-bus-stop" type="submit" class="btn btn-primary w-md">Rename</button>
	</div>
</form>