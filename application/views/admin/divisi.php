<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>
    <div class="row pb-3 pt-3">
        <div class="col-xl-12 col-md-12">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <a type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#divisiModal"><i class="fas fa-solid fa-plus"></i> Tambah Divisi</a>
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="divisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('dashboard/tambahdivisi') ?>" method="post">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Divisi Baru</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                Nama Divisi: <input type="text" name="divisi" placeholder="Nama Divisi" class="form-control" required><br>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addjob">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder"></i> List Kuota Magang</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datadivisi" id="datadivisi" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Divisi</th>
                                    <th>Nama Penanggung Jawab</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($divisi as $dv) : ?>
                                    <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-center"><?= $dv['divisi']; ?></td>
                                        <?php
                                        if ($dv['kode_penyelia'] == 0) {
                                            echo '<td class="text-center"><span class="badge badge-secondary text-bg-secondary">No data !</span></td>';
                                        } else {
                                            echo '<td class="text-center">' . $dv['nama'] . '</td>';
                                        } ?>

                                        <td class="text-center">
                                            <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editdivisiModal<?= $dv['kode_kategori'] ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Kelola</span></a>&ensp;
                                            <!-- The Modal -->
                                            <div class="modal fade" id="editdivisiModal<?= $dv['kode_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Divisi</h4>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body text-left">
                                                            <form action="<?= base_url('dashboard/editdivisi/' . $dv['kode_kategori']) ?>" method="post">
                                                                <div class="form-group">
                                                                    Nama Divisi: <input type="text" name="divisi" placeholder="Nama Divisi" class="form-control" required value="<?= $dv['divisi'] ?>"><br>
                                                                    Nama Penanggung Jawab: <select name="kode_penyelia" id="kode_penyelia" class="custom-select">
                                                                        <option value="<?= $dv['kode_penyelia'] ?>"><?= $dv['nama'] ?></option>
                                                                        <?php
                                                                        $kode_kategori = $dv['kode_kategori'];
                                                                        $sql1 = "SELECT * FROM penyelia where kode_kategori = $kode_kategori";
                                                                        $result1 = mysqli_query($con, $sql1);
                                                                        // while ($row1 = mysqli_fetch_array($result1))
                                                                        foreach ($result1 as $rows1) : ?>
                                                                            <option value="<?= $rows1['kode_penyelia'] ?>"><?= $rows1['nama'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">

                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="addjob">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a type="button" id="btn-hapus" href="<?= base_url('dashboard/deletedivisi/' . $dv['kode_kategori']) ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash" style="font-size:15px;"></i> <span style="font-size:15px;">Hapus</span></a>&ensp;
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
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->