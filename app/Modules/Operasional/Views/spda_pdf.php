<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data SPDA</title>
	<style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .dirjen {
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            padding-top: -40px;
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
            margin-top: 25px !important;
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

        .table-data {
            padding-top: 80px;
        }

        .table-ttd {
            margin-top: 100px;
        }
    </style>
</head>
<body>
	<div class="row">
        <div class="dirjen">
            DIREKTORAT JENDERAL PERHUBUNGAN DARAT
        </div>
        <span class="sub-title">Surat Perjalanan Dinas Armada (SPDA)</span>
        <!-- <div class="no-spda">
        </div> -->
    </div>
    <div class="table-data">
        <table>
            <tr>
                <th colspan="6" style="text-align:center; color: white;"><?= $data->route_name ?></th>
            </tr>
            <tr>
                <td style="width:6%; text-align:center;">1.</td>
                <td>Hari/Tanggal</td>
                <td>
                    <?= date("d-m-Y", strtotime($data->spda_date)) ?>
                </td>
                <td style="width:6%; text-align:center;">6.</td>
                <td style="width:25%">Jam Keberangkatan</td>
                <td><?= date("H:i", strtotime($data->spda_dep_datetime)) ?></td>
            </tr>
            <tr>
                <td style="text-align:center;">2.</td>
                <td>Nama Pengemudi</td>
                <td><?= $data->driver_name ?></td>
                <td style="text-align:center;">7.</td>
                <td>Waktu Tempuh</td>
                <td><?=$data->spda_travelling_time?> Menit</td>
            </tr>
            <tr>
                <td style="text-align:center;">3.</td>
                <td>Kode Bus</td>
                <td><?= $data->nopol ?></td>
                <td style="text-align:center;">8.</td>
                <td>Kapasitas Bus</td>
                <td><?=$data->bus_capacity?> Seat</td>
            </tr>
            <tr>
                <td style="text-align:center;">4.</td>
                <td>Ritase</td>
                <td><?= $data->ritke ?></td>
                <td style="text-align:center;">9.</td>
                <td>Total Penumpang</td>
                <td><?=$data->tot_passenger?> Orang</td>
            </tr>
            <tr>
                <td style="text-align:center;">5.</td>
                <td>Jarak</td>
                <td><?= $data->trip_distance ?> KM</td>
                <td style="text-align:center;">10.</td>
                <td>Total Pendapatan</td>
                <td>Rp. <?=number_format($data->spda_earning)?></td>
            </tr>
        </table>
    </div>
    <table class="table-ttd">
        <tr>
            <th style="text-align: center; font-size: 14px; color: white;">Pengemudi</th>
            <th style="text-align: center; font-size: 14px; color: white;">Manager</th>
            <?php if($data->bptd_name != null ) { ?>
            <th style="text-align: center; font-size: 14px; color: white;">Petugas BPTD</th>
            <?php } ?>
        </tr>
        <tr>
            <td style="text-align: center; height:100px">
                <img src="<?= $data->sign_driver ?>" alt="" srcset="">
            </td>
            <td style="text-align: center; height:100px">
                <img src="<?= $data->sign_manager ?>" alt="">
            </td>
            <?php if($data->bptd_name != null ) { ?>
            <td style="text-align: center; height:100px">
                <img src="<?= $data->sign_bptd ?>" alt="">
            </td>
            <?php } ?>
        </tr>
        <tr>
            <td style="text-align: center;">
                <b><?= $data->driver_name ?></b>
            </td>
            <td style="text-align: center;">
                <b><?= $data->manager_name ?></b>
            </td>
            <?php if($data->bptd_name != null ) { ?>
            <td style="text-align: center;">
                <b><?= $data->bptd_name ?></b>
            </td>
            <?php } ?>
        </tr>
    </table>
</body>
</html>