<?php
/**
 * Created by PhpStorm.
 * User: small-project
 * Date: 05/02/2018
 * Time: 13.28
 */
?>
<div class="well" id="formKomplain">
    <h3 class="title">Form Komplain</h3>
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
            <label for="daterange" class="col-sm-2 control-label">Judul Komplain</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtJudul" placeholder="" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea id="txtISI" class="form-control" rows="3" required="" placeholder="penjelasan komplain"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Ajukan</button>
            </div>
        </div>
    </form>
</div>

<div class="panel panel-primary panel-body" id="listkomplain">
    <h3>List Complain Karyawan</h3>
    <hr>
    <button class="btn btn-sm btn-success" id="getKomplain">
        <span class="glyphicon glyphicon-plus-sign"></span> form komplain
    </button>
    <br>
    <table id="tablekomplain"
           data-toggle="table"
           data-toolbar="#toolbar"
           data-height="520"
           data-pagination="true"
           data-click-to-select="true"
           data-url="Json/data-crud.php?type=tableComplain&ktp=<?=$user_id?>"
           data-unique-id="id">
        <thead>
        <tr>

            <th data-field="kupon" class="success">Kupon Komplain</th>
            <th data-field="judul" class="success">Judul</th>
            <th data-field="keterangan" class="success">Keterangan</th>
            <th data-field="create_date" class="success">Create Date</th>
            <th data-field="update" class="success">Update ON</th>
            <th data-field="admin" class="success">Admin By</th>
            <th data-field="status" class="danger">Status</th>
        </tr>
        </thead>
    </table>
</div>