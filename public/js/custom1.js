window.addEventListener('load', function () {
    $(document).ready(function () {
        // Masks
        $('.date-mask').mask('00/00/0000', { placeholder: "__/__/____" });
        $('.integer-mask').mask('#', { reverse: true });

        // Datatables
        $('.datatable').DataTable({
            "order": [[0, 'asc']],
            "language": {
                "paginate": {
                    "previous": "Anterior",
                    'next': 'Próxima',
                    'first': 'Primeira',
                    'last': 'Última',
                },
                "lengthMenu": "Exibindo _MENU_ linhas",
                "infoFiltered": "(filtrados de um total de _MAX_ linhas)",
                "info": "Exibindo _START_ até _END_ de _TOTAL_ linhas",
                'search': 'Pesquisa rápida:',
                "zeroRecords": "0 resultados",
                "thousands": ".",
                "emptyTable": "Tabela vazia",
            },
            "pageLength": 100
        });
    });
});