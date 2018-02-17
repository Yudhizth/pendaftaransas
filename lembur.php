<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 05/02/2018
 * Time: 13.27
 */

$sql = "SELECT * FROM tb_lembur WHERE no_ktp = :ktp ORDER BY tanggal DESC ";
$stmt = $auth_user->runQuery($sql);
$stmt->execute(array(':ktp' => $user_id));
?>



<br>
<br>
<br>

<div id="listLembur" class="contain">
    <h3 class="title">
        History Lembur
    </h3>
    <hr>
    <button class="btn btn-sm btn-success" id="getLembur">
        <span class="glyphicon glyphicon-plus-sign"></span> form lembur
    </button>
    <br/>
    <br/>
    <table class="table table-striped table-bordered" >
        <thead>
        <tr>
            <th width="2%">#</th>
            <th width="28%">Tanggal</th>
            <th width="55%">Keterangan</th>
            <th width="15%">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($stmt->rowCount() > 0){
            $i = 1;
            while ($row = $stmt->fetch(PDO::FETCH_LAZY)){

                if($row['status'] == '1'){
                    $status = "<span class='label label-success'>Approve</span>";
                }elseif($row['status'] == '2'){
                    $status = "<span class='label label-danger'>Decline</span>";
                }else{
                    $status = "<span class='label label-default'>unset</span>";
                }
                ?>
                <tr>
                    <th scope="row"><?=$i++;?></th>
                    <td><?=$row['tanggal']?></td>
                    <td><?=$row['keterangan']?></td>
                    <td>
                        <?=$status?>
                    </td>
                </tr>

            <?php  }
        }else{ ?>
        <Tr>
            <td colspan="4">
                Belum ada riwayat lembur.
            </td>
        </Tr>
        <?php }
        ?>

        </tbody>
    </table>
</div>

<div id="formLembur">
    <div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 col-xs-12 well">
        <h4>
            Form Lembur
        </h4>
        <hr>
        <form class="form-horizontal" name="reqLembur" id="reqLembur" method="post" action="" data-parsley-validate="">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="textNama" value="<?=$userRow['nama_depan']?> <?=$userRow['nama_belakang']?>" readonly>
                    <input type="hidden" class="form-control" id="textKTP" value="<?=$user_id?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea id="txtKeterangan" class="form-control" rows="3" required placeholder="penjelasan lembur"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Ajukan</button>
                </div>
            </div>
        </form>
    </div>
</div>
