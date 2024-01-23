<div>
    <form wire:submit.prevent="submitForm">
        @foreach($fields as $index => $field)
            <div class="input-group">
                {{-- <label class="form-label" for="persentase-{{ $index }}">Persentase:</label> --}}
                <input type="text" step="0.01" wire:model="persentase.{{ $index }}" id="persentase-{{ $index }}" name="persentase[]" required class="form-control mb-1" placeholder="Persentase">

                {{-- <label class="form-label" for="FAI_code_barang-{{ $index }}">Kandungan:</label> --}}
                <select wire:model="FAI_code_barang.{{ $index }}" name="FAI_code_barang[]" id="FAI_code_barang-{{ $index }}" class="form-control select2 mb-1" required>
                    <option value="" disabled>Select FAI code</option>
                    @foreach ($brg as $c)
                        <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }}</option>
                    @endforeach
                </select>
                <button type="button" wire:click="removeFormField({{ $index }})" class="btn btn-danger ms-1 mb-1">Remove</button>

            </div>

        @endforeach

        <button type="button" wire:click="addFormField" class="btn btn-primary mt-2 mb-2">Add Input</button>

        <div class="col-12 pb-4">
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
    </form>
    @livewireScripts

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('submitForm', function (formData) {
                // Use axios or Livewire HTTP client to send the form data to the controller
                axios.post('/product/store', formData)
                    .then(response => {
                        // Handle the response as needed
                        console.log(response.data);
                    })
                    .catch(error => {
                        // Handle errors
                        console.error(error);
                    });
            });
        });
    </script>
</div>
