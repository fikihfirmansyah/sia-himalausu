<?php foreach ($keu_departemen as $row) { ?>
  <!-- FILE MODALS -->
<!-- START Modal Hapus Departemen -->
<div class="modal fade" id="hapusdepartemen_<?php echo $row->id_departemen; ?>">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Hapus Departemen</h4>
	  </div>
	  <div class="modal-body">
		<p>Anda ingin menghapus Departemen ini?<br>Tindakan ini tidak dapat dibatalkan!</p>
		<a href="<?php echo base_url(); ?>departemen/daftardepartemen/hapusdepartemen_aksi/?id=<?php echo $row->id_departemen;?>" class="btn btn-block btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
		<button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Hapus Departemen -->
<?php } ?>
