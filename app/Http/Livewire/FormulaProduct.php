<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Products;
use Livewire\Component;

class FormulaProduct extends Component
{
    public $inputs = [];
    public $faicodeOptions = [];
    public $brg;
    public $prd;

    public function mount()
    {
        $this->brg = Barang::all();
        $this->prd = Products::all();
        $this->addInput();
    }

    public function addInput()
    {
        $this->inputs[] = count($this->inputs);
        $this->faicodeOptions[] = null; // Change to null to avoid JSON issue
    }

    public function render()
    {
        return view('livewire.formula-product');
    }
}
