<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-secret"></i> List Ketua</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataketua" id="dataketua" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>NIP</th>
                                    <th>Divisi</th>
                                    <th>Status Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ketua as $k) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/ketua/pas_foto/' . $k['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $k['nama'] ?>">
                                        </td>
                                        <td><a href="<?= base_url('dashboard/detailketua/' . $k['kode_ketua'])  ?>"><b><?= $k['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td><b><?= $k['nip']; ?></b></td>
                                        <td class="text-center"><b><?= $k['divisi']; ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($k['is_active'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Mangkir</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#editketuaModal<?= $k['kode_ketua']; ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Edit</span></a></span>
                                            <!-- Modal Edit Data Ketua-->
                                            <div class="modal fade" id="editketuaModal<?= $k['kode_ketua'] ?>" tabindex="-1" aria-labelledby="editketuaModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editketuaModalLabel">Edit Data Ketua</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editketua/') . $k['kode_ketua']; ?>" method="POST">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Nama Ketua</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $k['nama'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">NIP</label>
                                                                    <input type="text" class="form-control" name="nip" value="<?= $k['nip'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Telepon</label>
                                                                    <input type="text" class="form-control" min="1" name="telp" value="<?= $k['telp'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                                                    <?php
                                                                    if ($k['jeniskel'] == 'P') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Perempuan" disabled>';
                                                                    } else if ($k['jeniskel'] == 'L') {
                                                                        echo '<input type="text" class="form-control" name="jeniskel" value="Laki-Laki" disabled>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Email address</label>
                                                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?= $k['email'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Password</label>
                                                                    <input type="text" class="form-control" name="password" value="<?= $k['password'] ?>" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlSelect1">Divisi Kerja</label>
                                                                    <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                        <option value="<?= $k['kode_kategori']; ?>">Pilih Divisi</option>
                                                                        <?php foreach ($kerja as $kerja) : ?>
                                                                            <option value="<?= $kerja['kode_kategori']; ?>"><?= $kerja['divisi']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($k['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($k['is_active'] == "") {
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
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('dashboard/deleteketua/' . $k['kode_ketua']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->