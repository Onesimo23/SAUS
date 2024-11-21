<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Log; // Importar o modelo Log
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{
    public $users, $name, $email, $password, $userId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function render()
    {
        $this->users = User::all(); // Carregar todos os usuários
        return view('livewire.user-component');
    }

    public function store()
    {
        $this->validate();

        // Criar o usuário
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Criar o log de ação para criação do usuário
        Log::create([
            'user_id' => $user->id,  // Associar o log ao novo usuário
            'action' => 'Criação de Usuário',
            'description' => 'O usuário foi criado com sucesso.',
        ]);

        session()->flash('message', 'Usuário criado com sucesso!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        // Atualizar os dados do usuário
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Criar o log de ação para atualização do usuário
        Log::create([
            'user_id' => $user->id,  // Associar o log ao usuário atualizado
            'action' => 'Atualização de Usuário',
            'description' => 'Os dados do usuário foram atualizados com sucesso.',
        ]);

        session()->flash('message', 'Usuário atualizado com sucesso!');
        $this->resetFields();
    }

  public function delete($id)
{
    $user = User::findOrFail($id); // Obter o usuário antes da exclusão

    // Criar o log de ação para exclusão do usuário
    Log::create([
        'user_id' => $user->id,  // Associar o log ao usuário excluído
        'action' => 'Exclusão de Usuário',
        'description' => "O usuário '{$user->name}' foi excluído com sucesso.", // Usar o nome do usuário no log
    ]);

    // Excluir o usuário
    $user->delete();

    session()->flash('message', "Usuário '{$user->name}' excluído com sucesso!");
}

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->userId = null;
    }
}
