<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Penilaian Magang Pdf</title>
    <link href="<?= base_url() ?>assets/css/admin/sertifikat-custom.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url() ?>assets/img/login/pn.png">
            </div>
            <h1>Laporan Penilaian Magang</h1>
            <div id="project">
                <div><span>Nama Peserta</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $peserta['nama']; ?></div>
                <div><span>Email</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $peserta['email']; ?></div>
                <div><span>Asal Sekolah</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $peserta['sekolah']; ?></div>
                <div><span>Divisi Magang</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $peserta['divisi']; ?></div>
                <div><span>Penyelia Magang</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $peserta['nama_penyelia']; ?></div>
                <div><span>Tanggal Cetak</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date; ?></div>
            </div>
        </header>
        <main>

            <table>
                <thead>
                    <tr>
                        <th class="desc">#</th>
                        <th class="desc">Tanggal Penilaian</th>
                        <th class="desc">Nilai Disiplin</th>
                        <th class="desc">Nilai Tanggung Jawab</th>
                        <th class="desc">Nilai Praktek</th>
                        <th class="desc">Rata-Rata</th>
                        <th class="desc">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nilai as $nilai) : ?>
                        <tr>
                            <td class="desc">#</td>
                            <td class="desc"><b><?= $nilai['tanggal_penilaian'] ?></b></td>
                            <td class="desc"><b><?= $nilai['nilai_disiplin'] ?></b></td>
                            <td class="desc"><b><?= $nilai['nilai_tanggungjawab'] ?></b></td>
                            <td class="desc"><b><?= $nilai['nilai_praktek'] ?></b></td>
                            <td class="desc"><b><?= $nilai['nilai_rata'] ?></b></td>
                            <td class="desc"><b><?= $nilai['grade'] ?></b></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th class=" desc">DESKRIPSI</th>
                        <th class="desc">Rata-Rata</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="desc">Rata-Rata Nilai Disiplin</td>
                        <td class="desc">
                            <?= $disiplin['total_disiplin']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">Rata-Rata Nilai Tanggung Jawab</td>
                        <td class="desc">
                            <?= $tanggung['total_tanggungjawab']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="desc" style="font-weight: bold;">Rata-Rata Nilai Praktek</td>
                        <td class="desc">
                            <?= $praktek['total_praktek']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="desc" style="font-weight: bold;">Total Nilai Rata-Rata</td>
                        <td class="desc" style="font-weight: bold;"><?= $rata['total_rata'] ?> </td>
                    </tr>
                    <!-- <tr>
                        <td class="desc" style="font-weight: bold;">Rata-Rata Grade</td> -->
                    <!-- <td class="desc" style="font-weight: bold;"><?php
                                                                        // if ($rata['total_rata'] >= 80 && $rata['total_rata'] <= 100) {
                                                                        //     echo 'A';
                                                                        // } else if ($rata['total_rata'] >= 60 && $rata['total_rata'] < 80) {
                                                                        //     echo 'B';
                                                                        // } else if ($rata['total_rata'] >= 40 && $rata['total_rata'] < 60) {
                                                                        //     echo 'C';
                                                                        // } else if ($rata['total_rata'] >= 20 && $rata['total_rata'] < 40) {
                                                                        //     echo 'D';
                                                                        // } else {
                                                                        //     echo 'E';
                                                                        // }
                                                                        ?></td>
                    </tr> -->
                </tbody>
            </table>
            <hr>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">Nilai diatas sudah sesuai apa yang diinputkan oleh penyelia selama magang, jika ada kesalahan silahkan hubungi penyelia masing-masing divisi</div>
            </div>
        </main>
        <footer>
            Created By <b>Simone</b>
        </footer>
    </div>
</body>

</html>