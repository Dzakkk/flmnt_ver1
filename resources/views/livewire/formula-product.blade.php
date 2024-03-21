<div wire:ignore.self>
    @foreach ($inputs as $key => $value)
        <div class="input-group mb-1 row g-3" wire:key="{{ $key }}">
            <div class="col-md-5">
                <label class="form-label" for="persentase-{{ $key }}">Persentase:</label>
                <input name="persentase[]" type="text" id="persentase-{{ $key }}"
                    wire:model="inputs.{{ $key }}" class="form-control">
            </div>
            <div class="col-md-7 d-flex">
                <div class="me-2">
                    <label for="kandungan-{{ $key }}" class="form-label">FAI Code</label>
                    <div id="ehe" class="form-control">
                        <select name="FAI_code_barang[]" id="kandungan-{{ $key }}" id="barang1"
                            class="form-control select2" wire:model="faicodeOptions.{{ $key }}">
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

    @endforeach

    <button wire:click.prevent="addInput" class="btn btn-primary" type="button" id="add-input">Add Input</button>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2').on('change', function(e) {
            var data = $(this).val();
            Livewire.emit('initialize-select2', data);
        });
    });
</script>
@endpush
{{-- @push('sss')
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada halaman pertama load
        $('.select2').select2();

        // Tangani event inisialisasi ulang Select2
        Livewire.on('initialize-select2', function () {
            $('.select2').select2();
        });
    });
</script>
@endpush --}}




{{-- <div>
    @foreach ($inputs as $key => $value)
        <div class="input-group mb-1 row g-3" wire:key="{{ $key }}">
            <div class="col-md-5">
                <label class="form-label" for="persentase-{{ $key }}">Persentase:</label>
                <input name="persentase[]" type="text" id="persentase-{{ $key }}"
                    wire:model="inputs.{{ $key }}" class="form-control">
            </div>
            <div class="col-md-7 d-flex">
                <div class="me-2">
                    <label for="kandungan-{{ $key }}" class="form-label">FAI Code</label>
                    <div id="ehe" class="form-control">
                        <select name="FAI_code_barang[]" id="kandungan-{{ $key }}"
                            class="form-control select2" wire:model="faicodeOptions.{{ $key }}" wire:ignore>
                            <option value="" selected>Select FAI Code</option>
                            @foreach ($brg as $c)
                                <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }} - {{ $c->name }}</option>
                            @endforeach
                            @foreach ($prd as $c)
                                <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }} - {{ $c->name }}</option>
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
    @endforeach
   
    <button wire:click.prevent="addInput" class="btn btn-primary" type="button" id="add-input">Add Input</button>
</div>

@livewireScripts
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('initialize-select2', function () {
            $('.select2').select2();
        });
    });
</script> --}}





