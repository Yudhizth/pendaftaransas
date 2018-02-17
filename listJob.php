<table class="table table-hover">
	<thead>
		<th>#</th>
		<th>Nama Perusahaan</th>
		<th>Keterangan</th>
		<th>Action</th>
	</thead>
	<tbody>
	<?php 

		$sql = "SELECT tb_list_karyawan.kode_list_karyawan, tb_list_karyawan.no_nip, tb_list_karyawan.kode_pekerjaan, tb_list_karyawan.status_karyawan, tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.kode_perusahaan, tb_perusahaan.nama_perusahaan, tb_perusahaan.bidang_perusahaan, tb_temporary_perusahaan.kebutuhan, tb_kategori_pekerjaan.nama_kategori
FROM tb_list_karyawan INNER JOIN tb_kerjasama_perusahan ON tb_kerjasama_perusahan.kode_list_karyawan = tb_list_karyawan.kode_list_karyawan
INNER JOIN tb_perusahaan ON tb_perusahaan.kode_perusahaan = tb_kerjasama_perusahan.kode_perusahaan
INNER JOIN tb_temporary_perusahaan ON tb_temporary_perusahaan.no_pendaftaran = tb_kerjasama_perusahan.kode_request
LEFT JOIN tb_kategori_pekerjaan ON tb_kategori_pekerjaan.kode_kategori = tb_temporary_perusahaan.kebutuhan WHERE tb_list_karyawan.no_nip = :nomor AND tb_list_karyawan.status_karyawan = '2'";
		$stmt = $auth_user->runQuery($sql);
		$stmt->execute(array(
			':nomor'	=> $user_id));

		if ($stmt->rowCount() == 0) {
			# code...
			echo "<tr>
			<td colspan='4'>Data belum ada.</td>
			</tr>";
		}else{
			$i = 0;
			while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
				# code...
				$i++;
//			if ($row['start_at'] == '') {
//				# code...
//				$label = "Start";
//				$btn = "btn btn-xs btn-primary";
//				$icon = "glyphicon glyphicon-play-circle";
//			}elseif (empty($row['finish_at'])) {
//				# code...
//				$label = "Finish";
//				$btn = "btn btn-xs btn-danger";
//				$icon = "glyphicon glyphicon-ok";
//			}else{
//				$label = "Done";
//				$btn = "btn btn-xs btn-success";
//				$icon = "glyphicon glyphicon-ok";
//			}
	?>
		<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row['nama_perusahaan']; ?> (<?=$row['bidang_perusahaan']?>)</td>
		<td><?php echo $row['nama_kategori']; ?></td>
		<td>
			<a href="?p=detail&kode=<?php echo $row['nomor_kontrak']; ?>">
				<button class="btn btn-sm btn-primary">
					Views <span class="glyphicon glyphicon-chevron-right"></span>
				</button>
			</a>
		</td>
		</tr>
		<?php }}?>
	</tbody>
</table>