window.addEventListener('load', function(){
    $(document).ready(function(){
        // Masks
        $('.date-mask').mask('00/00/0000', {placeholder: "__/__/____"});
        $('.integer-mask').mask('#', {reverse: true});

        // Datatables
        $('.datatable').DataTable({
            "sDom": 'ft',
            "order": [[0, 'asc']],
            "language": {
                "paginate": {
                    "previous": "Anterior",
                    'next': 'Próxima',
                    'first': 'Primeira',
                    'last': 'Última',
                },
                'search': 'Pesquisa rápida:',
                "zeroRecords":    "0 resultados",
                "emptyTable":     "Tabela vazia",
            },
            "pageLength": 500
        });
    });
});