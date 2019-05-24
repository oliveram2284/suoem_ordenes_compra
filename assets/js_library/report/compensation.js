$(function() {
    console.log("=====>   APORTES REPORTES JS LOAD <=====");
    var table_ = $("table").dataTable({
        pageLength: 100,
        responsive: true,
        //'processing': true,
        //'serverSide': true,
        fixedHeader: {
            header: true,
            footer: true
        },
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
            "lengthMenu": "Ver _MENU_ filas por página",
            "zeroRecords": "No hay registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrando de un total de _MAX_ registros)",
            "sSearch": "Buscar:  ",
            "oPaginate": {
                "sNext": "Sig.",
                "sPrevious": "Ant."
            }
        },
        "columnDefs": [

            { "className": "text-center ", "targets": [0] },
        ],
        dom: "<'row'<'col col-3'l><'col col-3'B><'col col-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            /*'copy', 'csv', 'excel', 'pdf', 'print'*/
            {
                extend: 'excelHtml5',
                text: '<i class="far fa-file-excel"></i> EXCEL',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                },
                title: '',
                filename: 'Fastram - Compensaciones ' + Date.now(),
                header: true,
                footer: true,
                sheetName: "Compensaciones",
                className: "btn-success btn-sm"
            }, {
                title: 'Fastram - Compensaciones',
                filename: 'Fastram - Compensaciones ' + Date.now(),
                text: '<i class="fas fa-file-pdf"></i> PDF',
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'TABLOID',
                header: true,
                footer: true,
                customize: function(doc) {
                    var tblBody = doc.content[1].table.body;
                    doc.content[1].layout = {
                        hLineWidth: function(i, node) {
                            return (i === 0 || i === node.table.body.length) ? 2 : 1;
                        },
                        vLineWidth: function(i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 2 : 1;
                        },
                        hLineColor: function(i, node) {
                            return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
                        },
                        vLineColor: function(i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
                        }
                    };
                    $('#gridID').find('tr').each(function(ix, row) {
                        var index = ix;
                        var rowElt = row;
                        $(row).find('td').each(function(ind, elt) {
                            tblBody[index][ind].border
                            if (tblBody[index][1].text == '' && tblBody[index][2].text == '') {
                                delete tblBody[index][ind].style;
                                tblBody[index][ind].fillColor = '#FFF9C4';
                            } else {
                                if (tblBody[index][2].text == '') {
                                    delete tblBody[index][ind].style;
                                    tblBody[index][ind].fillColor = '#FFFDE7';
                                }
                            }
                        });
                    });
                },
                className: "btn-dark btn-sm"

            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimir',
                header: true,
                footer: true,
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                },
                filename: 'Fastram - Compensaciones ' + Date.now(),
                title: 'Fastram - Compensaciones',
                className: "btn-danger btn-sm"
            },
        ]
    });
});

$('#filter_btn').click(function(){
        var desde = $('#datepicker_from').val().split('/'); 
        var hasta = $('#datepicker_to').val().split('/');
        window.location.href = $('#url').val()+'report/compensation/'+desde+'/'+hasta;
    });