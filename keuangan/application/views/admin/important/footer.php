<footer class="main-footer">
<div class="span12 well well-sm">
		<h6>&copy; 2016-<?php echo date("Y");?> | 
 Waktu Eksekusi : {elapsed_time}, Penggunaan Memori : {memory_usage}</h6>
	  </div>
</footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->


<script src="<?php echo base_url('assets/template/back')?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets/template/back')?>/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
