<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Products;
use Livewire\Component;

class FormulaProductUpdate extends Component
{
    public $inputs = [];
    public $faicodeOptions = [];
    public $persenOptions = [];
    public $persentase;
    public $FAI_code;
    public $prd;
    public $brg;

    public function mount($persentase, $FAI_code)
    {
        $this->brg = Barang::all();
        $this->prd = Products::all();
        $this->persentase = $persentase;
        $this->FAI_code = $FAI_code;

        // Inisialisasi properti faicodeOptions dan persenOptions dengan nilai dari FAI_code dan persentase
        foreach ($this->FAI_code as $key => $value) {
            $this->faicodeOptions[$key] = $value;
        }
        foreach ($this->persentase as $key => $value) {
            $this->persenOptions[$key] = $value;
        }

        $this->addInput();
    }

    public function updatePersentaseAndFaiCodes()
    {
        // Lakukan aksi yang diperlukan dengan data persentase dan FAI_code
    }

    public function addInput()
    {
        // Memasukkan semua nilai FAI_code ke dalam inputs
        foreach ($this->FAI_code as $key => $value) {
            $this->inputs[$key] = $value;
        }
        // Menambahkan null ke faicodeOptions dan persenOptions
        $this->inputs[] = count($this->inputs);
        $this->faicodeOptions[] = null;
        $this->persenOptions[] = null;
        $this->emit('initialize-select2');
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        unset($this->faicodeOptions[$index]);
        unset($this->persenOptions[$index]);
        $this->emit('initialize-select2');
    }

    public function render()
    {
        return view('livewire.formula-product-update');
    }
}
