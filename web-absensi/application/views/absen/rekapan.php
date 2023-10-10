<?php foreach ($rekapan as $a) {
    $s = $a['shift'];
    $r = explode(',', $s);


    break;
} ?>
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
                                    <?php for ($j = 0; $j < count($r); $j++) { ?>
                                        <th><?= $j + 1; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($rekapan as $a) { ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $a['nira']; ?></td>
                                        <td><?= $a['nama']; ?></td>
                                        <?php
                                        $jadwal = $a['shift'];
                                        $r_jadwal = explode(',', $jadwal);
                                        $r1 = count($r_jadwal) - 1;
                                        for ($j = 0; $j < count($r); $j++) {
                                            if ($r1 < $j) {
                                        ?>
                                                <td></td>
                                            <?php } else { ?>

                                                <td><?= $r_jadwal[$j]; ?></td>
                                            <?php } ?>
                                        <?php } ?>
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