<html>
<head>
	<title>Iuran HIMALA USU </title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/image/1024.png" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/signin.css') ?>" media="screen, projector">-->
	<script type='text/javascript'>
			function validasi(form)
			{
				if (form.nim.value == "")
				{
					alert("Anda belum mengisi NIM!");
					form.nim.focus();
					return (false);
				}

				return (true);
			}
	</script>
	<style>
					@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
					footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  text-align: center;
  font-size="10px"
}
		body {
			font-family: 'Poppins', sans-serif;
		}
		br {
  content: "";
  margin: 2em;
  display: block;
  font-size: 24%;
}
		#table {
  border-collapse: separate;
  border-spacing: 15px;
}

#hasil {
	
  border-collapse: separate;
  border-spacing: 5px 10px;
  border-style: dotted;
  border-width:2px
}

	</style>
</head>


<body class="text-center" >
<main class="form-signin">
<form method="POST" action="<?php echo base_url(); ?>utama"onSubmit='return validasi(this)'> 
<br>
    <img class="mb-4" src="assets/image/1024.png" alt="" width="72">
    <h3 class="h3 mb-3 fw-normal"><b>Selamat Datang</b></h3><br><h6>Silahkan Masukkan NIM Untuk Cek Iuran</h6>
    <label for="inputEmail" class="visually-hidden">NIM</label>
    <input type="text" name="nim" class="form-control" placeholder="NIM" ><br>
	<input type="submit" value="Cek" name="Cek" class="btn btn-primary">
  </form>
  
<center>
	<!-- <div id="load">Loading...</div> -->
				 <?php
				 if(isset($data_pengurus)){
					 if($data_pengurus!= NULL){
				 include 'function.php';
				 foreach ($data_pengurus as $row) {

					 if($row->nama_departemen == NULL){
						 $keu_departemen = '-';
					 }
					 else {
					 	$keu_departemen = $row->nama_departemen;
					 }

						echo "
							<table id='tables' align='center'>
							<tr>
								<td>NIM</td>
								<td>:</td>
								<td> $row->nim </td>
							</tr>
							<tr>
								<td>Nama</td>
								<td>:</td>
								<td> $row->nama </td>
							</tr>
							<tr>
								<td>Amanah</td>
								<td>:</td>
								<td> $row->nama_amanah</td>
							</tr>
							<tr>
								<td>Departemen</td>
								<td>:</td>
								<td> $keu_departemen </td>
							</tr>
							</table>
							";
							}

							?>
							<br>
							<div id='riwayat'><b>Riwayat Pembayaran</b></div>

							<table id='hasil' border='1'>


							<tr align='center'>
							<td><b> No. </b></td>
							<td><b> Tanggal </b></td>
							<td><b> Besar Iuran </b></td>
							</tr>

							<?php $no=1; ?>
							<?php foreach ($riwayat_iuran as $row) {?>
							<?php  if($row->jumlah!=NULL){?>

									<tr align='center'>
									<td> <?php echo $no; ?> </td>
									<td> <?php echo  tgl_indo($row->tanggal); ?></td>
									<td> <?php echo  rupiah($row->jumlah); ?></td></tr>

									<?php $no++; }}?>
							</table>

<?php 	foreach ($iuranpengurus as $row) { ?>
	  <?php
	    $jumlah = $row->jumlah;
	    $tgl_now = date("Y-m-d");
	    foreach ($keu_setting as $r) {
	    $keu_iuran_pengurus = $r->keu_iuran_pengurus;
	    $tgl_awal = $r->tanggal_awal;
	    // Menambah bulan ini + semua bulan pada tahun sebelumnya
	    $numBulan = 1 + (date("Y",strtotime($tgl_now))-date("Y",strtotime($tgl_awal)))*12;
	    // menghitung selisih bulan
	    $numBulan += date("m",strtotime($tgl_now))-date("m",strtotime($tgl_awal));
			$harusbayar = $keu_iuran_pengurus*$numBulan;
			if ($keu_iuran_pengurus > 0){
				$bulan_yg_lunas = $jumlah / $keu_iuran_pengurus;
			}
			else {
				$bulan_yg_lunas = $numBulan;
			}
	    $jumlah_lunas = $jumlah - $harusbayar;
			if($jumlah_lunas>=0){
				$lunas = '-';
			}
			else{
				$lunas = rupiah($jumlah_lunas* -1);
			}
			$bulan_udah = $bulan_yg_lunas - 1;

	    if($jumlah >= $keu_iuran_pengurus){
	    $tgllunas = date('Y-m-d',strtotime('+'.$bulan_udah.'months',strtotime($tgl_awal)));
			$tglbelum = date('Y-m-d', strtotime("last day of next month",strtotime($tgllunas)));
	    }
			else{
				$tgllunas = "-";
			}

			echo "<table id='iuran'><tr><td><br></td></tr>";
			echo "<tr><td>Besar iuran yang harus dibayar</td><td> :</td><td> " . rupiah($harusbayar) ."</td</tr>";
			echo "<tr><td>Besar iuran yang sudah dibayar</td><td> :</td><td> " . rupiah($jumlah) ."</td</tr>";
			echo "<tr><td>Besar iuran yang belum dibayar</td><td> :</td><td> " . $lunas ."</td></tr>";
			echo "</table>";
		}

							echo "<table><tr><td colspan='3'> ";
							if($jumlah_lunas >= 0)
								echo "<marquee><br><b>Anda Sudah Melunasi Iuran. Syukron, ya Jazakallahu Khair";
							else if($jumlah_lunas < 0){
								if($tgllunas != '-'){
									if($tgllunas == $tgl_awal){
										echo "<marquee><br><b>Anda Sudah Melunasi Iuran Bulan ".bulan($tgllunas).". Segera Lunasi Iuran Bulan ".bulan($tglbelum);
										if(bulan($tglbelum) != bulan(date('Y-m-d'))){
											echo " - ".bulan(date('Y-m-d'));
										}
									}
									else {
										echo "<marquee><br><b>Anda Sudah Melunasi Iuran Bulan ".bulan($tgl_awal)." - ".bulan($tgllunas).". Segera Lunasi Iuran Bulan ".bulan($tglbelum);
										if(bulan($tglbelum) != bulan(date('Y-m-d'))){
											echo " - ".bulan(date('Y-m-d'));
										}
									}
								}
								else{
									echo "<div align='center' id='error'><br><br><b>Maaf, akhi/ukhti belum pernah sekalipun membayar iuran keu_pengurus. <br>Mohon dibayar secepatnya ya :)</b></div>";
								}
							}
							echo "</b></marquee><br><br></td></tr></table>";
							}
						}
						else{
							echo "<br><br><b>Maaf, Tidak ada Pengurus HIMALA USU yang memiliki NIM '$nim'. Silahkan masukkan NIM kembali.</b>";
						}
					}
					?>
			</div>
		</div>
	</div>
	</main>

	<footer>
	<input style="font-size:10px" type="button" class="button_active" value="Login Admin" onclick="location.href='apps';" />

<br>
	<div class="span12 well well-sm">
		<h6 style="font-size:10px">&copy; 2016-<?php echo date("Y");?> | 
 Waktu Eksekusi : {elapsed_time}, Penggunaan Memori : {memory_usage}</h6>
	  </div>
	</div>
</div>
</center>
</footer>
</body>

<script>
// $(document).ready(function(){
//     $("#load").fadeOut(500);
// });
</script>
</html>
