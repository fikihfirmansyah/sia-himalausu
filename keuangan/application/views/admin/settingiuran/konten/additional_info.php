<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if(isset($_GET['info'])) {?>
<!-- START informasi -->
  <div class="box">
	<div class="box-header with-border">
	  <i class="fa fa-info-circle"></i> <?php echo $_GET['info']; ?>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
  </div>
<!-- END informasi -->
<?php } ?>

<?php if ($keu_setting == NULL){?>
  <!-- START informasi -->
    <div class="box">
  	<div class="box-header with-border">
  	  <i class="fa fa-info-circle"></i> Tidak ada tahun kepengurusan yang aktif
  	  <div class="box-tools pull-right">
  		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  	  </div>
  	</div>
    </div>
  <!-- END informasi -->
<?php } ?>
