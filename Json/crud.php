<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 05/02/2018
 * Time: 14.51
 */
require '../class.user.php';

$config = new USER();

if(@$_GET['type'] == 'addLembur'){

    $table = "tb_lembur";
    $field = "kode_lembur";
    $key = "LMBR";

    $kode = $config->getKode($field, $key, $table);

    $ktp = $_POST['ktp'];
    $ket = $_POST['keterangan'];
    $status = "";

    $sql = "INSERT INTO tb_lembur (kode_lembur, no_ktp, keterangan, status) VALUES (:kode, :ktp, :ket, :st)";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':kode' => $kode,
        ':ktp'  => $ktp,
        ':ket'  => $ket,
        ':st'   => $status
    ));

    if($stmt){
        echo "Success";
    }else{
        echo "Failed";
    }
}elseif(@$_GET['type'] == 'addCuti'){
    $a = $_POST['ktp'];
    $b = $_POST['dari'];
    $c = $_POST['sampai'];
    $d = $_POST['alasan'];

    $sql = "INSERT INTO tb_cuti (no_ktp, dari, sampai, keterangan) VALUES (:a, :b, :c, :d)";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':a' => $a,
        ':b'  => $b,
        ':c'  => $c,
        ':d'   => $d
    ));

    if($stmt){
        echo "Cuti Berhasil diajukan.";
    }else{
        echo "Gagal diajukan.";
    }
}
elseif(@$_GET['type'] == 'addKomplain'){

    $table = "tb_complain_karyawan";
    $field = "kode_komplain";
    $key = "CMLN";

    $formatt = "d-m-Y";
    $tgl = $config->getDate($formatt);

    $kode = $config->getKode($field, $key, $table);

    $a = $_POST['ktp'];
    $b = $_POST['judul'];
    $c = $_POST['isi'];



    $sql = "INSERT INTO tb_complain_karyawan (kode_komplain, no_ktp, judul, keterangan, create_date) VALUES (:a, :b, :c, :d, :e)";
    $stmt = $config->runQuery($sql);
    $stmt->execute(array(
        ':a' => $kode,
        ':b'  => $a,
        ':c'  => $b,
        ':d'   => $c,
        ':e'    => $tgl
    ));

    if($stmt){
        echo "Komplain Berhasil diajukan.";
    }else{
        echo "Gagal diajukan.";
    }
}