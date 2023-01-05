<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sertifikat Magang Pdf</title>
    <link href="<?= base_url() ?>assets/css/admin/sertifikat-custom.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <header class="clearfix">
            <table>
                <tr>
                    <th>
                        <div id="logo">
                            <img src="<?= base_url() ?>assets/img/login/udinus.jpg">
                        </div>
                    </th>
                    <th>
                        <div id="kop">
                            <p>KEMENTERIAN HUKUM RI <br> PENGADILAN TINGGI KOTA SEMARANG <br> <?php echo $peserta['divisi'] ?></p>
                        </div>
                    </th>
                </tr>
            </table>

        </header>
        <main>
            <h1>Sertifikat</h1>
            <div id="cepak">
                <p>Diberikan Kepada :</p>
                <p><img src="<?= base_url('assets/data/peserta/pas_foto/' . $peserta['foto']) ?>" alt="foto pas"></p>
                <p><b><?php echo $peserta['nama']; ?></b></p>
                <p><b>( <?php echo $peserta['nim']; ?> )</b></p>
            </div>


            <div id="data">
                <table>
                    <tr>
                        <th style="text-align: left;">Sekolah, Jurusan</th>
                        <th style="text-align: left;">:</th>
                        <th style="text-align: left;"><?php echo $peserta['sekolah']; ?>, <?php echo $peserta['jurusan']; ?></th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Divisi Magang</th>
                        <th style="text-align: left;">:</th>
                        <th style="text-align: left;"><?php echo $peserta['divisi']; ?></th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Hasil</th>
                        <th style="text-align: left;">:</th>
                        <th style="text-align: left;"><?php if ($rata['total_rata'] >= 80 && $rata['total_rata'] <= 100) {
                                                            echo '<b>Sangat Baik</b>';
                                                        } elseif ($rata['total_rata'] >= 50 && $rata['total_rata'] <= 79) {
                                                            echo '<b>Baik</b>';
                                                        } else {
                                                            echo '<b>Kurang Baik</b>';
                                                        } ?></th>
                    </tr>
                </table>
            </div>

            <div id="deskripsi">
                <p>Telah melakukan Praktek Kerja Lapangan <br> pada Pengadilan Tinggi Kota Semarang <br> dari tanggal <?php echo date('j F Y', strtotime($job['jobstart'])); ?> - <?php echo date('j F Y', strtotime($job['jobend'])); ?> </p>
            </div>

            <div id="ttd">
                <p>Semarang, <?php echo $date; ?> <br> Penyelia Divisi <br></p>
            </div>

            <div id="ttd">
                <p><?= $penyelia['nama'] ?></p>
            </div>
        </main>
        <footer>
            Created By <b>Simone</b>
        </footer>
    </div>
</body>

</html>