<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($thnkepengurusan as $row) { ?>
<!-- START Modal Hapus Donatur -->
<div class="modal fade" id="hapusthnkepengurusan_<?php echo $row->id_thnkepengurusan; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Tahun Kepengurusan</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Tahun Kepengurusan ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>kepengurusan/thnkepengurusan/hapus_aksi/?id=<?php echo $row->id_thnkepengurusan;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Donatur -->
<?php } ?>
