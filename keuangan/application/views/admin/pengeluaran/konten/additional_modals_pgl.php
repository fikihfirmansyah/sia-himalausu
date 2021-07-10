<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($keu_pengeluaran_lainnya as $row) { ?>
<!-- FILE MODALS -->
<!-- START Modal Hapus Pengeluaran -->
<div class="modal fade" id="hapuspengeluaran_<?php echo $row->id_peng_lainnya; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Pengeluaran</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Pengeluaran ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>pengeluaran/lainnya/hapuspengeluaran_aksi/?id=<?php echo $row->id_peng_lainnya;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Surat -->
<?php } ?>
