<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 05/02/2018
 * Time: 13.28
 */
?>
<div class="well" id="formCuti">
    <h3 class="title">Form Request Cuti</h3>
    <br>
    <form class="form-horizontal" name="reqLembur" id="reqCuti" method="post" action="" data-parsley-validate="">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtNama" value="<?=$userRow['nama_depan']?> <?=$userRow['nama_belakang']?>" readonly="">
                <input type="hidden" class="form-control" id="txtKTP" value="<?=$user_id?>" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="daterange" class="col-sm-2 control-label">Dari ~ Sampai</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="tglDari" required>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="tglSampai" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea id="txtAlasan" class="form-control" rows="3" required="" placeholder="alasan cuti"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Ajukan</button>
            </div>
        </div>
    </form>
</div>

<div class="panel panel-primary panel-body" id="listCuti">
    <h3>List Cuti</h3>
    <hr>
    <button class="btn btn-sm btn-success" id="getCuti">
        <span class="glyphicon glyphicon-plus-sign"></span> form cuti
    </button>
    <br>
    <table id="tablecuti"
           data-toggle="table"
           data-toolbar="#toolbar"
           data-height="520"
           data-pagination="true"
           data-click-to-select="true"
           data-url="Json/data-crud.php?type=tableCuti&ktp=<?=$user_id?>"
           data-unique-id="id">
        <thead>
        <tr>

            <th data-field="no_ktp" class="success">Nomor KTP</th>
            <th data-field="dari" class="success">Dari</th>
            <th data-field="sampai" class="success">Sampai</th>
            <th data-field="keterangan" class="success">Alasan</th>
            <th data-field="status" class="danger">Status</th>
        </tr>
        </thead>
    </table>
</div>