<div class="mahadashboard">
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-1 pb-1">
            <h1 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3" style="color: #444444; font-weight:500;">Penilaian Magang</span></h1>
        </div>
        <div class="row px-xl-5 pb-3">
            <a class="btn btn-info" href="<?= base_url('home/absen') ?>"><i class="fas fa-solid fa-print"></i> Cetak Nilai </a>
        </div>
        <div class="row px-xl-5 pb-3">
            <div class="col-xl-12 card mb-4 bg-light">
                <div class="card-header bg-light">
                    <i class="fas fa-graduation-cap me-1"></i>
                    Data Nilai Magang
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datanilai" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Nilai Disiplin</th>
                                    <th>Nilai Tanggung Jawab</th>
                                    <th>Nilai Praktek</th>
                                    <th>Rata-Rata</th>
                                    <th>Grade</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($nilai as $nilai) : ?>
                                    <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-center"><?= $nilai['tanggal_penilaian'] ?></td>
                                        <td class="text-center"><?= $nilai['nilai_disiplin'] ?></td>
                                        <td class="text-center"><?= $nilai['nilai_tanggungjawab'] ?></td>
                                        <td class="text-center"><?= $nilai['nilai_praktek'] ?></td>
                                        <td class="text-center"><?= $nilai['nilai_rata'] ?></td>
                                        <td class="text-center"><?= $nilai['grade'] ?></td>
                                        <!-- <td class="text-center"><b>
                                                <a type="button" class="badge badge-success" href="" data-toggle="modal" data-target="#editnilaiModal<?= $nilai['nilai_id']; ?>"><span style="font-size: 15px;"><i class="fa-solid fa-pen-to-square"></i> Edit</span></a>
                                            </b></td> -->
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editnilaiModal<?= $nilai['nilai_id']; ?>" tabindex="-1" aria-labelledby="editnilaiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editnilaiModalLabel">Edit Nilai Mahasiswa</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('penyelia/editnilai/') . $nilai['nilai_id'] ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label for="tanggal_penilaian" class="col-sm-5 col-form-label">Tanggal Penilaian</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" id="tanggal_penilaian" name="tanggal_penilaian" value="<?= $nilai['tanggal_penilaian'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="disiplin" class="col-sm-5 col-form-label">Nilai Kedisiplinan</label>
                                                            <div class="col-sm-5">
                                                                <input type="number" class="form-control" id="disiplinedit" name="disiplinedit" value="<?= $nilai['nilai_disiplin'] ?>" onchange="totaledit()" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="tanggung" class="col-sm-5 col-form-label">Nilai Tanggung Jawab</label>
                                                            <div class="col-sm-5">
                                                                <input type="number" class="form-control" id="tanggungedit" name="tanggungedit" value="<?= $nilai['nilai_tanggungjawab'] ?>" onchange="totaledit()" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="praktek" class="col-sm-5 col-form-label">Nilai Praktek</label>
                                                            <div class="col-sm-5">
                                                                <input type="number" class="form-control" id="praktekedit" name="praktekedit" value="<?= $nilai['nilai_praktek'] ?>" onchange="totaledit()" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="rata" class="col-sm-5 col-form-label">Nilai Rata-Rata</label>
                                                            <div class="col-sm-5">
                                                                <input type="number" class="form-control" id="rataedit" name="rataedit" value="<?= $nilai['nilai_rata'] ?>" readonly required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="grade" class="col-sm-5 col-form-label">Grade</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control" id="gradeedit" name="gradeedit" value="<?= $nilai['grade'] ?>" readonly required>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="kode_magang" value="<?= $kode_magang ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products End -->
        <script>
            $(document).ready(function() {
                $('#dataabsen').DataTable({
                    "pageLength": 10,
                    order: [
                        [0, 'desc']
                    ]
                });
            });
        </script>