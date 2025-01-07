<?php

namespace App\Livewire;

use App\Models\Server;
use App\Models\SubServer;
use App\Models\User;
use Livewire\Component;

class DashboardStats extends Component
{
    public $userCount;

    public function mount()
    {
        $this->userCount = User::count();
    
    }
    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
