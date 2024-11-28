<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Construtor para garantir que as policies sejam aplicadas corretamente
    public function __construct()
    {
        // Aplica as políticas para as ações de editar, atualizar e gerenciar usuários
        $this->authorizeResource(Project::class, 'project');
    }

    // Exibir todos os projetos para os quais o usuário tem acesso
    // Exibir todos os projetos
    public function index()
    {
        $user = auth()->user();  // Recupera o usuário logado

        // Buscar projetos que o usuário criou ou aos quais ele foi adicionado
        $projects = Project::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);  // Filtra os projetos associados ao usuário
        })->orWhere('user_id', $user->id) // Adiciona projetos criados pelo próprio usuário
            ->get();

        return view('projects.index', compact('projects'));
    }


    // Mostrar o formulário de criação
    public function create()
    {
        return view('projects.create');
    }

    // Armazenar um novo projeto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Criar o projeto
        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Associar o usuário criador como admin
        $project->users()->attach(auth()->user(), ['role' => 'admin']);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    // Mostrar o formulário de edição
    public function edit(Project $project)
    {
        // Verificar se o usuário tem permissão para editar
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    // Atualizar um projeto
    public function update(Request $request, Project $project)
    {
        // Verificar se o usuário tem permissão para editar
        $this->authorize('update', $project);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    // Gerenciar usuários do projeto
    public function manageUsers(Project $project)
    {
        // Verificar se o usuário tem permissão para gerenciar os usuários do projeto
        $this->authorize('manage', $project);

        // Buscar todos os usuários cadastrados
        $users = User::all();

        return view('projects.manageUsers', compact('project', 'users'));
    }

    // Adicionar usuário ao projeto
    public function addUser(Request $request, Project $project)
    {
        // Verificar se o usuário tem permissão para gerenciar usuários
        $this->authorize('manage', $project);

        // Validar o email e o papel
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:admin,editor,viewer', // Os três papéis
        ]);

        // Buscar o usuário pelo email
        $user = User::where('email', $request->email)->first();

        // Associar o usuário ao projeto com o papel (role)
        $project->users()->attach($user, ['role' => $request->role]);

        return redirect()->route('projects.manageUsers', $project->id)->with('success', 'Usuário adicionado com sucesso!');
    }
}
