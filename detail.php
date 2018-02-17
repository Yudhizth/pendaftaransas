<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 05/02/2018
 * Time: 12.54
 */
$nomorKontrak = $_GET['kode'];

    $sql = "SELECT tb_kerjasama_perusahan.nomor_kontrak, tb_kerjasama_perusahan.kode_request, tb_job.kode_detail_job, tb_job.title, tb_job.type, tb_job.status, tb_jenis_pekerjaan.nama_pekerjaan
    FROM tb_kerjasama_perusahan INNER JOIN tb_job ON tb_job.nomor_kontrak=tb_kerjasama_perusahan.nomor_kontrak
    LEFT JOIN tb_jenis_pekerjaan ON tb_jenis_pekerjaan.kd_pekerjaan = tb_job.title WHERE tb_kerjasama_perusahan.nomor_kontrak = :nomor";

    $stmt = $auth_user->runQuery($sql);
    $stmt->execute(array(
        ':nomor' => $nomorKontrak
    ));




?>

<div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1" id="listJobs">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php while ($data = $stmt->fetch(PDO::FETCH_LAZY)){
            $type = substr($data['kode_request'], 0, 3);

            if($type == 'MPO'){
                $judulJobs = $data['nama_pekerjaan'];
            }else{
                $judulJobs = $data['title'];
            }
            if($data['type'] == 'main'){
                $panel = "primary";
            }else{
                $panel = "info";
            }
          ?>

        <div class="panel panel-<?=$panel?>">
            <div class="panel-heading" role="tab" id="heading<?=$data['kode_detail_job']?>">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$data['kode_detail_job']?>" aria-expanded="true" aria-controls="collapse<?=$data['kode_detail_job']?>">
                        <?=$judulJobs?> <span class="pull-right" style="font-size: 10px; text-transform: uppercase;"> <?=$data['type']?> <i class="glyphicon glyphicon-tags"></i></span>
                    </a>
                </h4>
            </div>
            <div id="collapse<?=$data['kode_detail_job']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$data['kode_detail_job']?>">
                <div class="panel-body">
                    <div id="detailJobs">
                        <?php include 'detailJobs.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
