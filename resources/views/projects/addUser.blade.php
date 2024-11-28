<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="space-y-4">
   
    <form action="{{ route('projects.storeUser', $project) }}" method="POST">
    @csrf
    <label for="user_id">Usuário</label>
    <select name="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <label for="role">Função</label>
    <select name="role">
        <option value="admin">Administrador</option>
        <option value="editor">Editor</option>
        <option value="viewer">Visualizador</option>
    </select>

    <button type="submit">Adicionar Usuário</button>
</form>

    </div>
</div>