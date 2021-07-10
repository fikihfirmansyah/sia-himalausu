<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "assets.php";
?>
<body class="hold-transition login-page" style="  background: url(../assets/image/tiny_grid.png);')">


<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">
    <form method="POST" id="FormLogin" action="<?php echo base_url(); ?>apps/loginvalidate">
			<center><img src="<?php echo base_url(); ?>assets/image/<?php echo $logo; ?>" width="100px"/>
      <b><h2 style="font-weight:700"><?php echo $namaweb; ?></h2><br></b>

			</center>
			 <p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>
			<?php if(isset($_GET['info'])) {?>
				<div class="alert alert-info"><?php echo $_GET['info']; ?></div>
			<?php } ?>
			<?php
        echo (isset($_GET['pesan']))? "<div class='alert alert-danger'>".$_GET['pesan']."</div>" : "";
      ?>
      <div class="form-group has-feedback">
        <input type="text" name ="nim" id="nim" class="form-control" placeholder="NIM">
        <span class="glyphicon glyphicon-one_admin form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" class="form-control" name="pass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
					<div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

<script src="<?php echo base_url('assets/template/back/bower_components') ?>/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('assets/template/back/bower_components') ?>/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/template/back/plugins') ?>/iCheck/icheck.min.js"></script>
<script>

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
