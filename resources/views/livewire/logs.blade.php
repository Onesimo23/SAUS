<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Logs de Ações</h2>

    <!-- Tabela com DataTable -->
    <table id="logsTable" class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Usuário</th>
                <th class="px-4 py-2 text-left">Ação</th>
                <th class="px-4 py-2 text-left">Descrição</th>
                <th class="px-4 py-2 text-left">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr class="border-t border-gray-200">
                    <td class="px-4 py-2">{{ $log->user->name ?? 'Desconhecido' }}</td>
                    <td class="px-4 py-2">{{ $log->action }}</td>
                    <td class="px-4 py-2">{{ $log->description }}</td>
                    <td class="px-4 py-2">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Iniciar o DataTable -->
<script>
    $(document).ready(function() {
        $('#logsTable').DataTable({
            "paging": true, // Habilita paginação
            "searching": true, // Habilita pesquisa
            "ordering": true, // Habilita ordenação
            "lengthMenu": [10, 25, 50, 100], // Quantidade de registros por página
            "order": [[3, 'desc']], // Ordenar pela data (coluna 3) em ordem decrescente
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json" // Tradução para português
            }
        });
    });
</script>
