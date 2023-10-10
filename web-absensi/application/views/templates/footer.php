            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RSUD BOLIYOHUTO <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
            <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

            <script src="<?= base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script>
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});



$('.form-check-input').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: "<?= base_url('admin/changeaccess'); ?>",
        type: 'post',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
        }
    });

});
            </script>
            <script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
            </script>
            <script>
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
                    $('#tanggal').append('<option value=' + tag.tanggal + '>' + tag
                        .tanggal + ' - ' + tag.shift + '</option>');
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
                        $('#pegawai2').append('<option value=' + aua.nira + '>' +
                            aua.nama + '</option>');
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
                        $('#shift2').append('<option value=' + aua.tanggal + '>' +
                            aua.tanggal + ' - ' + aua.shift + '</option>');
                    }
                }
            });

        });
        $('#shift2').change(function() {
            $('#btn1').show();
        })
    });
});
            </script>
            </body>

            </html>