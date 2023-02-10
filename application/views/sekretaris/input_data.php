<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="needs-validation" action="<?= base_url('sekretaris/daftarindividu') ?>" method="POST" enctype="multipart/form-data" novalidate>
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
                                        <label for="inputPassword4">Email Pribadi<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control shadow" id="email" name="email" placeholder="Email Aktif" required>
                                        <div class="invalid-feedback">
                                            Tolong Lengkapi Email.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Email Sekolah / Kampus<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control shadow" id="email_kampus" name="email_kampus" placeholder="Email Kampus / Sekolah Aktif" required>
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
                                    <div class="form-group col-md-12">
                                        <label for="exampleFormControlSelect1">Divisi<span class="text-danger">*</span></label>
                                        <select class="form-control shadow" id="divisi" name="divisi" required>
                                            <option selected value="" disabled>Pilih Divisi</option>
                                            <?php foreach ($kerja as $kj) : ?>
                                                <option value="<?= $kj['kode_kategori']; ?>"><?= $kj['divisi']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Tolong Pilih Jenis Kelamin.
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="foto" value="default.png">
                                <input type="hidden" class="form-control" name="is_active" value="0">
                                <input type="hidden" class="form-control" name="idrole" value="2">
                                <input type="hidden" class="form-control" name="status" value="0">
                                <input type="hidden" class="form-control" name="password" value="<?= $password ?>">
                                <input type="hidden" class="form-control" name="tgl_daftar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                    echo date('Y-m-d H:i:s'); ?>">
                                <input type="hidden" class="form-control" name="tgl_terima" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                    echo date('Y-m-d'); ?>">
                                <button type="submit" id="confirm" name="confirm" class="btn btn-success" onclick="validateFile()">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        $('.data_mahasiswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.data_siswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
<!-- End of Main Content -->