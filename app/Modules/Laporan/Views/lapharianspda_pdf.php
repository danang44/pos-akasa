<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Harian SPDA</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .dirjen {
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            padding-top: -70px;
        }

        .detail {
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            /* padding-top: -70px; */
            padding-bottom: 10px;
        }

        .no-spda {
            text-align: right;
            font-size: 15px;
            font-weight: bold;
            padding-top: 30px;
        }

        table {

            border-collapse: collapse;
            border: 1px solid black;
            width: 100%;
            font-size: 12px;
        }

        .table-data {
            margin-top: 5px !important;
            padding-top: 65px;
        }

        .table-detail {
            margin-top: 5px !important;
            padding-top: 65px;
        }

        td {
            padding: 5.4px;
            border: 1px solid black;
        }

        th {
            padding: 5.4px;
            background-color: #224DDD;
            border: 1px solid black;
        }

        .font-white {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="dirjen">
            DIREKTORAT JENDERAL PERHUBUNGAN DARAT
        </div>
        <span class="sub-title">Laporan Harian SPDA</span>
        <!-- <div class="no-spda">
        </div> -->
    </div>
    <div class="table-data">
        <div class="detail">
            LAPORAN RINGKASAN SPDA
        </div>
        <table>
            <thead>
                <tr>
                    <th class="font-white">#</th>
                    <th class="font-white">Tanggal</th>
                    <th class="font-white">Nama Bus</th>
                    <th class="font-white">Ritase</th>
                    <th class="font-white">Kilometer</th>
                    <th class="font-white">Trip</th>
                    <th class="font-white">Jumlah Penumpang</th>
                    <th class="font-white">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $total_trip_distance = 0;
                $total_pnp = 0;

                foreach ($data as $key => $value) {

                    $date = $value->spda_date;
                    $dates = date('d-m-Y', strtotime($date));

                    $detail = json_decode($value->detail);
                    for ($i = 0; $i < count($detail); $i++) {
                        if ($detail[$i]->spda_status == '1') {
                            $status = '<span style="color: #fd625e;">Belum Verifikasi</span>';
                        } else if ($detail[$i]->spda_status == '0') {
                            $status = '<span style="color: #ffbf53;">Masih Perjalanan</span>';
                        } else {
                            $status = '<span style="color: #2ab57d;">Sudah Verifikasi</span>';
                        }

                        $total_trip_distance += $detail[$i]->trip_dist;
                        $total_pnp += $detail[$i]->naik_total;

                        if ($i == 0) {
                            echo '<tr>
                                        <td rowspan="' . count($detail) . '" style="font-weight: bold;">' . ($no++) . '</td>
                                        <td rowspan="' . count($detail) . '" style="font-weight: bold;"><div style="width:80px;">' . $dates . '</div></td>
                                        <td rowspan="' . count($detail) . '" style="font-weight: bold;">' . $value->bus_name . '</td>
                                        <td rowspan="' . count($detail) . '" style="text-align: center;">' . $value->ritke . '</td>
                                        <td style="text-align: center;">' . $detail[$i]->trip_dist . '</td>
                                        <td>' . $detail[$i]->trip_name . '</td>
                                        <td style="text-align: center;">' . $detail[$i]->naik_total . '</td>
                                        <td>' . $status . '</td>
                                    </tr>';
                        } else {
                            echo '<tr>
                                        <td style="text-align: center;">' . $detail[$i]->trip_dist . '</td>
                                        <td>' . $detail[$i]->trip_name . '</td>
                                        <td style="text-align: center;">' . $detail[$i]->naik_total . '</td>
                                        <td>' . $status . '</td>
                                    </tr>';
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold;">TOTAL</td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_trip_distance ?></td>
                    <td></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_pnp ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- page 2 -->
    <pagebreak />
    <div class="row">
        <div class="dirjen">
            DIREKTORAT JENDERAL PERHUBUNGAN DARAT
        </div>
        <span class="sub-title">Laporan Harian SPDA</span>
        <!-- <div class="no-spda">
        </div> -->
    </div>
    <div class="table-detail">
    <div class="detail">
            LAPORAN RINCIAN TRAYEK SPDA
        </div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" class="font-white">#</th>
                    <th rowspan="2" class="font-white">Tanggal</th>
                    <th rowspan="2" class="font-white">Nama Bus</th>
                    <th rowspan="2" class="font-white">Trip</th>
                    <th colspan="5" class="font-white">Penumpang Naik</th>
                    <th colspan="5" class="font-white">Penumpang Turun</th>
                </tr>
                <tr>
                    <th class="font-white">Dewasa Laki-laki</th>
                    <th class="font-white">Dewasa Perempuan</th>
                    <th class="font-white">Anak Laki-laki</th>
                    <th class="font-white">Anak Perempuan</th>
                    <th class="font-white">Total</th>
                    <th class="font-white">Dewasa Laki-laki</th>
                    <th class="font-white">Dewasa Perempuan</th>
                    <th class="font-white">Anak Laki-laki</th>
                    <th class="font-white">Anak Perempuan</th>
                    <th class="font-white">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $total_naik_dl = 0;
            
                $total_naik_dp = 0;
                $total_naik_al = 0;
                $total_naik_ap = 0;
                $total_naik_pnp = 0;
                $total_turun_dl = 0;
                $total_turun_dp = 0;
                $total_turun_al = 0;
                $total_turun_ap = 0;
                $total_turun_pnp = 0;

                foreach ($data as $key => $value) {

                    $date = $value->spda_date;
                    $dates = date('d-m-Y', strtotime($date));
                    $detail = json_decode($value->detail);

                    for ($i = 0; $i < count($detail); $i++) {
                        $total_naik_dl += $detail[$i]->naik_dl;
                        $total_naik_dp += $detail[$i]->naik_dp;
                        $total_naik_al += $detail[$i]->naik_al;
                        $total_naik_ap += $detail[$i]->naik_ap;
                        $total_naik_pnp += $detail[$i]->naik_total;
                        $total_turun_dl += $detail[$i]->turun_dl;
                        $total_turun_dp += $detail[$i]->turun_dp;
                        $total_turun_al += $detail[$i]->turun_al;
                        $total_turun_ap += $detail[$i]->turun_ap;
                        $total_turun_pnp += $detail[$i]->turun_total;

                        if($i == 0){
                            echo '<tr>
                                    <td rowspan="'.count($detail).'" style="font-weight: bold;">' . ($no++) . '</td>
                                    <td rowspan="'.count($detail).'" style="font-weight: bold;"><div style="width:80px;">' . $dates . '</div></td>
                                    <td rowspan="'.count($detail).'" style="font-weight: bold;">' . $value->bus_name . '</td>
                                    <td style="font-weight: bold;">' . $detail[$i]->trip_name . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_dl . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_dp . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_al . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_ap . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_total . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_dl . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_dp . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_al . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_ap . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_total . '</td>
                                </tr>';
                        }else{
                            echo '<tr>
                                    <td style="font-weight: bold;">' . $detail[$i]->trip_name . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_dl . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_dp . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_al . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_ap . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->naik_total . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_dl . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_dp . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_al . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_ap . '</td>
                                    <td style="text-align: center;">' . $detail[$i]->turun_total . '</td>
                                </tr>';
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold;">TOTAL</td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_naik_dl ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_naik_dp ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_naik_al ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_naik_ap ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_naik_pnp ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_turun_dl ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_turun_dp ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_turun_al ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_turun_ap ?></td>
                    <td colspan="1" style="text-align: center; font-weight: bold;"> <?= $total_turun_pnp ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- page 3 -->
    <pagebreak />
    <div class="row">
        <div class="dirjen">
            DIREKTORAT JENDERAL PERHUBUNGAN DARAT
        </div>
        <span class="sub-title">Laporan Harian SPDA</span>
        <!-- <div class="no-spda">
        </div> -->
    </div>
    <div class="table-detail">
    <div class="detail">
            LAPORAN RINCIAN PO SPDA
        </div>
        <table>
            <thead>
                <tr>
                    <th class="font-white">Nama PO</th>
                    <th class="font-white">No. Telfon PO</th>
                    <th class="font-white">Nama Manager</th>
                    <th class="font-white">No. Telfon Manager</th>
                    <th class="font-white">Alamat</th>
                    <th class="font-white">Jenis Pelayanan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$po->cp_name?></td>
                    <td><?=$po->cp_phone?></td>
                    <td><?=$po->cp_mngr_name?></td>
                    <td><?=$po->cp_mngr_phone?></td>
                    <td><?=($po->cp_addr . ($po->kel!=null?', '.$po->kel:'') . ($po->kec!=null?', '.$po->kec:'') . ($po->kabkota!=null?', '.$po->kabkota:'') . ($po->prov!=null?', '.$po->prov:''))?></td>
                    <td><?=$po->jenis_pelayanan?></td>
                </tr>
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>

</html>