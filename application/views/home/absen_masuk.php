<div class="col-12 d-flex px-1 justify-content-between">
    <h1 class="section-title position-relative text-uppercase mx-xl-0 mb-1"><span class="pr-3" style="color: #444444; font-weight:500; font-size:30px;"><?= $title ?></span></h1>
</div>
<div class="col-12 d-flex px-1 justify-content-between">
    <h3 class="section-title position-relative text-uppercase mx-xl-0 mb-4"><span class="pr-3" style="color: #444444; font-weight:500;"><span id="date_time"><?php echo $waktu['masuk'] ?></span></span></h3>
</div>
<form action="<?= base_url('home/absen') ?>" method="post" enctype="multipart/form-data" class="mt-5">

    <div class=" form-row">

        <div class="col-md-6 form-group">

            <label for="nama">Nama Lengkap</label>

            <input id="nama" class="form-control shadow" type="text" name="nama" value="<?= $peserta['nama'] ?>" readonly />
        </div>

        <div class="col-md-6 form-group">

            <label for="jobname">Divisi Magang</label>

            <input id="jobname" class="form-control shadow" type="text" name="jobname" value="<?= $peserta['divisi'] ?>" readonly />
        </div>

    </div>

    <div class="form-group">

        <label for="status">Status Absen</label>

        <select class="form-control shadow" name="status" id="status">
            <option value="0">-- Pilih -- </option>
            <option value="1">Hadir</option>
            <option value="2">Ijin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="ijin">Upload Surat Ijin</label>
        <input type="file" class="form-control-file" name="surat_ijin" id="surat_ijin">
        <small class="form-text text-muted">Upload saat akan mengajukan ijin absen</small>

    </div>

    <input type="hidden" name="tgl_absen" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                    echo date('Y-m-d H:i:s'); ?>">

    <input type="hidden" name="kode_magang" value="<?= $peserta['kode_magang'] ?>">

    <button type="submit" class="btn btn-success mt-3">Kirim Absen</button>&ensp;&ensp;&ensp;&ensp;
    <a type="button" href="<?= base_url('home') ?>" class="btn btn-secondary mt-3">Kembali</a>

</form>