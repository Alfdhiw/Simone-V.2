<?php
date_default_timezone_set("Asia/Bangkok");
$time_now = date("G:i:s");
$pulang = $waktu['pulang'];

$jam    = strtotime($waktu['pulang']) - strtotime($time_now);
$hours = intval($jam / 3600);
?>
<div class="col-md-12 mt-5">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="card-title mb-3" style="font-weight: bold; color: #5D6975;">Absen Telah Ditutup</h1>
                    <div class="col-auto">
                        <i class="fas fa-hand text-danger mb-3" style="font-size: 90px;"></i>
                    </div>
                    <p class="card-text">Silahkan Menunggu Jam Kepulangan Untuk Absen Kembali</p>
                    <span class="badge badge-danger mt-3" style="font-size: 20px;"><?= $hours ?> Jam Lagi Untuk Absen</span><br><br>
                    <a type="button" href="<?= base_url('home') ?>"><span class="card-text" style="font-size: 14px; color:#5D6975;"><i class="fa-solid fa-circle-arrow-left"></i> <u>Kembali Ke beranda</u></span></a>
                </div>
                <!-- <div class="card-footer text-muted">
                    <marquee style="margin-bottom: -5px;">SISTEM INFORMASI MAGANG DPRD JAWA TENGAH</marquee>
                </div> -->
            </div>
        </div>
    </div>
</div>