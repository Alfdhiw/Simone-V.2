<div style="min-height: 100vh;" class="bg-grey pt-md-5 pb-5">



    <div class="col-lg-6 col-md-8 col-12 m-auto">

        <div class="col-12 d-flex justify-content-between">

            <h1 class="text-secondary" style="font-weight: bold; font-size:30px;">Edit Profile</h1>

        </div>

        <?php if ($this->session->flashdata('success')) : ?>

            <div class="alert alert-success" role="alert">

                <?php echo $this->session->flashdata('success'); ?>

            </div>

        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>

            <div class="alert alert-danger" role="alert">

                <?php echo $this->session->flashdata('error'); ?>

            </div>

        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" class="mt-5 needs-validation" novalidate>



            <input type="hidden" name="kode_magang" value="<?php echo $profil['kode_magang'] ?>" />



            <div class="form-group form-row mb-4">

                <div class="col-4">

                    <div class="img">
                        <img class="border-right rounded-lg shadow img-thumbnail" name="foto" src="<?= base_url('assets/data/peserta/pas_foto/' . $profil['foto']); ?>" alt="" style="height: 200px; width: 170px">
                    </div>
                </div>

                <div class="col d-flex align-items-center">

                    <input class="form-control-file" type="file" name="foto" />

                    <input type="hidden" name="gambar_lama" value="<?= $profil['foto'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-12">

                    <label for="nim">NISN / NIM</label>

                    <input id="nim" class="form-control shadow" type="text" name="nim" value="<?= $profil['nim'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-6">

                    <label for="nama">Nama Mahasiswa</label>

                    <input id="nama" class="form-control shadow" type="text" name="nama" value="<?= $profil['nama'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label for="jeniskel">Jenis Kelamin</label>
                    <select id="jeniskel" class="form-control shadow" type="text" name="jeniskel" required>
                        <option value="<?= $profil['jeniskel'] ?>"><?php if ($profil['jeniskel'] == 'L') {
                                                                        echo 'Laki-laki';
                                                                    } else if ($profil['jeniskel'] == 'P') {
                                                                        echo 'Perempuan';
                                                                    } else {
                                                                        echo 'Pilih Jenis Kelamin';
                                                                    } ?></option>
                        </option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>

            </div>

            <div class="form-row">

                <div class="form-group col-md-6">

                    <label for="email">Email</label>

                    <input id="email" class="form-control shadow" type="email" name="email" value="<?= $profil['email'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>

                <div class="form-group col-md-6">

                    <label for="password">Kata Sandi</label>

                    <input id="password" class="input-100 form-control shadow" type="password" name="password" value="<?= $profil['password'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>
            </div>



            <div class="form-group form-row">

                <div class="form-group col-md-6">

                    <label for="sekolah">Asal Sekolah</label>

                    <input id="sekolah" class="form-control shadow" type="text" name="sekolah" value="<?= $profil['sekolah'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>



                </div>

                <div class="form-group col-md-6">

                    <label for="jurusan">Asal Jurusan</label>

                    <input id="jurusan" class="form-control shadow" type="jurusan" name="jurusan" value="<?= $profil['jurusan'] ?>" required />
                    <div class="invalid-feedback">
                        Tolong Lengkapi Data.
                    </div>

                </div>

            </div>

            <div class="form-group">

                <label for="telepon">Nomer Telp/HP.</label>

                <input id="telepon" class="form-control shadow" type="text" name="telepon" value="<?= $profil['telepon'] ?>" required />
                <div class="invalid-feedback">
                    Tolong Lengkapi Data.
                </div>

            </div>

            <input class="btn btn-success mt-3" data-toggle="modal" value="Update Biodata" data-target="#submitModal"></input>&ensp;&ensp;&ensp;&ensp;
            <a type="button" href="<?= base_url('home') ?>" class="btn btn-secondary mt-3">Kembali</a>
            <!-- Modal Submit -->
            <div class="modal fade" id="submitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitModalLabel">Peringatan ! </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin dengan perubahan ini ? Jika iya anda akan langsung log out dan memulai login ulang
                            untuk perubahan data
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" name="btn" id="submit" class="btn btn-primary">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>