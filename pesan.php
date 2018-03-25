<?php 
$sql = "SELECT tb_compos.id, tb_compos.kode_compos, tb_compos.id_reff, tb_compos.no_ktp, tb_compos.judul,
            tb_compos.isi, tb_compos.create_date, tb_compos.admin, tb_compos.status, tb_karyawan.nama_depan, tb_karyawan.nama_belakang
            FROM tb_compos 
            INNER JOIN tb_karyawan ON tb_karyawan.no_ktp = tb_compos.no_ktp
            WHERE tb_compos.kode_compos !='' AND tb_compos.no_ktp = :ktp ORDER BY tb_compos.create_date DESC";
$stmt = $auth_user->runQuery($sql);
$stmt->execute(array(
    ':ktp'   => $user_id
));
?>
<br/>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="list-group">
<a href="#" class="list-group-item active">
  Message <span class="pull-right"><span class="fa fa-fw fa-envelope"></span></span>
</a>
<?php 

    if($stmt->rowCount() > 0){
    while ($row = $stmt->fetch(PDO::FETCH_LAZY)){

        $tgl = date('d/m/Y H:m:s', strtotime($row['create_date']));

        if(empty($row['status'])){
            $status = "Unread";
        }else{
            $status = "Read";
        }
        
?>
<a href="?p=detailPesan&kode=<?php echo $row['kode_compos']; ?>" class="list-group-item list-group-item-action"><?php echo $row['judul']; ?> <b><i><?=$status;?></i></b> <span class="pull-right"><?=$tgl?></span></a>
    <?php } }else{ echo "<a href='' class='list-group-item list-group-item-action'>Belum Ada Pesan!</a>"; } ?>
</div>
</div>
<!-- <div class="col-md-8">
    <div class="well">
        <h4 class="page-header">Subject Pesan</h4>
    </div>
</div> -->
</div>