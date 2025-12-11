//SideBar Menu
// $('.sidebar-menu').tree()

//DataTable
//Documentação https://datatables.net/
$(".tabelas").DataTable({
    "language": {
        "sProcessing": "Processando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "Nenhum resultado encontrado",
        "sEmptyTable": "Nenhum dado disponível nesta tabela",
        "sInfo": "Mostrando registros de _START_ até _END_ de um total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros de 0 até 0 de um total de 0",
        "sInfoFiltered": "(filtrado de um total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ".",
        "sLoadingRecords": "Carregando...",
        "oPaginate": {
            "sFirst": "Primeiro",
            "sLast": "Último",
            "sNext": "Próximo",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Ativar para ordenar a coluna em ordem crescente",
            "sSortDescending": ": Ativar para ordenar a coluna em ordem decrescente"
        }
    }
});

