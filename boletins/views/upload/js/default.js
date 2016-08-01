$(function() {
    //datatables
    var MinhaTable = $('#TabelaPrincipal').dataTable({
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": '../public/TableTools-master/swf/copy_csv_xls_pdf.swf'
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "upload/lista_arquivos_datatables",
            "type": "POST"
        },
        "dom": '<"top">rt<"bottom"ip><"clear">',
        "pagingType": "full_numbers",
        "pageLength": 30,
        "oLanguage": {
            "sProcessing": "Aguarde enquanto os dados são carregados ...",
            "sLengthMenu": "Mostrar _MENU_ registros por pagina",
            "sZeroRecords": "Nenhum registro correspondente ao critério encontrado..",
            "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
            "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
            "sInfoFiltered": "",
            "sLoadingRecords": "Carregando...",
            "sSearch": "Procurar",
            "oPaginate": {
                "sFirst":    "<i class='glyphicon glyphicon-fast-backward'></i> ",
                "sPrevious": " <i class='glyphicon glyphicon-step-backward'></i>",
                "sNext":     " <i class='glyphicon glyphicon-step-forward'></i>",
                "sLast":     " <i class='glyphicon glyphicon-fast-forward'></i>"
            }
        },
        buttons:
            [{
                extend: 'copy',
                text: '<u>C</u>opy',
                key: {
                    key: 'c',
                    altKey: true
                }
            }]
    });

    
    $('#FrmDirSel').submit(function(evt){
        evt.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'upload/envia_arquivos_de_um_diretorio',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data; charset=UTF-8',
            processData: false,
            success: function (response){
                if(response!=""){
                    MinhaTable.fnDraw();
                    
                }
            }
        });
        return false;
    });
});