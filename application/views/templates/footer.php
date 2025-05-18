<style>
    .footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
    }

    .footer a {
        color: #f8f9fa;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }
</style>

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer text-right">
    <strong>Copyright &copy; 2024 <a href="#"> po.SYSTEM</a>.</strong> All rights
    reserved.
</footer> -->
<footer class="footer mt-auto py-3 bg-dark text-white">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <p class="mb-0">&copy; <?= date('Y') ?> <strong>po.SYSTEM</strong>. All rights reserved.</p>
        <ul class="list-inline mb-0">
            <li class="list-inline-item"><a class="text-white text-decoration-none" href="#">Privacy</a></li>
            <li class="list-inline-item"><a class="text-white text-decoration-none" href="#">Terms</a></li>
            <li class="list-inline-item"><a class="text-white text-decoration-none" href="#">Contact</a></li>
        </ul>
    </div>
</footer>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/template') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/template') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/template') ?>/dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function() {
        // Inisialisasi DataTable untuk tabel lain selain example1
        // (example1 diinisialisasi di halaman masing-masing)
        if ($('#example2').length) {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        }
    });
</script>
</body>

</html>