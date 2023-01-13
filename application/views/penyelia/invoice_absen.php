<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Magang Pdf</title>
    <link href="<?= base_url() ?>assets/css/admin/invoice.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <div id="logo">
                <img src="<?= base_url() ?>assets/img/login/pn.png">
            </div>
            <h1>Laporan Absensi Magang</h1>
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
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absen as $absen) : ?>
                        <tr>
                            <td class="desc">#</td>
                            <td class="desc"><?= date('j F Y H:i:s', strtotime($absen['tgl_absen'])) ?></td>
                            <td class="desc"><?= $absen['kegiatan'] ?></td>
                            <td class="desc"><?php if ($absen['status'] == 0) {
                                                    echo '<span class="badge badge-danger">Belum Absen</span>';
                                                } else if ($absen['status'] == 1) {
                                                    echo '<span class="badge badge-success">Sudah Absen</span>';
                                                } else {
                                                    echo '<span class="badge badge-warning">Ijin Absen</span>';
                                                } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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