<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="space-y-4">
        <h1>{{ $project->name }}</h1>
        <p>{{ $project->description }}</p>

        @can('update', $project)
        <a href="{{ route('projects.edit', $project) }}">Editar</a>
        @endcan

        @can('manage', $project)
        <a href="{{ route('projects.addUser', $project) }}">Adicionar Usuário</a>
        @endcan



    </div>
</div>