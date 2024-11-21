<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; // Importar o modelo de Usuário
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

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
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

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Usuário atualizado com sucesso!');
        $this->resetFields();
    }

    public function delete($id)
    {
        User::destroy($id);
        session()->flash('message', 'Usuário excluído com sucesso!');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->userId = null;
    }
}
