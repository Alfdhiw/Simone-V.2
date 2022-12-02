<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px; font-weight:500;"><?= $title ?></h1>
        <?php
        if ($rownilai['sertifikat'] != null) {
            echo '<a href="' . base_url('penyelia/invoice/' . $kode_magang) . '" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>';
        } else {
            echo '<a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#konfrModal"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>';
        }
        ?>
        <!-- Modal konfirmasi-->
        <div class="modal fade" id="konfrModal" tabindex="-1" aria-labelledby="konfrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="konfrModalLabel">Perhatian!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Penyelia Belum Mencantumkan Sertifikat !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
        </div>
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Nilai Mahasiswa</h6>
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
                                        <td class="text-center"><b><?= $nilai['tanggal_penilaian'] ?></b></td>
                                        <td class="text-center"><b><?= $nilai['nilai_disiplin'] ?></b></td>
                                        <td class="text-center"><b><?= $nilai['nilai_tanggungjawab'] ?></b></td>
                                        <td class="text-center"><b><?= $nilai['nilai_praktek'] ?></b></td>
                                        <td class="text-center"><b><?= $nilai['nilai_rata'] ?></b></td>
                                        <td class="text-center"><b><?= $nilai['grade'] ?></b></td>
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
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script type="text/javascript">
    function total() {
        var disiplin = parseInt(document.getElementById('disiplin').value);
        var tanggung = parseInt(document.getElementById('tanggung').value);
        var praktek = parseInt(document.getElementById('praktek').value);

        var rata = (disiplin + tanggung + praktek) / 3;

        document.getElementById('rata').value = Math.trunc(rata);

        var grade = 0;

        if (rata >= 80 && rata <= 100) {
            grade = 'A';
        } else if (rata >= 60 && rata < 80) {
            grade = 'B';
        } else if (rata >= 40 && rata < 60) {
            grade = 'C';
        } else if (rata >= 20 && rata < 40) {
            grade = 'D';
        } else {
            grade = 'E';
        }

        document.getElementById('grade').value = grade;

    }
</script>
<script type="text/javascript">
    function totaledit() {
        var disiplinedit = parseInt(document.getElementById('disiplinedit').value);
        var tanggungedit = parseInt(document.getElementById('tanggungedit').value);
        var praktekedit = parseInt(document.getElementById('praktekedit').value);

        var rataedit = (disiplinedit + tanggungedit + praktekedit) / 3;

        document.getElementById('rataedit').value = Math.trunc(rataedit);

        var gradeedit = 0;

        if (rataedit >= 80 && rataedit <= 100) {
            gradeedit = 'A';
        } else if (rataedit >= 60 && rataedit < 80) {
            gradeedit = 'B';
        } else if (rataedit >= 40 && rataedit < 60) {
            gradeedit = 'C';
        } else if (rataedit >= 20 && rataedit < 40) {
            gradeedit = 'D';
        } else {
            gradeedit = 'E';
        }

        document.getElementById('gradeedit').value = gradeedit;

    }
</script>