<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Mahasiswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data_mahasiswa" id="data_mahasiswa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Divisi</th>
                                    <th>Status Verif</th>
                                    <th>Status Magang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $mhs['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $mhs['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datamhs/' . $mhs['kode_magang'])  ?>"><b><?= $mhs['nama']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['divisi'] ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($mhs['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($mhs['is_active'] == 0) {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editmhsModal<?= $mhs['kode_magang']; ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>
                                            <!-- Modal Edit Data Mahasiswas-->
                                            <div class="modal fade" id="editmhsModal<?= $mhs['kode_magang'] ?>" tabindex="-1" aria-labelledby="editmahasiswaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editmhsModalLabel"><b>Edit Data Mahasiswa</b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editdatamhs/') . $mhs['kode_magang']; ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $mhs['nama'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">NIM</label>
                                                                    <input type="text" class="form-control" name="nim" value="<?= $mhs['nim'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Asal Sekolah</label>
                                                                    <input type="text" class="form-control" name="sekolah" value="<?= $mhs['sekolah'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jurusan</label>
                                                                    <input type="text" class="form-control" name="jurusan" value="<?= $mhs['jurusan'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telepon</label>
                                                                    <input type="text" class="form-control" min="1" name="telepon" value="<?= $mhs['telepon'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                                    <?php
                                                                    if ($mhs['jeniskel'] == 'P') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Perempuan" disabled>';
                                                                    } else if ($mhs['jeniskel'] == 'L') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Laki-Laki" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $mhs['email'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Password</label>
                                                                    <input type="text" class="form-control" name="password" value="<?= $mhs['password'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Status Akun</label>
                                                                    <?php
                                                                    if ($mhs['status'] == 0) {
                                                                        echo '<input type="text" class="form-control" name="status" value="Unverified" disabled>';
                                                                    } else {
                                                                        echo '<input type="text" class="form-control" name="status" value="Verified" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Divisi Magang</label>
                                                                    <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                        <option value="<?= $mhs['kode_kategori']; ?>">Pilih Divisi</option>
                                                                        <?php foreach ($kerja as $k) : ?>
                                                                            <option value="<?= $k['kode_kategori']; ?>"><?= $k['divisi']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($mhs['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($mhs['is_active'] == "") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        } else {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        }
                                                                        ?>
                                                                        Active?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('dashboard/deletemhs/' . $mhs['kode_magang']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Siswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data_siswa" id="data_siswa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Divisi</th>
                                    <th>Status Verif</th>
                                    <th>Status Magang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siswa as $swa) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $swa['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $swa['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datamhs/' . $swa['kode_magang'])  ?>"><b><?= $swa['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['divisi']; ?></td>
                                        <td class="text-center"><?php
                                                                if ($swa['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center"><?php
                                                                if ($swa['is_active'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Mangkir</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editswaModal<?= $swa['kode_magang']; ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>
                                            <!-- Modal Edit Data Mahasiswas-->
                                            <div class="modal fade" id="editswaModal<?= $swa['kode_magang'] ?>" tabindex="-1" aria-labelledby="editswaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editswaModalLabel"><b>Edit Data Mahasiswa</b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editdatamhs/') . $swa['kode_magang']; ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $swa['nama'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">NISN</label>
                                                                    <input type="text" class="form-control" name="nim" value="<?= $swa['nim'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Asal Sekolah</label>
                                                                    <input type="text" class="form-control" name="sekolah" value="<?= $swa['sekolah'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jurusan</label>
                                                                    <input type="text" class="form-control" name="jurusan" value="<?= $swa['jurusan'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telepon</label>
                                                                    <input type="text" class="form-control" min="1" name="telepon" value="<?= $swa['telepon'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                                    <?php
                                                                    if ($swa['jeniskel'] == 'P') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Perempuan" disabled>';
                                                                    } else if ($swa['jeniskel'] == 'L') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Laki-Laki" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $swa['email'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Password</label>
                                                                    <input type="text" class="form-control" name="password" value="<?= $swa['password'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Status Akun</label>
                                                                    <?php
                                                                    if ($swa['status'] == 0) {
                                                                        echo '<input type="text" class="form-control" name="status" value="Unverified" disabled>';
                                                                    } else {
                                                                        echo '<input type="text" class="form-control" name="status" value="Verified" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Divisi Magang</label>
                                                                    <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                        <option value="<?= $swa['kode_kategori']; ?>">Pilih Divisi</option>
                                                                        <?php foreach ($kerja as $k) : ?>
                                                                            <option value="<?= $k['kode_kategori']; ?>"><?= $k['divisi']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>

                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($swa['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($swa['is_active'] == "") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        } else {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        }
                                                                        ?>
                                                                        Active?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('dashboard/deleteswa/' . $swa['kode_magang']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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