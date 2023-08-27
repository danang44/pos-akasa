
<?php
foreach($rspetugas as $item){
?>
<li class="active">
    <a href="#">
        <div class="d-flex align-items-start">
            <div class="flex-shrink-0 user-img <?=$item->status=='offline'?'':'online'?> align-self-center me-3">
                <img src="<?=$item->user_mobile_photo?>" class="rounded-circle avatar-sm" alt="">
                <span class="user-status"></span>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="text-truncate font-size-14 mb-1"><?=$item->name?></h5>
                <p class="text-truncate mb-0"><?=$item->status?></p>
            </div>
            <div class="flex-shrink-0">
                <div class="call-this-user" data-id="<?=$item->id?>"><i class="bx bx-phone-call"></i></div>
            </div>
        </div>
    </a>
</li>
<?php
}
?>