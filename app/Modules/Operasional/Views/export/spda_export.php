<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN SPDA TRIP</title>
    <style>
        .dirjen {
            text-align: left;
            font-size: 15px;
            font-weight: bold;
        }

        .no-spda {
            text-align: right;
            font-size: 15px;
            font-weight: bold;
            padding-top: 30px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            border: 1px solid black;
            width: 100%;
            font-size: 12px;
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
    <?php
    if ($data->id == null) { ?>
        <div style="text-align: center; font-size: 32px;">Maaf Data Tidak Ditemukan</div>
    <?php } else { ?>
        <div class="row">
            <div class="dirjen">
                DIREKTORAT JENDERAL PERHUBUNGAN DARAT
            </div>
            <div class="no-spda"></div>
        </div>

        <div class="table-data">
            <table>
                <tr>
                    <th colspan="6" style="text-align:center; color: white;"><?= $data->trayek_name ?></th>
                </tr>
                <tr>
                    <td style="width:6%; text-align:center;">1.</td>
                    <td>Hari/Tanggal</td>
                    <td>
                        <?= date("d M Y", strtotime($data->spda_date)) ?>
                    </td>
                    <td style="width:6%; text-align:center;">6.</td>
                    <td style="width:25%">Jarak Trip</td>
                    <td><?= $data->trip_distance ?> Km</td>
                </tr>
                <tr>
                    <td style="text-align:center;">2.</td>
                    <td>Nama Pengemudi</td>
                    <td><?= $data->driver_name ?></td>
                    <td style="text-align:center;">7.</td>
                    <td>Waktu Tempuh</td>
                    <td><?= $data->spda_travelling_time ?> Menit</td>
                </tr>
                <tr>
                    <td style="text-align:center;">3.</td>
                    <td>Kode Bus</td>
                    <td><?= $data->nopol ?></td>
                    <td style="text-align:center;">8.</td>
                    <td>Kapasitas Bus</td>
                    <td><?= $data->bus_capacity ?> Seat</td>
                </tr>
                <tr>
                    <td style="text-align:center;">4.</td>
                    <td>Trip</td>
                    <td>Ke-<?= $data->ritke ?></td>
                    <td style="text-align:center;">9.</td>
                    <td>Total Penumpang</td>
                    <td><?= $data->tot_passenger ?> Orang</td>
                </tr>
                <tr>
                    <td style="text-align:center;">5.</td>
                    <td>Jarak</td>
                    <td><?= $data->trip_distance ?></td>
                    <td style="text-align:center;">10.</td>
                    <td>Total Pendapatan</td>
                    <td><?= "Rp " . number_format($data->spda_earning, 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>
        <table class="table-ttd">
            <tr>
                <th style="text-align: center; font-size: 14px; color: white;">PENGEMUDI</th>
                <th style="text-align: center; font-size: 14px; color: white;">MANAGER</th>
                <th style="text-align: center; font-size: 14px; color: white;">BPTD</th>
            </tr>
            <tr>
                <td style="text-align: center; height:100px">
                    <img src="<?= $data->sign_driver ?>" alt="" srcset="">
                </td>
                <td style="text-align: center; height:100px">
                    <img src="<?= $data->sign_manager ?>" alt="">
                </td>
                <td style="text-align: center; height:100px">
                    <img src="<?= $data->sign_bptd ?>" alt="">
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <b><?= $data->driver_name ?></b>
                </td>
                <td style="text-align: center;">
                    <b><?= $data->manager_name ?></b>
                </td>
                <td style="text-align: center;">
                    <b><?= $data->bptd_name ?></b>
                </td>
            </tr>
        </table>
    <?php } ?>
</body>

</html>