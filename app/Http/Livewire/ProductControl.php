<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductControl extends Component
{

    public $inputs = [];
    public $packaging_qty;
    public $qty_packaging = [];


    public function mount($packaging_qty)
    {
        $this->packaging_qty = $packaging_qty;
        if ($this->packaging_qty == !null) {
            foreach ($this->packaging_qty as $key => $value) {
                $this->qty_packaging[$key] = $value;
            }
        }


        $this->addInput();
    }

    public function addInput()
    {
        if ($this->packaging_qty == !null) {

            foreach ($this->packaging_qty as $key => $value) {
                $this->inputs[$key] = $value;
            }
            $this->inputs[] = count($this->inputs);
            $this->qty_packaging[] = null;
        }
        $this->inputs[] = count($this->inputs);
    }

    public function render()
    {
        return view('livewire.product-control');
    }
}
