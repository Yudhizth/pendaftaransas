<?php
    if(isset($_POST['sendMsg'])){

      $tgl = date('Y-m-d H:m:s');
        $kd = $_POST['txt_kodePush'];
        $dari = $_POST['txt_kepada'];
        $msg = $_POST['txt_pesan'];
        $judul = $_POST['txt_subject'];
        

        $sql = "INSERT INTO tb_compos (id_reff, judul, isi, create_date, last_seed, admin) VALUES (:a, :b, :c, :tgl, :d, :e)";
        $st = $auth_user->runQuery($sql);
        $st->execute(array(
            ':a' => $kd,
            ':b'   => $judul,
            ':c'     => $msg,
            ':tgl'  => $tgl,
            ':d'    => $tgl,
            ':e'  => $dari
        ));

        if(!st){
            echo "data tidak masuk db";
        }else{

          $sql = "UPDATE tb_compos SET status = :status WHERE kode_compos = :kode";
          $stmt = $auth_user->runQuery($sql);
          $stmt->execute(array(
              ':status'  => '2',
              ':kode' => $kd
          ));

            echo "<script>
            alert('Pesan Berhasil Dikirim!');
            window.location.href='?p=pesan';
            </script>";
        }

    }
    $id = $_GET['data'];
    $query = "SELECT * FROM tb_compos WHERE kode_compos = :kode";
    $stmt = $auth_user->runQuery($query);
    $stmt->execute(array(
        ':kode' => $id
    ));
    $row = $stmt->fetch(PDO::FETCH_LAZY);
?>
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-primary">
    <div class="panel-body">
    <form class="form-horizontal" method="post" action="">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Kepada :</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" placeholder="<?=$row['admin']?> Admin" readonly>
      <input type="hidden" class="form-control" name="txt_kodePush" id="d" value="<?=$row['kode_compos']?>" >
      <input type="hidden" class="form-control" name="txt_kepada" id="s" value="<?=$user_id?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Subject :</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" name="txt_subject" placeholder="<?=$row['judul']?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pesan">Pesan :</label>
    <div class="col-sm-10"> 
    <textarea class="form-control" rows="5" name="txt_pesan" id="pesanPush" placeholder="isi pesan" required></textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="sendMsg" class="btn btn-default">.:Reply:.</button>
    </div>
  </div>
</form>
    </div>
</div>
</div>