<div>
    @foreach($inputs as $key => $value)
    <div class="row mb-3" wire:key="{{ $key }}">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity/kemasan (KG)</label>
        <div class="col-sm-10 d-flex">
            <input type="text" name="packaging_qty[]" class="form-control me-2" wire:model="qty_packaging.{{ $key }}">
        </div>
    </div>
    @endforeach
    <button wire:click.prevent="addInput" class="btn btn-primary" type="button" id="add-input">Add Input</button>

</div>
