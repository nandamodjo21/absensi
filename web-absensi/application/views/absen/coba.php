<div class="container" style="margin-top: 2%;">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800 text-center"><?= $title; ?></h1>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 sm-2">

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tukarModal">
                    INPUT JADWAL
                </button>
                <hr>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center text-white bg-gradient-primary">
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Nira</th>
                            <th>Nama</th>
                            <th>Shift</th>
                            <th>Tim</th>
                            <th>Tanggal</th>
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
                                <td><?= $j['waktu']; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- End of Page Wrapper -->


<!-- tukar modal  -->
<div class="modal fade" id="tukarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH JADWAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('absen/tambah_jadwal'); ?>" method="POST">
                    <div class="form-group">
                        <label>TIM</label>
                        <select name="tim" id="tim" class="select form-control">
                            <option value="">--pilih--</option>
                            <?php foreach ($tim as $p) { ?>
                                <option value="<?= $p->kode_tim; ?>"><?= $p->tim; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SHIFT</label>
                        <select name="sip" id="sip" class="select form-control">
                            <option value="">--pilih--</option>
                            <?php foreach ($shift as $s) { ?>
                                <option value="<?= $s->kode_shift; ?>"><?= $s->shift; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ruangan</label>
                        <select name="ruangan" id="ruangan" class="select form-control">
                            <option value="">--pilih--</option>
                            <?php foreach ($ruangan as $r) { ?>
                                <option value="<?= $r->kode_ruangan; ?>"><?= $r->nama_ruangan; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            TUKAR
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Logout Modal -->

<!-- <script>
    $('#perawat2').hide();
    $('#tgl').hide();
    $('#shift').hide();
    $('#btn1').hide();
    $(document).ready(function() {
        $('#perawat').change(function() {
            $('#tgl').show();

            var id_nama = $('#perawat').val();


            console.log(id_nama);
            $.ajax({
                url: 'cek',
                method: 'POST',
                type: 'ajax',
                data: {
                    idnama: id_nama
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#tanggal').empty();
                    $('#tanggal').append('<option value="">--pilih--</option>');
                    for (var i = 0; i < response.length; i++) {
                        console.log(response[i].tanggal);
                        var tag = response[i];
                        $('#tanggal').append('<option value=' + tag.tanggal + '>' + tag.tanggal + ' - ' + tag.shift + '</option>');
                    }
                }
            });
            $('#tanggal').change(function() {
                $('#perawat2').show();
                var id_tgl = $('#tanggal').val();
                var nira1 = $('#perawat').val();
                console.log(nira1);
                $.ajax({
                    url: 'shift',
                    method: 'POST',
                    type: 'ajax',
                    data: {
                        idtgl: id_tgl
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#pegawai2').empty();
                        $('#pegawai2').append('<option value="">--pilih--</option>');
                        for (var i = 0; i < response.length; i++) {
                            // console.log(response[i].tanggal);
                            var aua = response[i];
                            $('#pegawai2').append('<option value=' + aua.nira + '>' + aua.nama + '</option>');
                        }
                    }
                });

            });
            $('#pegawai2').change(function() {
                $('#shift').show();
                var id_tgl = $('#tanggal').val();
                var nira1 = $('#perawat').val();
                var nira2 = $('#pegawai2').val();
                console.log(nira1);
                $.ajax({
                    url: 'data_shift',
                    method: 'POST',
                    type: 'ajax',
                    data: {
                        idtgl: id_tgl,
                        idnira1: nira1,
                        idnira2: nira2
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);
                        $('#shift2').empty();
                        $('#shift2').append('<option value="">--pilih--</option>');
                        for (var i = 0; i < response.length; i++) {
                            // console.log(response[i].tanggal);
                            var aua = response[i];
                            $('#shift2').append('<option value=' + aua.tanggal + '>' + aua.tanggal + ' - ' + aua.shift + '</option>');
                        }
                    }
                });

            });
            $('#shift2').change(function() {
                $('#btn1').show();
            })
        });
    });
</script> -->