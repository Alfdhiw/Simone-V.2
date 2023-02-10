<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Mahasiswa</h1>
        <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#dataModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
        <!-- Modal -->
        <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="dataModalLabel">Cetak Report Data</h1>
                    </div>
                    <form action="<?= base_url('dashboard/cetak_laporan') ?>" method="post" id="tes1">
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td><b>Periode</b></td>
                                    <td>:</td>
                                    <td></td>
                                    <td><input class="form-control" type="date" name="from" id="from"></td>
                                    <td><b>-</b></td>
                                    <td><input class="form-control" type="date" name="to" id="to"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary" type="button" target="_blank" onclick="myFunction()">Cetak</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-6">
                    <form action="" method="get">
                        <table class="text-right">
                            <tr>
                                <td><b>Periode :&ensp;</b></td>
                                <td><input type="date" name="from" class="form-control" required></td>
                                <td><b>-</b></td>
                                <td><input type="date" name="to" class="form-control" required></td>
                                <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <br>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datamahasiswa" id="datamahasiswa" width="100%" cellspacing="0">
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
                                <?php
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='mahasiswa' and p.status='1' and p.tgl_terima BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='mahasiswa' and p.status='1'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $d['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $d['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datamhs/' . $d['kode_magang'])  ?>"><b><?= $d['nama']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['divisi'] ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($d['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($d['is_active'] == 0) {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editmhsModal<?= $d['kode_magang']; ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>
                                            <!-- Modal Edit Data Mahasiswas-->
                                            <div class="modal fade" id="editmhsModal<?= $d['kode_magang'] ?>" tabindex="-1" aria-labelledby="editmahasiswaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editmhsModalLabel"><b>Edit Data Mahasiswa</b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editdatamhs/') . $d['kode_magang']; ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $d['nama'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">NIM</label>
                                                                    <input type="text" class="form-control" name="nim" value="<?= $d['nim'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Asal Sekolah</label>
                                                                    <input type="text" class="form-control" name="sekolah" value="<?= $d['sekolah'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jurusan</label>
                                                                    <input type="text" class="form-control" name="jurusan" value="<?= $d['jurusan'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telepon</label>
                                                                    <input type="text" class="form-control" min="1" name="telepon" value="<?= $d['telepon'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                                    <?php
                                                                    if ($d['jeniskel'] == 'P') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Perempuan" disabled>';
                                                                    } else if ($d['jeniskel'] == 'L') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Laki-Laki" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $d['email'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Password</label>
                                                                    <input type="text" class="form-control" name="password" value="<?= $d['password'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Status Akun</label>
                                                                    <?php
                                                                    if ($d['status'] == 0) {
                                                                        echo '<input type="text" class="form-control" name="status" value="Unverified" disabled>';
                                                                    } else {
                                                                        echo '<input type="text" class="form-control" name="status" value="Verified" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Divisi Magang</label>
                                                                    <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                        <option value="<?= $d['kode_kategori']; ?>">Pilih Divisi</option>
                                                                        <?php foreach ($kerja as $k) : ?>
                                                                            <option value="<?= $k['kode_kategori']; ?>"><?= $k['divisi']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($d['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($d['is_active'] == "") {
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
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('dashboard/deletemhs/' . $d['kode_magang']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php } ?>
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
            <div class="row">
                <div class="col-xl-6 col-md-6 mb-4">
                    <form action="" method="get">
                        <table class="text-right">
                            <tr>
                                <td><b>Periode :&ensp;</b></td>
                                <td><input type="date" name="dari" class="form-control" required></td>
                                <td><b>-</b></td>
                                <td><input type="date" name="ke" class="form-control" required></td>
                                <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datasiswa" id="datasiswa" width="100%" cellspacing="0">
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
                                <?php
                                if (isset($_GET['dari']) && isset($_GET['ke'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='siswa' and p.status='1' and p.tgl_terima BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='siswa' and p.status='1'");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $d['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $d['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datamhs/' . $d['kode_magang'])  ?>"><b><?= $d['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $d['divisi']; ?></td>
                                        <td class="text-center"><?php
                                                                if ($d['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center"><?php
                                                                if ($d['is_active'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Mangkir</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editswaModal<?= $d['kode_magang']; ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>
                                            <!-- Modal Edit Data Mahasiswas-->
                                            <div class="modal fade" id="editswaModal<?= $d['kode_magang'] ?>" tabindex="-1" aria-labelledby="editswaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editswaModalLabel"><b>Edit Data Mahasiswa</b> </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editdatamhs/') . $d['kode_magang']; ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $d['nama'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">NISN</label>
                                                                    <input type="text" class="form-control" name="nim" value="<?= $d['nim'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Asal Sekolah</label>
                                                                    <input type="text" class="form-control" name="sekolah" value="<?= $d['sekolah'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Jurusan</label>
                                                                    <input type="text" class="form-control" name="jurusan" value="<?= $d['jurusan'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telepon</label>
                                                                    <input type="text" class="form-control" min="1" name="telepon" value="<?= $d['telepon'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                                    <?php
                                                                    if ($d['jeniskel'] == 'P') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Perempuan" disabled>';
                                                                    } else if ($d['jeniskel'] == 'L') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Laki-Laki" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $d['email'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Password</label>
                                                                    <input type="text" class="form-control" name="password" value="<?= $d['password'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Divisi Magang</label>
                                                                    <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                        <option value="<?= $d['kode_kategori']; ?>">Pilih Divisi</option>
                                                                        <?php foreach ($kerja as $k) : ?>
                                                                            <option value="<?= $k['kode_kategori']; ?>"><?= $k['divisi']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($d['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($d['is_active'] == "") {
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
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('dashboard/deleteswa/' . $d['kode_magang']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php } ?>
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