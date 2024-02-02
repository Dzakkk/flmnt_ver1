<div>
    @foreach ($inputs as $key => $value)
        <div class="input-group mb-3" wire:key="{{ $key }}">
            <div class="col-md-6">
                <label class="form-label" for="persentase-{{ $key }}">Persentase:</label>
                <input name="persentase[]" type="text" id="persentase-{{ $key }}"
                    wire:model="persenOptions.{{ $key }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="kandungan-{{ $key }}">Kandungan:</label>
                <select name="FAI_code_barang[]" id="kandungan-{{ $key }}" class="form-control select2"
                    wire:model="faicodeOptions.{{ $key }}">
                    <option value="" selected>Select FAI code</option>
                    @foreach ($brg as $c)
                        <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }}</option>
                    @endforeach
                    @foreach ($prd as $c)
                        <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button wire:click.prevent="removeInput({{ $key }})" class="btn btn-danger"
                    type="button">Remove</button>
            </div>
        </div>
    @endforeach

    <button wire:click.prevent="addInput" class="btn btn-primary" type="button" id="add-input">Add Input</button>
</div>
