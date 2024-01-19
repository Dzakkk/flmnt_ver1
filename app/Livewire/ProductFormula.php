<?php

namespace App\Livewire;

use App\Models\Barang;
use Livewire\Component;

class ProductFormula extends Component
{
    public $fields = [];
    public $persentase = [];
    public $FAI_code_barang = [];
    public $brg;

    public function mount()
    {
        $this->fields = []; // or any initial values
        $this->persentase = [];
        $this->FAI_code_barang = [];
        $this->brg = Barang::all(); // or any other way to get data
    }

    public function render()
    {
        return view('livewire.product-formula');
    }

    public function addFormField()
    {
        $this->fields[] = '';
        $this->persentase[] = '';
        $this->FAI_code_barang[] = '';
    }

    public function removeFormField($index)
    {
        unset($this->fields[$index]);
        unset($this->persentase[$index]);
        unset($this->FAI_code_barang[$index]);

        $this->fields = array_values($this->fields);
        $this->persentase = array_values($this->persentase);
        $this->FAI_code_barang = array_values($this->FAI_code_barang);
    }
}
