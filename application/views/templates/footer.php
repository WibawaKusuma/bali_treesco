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
<!-- DataTables -->
<script src="<?= base_url('assets/template') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/template') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/template') ?>/dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>