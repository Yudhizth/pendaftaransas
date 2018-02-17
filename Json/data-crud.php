<?php

require '../class.user.php';

$config = new USER();


//show data
if(@$_GET['type'] == 'tableCuti'){
    $ktp = $_GET['ktp'];

    $sql = "SELECT tb_cuti.id, tb_cuti.no_ktp, tb_cuti.dari, tb_cuti.sampai, tb_cuti.keterangan, tb_cuti.status FROM tb_cuti
WHERE tb_cuti.no_ktp = :ktp";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':ktp'  => $ktp
    ));

    $data = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        if($row['status'] == "1"){
            $row['status'] = "<span class='label label-success'>Approve</span>";
        }elseif($row['status'] == "2"){
            $row['status'] = "<span class='label label-danger'>Decline</span>";
        }else{
            $row['status'] = "<span class='label label-default'>unset</span>";
        }

        array_push($data, $row);
    }

    echo json_encode($data);
}elseif(@$_GET['type'] == 'tableComplain'){
    $ktp = $_GET['ktp'];

    $sql = "SELECT * FROM tb_complain_karyawan WHERE tb_complain_karyawan.no_ktp = :ktp ORDER BY id DESC";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':ktp'  => $ktp
    ));

    $data = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        if($row['status'] == "1"){
            $row['status'] = "<span class='label label-primary'>Process</span>";
        }elseif($row['status'] == "2"){
            $row['status'] = "<span class='label label-success'>Done</span>";
        }else{
            $row['status'] = "<span class='label label-default'>unset</span>";
        }

        if(empty($row['kode_komplain'])){
            $row['kupon'] = $row['id_reff'];
        }else{
            $row['kupon'] = $row['kode_komplain'];
        }

        array_push($data, $row);
    }

    echo json_encode($data);
}


?>