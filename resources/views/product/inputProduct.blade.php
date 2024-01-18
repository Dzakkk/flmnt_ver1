@extends('dashboard')

@section('product_form')
    <div class="container shadow pt-2 mt-2" style="width: 800px">
        <form class="row g-3 d-flex" action="/newBarang" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <h5 for="nama_pendidikan" class="form-h5">Daftar Barang Baru</h5>
            </div>
            <div class="col-md-6">
                <label for="inpnip" class="form-label">FAI_code</label>
                <input type="text" name="FAI_code" class="form-control" id="inpFAI_code">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="TMT">FINA code</label>
                <input type="text" name="FINA_code" class="form-control" id="FINA_code">
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">category</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="category">
                        <option value="">Pilih Kategori</option>
                        <option value="PRODUCT BASE">PRODUCT BASE</option>
                        <option value="PRODUCT FLAVOR">PRODUCT FLAVOR</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="aspect">aspect</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="aspect">
                        <option value="">Pilih Kategori</option>
                        <option value="LIQUID">LIQUID</option>
                        <option value="POWDER">POWDER</option>
                        <option value="SOLID">SOLID</option>
                        <option value="FLEXIBLE">FLEXIBLE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="product_name" class="form-label">product_name</label>
                <input type="text" name="product_name" id="product_name" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="build_product" class="form-label">build_product</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="build_product">
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="OSF">OSF</option>
                        <option value="FAI">FAI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="formula_id" class="form-label">formula_id</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="formula_id">
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="ALT1">ALT1</option>
                        <option value="ALT2">ALT2</option>
                        <option value="ALT3">ALT3</option>
                        <option value="ALT4">ALT4</option>
                        <option value="ALT5">ALT5</option>
                        <option value="ORI">ORI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="segment" class="form-label">segment</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="segment">
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="SAVORY">SAVORY</option>
                        <option value="SWEET">SWEET</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="solubility" class="form-label">solubility</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="solubility">
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="OS">OS</option>
                        <option value="WS">WS</option>
                    </select>
                </div>
            </div>

            {{-- <div class="col-md-6">
                <label for="supplier" class="form-label">supplier</label>
                <select name="supplier" id="supplier" class="form-control select2" required>
                    <option value="" disabled selected>Select Supplier</option>
                    @foreach ($supp as $c)
                        <option value="{{ $c->id_supplier }}">{{ $c->supplier_name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="col-md-6">
                <label class="form-label" for="created_date">created_date</label>
                <input type="text" name="created_date" class="form-control" id="created_date">
            </div>
            <div class="col-md-6">
                <label for="release_date" class="form-label">release_date</label>
                <input type="text" name="release_date" id="release_date" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="created_by">created_by</label>
                <input type="text" name="created_by" class="form-control" id="created_by">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="note">note</label>
                <input type="text" name="note" class="form-control" id="note">
            </div>
            <div class="col-md-6">
                <label for="storage" class="form-label">storage</label>
                <input type="text" name="storage" id="storage" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="total_order">total_order</label>
                <input type="text" name="total_order" class="form-control" id="total_order">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">unit</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="unit">
                        <option value="">Pilih Kategori</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="ml">ml</option>
                        <option value="gram">gram</option>
                    </select>
                </div>
            </div>
            {{-- //formula --}}
            <div class="col-md-12" id="input-container">
                <div class="input-group">
                    <label class="form-label" for="persentase-0">Persentase:</label>
                    <input type="number" id="persentase-0" name="persentase[]" required class="form-control">
                    <label class="form-label" for="kandungan-0">Kandungan:</label>
                    <select name="FAI_code_barang[]" id="kandungan-0" class="form-control select2" required>
                        <option value="" disabled selected>Select Supplier</option>
                        @foreach ($brg as $c)
                            <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-danger" onclick="removeInput(0)" type="button">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="addInput()" id="add-input">Add Input</button>
            <div class="col-12 pb-4">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </form>
    </div>



    <!-- ... (Your previous HTML and form) ... -->

    <script>
        $(document).ready(function() {
            let inputCounter = 1;
    
            function addInput() {
                const inputContainer = $('#input-container');
    
                const newInputGroup = $('<div>').addClass('input-group');
    
                const labelPersentase = $('<label>').addClass('form-label').text(`Persentase ${inputCounter + 1}:`);
                const inputPersentase = $('<input>').attr({
                    type: 'number',
                    name: 'persentase[]',
                    required: true
                }).addClass('form-control');
    
                const labelKandungan = $('<label>').addClass('form-label').text(`Kandungan ${inputCounter + 1}:`);
                const selectKandungan = $('<select>').attr({
                    name: 'FAI_code_barang[]',
                    required: true
                }).addClass('form-control select2');
    
                const defaultOption = $('<option>').attr({
                    value: '',
                    disabled: true,
                    selected: true
                }).text('Select Supplier');
                selectKandungan.append(defaultOption);
    
                // Adding options from the server-side variable 'brg'
                @foreach ($brg as $c)
                    const option = $('<option>').attr({
                        value: '{{ $c->FAI_code }}'
                    }).text('{{ $c->FAI_code }}');
                    selectKandungan.append(option);
                @endforeach
    
                const removeBtn = $('<button>').addClass('btn btn-danger').text('Remove').on('click', removeInput);
    
                newInputGroup.append(labelPersentase, inputPersentase, labelKandungan, selectKandungan, removeBtn);
    
                inputContainer.append(newInputGroup);
    
                inputCounter++;
            }
    
            function removeInput() {
                $(this).closest('.input-group').remove();
            }
    
            $('#add-input').on('click', addInput);
        });
    </script>
    
@endsection
