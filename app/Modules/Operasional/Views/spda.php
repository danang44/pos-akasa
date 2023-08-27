<style>
    #sig-canvas,
    #sig-canvas-manager,
    #bptd-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
        /* disable scroll when touch */
        touch-action: none;
    }

    .passenger-list {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .passenger-container {
        width: 200px;
    }

    .bus-container {
        width: 100px;
    }

    .spda-container {
        width: 100px;
    }

    .trip-container {
        width: 100px;
    }

    #action-spda button {
        margin-top: 10px;
    }
</style>
<div class="col-xl-12">
    <div class="card">

        <div class="card-body">
            <!-- Nav tabs -->
            <ul id="tab" class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <?php if ($role_code == "ppo") { ?>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-form2" role="tab" aria-selected="false">
                            <span class="d-block d-sm-none"><i class="fas fa-table"></i></span>
                            <span class="d-none d-sm-block">Update</span>
                        </a>
                    </li>
                <?php } else { ?>
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
                <?php } ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <?php if ($role_code == "ppo") { ?>
                    <div class="tab-pane active" id="tab-form2" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="mb-3">
                                    <label>SPDA</label>
                                    <select class="form-control sel2 select2-container" id="spda_id" name="spda_id" required aria-required="true"></select>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 mt-3" id="spda-detail"></div>
                            <div id="action-spda" style="display: none;">
                                <button type="button" class="btn btn-info input-pnp">Input Penumpang</button>
                                <button type="button" class="btn btn-success input-selesai">Selesaikan Perjalanan</button>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="tab-pane active" id="tab-data" role="tabpanel">
                        <div class="table-responsive" style="padding:7px;">
                            <table id="datatable" class="table table-theme table-row v-middle table-hover" data-plugin="dataTable">
                                <thead>
                                    <tr>
                                        <th><span>#</span></th>
                                        <th><span>Rute</span></th>
                                        <th><span>Trip</span></th>
                                        <th><span>Jarak Tempuh</span></th>
                                        <th><span>Tanggal/Jam Keberangkatan</span></th>
                                        <th><span>Pengemudi</span></th>
                                        <th><span>Ritase</span></th>
                                        <th><span>Bus</span></th>
                                        <th><span>Verifikator</span></th>
                                        <th><span>Status</span></th>
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
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Trayek</label>
                                                <select class="form-control sel2 select2-container" id="route_id" name="route_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Trip</label>
                                                <select class="form-control sel2 select2-container" id="trip_id" name="trip_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="trip_distance">Jarak Tempuh</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="trip_distance" name="trip_distance" readonly="" />
                                                <div class="input-group-text">Km</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Lintasan</label>
                                                <textarea readonly="" class="form-control" id="routes" name="routes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 50px;"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Nama Pengemudi</label>
                                                <select class="form-control sel2 select2_driver_id" id="driver_id" name="driver_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Armada Bus</label>
                                                <select class="form-control sel2 select2_bus_id" id="bus_id" name="bus_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" name="spda_date" id="spda_date" required="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Jadwal Keberangkatan</label>
                                                <select class="form-control sel2 select2_timetable_id" id="timetable_id" name="timetable_id" required aria-required="true"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Waktu Keberangkatan</label>
                                                <input type="time" class="form-control" name="spda_dep_datetime" id="spda_dep_datetime" required="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Kapasitas Bus</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bus_capacity" name="bus_capacity" maxlength="4" required autocomplete="off" placeholder="40" readonly="">
                                                    <span class="input-group-text"> Orang</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row">    
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label>Jarak (Km)</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="jrk_tempuh_spda" name="jrk_tempuh_spda" maxlength="15" required autocomplete="off" placeholder="Cth: 9.46">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kapasitas Bus</label>
                                            <select class="form-control select2_armada_kapasitas" id="armada_kapasitas" name="kapsts_bus_spda" required aria-required="true"></select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Total Penumpang</label>
                                            <input type="text" class="form-control" id="ttl_penumpang_spda" name="ttl_penumpang_spda" maxlength="15" required autocomplete="off" placeholder="Total Penumpang">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Total Pendapatan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" id="ttl_pdptan_spda" name="ttl_pdptan_spda" maxlength="15" required autocomplete="off" placeholder="Total Pendapatan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                    <br>
                                    <div class="mb-3 row">
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <p><b>Penjual Karcis / Pengemudi</b></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <canvas id="sig-canvas" name="sign_driver"></canvas>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 text-center mb-3">
                                                    <div class="btn btn-info btn-sm" id="sig-submitBtn">Simpan Tanda Tangan</div>
                                                    <div class="btn btn-default btn-sm" id="sig-clearBtn">Clear</div>
                                                </div>
                                                <div class="col-lg-12 text-center mb-3">
                                                    <i class="fa fa-check" id="sig-check" style="display:none;"> Tanda Tangan Pengemudi Tersimpan</i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <!-- <input type="text" class="form-control" name="form_spda_nama_pengemudi" id="form_spda_nama_pengemudi" placeholder="Nama Pengemudi / Penjual Karcis"> -->
                                                </div>
                                            </div>
                                            <div hidden>
                                                <div class="col-md-12">
                                                    <textarea id="sig-dataUrl" name="sig-dataUrl" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <p><b>General Manager / Manager Usaha</b></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <canvas id="sig-canvas-manager" name="sign_manager"></canvas>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 text-center mb-3">
                                                    <div class="btn btn-info btn-sm" id="sig-submitBtn-manager">Simpan Tanda Tangan</div>
                                                    <div class="btn btn-default btn-sm" id="sig-clearBtn-manager">Clear</div>
                                                </div>
                                                <div class="col-lg-12 text-center mb-3">
                                                    <i class="fa fa-check" id="sig-check-manager" style="display:none;"> Tanda Tangan Manager Tersimpan</i>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">&nbsp;</div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="manager_name" id="manager_name" placeholder="Nama General Manager / Manager Usaha">
                                                </div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <div hidden>
                                                <div class="col-md-12">
                                                    <textarea id="sig-dataUrl-manager" name="sig-dataUrl-manager" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="text-center">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button class="btn btn-dark" type="reset">Reset</button>
                                        </div>
                                    </div>
                                    <br><br>
                                    <h6 class="text-center">Catatan : Mohon cek kembali setiap data yang telah di
                                        input<br>Karena data bersifat tidak dapat di edit!</h6>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
</div>
<div class="modal fade" id="penumpang-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-penumpang" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Penumpang</h5>
                </div>
                <div class="modal-body" id="penumpang-modal-body">
                    <div id="penumpang-modal-body-load">
                        <?php
                        $result = null;
                        if (isset($_POST['id'])) {
                            $db = db_connect();
                            $query = $db->query('select sum(naik_dl) - sum(turun_dl) as turun_dl,
                                                    sum(naik_dp) - sum(turun_dp) as turun_dp,
                                                    sum(naik_al) - sum(turun_al) as turun_al,
                                                    sum(naik_ap) - sum(turun_ap) as turun_ap,
                                                    sum(naik_total) - sum(turun_total) as turun_total
                                                    from spda_pass_routes where spda_id = ?', array($_POST['id']));
                            $result = $query->getRow();

                            $query2 = $db->query('SELECT a.bus_capacity FROM spda_routes a WHERE a.id = ?', array($_POST['id']));
                            $result2 = $query2->getRow();
                        }
                        ?>
                        <input type="hidden" name="penumpang_id" id="penumpang_id" value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Penumpang Naik</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Dewasa :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_pass_dl" name="naik_dl" maxlength="4" autocomplete="off" placeholder="0">
                                        <div class="input-group-text">Laki-laki</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_pass_dm" name="naik_dp" maxlength="4" autocomplete="off" placeholder="0">
                                        <span class="input-group-text">Perempuan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Anak-Anak :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_pass_cl" name="naik_al" maxlength="4" autocomplete="off" placeholder="0">
                                        <span class="input-group-text">Laki-laki</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_pass_cm" name="naik_ap" maxlength="4" autocomplete="off" placeholder="0">
                                        <span class="input-group-text">Perempuan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <?php
                                        $bus_capacity = isset($result2) ? $result2->bus_capacity : '';
                                        ?>
                                        <input type="text" class="form-control" id="tot_passenger" name="naik_total" maxlength="4" autocomplete="off" placeholder="0" readonly="">
                                        <span class="input-group-text" id="bus_kapasitas" data-capacity="<?= $bus_capacity ?>">Total (Max: <?= $bus_capacity ?>)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Jumlah Penumpang Turun</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Dewasa :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_passgo_dl" name="turun_dl" maxlength="4" autocomplete="off" placeholder="<?= !is_null($result) ? $result->turun_dl : '' ?>" value="0">
                                        <span class="input-group-text"> Laki-laki<?= !is_null($result) ? ' (Max: ' . $result->turun_dl . ')' : '' ?></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_passgo_dm" name="turun_dp" maxlength="4" autocomplete="off" placeholder="<?= !is_null($result) ? $result->turun_dp : '' ?>" value="0">
                                        <span class="input-group-text"> Perempuan<?= !is_null($result) ? ' (Max: ' . $result->turun_dp . ')' : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Anak-Anak :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_passgo_cl" name="turun_al" maxlength="4" autocomplete="off" placeholder="<?= !is_null($result) ? $result->turun_al : '' ?>" value="0">
                                        <span class="input-group-text"> Laki-laki<?= !is_null($result) ? ' (Max: ' . $result->turun_al . ')' : '' ?></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_passgo_cm" name="turun_ap" maxlength="4" autocomplete="off" placeholder="<?= !is_null($result) ? $result->turun_ap : '' ?>" value="0">
                                        <span class="input-group-text"> Perempuan<?= !is_null($result) ? ' (Max: ' . $result->turun_ap . ')' : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tot_passenger_go" name="turun_total" maxlength="4" autocomplete="off" placeholder="<?= !is_null($result) ? $result->turun_total : '' ?>" readonly="" value="0">
                                        <span class="input-group-text"> Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="selesaikan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form id="form-selesaikan" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selesaikan Perjalanan</h5>
                </div>
                <div class="modal-body" id="selesaikan-modal-body">
                    <div id="selesaikan-modal-body-load">
                        <?php
                        $result = null;
                        if (isset($_POST['id'])) {
                            $db = db_connect();
                            $query = $db->query('select sum(naik_dl) - sum(turun_dl) as turun_dl,
                                                    sum(naik_dp) - sum(turun_dp) as turun_dp,
                                                    sum(naik_al) - sum(turun_al) as turun_al,
                                                    sum(naik_ap) - sum(turun_ap) as turun_ap,
                                                    sum(naik_total) - sum(turun_total) as turun_total
                                                    from spda_pass_routes where spda_id = ?', array($_POST['id']));
                            $result = $query->getRow();
                        }
                        ?>
                        <input type="hidden" name="selesaikan_id" id="selesaikan_id" value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Jumlah Penumpang Turun</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Dewasa :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control pnp_turun" name="turun_dl" maxlength="4" autocomplete="off" placeholder="0" value="<?= !is_null($result) ? $result->turun_dl : '' ?>">
                                        <span class="input-group-text">Laki-laki</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control pnp_turun" name="turun_dp" maxlength="4" autocomplete="off" placeholder="0" value="<?= !is_null($result) ? $result->turun_dp : '' ?>">
                                        <span class="input-group-text">Perempuan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Anak-Anak :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control pnp_turun" name="turun_al" maxlength="4" autocomplete="off" placeholder="0" value="<?= !is_null($result) ? $result->turun_al : '' ?>">
                                        <span class="input-group-text">Laki-laki</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control pnp_turun" name="turun_ap" maxlength="4" autocomplete="off" placeholder="0" value="<?= !is_null($result) ? $result->turun_ap : '' ?>">
                                        <span class="input-group-text">Perempuan</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control pnp_turun_total" name="turun_total" maxlength="4" required autocomplete="off" placeholder="0" readonly="" value="<?= !is_null($result) ? $result->turun_total : '' ?>">
                                        <span class="input-group-text">Total</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="time_form">
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label>Jam</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="spda_travelling_hour" name="spda_travelling_hour" value="0" autocomplete="off" step="1" min="-1" max="24" required>
                                        <span class="input-group-text">Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label>Menit</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="spda_travelling_minute" name="spda_travelling_minute" value="0" autocomplete="off" step="1" min="-1" max="60" required>
                                        <span class="input-group-text">Menit</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label>Detik</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="spda_travelling_second" name="spda_travelling_second" value="0" autocomplete="off" step="1" min="-1" max="60" required>
                                        <span class="input-group-text">Detik</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Pendapatan</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp. </span>
                                        <input type="text" class="form-control" id="spda_earning" name="spda_earning" required autocomplete="off" placeholder="0" oninput="F.masking(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="verifikasi-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-verifikasi" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi SPDA</h5>
                </div>
                <div class="modal-body">
                    <div id="verifikasi-modal-body">

                    </div>
                    <div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <p><b>Pegawai BPTD</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <canvas id="bptd-canvas"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <div class="btn btn-info btn-sm" id="bptd-submitBtn">Simpan Tanda Tangan</div>
                                <div class="btn btn-default btn-sm" id="bptd-clearBtn">
                                    <i class="fa fa-eraser"></i> Hapus
                                </div>
                            </div>
                            <div class="col-lg-12 text-center mb-3">
                                <i class="fa fa-check" id="bptd-check" style="display:none; color: green;"> Tanda Tangan Tersimpan</i>
                            </div>
                            <div hidden>
                                <div class="col-md-12">
                                    <textarea id="bptd-dataUrl" name="bptd-dataUrl" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="bptdSubmit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="spda-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="form-spda-detail" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail SPDA</h5>
                </div>
                <div class="modal-body" id="spda-detail-modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>
<form id="form_export_pdf" action="<?= base_url() ?>/operasional/action/spda_pdf" method="post" target="_blank">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_pdf" id="id_pdf" />
</form>
<script type="text/javascript">
    const role_code = '<?= $role_code ?>';
    const auth_insert = '<?= $rules->i ?>';
    const auth_edit = '<?= $rules->e ?>';
    const auth_delete = '<?= $rules->d ?>';
    const auth_otorisasi = '<?= $rules->o ?>';

    const url = '<?= base_url() . "/" . uri_segment(0) . "/action/" . uri_segment(1) ?>';
    const url_ajax = '<?= base_url() . "/" . uri_segment(0) . "/ajax" ?>';

    var dataStart = 0;
    var coreEvents;

    const select2Array = [{
            id: 'route_id',
            url: '/route_id_spda_select_get',
            placeholder: 'Pilih Trayek',
            params: null
        }, {
            id: 'trip_id',
            url: '/trip_id_select_get',
            placeholder: 'Pilih Trip',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                }
            }
        },
        {
            id: 'driver_id',
            url: '/driver_id_select_get',
            placeholder: 'Pilih Pengemudi',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                }
            }
        },
        {
            id: 'bus_id',
            url: '/armada_id_select_get',
            placeholder: 'Pilih Armada',
            params: {
                route_id: function() {
                    return $('#route_id').val()
                }
            }
        },
        {
            id: 'timetable_id',
            url: '/timetable_id_select_get',
            placeholder: 'Pilih Jadwal Keberangkatan',
            params: {
                trip_id: function() {
                    return $('#trip_id').val()
                }
            }
        },
        {
            id: 'spda_id',
            url: '/spda_select_get',
            placeholder: 'Pilih SPDA',
            params: null
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
            placeholder: 'Berhasil menyimpan data SPDA',
            afterAction: function(result) {}
        }

        coreEvents.editHandler = {
            placeholder: '',
            afterAction: function(result) {
                var data = result.data;
                if (data.route_id != null) {
                    $('#route_id').select2("trigger", "select", {
                        data: {
                            id: data.route_id,
                            text: data.route_name
                        }
                    });
                }

                if (data.trip_id != null) {
                    $('#trip_id').select2("trigger", "select", {
                        data: {
                            id: data.trip_id,
                            text: data.trip_name
                        }
                    });
                }

                if (data.driver_id != null) {
                    $('#driver_id').select2("trigger", "select", {
                        data: {
                            id: data.driver_id,
                            text: data.driver_name
                        }
                    });
                }

                if (data.bus_id != null) {
                    $('#bus_id').select2("trigger", "select", {
                        data: {
                            id: data.bus_id,
                            text: data.bus_name
                        }
                    });
                }

                if (data.timetable_id != null) {
                    $('#timetable_id').select2("trigger", "select", {
                        data: {
                            id: data.timetable_id,
                            text: data.timetable_name
                        }
                    });
                }

                setTimeout(function() {
                    $('#routes').val(data.routes);
                }, 500);
            }
        }

        coreEvents.deleteHandler = {
            placeholder: 'Berhasil menghapus data SPDA',
            afterAction: function() {}
        }

        coreEvents.resetHandler = {
            action: function() {
                var driverCanvas = document.getElementById('sig-canvas');
                var managerCanvas = document.getElementById('sig-canvas-manager');

                driverCanvas.width = driverCanvas.width;
                managerCanvas.width = managerCanvas.width;

                $('#sig-dataUrl').val('');
                $('#sig-dataUrl-manager').val('');
                // document.getElementById('form').reset();
                // $('#route_id').val(null).trigger('change');
                // $('#trip_id').val(null).trigger('change');
                // $('#driver_id').val(null).trigger('change');
                // $('#bus_id').val(null).trigger('change');
                // $('#bus_id').val(null).trigger('change');
            }
        }

        select2Array.forEach(function(x) {
            coreEvents.select2Init('#' + x.id, x.url, x.placeholder, x.params);
        });

        $('#trip_id').on('select2:select', function(e) {
            let points = e.params.data.points;
            $('#routes').val(e.params.data.trip);
            $.ajax({
                type: "get",
                url: '<?= base_url() ?>/kspn/ajax/jsonGetRoutesfromPoints2/' + points,
                dataType: "json",
                success: function(response) {
                    if (response.status == '1') {
                        $('#trip_distance').val((response.data.paths[0].distance / 1000).toFixed(0));
                    }
                }
            });
        });

        $('#spda_id').on('select2:select', function(e) {
            let id = $(this).val();

            $.ajax({
                type: "get",
                url: '<?= base_url() ?>/operasional/action/spda_ppodetail/' + id,
                dataType: "html",
                success: function(response) {
                    $('#action-spda').show();
                    $('#spda-detail').html(response);
                }
            });
        })
        $('#bptdSubmit').prop('disabled', true);

        $(document).on('click', '.otorisasi', function(e) {
            let ids = $(this).data('id');
            let $this = $(this);
            let data = {
                id: ids
            }
            $('#id_pdf').val(ids);
            $.extend(data, coreEvents.csrf);

            $.ajax({
                url: coreEvents.url + "_detail",
                type: 'POST',
                data: data,
                dataType: 'html',
                success: function(result) {
                    Swal.close();
                    $('#verifikasi-modal-body').html(result);
                    $('#verifikasi-modal').modal('show');
                },
                error: function() {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        }).on('submit', '#form-verifikasi', function(e) {
            e.preventDefault();
            let $this = $(this);
            var data = $this.serialize();
            data += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";

            Swal.fire({
                title: "Verifikasi SPDA ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        title: "",
                        icon: "info",
                        text: "Proses menyimpan data, mohon ditunggu...",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    });

                    $.ajax({
                        url: url + "_saveverif",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            Swal.close();
                            if (result.success) {
                                var bptdCanvas = document.getElementById('bptd-canvas');
                                bptdCanvas.width = bptdCanvas.width;

                                $('#bptd-dataUrl').val('');
                                $('#verifikasi-modal').modal('hide');
                                coreEvents.table.ajax.reload();

                                // Swal.fire('Sukses', 'Berhasil menyelesaikan SPDA', 'success');
                                Swal.fire({
                                    title: "Berhasil memverifikasi SPDA. Export PDF ?",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonText: "Export",
                                    cancelButtonText: "Tutup",
                                    reverseButtons: true
                                }).then(function(result) {
                                    if (result.value) {
                                        $('#form_export_pdf').submit();
                                    }
                                });
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            });
        }).on('click', '#bptd-submitBtn', function(e) {
            let dataUrl = $('#bptd-dataUrl').val();
            if (dataUrl == '') {
                Swal.fire('Error', 'Tanda tangan belum tersimpan', 'error');
                $('#bptdSubmit').prop('disabled', true);
            } else {
                $('#bptdSubmit').prop('disabled', false);
            }
        }).on('click', '#bptd-clearBtn', function(e) {
            $('#bptdSubmit').prop('disabled', true);
        }).on('click', '.input-selesai', function(e) {
            let ids = $('#spda_id').val();
            $('#selesaikan-modal-body').load(location.href + ' #selesaikan-modal-body-load', {
                'id': ids,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }, function() {
                $('#selesaikan-modal').modal('show');
            })
        }).on('submit', '#form-selesaikan', function(e) {
            e.preventDefault();
            let $this = $(this);
            var data = $this.serialize();
            data += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";

            Swal.fire({
                title: "Selesaikan perjalanan ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        title: "",
                        icon: "info",
                        text: "Proses menyimpan data, mohon ditunggu...",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    });

                    $.ajax({
                        url: url + "_savedone",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            Swal.close();
                            if (result.success) {
                                $('#selesaikan-modal').modal('hide');
                                $(".sel2").val(null).trigger('change');
                                $('#spda-detail').html('');
                                $('#action-spda').hide();

                                Swal.fire('Sukses', 'Berhasil menyelesaikan perjalanan', 'success');
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            });
        }).on('click', '.input-pnp', function(e) {
            let ids = $('#spda_id').val();
            $('#penumpang-modal-body').load(location.href + ' #penumpang-modal-body-load', {
                'id': ids,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            }, function() {
                $('#penumpang-modal').modal('show');
            })
        }).on('submit', '#form-penumpang', function(e) {
            e.preventDefault();
            let $this = $(this);
            var data = $this.serialize();
            data += "&<?= csrf_token() ?>=<?= csrf_hash() ?>";

            Swal.fire({
                title: "Jumlah penumpang sudah benar ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        title: "",
                        icon: "info",
                        text: "Proses menyimpan data, mohon ditunggu...",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    });

                    $.ajax({
                        url: url + "_savepnp",
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function(result) {
                            Swal.close();
                            if (result.success) {
                                $('#penumpang-modal').modal('hide');
                                Swal.fire('Sukses', 'Berhasil menginput penumpang', 'success');

                                $.ajax({
                                    type: "get",
                                    url: '<?= base_url() ?>/operasional/action/spda_ppodetail/' + $('#penumpang_id').val(),
                                    dataType: "html",
                                    success: function(response) {
                                        $('#spda-detail').html(response);
                                    }
                                });
                            } else {
                                Swal.fire('Error', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            });
        }).on('click', '.export', function(e) {
            e.preventDefault();

            let ids = $(this).data('id');
            $('#id_pdf').val(ids);
            $('#form_export_pdf').submit();
        }).on('submit', '#form_export_pdf', function(e) {
            // window.location = $(this).attr('action');
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
                type: 'POST',
                data: data,
                dataType: 'html',
                success: function(result) {
                    Swal.close();
                    $('#spda-detail-modal-body').html(result);
                    $('#spda-detail-modal').modal('show');
                },
                error: function() {
                    Swal.close();
                    Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
                }
            });
        });

        $('#trip_id').on('select2:clear', function(e) {});

        $('#bus_id').on('select2:select', function(e) {
            let databus = e.params.data;
            $('#bus_capacity').val(databus.capacity);
        });

        $(document).on('keyup', '#tot_pass_dl', function(e) {
            totPassenger();
        }).on('keyup', '#tot_pass_dm', function(e) {
            totPassenger();
        }).on('keyup', '#tot_pass_cl', function(e) {
            totPassenger();
        }).on('keyup', '#tot_pass_cm', function(e) {
            totPassenger();
        }).on('keyup', '#tot_passgo_dl', function(e) {
            totPassengerGo();
        }).on('keyup', '#tot_passgo_dm', function(e) {
            totPassengerGo();
        }).on('keyup', '#tot_passgo_cl', function(e) {
            totPassengerGo();
        }).on('keyup', '#tot_passgo_cm', function(e) {
            totPassengerGo();
        }).on('keyup', '.pnp_turun', function(e) {
            let total = 0;
            $('.pnp_turun').each((x, a) => {
                const abcde = parseInt($(a).val());
                total += isNaN(abcde) ? 0 : abcde;
            });

            $('.pnp_turun_total').val(total);
        })

        const totPassenger = () => {
            let tot_pass_dl = parseInt($('#tot_pass_dl').val());
            let tot_pass_dm = parseInt($('#tot_pass_dm').val());
            let tot_pass_cl = parseInt($('#tot_pass_cl').val());
            let tot_pass_cm = parseInt($('#tot_pass_cm').val());
            tot_pass_dl = isNaN(tot_pass_dl) ? 0 : tot_pass_dl;
            tot_pass_dm = isNaN(tot_pass_dm) ? 0 : tot_pass_dm;
            tot_pass_cl = isNaN(tot_pass_cl) ? 0 : tot_pass_cl;
            tot_pass_cm = isNaN(tot_pass_cm) ? 0 : tot_pass_cm;

            totalPass = tot_pass_dl + tot_pass_dm + tot_pass_cl + tot_pass_cm;
            busCapacity = parseInt($('#bus_kapasitas').data('capacity'));

            if (totalPass > busCapacity) {
                Swal.fire('Perhatian!', 'Jumlah penumpang melebihi kapasitas bus', 'warning');
                $('#bus_kapasitas').attr('style', 'color:red');
            } else {
                $('#tot_passenger').val(totalPass);
                $('#bus_kapasitas').attr('style', 'color:black');
            }
            // $('#tot_passenger').val(tot_pass_dl + tot_pass_dm + tot_pass_cl + tot_pass_cm);

        }

        const totPassengerGo = () => {
            let tot_pass_dl = parseInt($('#tot_passgo_dl').val());
            let tot_pass_dm = parseInt($('#tot_passgo_dm').val());
            let tot_pass_cl = parseInt($('#tot_passgo_cl').val());
            let tot_pass_cm = parseInt($('#tot_passgo_cm').val());
            tot_pass_dl = isNaN(tot_pass_dl) ? 0 : tot_pass_dl;
            tot_pass_dm = isNaN(tot_pass_dm) ? 0 : tot_pass_dm;
            tot_pass_cl = isNaN(tot_pass_cl) ? 0 : tot_pass_cl;
            tot_pass_cm = isNaN(tot_pass_cm) ? 0 : tot_pass_cm;

            totalPassGo = tot_pass_dl + tot_pass_dm + tot_pass_cl + tot_pass_cm;

            $('#tot_passenger_go').val(totalPassGo);
            // $('#tot_passenger_go').val(tot_pass_dl + tot_pass_dm + tot_pass_cl + tot_pass_cm);
        };

        $(document).on('select2:select', '#route_id', function() {
            coreEvents.select2Init('#trip_id', '/trip_id_select_get', 'Pilih Trip', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#driver_id', '/driver_id_select_get', 'Pilih Pengemudi', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#bus_id', '/armada_id_select_get', 'Pilih Armada', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#timetable_id', '/timetable_id_select_get', 'Pilih Jadwal Keberangkatan', {
                trip_id: function() {
                    return $('#trip_id').val();
                }
            });
        }).on('select2:select', '#trip_id', function() {
            coreEvents.select2Init('#driver_id', '/driver_id_select_get', 'Pilih Pengemudi', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#bus_id', '/armada_id_select_get', 'Pilih Armada', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#timetable_id', '/timetable_id_select_get', 'Pilih Jadwal Keberangkatan', {
                trip_id: function() {
                    return $('#trip_id').val();
                }
            });
        }).on('select2:select', '#driver_id', function() {
            coreEvents.select2Init('#bus_id', '/armada_id_select_get', 'Pilih Armada', {
                route_id: function() {
                    return $('#route_id').val();
                }
            });
            coreEvents.select2Init('#timetable_id', '/timetable_id_select_get', 'Pilih Jadwal Keberangkatan', {
                trip_id: function() {
                    return $('#trip_id').val();
                }
            });
        }).on('select2:select', '#bus_id', function() {
            coreEvents.select2Init('#timetable_id', '/timetable_id_select_get', 'Pilih Jadwal Keberangkatan', {
                trip_id: function() {
                    return $('#trip_id').val();
                }
            });
        });

        coreEvents.buttons = [{
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"></i> Export XLS',
        }];
        coreEvents.dom = "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 text-end col-md-3'B><'col-sm-12 col-md-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
        coreEvents.placeholder = 'Cari Data SPDA';

        coreEvents.load(null, coreEvents.placeholder, coreEvents.dom, coreEvents.buttons);
        $('.buttons-html5').removeClass('btn-secondary').addClass('btn-link');
    });

    function time_form_input_handler(ev) {
        var form = ev.currentTarget;

        if (form.spda_travelling_second.valueAsNumber == -1) {
            if (form.spda_travelling_minute.valueAsNumber > 0 || form.spda_travelling_hour.valueAsNumber > 0) {
                form.spda_travelling_minute.valueAsNumber--;
                form.spda_travelling_second.valueAsNumber = 59;
            } else {
                form.spda_travelling_second.valueAsNumber = 0;
            }
        } else if (form.spda_travelling_second.valueAsNumber == 60) {
            form.spda_travelling_minute.valueAsNumber++;
            form.spda_travelling_second.valueAsNumber = 0;
        }

        if (form.spda_travelling_minute.valueAsNumber == -1) {
            if (form.spda_travelling_hour.valueAsNumber > 0) {
                form.spda_travelling_hour.valueAsNumber--;
                form.spda_travelling_minute.valueAsNumber = 59;
            } else {
                form.spda_travelling_minute.valueAsNumber = 0;
            }
        } else if (form.spda_travelling_minute.valueAsNumber == 60) {
            form.spda_travelling_hour.valueAsNumber++;
            form.spda_travelling_minute.valueAsNumber = 0;
        }

        if (form.spda_travelling_hour.valueAsNumber == -1) {

            form.spda_travelling_hour.valueAsNumber = 0;

        } else if (form.spda_travelling_hour.valueAsNumber == 24) {
            form.spda_travelling_hour.valueAsNumber = 0;
        }

        // if (form.days.valueAsNumber == -1) {
        //     form.days.valueAsNumber = 0;
        // }
    }
    document.getElementById('form-selesaikan').addEventListener('input', time_form_input_handler);

    function select2Init(id, url, placeholder, parameter) {
        $(id).select2({
            id: function(e) {
                return e.id
            },
            placeholder: placeholder,
            multiple: false,
            width: '100%',
            ajax: {
                url: url_ajax + url,
                dataType: 'json',
                quietMillis: 500,
                delay: 500,
                data: function(param) {
                    var def_param = {
                        keyword: param.term, //search term
                        perpage: 5, // page size
                        page: param.page || 0, // page number
                    };

                    return Object.assign({}, def_param, parameter);
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
                if (data.id === '') {
                    return placeholder;
                }

                return data.text;
            },
            escapeMarkup: function(m) {
                return m;
            }
        });
    }

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
                data: "route_name",
                orderable: true,
                render: function(a, type, data, index) {
                    return '<div class="trip-container">' + data.route_name + '</div>';
                }
            },
            {
                data: "trip_name",
                orderable: true,
                render: function(a, type, data, index) {
                    return '<div class="trip-container">' + data.trip_name + '</div>';
                }
            },
            {
                data: "trip_distance",
                orderable: true
            },
            {
                data: "spda_date",
                orderable: false,
                render: function(a, type, data, index) {
                    var date = data.spda_date;
                    var momentObject = moment(date, 'YYYY-MM-DD');
                    var momentString = momentObject.format('DD-MM-YYYY');
                    return '<div class="spda-container">' + momentString + '<br>' + data.spda_dep_datetime + '</div>';
                }

            },
            {
                data: "driver_name",
                orderable: true,
                width: '50%'
            },
            {
                data: "ritke",
                orderable: true,
                width: '50%',
                render: function(a, type, data, index) {
                    return '<div class="trip-container">Ritke-' + data.ritke + '</div>';
                }
            },
            {
                data: "nopol",
                orderable: true,
                render: function(a, type, data, index) {
                    return '<div class="bus-container">' + data.nopol + '<br>Kapasitas : ' + data.bus_capacity + '</div>';
                }
            },
            {
                data: "verifikator",
                orderable: true,
                render: function(a, type, data, index) {
                    if (data.verivikator == null) {
                        return '<span></span>';
                    } else {
                        return '<span>' + data.verivikator + '</span>';
                    }
                }
            },
            // { 
            //     data: "tot_passenger", orderable: true, width: '200px',
            //     render: function (a, type, data, index) {
            //         return '<div class="passenger-container">\
            //         <div class="passenger-list">\
            //             <div>Dewasa Laki-laki</div>\
            //             <div>'+data.tot_pass_dl+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Dewasa Perempuan</div>\
            //             <div>'+data.tot_pass_dm+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Anak Laki-laki</div>\
            //             <div>'+data.tot_pass_cl+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Anak Perempuan</div>\
            //             <div>'+data.tot_pass_cm+'</div>\
            //         </div>\
            //         </div>';
            //     }
            // },
            // { 
            //     data: "tot_passenger_go", orderable: true, width: '200px',
            //     render: function (a, type, data, index) {
            //         return '<div class="passenger-container">\
            //         <div class="passenger-list">\
            //             <div>Dewasa Laki-laki</div>\
            //             <div>'+data.tot_passgo_dl+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Dewasa Perempuan</div>\
            //             <div>'+data.tot_passgo_dm+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Anak Laki-laki</div>\
            //             <div>'+data.tot_passgo_cl+'</div>\
            //         </div>\
            //         <div class="passenger-list">\
            //             <div>Anak Perempuan</div>\
            //             <div>'+data.tot_passgo_cm+'</div>\
            //         </div>\
            //         </div>';
            //     }
            // },
            {
                data: "spda_status",
                orderable: true,
                render: function(a, type, data, index) {
                    var date = data.verif_at;
                    var momentObject = moment(date, 'YYYY-MM-DD');
                    var momentString = momentObject.format('DD-MM-YYYY');

                    // return '<div class="spda-container">' + data.spda_status + '</div>';
                    switch (data.spda_status) {
                        case '0':
                            if (data.spda_id == null) {
                                return '<span class="badge bg-danger">Masih Perjalanan</span>';
                            } else {
                                return '<span class="badge bg-danger">Masih Perjalanan</span></br>' + momentString + '</span>';
                            }
                            break;
                        case '1':
                            if (data.verivikator == null) {
                                return '<span class="badge bg-warning">Perjalanan Selesai</span></br>  </span>';
                            } else {
                                return '<span class="badge bg-warning">Perjalanan Selesai</span></br>' + momentString + '</span>';
                            }
                            break;
                        case '2':
                            if (data.verivikator == null) {
                                return '<span class="badge bg-success">Sudah Verifikasi</span></br>  </span>';
                            } else {
                                return '<span class="badge bg-success">Sudah Verifikasi</span></br>' + momentString + '</span>';
                            }
                            break;
                        default:
                            return '<span class="badge bg-warning"> - </span> </br>' + momentString + '</span>';
                            break;
                    }
                }
            },
            // { data: "tot_pass_dl", orderable: true },
            // { data: "tot_pass_dm", orderable: true },
            // { data: "tot_pass_cl", orderable: true },
            // { data: "tot_pass_cm", orderable: true },
            {
                data: "id",
                orderable: false,
                render: function(a, type, data, index) {
                    let button = ''

                    if (auth_edit == "1" && data.spda_status == "0") {
                        button += '<button class="btn btn-sm btn-outline-primary edit" data-id="' + data.id + '" title="Edit">\
                                    <i class="fa fa-edit"></i>\
                                </button>\
                                ';
                    }

                    if (auth_delete == "1") {
                        button += '<button class="btn btn-sm btn-outline-danger delete" data-id="' + data.id + '" title="Delete">\
                                        <i class="bx bx-trash-alt"></i>\
                                    </button>';
                    }

                    if (auth_otorisasi == "1" && data.spda_status == "1") {
                        button += '<button class="btn btn-sm btn-outline-success otorisasi" data-id="' + data.id + '" title="Verifikasi">\
                                        <i class="fa fa-check"></i>\
                                    </button>';
                    }

                    button += '<button class="btn btn-sm btn-outline-info details" data-id="' + data.id + '" title="Detail">\
                                    <i class="fa fa-eye"></i>\
                                </button>\
                                <button class="btn btn-sm btn-outline-warning export" data-id="' + data.id + '" title="Export PDF">\
                                    <i class="fa fa-file-pdf"></i>\
                                </button>';

                    button += (button == '') ? "<b>Tidak ada aksi</b>" : ""

                    return "<div class='action-button'>" + button + "</div>";
                }
            }
        ];

        return columns;
    }
</script>
<?php if ($role_code != "ppo" && $rules->i == "1") { ?>
    <script src="<?= base_url() ?>/assets/js/sig-pengemudi.js"></script>
    <script src="<?= base_url() ?>/assets/js/sig-manager.js"></script>
<?php } ?>
<?php if ($rules->o == "1") { ?>
    <script src="<?= base_url() ?>/assets/js/sig-bptd.js"></script>
<?php } ?>