<div id="myCarousel" class="carousel slide banner_main" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container-fluid">
                <div class="carousel-caption">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                            <div class="text-bg">
                                <h2 class="text-light mb-3" style="font-size: 40px;"><b>Sistem Magang Online Pengadilan Negeri Semarang</b></h2>
                                <h5 class="text-light mt-5" style="font-size: 20px;">Simone adalah website untuk aplikasi Pendafataran Magang Online berbasis web di Pengadilan Negeri Semarang. Anda dapat menikmati beberapa fitur yang kami sediakan. antara lain, absensi, nilai, kuota tersedia, sertifikat.</h5>
                                <a class="read_more mt-3" href="#about"><span class="text-light">Read more</span></a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                            <div class="images_box">
                                <figure><img src="<?= base_url(); ?>assets/img/home/img2.png"></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end banner -->
<!-- about -->
<div id="about" class="about">
    <div class="container-fluid">
        <div class="row d_flex">
            <div class="col-md-5">
                <div class="about_img">
                    <figure><img src="<?= base_url(); ?>assets/img/home/about_img.jpg" alt="#" /></figure>
                </div>
            </div>
            <div class="col-md-7">
                <div class="titlepage">
                    <h2>Tentang <span class="blu">Simone </span></h2>
                    <p>Simone adalah website untuk aplikasi Pendafataran Magang Online
                        berbasis web di Pengadilan Negeri Semarang. Anda dapat menikmati beberapa fitur yang kami sediakan.
                        antara lain, persyaratan magang, absensi, nilai, kuota tersedia, sertifikat.</p>
                    <p>Tujuan aplikasi Simone ini sangat membantu Mahasiswa / Siswa yang dari luar kota ingin magang di instansi Pengadilan Negeri
                        Semarang. Mahasiswa / Siswa tidak perlu datang ke Pengadilan Negeri Semarang untuk mengajukan surat permohonan magang,
                        cukup mendaftar online lewat website Simone.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->
<!-- persyaratan  section -->
<div id="persyaratan" class="choose">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Persyaratan<span class="blu"> Magang</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row shapes">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row">
                    <div class="col-md-12 minHeightProp">
                        <div class="icon-pendaftaran">
                            <i class=" fas fa fa-envelope fa-4x"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <span>Surat Permohonan</span>
                            <p>Surat permohonan persetujuan magang dari Kampus / Sekolah </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row">
                    <div class="col-md-12 minHeightProp">
                        <div class="icon-pendaftaran">
                            <i class=" fas fa fa-syringe fa-4x"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <span>Vaksin Ketiga</span>
                            <p>Minimal sudah vaksin ketiga / booster</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row">
                    <div class="col-md-12 minHeightProp">
                        <div class="icon-pendaftaran">
                            <i class=" fas fa fa-graduation-cap fa-4x"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <span>Pendidikan D3 / S1</span>
                            <p>Minimal pendidikan D3 / S1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end choose  section -->
<!-- pendaftaran -->
<div id="pendaftaran" class="work">
    <div class="container-fluid">
        <div class="row d_flex">
            <div class="col-md-7">
                <div class="mx-auto" style="justify-content: center;">
                    <div class="titlepage float-left ml-5 text-center">
                        <h2>Magang<span class="blu"> Tersedia</span></h2>
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <table class="table table-hover mr-3 col-md-12">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="font-size: 15px;">No</th>
                                            <th style="font-size: 15px;">Posisi Tersedia</th>
                                            <th class="text-center" style="font-size: 15px;">Periode</th>
                                            <th style="font-size: 15px;">Deadline Pendaftaran</th>
                                            <th style="font-size: 15px;">Kuota</th>
                                            <th style="font-size: 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($loker as $loker) {
                                            $count = $count + 1; ?>
                                            <tr>
                                                <td style="text-center"><?= $count ?></td>
                                                <td class="text-center"><?= $loker['divisi']; ?></td>
                                                <td class="text-center"><?php echo date('j M Y', strtotime($loker['jobstart'])) ?> - <?php echo date('j M Y', strtotime($loker['jobend'])) ?></td>
                                                <td class="text-center"><?php echo date('j M Y', strtotime($loker['registerend'])) ?></td>
                                                <td class="text-center"><?= $loker['kuota'] ?></td>
                                                <?php if ($loker['kuota'] == 0) {
                                                    echo '<td class="text-center"><button type="button" href="" class="badge badge-secondary btn-sm" disabled><span style="font-size:15px;">Apply</span></button></td>';
                                                } else if ($loker['kuota'] > 0) {
                                                    echo '<td class="text-center"><a type="button" href="' . base_url('home/daftarloker/' . $loker['jobid']) . '" class="badge badge-success btn-sm"><span style="font-size:15px;">Apply</span></a></td>';
                                                } ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="work_img">
                    <figure><img src="<?= base_url(); ?>assets/img/home/work_img.jpg" alt="#" /></figure>
                </div>
            </div>
        </div>
    </div>
</div>