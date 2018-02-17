
$(document).ready(function(){

    $(function () {
        $('#tglDari').datetimepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayBtn: true,
            minView: 2
        });
        $('#tglSampai').datetimepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayBtn: true,
            minView: 2
        });
    });


    var formLembur = $('#formLembur').hide();
    var formCuti = $('#formCuti').hide();
    var formKomplain = $('#formKomplain').hide();

    $('#getLembur').on('click', function () {
        var list = $('#listLembur').hide();

        formLembur.show(500);
    });

    $('#getCuti').on('click', function () {
        var list = $('#listCuti').hide();

        formCuti.show(500);
    });

    $('#getKomplain').on('click', function () {
        var list = $('#listkomplain').hide();

        formKomplain.show(500);
    });

    $('#reqLembur').on('submit', function () {
        var id = $('#textKTP').val();
        var keterangan = $('#txtKeterangan').val();
        if(keterangan != ""){
            $.ajax({
                url : 'Json/crud.php?type=addLembur',
                type: 'post',
                data: 'ktp='+id+'&keterangan='+keterangan,

                success: function (msg) {
                    if(msg != ""){
                        alert(msg);
                        location.reload();
                    }
                }
            });
        }else{
            alert("sue");
        }
    });

    //cuti
    $('#formCuti').on('submit', function () {

        var ktp = $('#txtKTP').val();
        var dari = $('#tglDari').val();
        var sampai = $('#tglSampai').val();
        var ket = $('#txtAlasan').val();

        $.ajax({
            url : 'Json/crud.php?type=addCuti',
            type: 'post',
            data: 'ktp='+ktp+'&dari='+dari+'&sampai='+sampai+'&alasan='+ket,

            success: function (msg) {
                if(msg != ""){
                    alert(msg);
                    location.reload();
                }
            }
        });
        //
        // alert( ktp + dari + sampai + ket);
        //
        // $('#formCuti input').val('');
        //
        // $("#tablecuti").bootstrapTable('refresh');
    });

    //komplain
    $('#formKomplain').on('submit', function () {

        var ktp = $('#txtKTP').val();
        var judul = $('#txtJudul').val();
        var isi = $('#txtISI').val();

        $.ajax({
            url : 'Json/crud.php?type=addKomplain',
            type: 'post',
            data: 'ktp='+ktp+'&judul='+judul+'&isi='+isi,

            success: function (msg) {
                if(msg != ""){
                    alert(msg);
                    location.reload();
                }
            }
        });
        //
        // alert( ktp + dari + sampai + ket);
        //
        // $('#formCuti input').val('');
        //
        // $("#tablecuti").bootstrapTable('refresh');
    });
})