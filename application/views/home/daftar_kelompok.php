<!-- <div class="about">
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
</div> -->
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
                <form class="needs-validation" action="<?= base_url('home/daftarkelompok') ?>" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="container mb-4">
                            <div class="col-xl-12 col-md-12">
                                <p style="font-size: 25px; font-weight:600px;">1) Instansi Sekolah / Kampus</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Asal Sekolah / Kampus<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="sekolah" name="sekolah" placeholder="Asal Sekolah" style="text-transform:uppercase" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Email Sekolah / Kampus <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="email_kampus" name="email_kampus" placeholder="Email Aktif" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Jurusan / Bidang Studi <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="jurusan" name="jurusan" placeholder="Jurusan" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleFormControlSelect1">Tingkat Pendidikan<span class="text-danger">*</span></label>
                                                <select class="form-control shadow" id="tingkat_pendidikan" name="tingkat_pendidikan" required>
                                                    <option selected value="" disabled>Pilih Pendidkan</option>
                                                    <option value="siswa">Sekolah Menengah Kejuruan</option>
                                                    <option value="mahasiswa">Perguruan Tinggi</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Tolong Pilih Pendidikan.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="container mb-4">
                            <div class="col-xl-12 col-md-12">
                                <p style="font-size: 25px; font-weight:600px;">2) Peserta Magang 1</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nama Lengkap<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nama1" name="nama1" placeholder="Nama Lengkap" style="text-transform:uppercase" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">NIM / NISN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nim1" name="nim1" placeholder="NIM / NISN" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="email1" name="email1" placeholder="Email Aktif" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Telepon<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="telp1" name="telp1" placeholder="Telepon Aktif" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <select class="form-control shadow" id="jeniskel1" name="jeniskel1" required>
                                                    <option selected value="" disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Tolong Pilih Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="container mb-4">
                            <div class="col-xl-12 col-md-12">
                                <p style="font-size: 25px; font-weight:600px;">3) Peserta Magang 2</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nama Lengkap<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nama2" name="nama2" placeholder="Nama Lengkap" style="text-transform:uppercase" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">NIM / NISN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nim2" name="nim2" placeholder="NIM / NISN" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="email2" name="email2" placeholder="Email Aktif" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Telepon<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="telp2" name="telp2" placeholder="Telepon Aktif" required>
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <select class="form-control shadow" id="jeniskel2" name="jeniskel2" required>
                                                    <option selected value="" disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Tolong Pilih Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="container mb-4">
                            <div class="col-xl-12 col-md-12">
                                <p style="font-size: 25px; font-weight:600px;">4) Peserta Magang 3</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nama Lengkap<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nama3" name="nama3" placeholder="Nama Lengkap" style="text-transform:uppercase">
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">NIM / NISN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="nim3" name="nim3" placeholder="NIM / NISN">
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Email<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="email3" name="email3" placeholder="Email Aktif">
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Telepon<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control shadow" id="telp3" name="telp3" placeholder="Telepon Aktif">
                                                <div class="invalid-feedback">
                                                    Tolong Lengkapi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlSelect1">Jenis Kelamin<span class="text-danger">*</span></label>
                                                <select class="form-control shadow" id="jeniskel3" name="jeniskel3">
                                                    <option selected value="" disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Tolong Pilih Jenis Kelamin.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="container mb-4">
                            <div class="col-xl-12 col-md-12">
                                <p style="font-size: 25px; font-weight:600px;">5) Berkas Pendaftaran</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="surat">Surat Pengantar<span class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file" id="surat_pengantar" name="surat_pengantar" oninput="validateFileSurat()" required>
                                                <div class="invalid-feedback">
                                                    Inputan harap diisi.
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="nilai">Transkip Nilai<span class="text-danger">*</span></label>
                                                <input type="file" class="form-control-file" id="transkip_nilai" name="transkip_nilai" oninput="validateFileNilai()" required>
                                                <div class="invalid-feedback">
                                                    Inputan harap diisi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="g-recaptcha" data-sitekey="6LdVPUYjAAAAAGCb_0ZGfCiaaOZap0aG2ziRV-vE"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="status" value="0">
                        <input type="hidden" class="form-control" name="tgl_daftar" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                            echo date('Y-m-d H:i:s'); ?>">
                        <div class="container">
                            <div class="col-xl-12 col-md-12">
                                <button type="submit" id="confirm" name="confirm" class="btn btn-success" onclick="validateFile()">Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <table class="text-secondary" style="font-size: medium; font-weight:500">
            <tr>
                <td>Keterangan :</td>
            </tr>
            <tr>
                <td>- Tanda <span style="color:red">*</span> artinya wajib diisi </td>
            </tr>
            <tr>
                <td>- Minimal pendaftar kelompok berjumlah 2 orang </td>
            </tr>
            <tr>
                <td>- Surat pengantar magang hanya bisa diperoleh dari instansi masing-masing sekolah dan dapat diwakilkan</td>
            </tr>
            <tr>
                <td>- Transkip nilai berisi nilai yang terbaru pada semester yang saat ini anda tempuh</td>
            </tr>
            <tr>
                <td>- Transkip nilai dijadikan satu folder PDF</td>
            </tr>
        </table>
    </div>
</div>
</div>
<script>
    /* javascript function to validate file type */
    function validateFileFoto() {
        var inputElement = document.getElementById('foto');
        var files = inputElement.files;
        if (files.length > 0) {
            var filename = files[0].name;

            /* getting file extenstion eg- .jpg,.png, etc */
            var extension = filename.substr(filename.lastIndexOf("."));

            /* define allowed file types */
            var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png)$/i;

            /* testing extension with regular expression */
            var isAllowed = allowedExtensionsRegx.test(extension);

            if (isAllowed) {

            } else {
                Swal.fire({
                    title: 'Invalid File',
                    text: "Gunakan Ekstensi JPG, PNG, JPEG",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#57c077',
                    confirmButtonText: 'Oke'
                })
            }
        }
    }
</script>
<script>
    /* javascript function to validate file type */
    function validateFileSurat() {
        var inputElement = document.getElementById('surat_pengantar');
        var files = inputElement.files;
        if (files.length > 0) {
            var filename = files[0].name;

            /* getting file extenstion eg- .jpg,.png, etc */
            var extension = filename.substr(filename.lastIndexOf("."));

            /* define allowed file types */
            var allowedExtensionsRegx = /(\.pdf)$/i;

            /* testing extension with regular expression */
            var isAllowed = allowedExtensionsRegx.test(extension);

            if (isAllowed) {

            } else {
                Swal.fire({
                    title: 'Invalid File',
                    text: "Gunakan Ekstensi PDF",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#57c077',
                    confirmButtonText: 'Oke'
                })
            }
        } else {

        }
    }
</script>

<script>
    /* javascript function to validate file type */
    function validateFileNilai() {
        var inputElement = document.getElementById('transkip_nilai');
        var files = inputElement.files;
        if (files.length > 0) {
            var filename = files[0].name;

            /* getting file extenstion eg- .jpg,.png, etc */
            var extension = filename.substr(filename.lastIndexOf("."));

            /* define allowed file types */
            var allowedExtensionsRegx = /(\.pdf)$/i;

            /* testing extension with regular expression */
            var isAllowed = allowedExtensionsRegx.test(extension);

            if (isAllowed) {

            } else {
                Swal.fire({
                    title: 'Invalid File',
                    text: "Gunakan Ekstensi PDF",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#57c077',
                    confirmButtonText: 'Oke'
                })
            }
        } else {

        }
    }
</script>