<div class="container" style="margin-top: 2%;">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800 text-center"><?= $title; ?></h1>
            <!-- /.card-header -->
            <?= $this->session->flashdata('pesan'); ?>

            <div class="card-body">
                <div class="row">
                    <div class="col-12 sm-2">
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahModal">
                            <i class="fa fa-plus" class="text-bold"></i>Tambah Data</button>
                        </button>
                        <hr>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center text-white bg-gradient-primary">
                                    <th>No</th>
                                    <th>Nira</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($perawat as $p) { ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td><?= $p['nira']; ?></td>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['jabatan']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td> <button class="btn btn-danger mb-0" data-toggle="modal"
                                            data-target="#modalHapusPegawai<?= $p['nira']; ?>">
                                            <i class="fa fa-trash" class="text-bold"></i></button>
                                        <button class="btn btn-primary mb-0" data-toggle="modal"
                                            data-target="#editPegawai<?= $p['nira']; ?>">
                                            <i class="fa fa-edit" class="text-bold"></i></button>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-bold" id="exampleModalLabel">TAMBAH DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url() . 'jadwal/tambah_perawat'; ?>">
                    <div class="form-group">
                        <label>Nira</label>
                        <input type="text" id="nira" name="nira" value="<?php echo set_value('nira'); ?>"
                            class="form-control" required
                            oninvalid="this.setCustomValidity('Nira wajib di isi dan tidak bisa sama')"
                            oninput="setCustomValidity('')">

                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required
                            oninvalid="this.setCustomValidity('Nama wajib di isi')" oninput="setCustomValidity('')">

                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control" required
                            oninvalid="this.setCustomValidity('jabatan wajib di pilih')"
                            oninput="setCustomValidity('')">
                            <option value="">Pilih</option>
                            <option value="perawat">Perawat</option>
                            <option value="kepala ruang">Kepala ruang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required
                            oninvalid="this.setCustomValidity('alamat wajib di isi')" oninput="setCustomValidity('')">
                    </div>
                    <div class="row mt-5">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn"
                            style="background-color: Green; margin-left: 10px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($perawat as $p) : ?>
<div class="modal fade" id="modalHapusPegawai<?= $p['nira']; ?>" tabindex="-1" aria-labelledby="mxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Hapus Data Anggota Tim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url() . 'jadwal/hapus_perawat/' . $p['nira']; ?>">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- editmodal -->
<?php
foreach ($perawat as $p) : ?>
<div class="modal fade" id="editPegawai<?= $p['nira']; ?>" tabindex="-1" aria-labelledby="mxModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">ubah pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('jadwal/update_perawat/') . $p['nira']; ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nira</label>
                        <input type="hidden" name="nira" class="form-control" value="<?php echo $p['nira'] ?>">
                        <input type="text" name="idnurs" class="form-control" value="<?php echo $p['nira'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $p['nama'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" id="jabatan" class="select form-control">
                            <?php foreach ($jabatan as $j) { ?>
                            <option value="<?= $j->nira; ?>"><?= $j->jabatan; ?></option>
                            <?php } ?>
                            <option value="<?= $p['nira']; ?>"><?= $p['jabatan']; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?php echo $p['alamat'] ?>">
                    </div>

                    <button type="close" class="btn btn-danger">Keluar</button>
                    <button type="submit" class="btn text-white" style="background-color: green;">Simpan</button>

                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php endforeach; ?>