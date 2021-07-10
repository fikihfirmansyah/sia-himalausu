<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<?php

	$this->load->view("admin/important/assets",$namaweb);
	$this->load->view("admin/important/header");
	include "konten/setting_iuran_konten.php";
	$this->load->view("admin/important/footer");

?>

</div>

</body>
</html>
