<div class="about">
    <div class="container-fluid">
        <div class="row d_flex">
            <div class="col-md-5">
                <div class="about_img">
                    <figure><img src="<?= base_url(); ?>assets/img/home/about_img.jpg" alt="#" /></figure>
                </div>
            </div>
            <div class="col-md-7">
                <div class="titlepage">
                    <h2>Divisi Magang <span class="blu"><br><?= $daftar['divisi'] ?></span></h2>
                    <ul>
                        <li class="text-secondary" style="font-size: 20px; font-weight:500;">Periode Magang : <?php echo date('j M Y', strtotime($daftar['jobstart'])) ?> - <?php echo date('j M Y', strtotime($daftar['jobend'])) ?></li>
                        <li class="text-secondary mt-4" style="font-size: 20px; font-weight:500;">Kuota Magang : <?= $daftar['kuota'] ?> Kuota</li>
                        <li class="text-secondary mt-4" style="font-size: 20px; font-weight:500;">Deskripsi Magang : <p class="text-secondary mt-2" style="font-size: 20px; font-weight:500;"><?= $daftar['jobdesc'] ?></p>
                        </li>
                        <li class="text-secondary" style="font-size: 20px; font-weight:500;">Tipe Kerja : <span class="badge badge-secondary"><?= $daftar['workingtype'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->

<div class="choose mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Formulir<span class="blu">Pendaftaran</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if ($this->session->flashdata('flash')) {
            echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
        } ?>
        <div class="row">
            <div class="col-md-12">
                <form class="needs-validation" action="<?= base_url('home/daftarloker') ?>" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow" id="nama" name="nama" placeholder="Nama Lengkap" style="text-transform:uppercase" required>
                            <div class="invalid-feedback">
                                Tolong Lengkapi Nama.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">NIM / NISN<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow" id="nim" name="nim" placeholder="NIM / NISN" required>
                            <div class="invalid-feedback">
                                Tolong Lengkapi NIM / NISN.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control shadow" id="email" name="email" placeholder="Email Aktif" required>
                            <div class="invalid-feedback">
                                Tolong Lengkapi Email.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Tingkat Pendidikan<span class="text-danger">*</span></label>
                            <select class="form-control shadow" id="pendidikan" name="pendidikan" required>
                                <option selected value="" disabled>Pilih Pendidkan</option>
                                <option value="siswa">Sekolah Menengah Kejuruan</option>
                                <option value="mahasiswa">Perguruan Tinggi</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong Pilih Pendidikan.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control shadow" id="jeniskel" name="jeniskel" required>
                                <option selected value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong Pilih Jenis Kelamin.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Asal Sekolah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow" id="sekolah" name="sekolah" required placeholder="Nama Sekolah" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                Tolong Isi Asal Sekolah.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Jurusan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow" id="jurusan" name="jurusan" required placeholder="Nama Jurusan" style="text-transform:uppercase">
                            <div class="invalid-feedback">
                                Tolong Isi Jurusan.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="telepon">Telepon<span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow" id="telepon" min="1" name="telepon" value="62" placeholder="Nomer Aktif" required>
                            <div class="invalid-feedback">
                                Tolong Isi Nomer Telp.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="foto">Foto Resmi 3X4<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                            <div class="invalid-feedback">
                                Tolong Upload Foto.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="surat">Foto Surat Pengantar<span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" id="surat_pengantar" name="surat_pengantar">
                            <div class="invalid-feedback">
                                Tolong Upload Surat Pengantar.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="g-recaptcha" data-sitekey="6LdVPUYjAAAAAGCb_0ZGfCiaaOZap0aG2ziRV-vE"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="kode_kategori" value="<?= $daftar['kode_kategori'] ?>">
                    <input type="hidden" class="form-control" name="is_active" value="0">
                    <input type="hidden" class="form-control" name="idrole" value="2">
                    <input type="hidden" class="form-control" name="status" value="0">
                    <input type="hidden" class="form-control" name="jobid" value="<?= $daftar['jobid'] ?>">
                    <input type="hidden" class="form-control" name="kuota" value="<?= $daftar['kuota'] - 1 ?>">
                    <input type="hidden" class="form-control" name="password" value="<?= $password ?>">
                    <input type="hidden" class="form-control" name="tgl_daftar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                        echo date('Y-m-d H:i:s'); ?>">
                    <button type="submit" id="confirm" name="confirm" class="btn btn-success">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>