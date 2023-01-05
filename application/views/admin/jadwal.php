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
        </div>
        <div class="card shadow mb-4 col-xl-12 col-md-6 mb-6">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datamenu" id="datajadwal" width="100%" cellspacing="0">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Pulang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($jadwal as $jd) : ?>
                                <tr>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td class="text-center"><b><?= $jd['masuk']; ?></b></td>
                                    <td class="text-center"><b><?= $jd['pulang']; ?></b></td>
                                    <td class="text-center">
                                        <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editmenuModal<?= $jd['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>&ensp;
                                        <!-- Modal Edit Menu-->
                                        <div class="modal fade" id="editmenuModal<?= $jd['id'] ?>" tabindex="-1" aria-labelledby="editmenuModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editmenuModalLabel">Edit Jadwal Baru</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('dashboard/editjadwal/' . $jd['id'])  ?>" method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Jadwal Masuk</label>
                                                                    <input type="time" class="form-control" name="masuk" placeholder="Jadwal Masuk">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Jadwal Pulang</label>
                                                                    <input type="time" class="form-control" name="pulang" placeholder="Last name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
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