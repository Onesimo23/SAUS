<?php

namespace App\Livewire;
use App\Models\Log;

use Livewire\Component;

class Logs extends Component
{
    public function render()
    {
        $logs = Log::with('user')->latest()->get();
        return view('livewire.logs', compact('logs'));
    }
}
