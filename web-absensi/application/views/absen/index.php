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
                                    <th>Nira</th>
                                    <th>Nama</th>
                                    <th>Tim</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($absen as $a) { ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $a['nira']; ?></td>
                                        <td><?= $a['nama']; ?></td>
                                        <td><?= $a['tim']; ?></td>
                                        <td><?= $a['jenis_absen']; ?></td>
                                        <td><?= $a['waktu']; ?></td>

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