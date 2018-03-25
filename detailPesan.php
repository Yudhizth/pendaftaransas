<?php
$data = $_GET['kode'];
$date = date('Y-m-d H:m:s');
    $query = "SELECT tb_compos.id, tb_compos.kode_compos, tb_compos.id_reff, tb_compos.no_ktp, tb_compos.judul,
            tb_compos.isi, tb_compos.create_date, tb_compos.admin, tb_compos.status, tb_karyawan.nama_depan, tb_karyawan.nama_belakang
            FROM tb_compos 
            INNER JOIN tb_karyawan ON tb_karyawan.no_ktp = tb_compos.no_ktp
            WHERE tb_compos.kode_compos = :kode ";
    $dt = $auth_user->runQuery($query);
    $dt->execute(array(
        ':kode' => $data
    ));

    $row = $dt->fetch(PDO::FETCH_LAZY);

    //show list
    $dd = "SELECT tb_compos.id, tb_compos.kode_compos, tb_compos.id_reff, tb_compos.no_ktp, tb_compos.judul,
            tb_compos.isi, tb_compos.create_date, tb_compos.admin, tb_compos.status, tb_karyawan.nama_depan, tb_karyawan.nama_belakang
            FROM tb_compos 
            LEFT JOIN tb_karyawan ON tb_karyawan.no_ktp = tb_compos.no_ktp
            WHERE tb_compos.id_reff = :id ";
    $listData = $auth_user->runQuery($dd);
    $listData->execute(array(
        ':id' => $row['kode_compos']
    ));

    
    $sql = "UPDATE tb_compos SET status = :status WHERE kode_compos = :kode";
    $stmt = $auth_user->runQuery($sql);
    $stmt->execute(array(
        ':status'  => '1',
        ':kode' => $data
    ));
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
               <?=$row['nama_subject'];?> 
            </div>
            <div class="panel-body">
            <?php 
                    if($row['inisial'] == $user_id){
                        $kode = 'class="blockquote-reverse"';
                    }else{
                        $kode = '';
                    }
            ?>
            <blockquote <?=$kode?> style="">
                <p><?=$row['isi'];?></p>
                <small><?=$row['admin'];?></small>
                <i style="margin-bottom: 2px; border-bottom: 1px solid #ebebeb;"><small><?=$row['create_date'];?></small></i>
            </blockquote>

            <?php while ($col = $listData->fetch(PDO::FETCH_LAZY)) {
                # code...
                if($col['admin'] == $row['no_ktp']){
                    $status = 'class="blockquote-reverse"';
                    $user = $row['nama_depan'] . ' ' .$row['nama_belakang'];
                }else{
                    $status = "";
                    $user = $col['admin'];
                }
            ?>
            <blockquote <?=$status?> >
              <p><?=$col['isi']?></p>
              <footer><?=$user?>
                  <br> <?=$col['create_date']?>
              </footer>
            </blockquote>

            <?php } ?>

            </div>
            <div class="panel-footer">
            <b><i><a href="?p=reply&data=<?=$data?>">Reply</a></i></b>
            </div>
        </div>
    </div>
</div>