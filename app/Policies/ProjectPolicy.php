<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    
    // Permite a visualização de qualquer projeto para membros
    public function view(User $user, Project $project)
    {
        return $project->users->contains($user);
    }

    // Somente admin pode editar
    public function update(User $user, Project $project)
    {
        return $project->users->where('pivot.role', 'admin')->contains($user);
    }

    // Somente admin pode gerenciar os usuários do projeto
    public function manage(User $user, Project $project)
    {
        return $project->users->where('pivot.role', 'admin')->contains($user);
    }
}
