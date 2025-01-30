<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Cour;
use Livewire\WithoutUrlPagination;


class ListCours extends Component
{
    use WithoutUrlPagination;
    public $cours_per_page = 2;
    public function render()
    {
        $cours = Cour::paginate($this->cours_per_page);
        return view('livewire.list-cours', [
            'cours' => $cours,
        ]);
    }
}
