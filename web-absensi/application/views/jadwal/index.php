<div class="container" style="margin-top: 2%;">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800 text-center"><?= $title; ?></h1>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 sm-2">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center text-white bg-gradient-primary">
                                    <th>No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Nira</th>
                                    <th>Nama</th>
                                    <th>Shift</th>
                                    <th>Tim</th>
                                    <!-- <th>Hari</th> -->
                                    <th>Tanggal</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jadwal as $j) { ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td><?= $j['nama_ruangan']; ?></td>
                                    <td><?= $j['nira']; ?></td>
                                    <td><?= $j['nama']; ?></td>
                                    <td><?= $j['shift']; ?></td>
                                    <td><?= $j['tim']; ?></td>
                                    <td><?= $j['hari']; ?>,<?= $j['tanggal']; ?></td>
                                    <td><?= $j['status'];?></td>

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