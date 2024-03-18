{{-- <div>
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
</div> --}}

<div>
    @foreach ($inputs as $key => $value)
        <div class="input-group mb-1 row g-3" wire:key="{{ $key }}">
            <div class="col-md-5">
                <label class="form-label" for="persentase-{{ $key }}">Persentase:</label>
                <input name="persentase[]" type="text" id="persentase-{{ $key }}"
                    wire:model="persenOptions.{{ $key }}" class="form-control">
            </div>
            <div class="col-md-7 d-flex">
                <div class="me-2">
                    <label for="kandungan-{{ $key }}" class="form-label">FAI Code</label>
                    <div id="ehe" class="form-control">
                        <select name="FAI_code_barang[]" id="kandungan-{{ $key }}" id="barang1"
                            class="form-control select2" wire:model="faicodeOptions.{{ $key }}" wire:ignore>
                            <option value="" selected>Select FAI Code</option>
                            @foreach ($brg as $c)
                                <option value="{{ $c->FAI_code }}">
                                    {{ $c->FAI_code }}&nbsp;&nbsp;{{ $c->name }}</option>
                            @endforeach
                            @foreach ($prd as $c)
                                <option value="{{ $c->FAI_code }}">
                                    {{ $c->FAI_code }}&nbsp;&nbsp;{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label for="" class="form-label">&nbsp;</label>
                    <button wire:click.prevent="removeInput({{ $key }})" class="btn btn-danger form-control"
                        type="button">Remove</button>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.select2').select2();
                $('.select2').on('change', function(e) {
                    var data = $(this).val();
                    Livewire.emit('initialize-select2', data);
                });
            });
        </script>
    @endforeach

    <button wire:click.prevent="addInput" class="btn btn-primary" type="button" id="add-input">Add Input</button>


</div>

