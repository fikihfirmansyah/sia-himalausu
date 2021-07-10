<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($keu_pengurus as $row) { ?>
<!-- START Modal Hapus Pengurus -->
<div class="modal fade" id="hapuspengurus_<?php echo $row->nim; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Pengurus</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Anggota Pengurus ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>pengurus/daftarpengurus/hapuspengurus_aksi/?nim=<?php echo $row->nim;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Pengurus -->
<?php } ?>
