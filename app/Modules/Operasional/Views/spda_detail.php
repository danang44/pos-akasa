<div class="mb-3">
    <input type="hidden" name="verifikasi_id" id="verifikasi_id" value="<?=$spda->id?>">
    <dl class="row">
        <dt class="col-lg-4 text-uppercase">Trayek</dt>
        <dd class="col-lg-8">: <?=$spda->route_name?></dd>
        <dt class="col-lg-4 text-uppercase">Trip</dt>
        <dd class="col-lg-8">: <?=$spda->trip_name?></dd>
        <dt class="col-lg-4 text-uppercase">Pengemudi</dt>
        <dd class="col-lg-8">: <?=$spda->driver_name?></dd>
        <dt class="col-lg-4 text-uppercase">No. Kendaraan Armada</dt>
        <dd class="col-lg-8">: <?=$spda->bus_nopol?></dd>
        <dt class="col-lg-4 text-uppercase">Tanggal Keberangkatan</dt>
        <dd class="col-lg-8">: <?=$spda->tgl?></dd>
        <dt class="col-lg-4 text-uppercase">Jam Keberangkatan</dt>
        <dd class="col-lg-8">: <?=$spda->jam?></dd>
        <dt class="col-lg-4 text-uppercase">Ritase</dt>
        <dd class="col-lg-8">: <?=$spda->timetable_name?></dd>
    </dl>
    <div class="table-responsive">
        <table class="table table-theme table-row v-middle table-bordered">
            <tr>
                <th rowspan="3" class="text-center text-uppercase" style="vertical-align: middle; width: 30px;">#</th>
                <th colspan="5" class="text-center text-uppercase">Penumpang Naik</th>
                <th colspan="5" class="text-center text-uppercase">Penumpang Turun</th>
                <th rowspan="3" class="text-center text-uppercase" style="vertical-align: middle;">Waktu</th>
            </tr>
            <tr>
                <th colspan="2" class="text-center text-uppercase">Dewasa</th>
                <th colspan="2" class="text-center text-uppercase">Anak-anak</th>
                <th rowspan="2" class="text-center text-uppercase" style="vertical-align: middle;">TOTAL</th>
                <th colspan="2" class="text-center text-uppercase">Dewasa</th>
                <th colspan="2" class="text-center text-uppercase">Anak-anak</th>
                <th rowspan="2" class="text-center text-uppercase" style="vertical-align: middle;">TOTAL</th>
            </tr>
            <tr>
                <th style="vertical-align: middle;">Laki-laki</th>
                <th style="vertical-align: middle;">Perempuan</th>
                <th style="vertical-align: middle;">Laki-laki</th>
                <th style="vertical-align: middle;">Perempuan</th>
                <th style="vertical-align: middle;">Laki-laki</th>
                <th style="vertical-align: middle;">Perempuan</th>
                <th style="vertical-align: middle;">Laki-laki</th>
                <th style="vertical-align: middle;">Perempuan</th>
            </tr>
            <?php $no = 1; $naik_tot = 0; $turun_tot = 0; ?>
            <?php foreach ($pnp as $p) { ?>
            <?php $naik_tot += $p->naik_total; $turun_tot += $p->turun_total; ?>
            <tr>
                <td class="text-center text-uppercase" style="vertical-align: middle;"><?=$no++?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->naik_dl?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->naik_dp?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->naik_al?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->naik_ap?></td>
                <td class="bg-success fw-bolder" style="text-align: center; width: 110px; vertical-align: middle; color: #ffffff;"><?=$p->naik_total?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->turun_dl?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->turun_dp?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->turun_al?></td>
                <td style="text-align: center; width: 110px; vertical-align: middle;"><?=$p->turun_ap?></td>
                <td class="bg-danger fw-bolder" style="text-align: center; width: 110px; vertical-align: middle; color: #ffffff;"><?=$p->turun_total?></td>
                <td style="text-align: center; width: 200px; vertical-align: middle;"><?=$p->waktu?></td>
            </tr>
            <?php } ?>
            <tr>
                <td><b>TOTAL</b></td>
                <td class="fw-bolder" colspan="5" style="text-align: right; width: 110px; vertical-align: middle;"><?=$naik_tot?></td>
                <td class="fw-bolder" colspan="5" style="text-align: right; width: 110px; vertical-align: middle;"><?=$turun_tot?></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>