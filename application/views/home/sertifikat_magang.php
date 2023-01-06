<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sertifikat Magang</title>
    <link href="<?= base_url() ?>assets/css/admin/sertifikat.css" rel="stylesheet">
</head>


<body>
    <div class="container-fluid">
        <header class="clearfix">
            <table>
                <tr>
                    <th>
                        <div id="logo">
                            <img src="<?= base_url() ?>assets/img/login/pn.png" style="width: 90px;">
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div id="logo">
                            SERTIFIKAT
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div id="nomor">
                            Nomor: W1 M/<?php echo $nomor; ?>/SERT/X/<?php echo $tahun; ?>
                        </div>
                    </th>
                </tr>
            </table>
        </header>
        <main>
            <table>
                <tr>
                    <th>
                        <div id="cepak">
                            <p>Diberikan Kepada :</p>
                            <p><img src="<?= base_url('assets/data/peserta/pas_foto/' . $peserta['foto']) ?>" alt="foto pas"></p>
                            <p><span style="font-size:small"><b>MAHASISWA <?php echo $peserta['jurusan']; ?> <?php echo $peserta['sekolah']; ?></b></span></p>
                            <p><span style="font-size: 20px; font-style:italic"><b><?php echo $peserta['nama']; ?></b><br><b>( <?php echo $peserta['nim']; ?> )</b></span></p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div id="deskripsi">
                            <p>Telah Melaksanakan Kegiatan Praktek Kerja Lapangan / Magang Pada Pengadilan Tinggi Kota Semarang<br>
                                Mulai Tanggal <?php echo date('j F Y', strtotime($job['jobstart'])); ?> Sampai Dengan <?php echo date('j F Y', strtotime($job['jobend'])); ?> </p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div id="ttd">
                            <p>Semarang, <?php echo $date; ?> <br> Kepala Pengadilan Tinggi Semarang <br></p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <div id="ketua">
                            <p><?= $ketua['nama'] ?></p>
                        </div>
                    </th>
                </tr>
            </table>




        </main>
        <footer>
            Created By <b>Simone</b>
        </footer>
    </div>
</body>

</html>