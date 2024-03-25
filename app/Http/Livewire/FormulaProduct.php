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
        $this->inputs[] = '';
        $this->faicodeOptions[] = '';
        $this->emit('initialize-select2');
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        unset($this->faicodeOptions[$index]);
        $this->emit('initialize-select2');

    }

    public function render()
    {
        return view('livewire.formula-product');
    }
}
