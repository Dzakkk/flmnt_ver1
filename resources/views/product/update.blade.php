@extends('dashboard')

@section('updateProduct')
    {{-- @livewireStyles --}}
    <div class="container shadow pt-2 mt-2 pb-2" style="width: 800px">
        <form class="row g-3 d-flex" action="/product/update/{{ $prd->FAI_code }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-12">
                <h5 for="nama_pendidikan" class="form-h5">Update Product</h5>
            </div>
            <div class="col-md-6">
                <label for="inpnip" class="form-label">FAI code</label>
                <input type="text" name="FAI_code" class="form-control" id="inpFAI_code" value="{{ $prd->FAI_code }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="TMT">FINA code</label>
                <input type="text" name="FINA_code" class="form-control" id="FINA_code" value="{{ $prd->FINA_code }}">
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">Category</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="category">
                        <option value="{{ $prd->category }}">{{ $prd->category }}</option>
                        <option value="PRODUCT BASE">PRODUCT BASE</option>
                        <option value="PRODUCT FLAVOR">PRODUCT FLAVOR</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="aspect">Aspect</label>
                <div class="input-group">
                    <select class="form-select" id="aspectcoy" name="aspect">
                        <option value="{{ $prd->aspect }}">{{ $prd->aspect }}</option>
                        <option value="LIQUID">LIQUID</option>
                        <option value="POWDER">POWDER</option>
                        <option value="SOLID">SOLID</option>
                        <option value="FLEXIBLE">FLEXIBLE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control"
                    value="{{ $prd->product_name }}">
            </div>
            <div class="col-md-6">
                <label for="build_product" class="form-label">Build Product</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="build_product">
                        <option value="{{ $prd->build_product }}">{{ $prd->build_product }}</option>
                        <option value="OSF">OSF</option>
                        <option value="FAI">FAI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="formula_id" class="form-label">Formula id</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="formula_id">
                        <option value="{{ $prd->formula_id }}">{{ $prd->formula_id }}</option>
                        <option value="FORMULA 1">FORMULA 1</option>
                        <option value="FORMULA 2">FORMULA 2</option>
                        <option value="FORMULA 3">FORMULA 3</option>
                        <option value="FORMULA 4">FORMULA 4</option>
                        <option value="FORMULA 5">FORMULA 5</option>
                        <option value="FORMULA 6">FORMULA 6</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="segment" class="form-label">Segment</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="segment">
                        <option value="{{ $prd->segment }}">{{ $prd->segment }}</option>
                        <option value="SAVORY">SAVORY</option>
                        <option value="SWEET">SWEET</option>
                        <option value="NDS">NDS</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="solubility" class="form-label">Solubility</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="solubility">
                        <option value="{{ $prd->solubility }}">{{ $prd->solubility }}</option>
                        <option value="OS">OS</option>
                        <option value="WS">WS</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="created_date">Created Date</label>
                <input type="date" name="created_date" class="form-control" id="created_date"
                    value="{{ $prd->created_date }}">
            </div>
            <div class="col-md-6">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control"
                    value="{{ $prd->release_date }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="created_by">Created by</label>
                <input type="text" name="created_by" class="form-control" id="created_by"
                    value="{{ $prd->created_by }}">
            </div>
           
            {{-- <div class="col-md-6">
                <label class="form-label" for="unit">Storage</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="storage">
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($gdg as $g)
                            <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="col-md-6">
                <label class="form-label" for="target_order">Target Order</label>
                <input type="number" name="target_order" class="form-control" id="target_order"
                    value="{{ $prd->target_order }}">
            </div>
            
            <div class="col-md-6">
                <label for="range" class="form-label">Range Color</label>
                <input type="text" name="range_color" id="range" class="form-control" value="{{ $prd->range_color }}">
            </div>
            <div class="col-md-6">
                <label for="odour_taste" class="form-label">Odour & Taste</label>
                <input type="text" name="odour_taste" id="odour_taste" class="form-control" value="{{ $prd->odour_taste }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">Unit</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="unit">
                        <option value="{{ $prd->unit }}">{{ $prd->unit }}</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="ml">ml</option>
                        <option value="gram">gram</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="note">Note</label>
                <textarea name="note" id="note" cols="30" rows="1" class="form-control">{{ $prd->note }}</textarea>
            </div>


            <div class="col-md-4" id="rigra1" style="display: none">
                <label for="sg_d20_min" class="form-label">SG d20 Min</label>
                <input type="text" name="sg_d20_min" id="sg_d20_min" class="form-control" value="{{ $prd->sg_d20_min }}">
            </div>
            <div class="col-md-4" id="rigra2" style="display: none">
                <label for="sg_d20_max" class="form-label">SG d20 Max</label>
                <input type="text" name="sg_d20_max" id="sg_d20_max" class="form-control" value="{{ $prd->sg_d20_max }}">
            </div>
            <div class="col-md-4" id="rigra3" style="display: none">
                <label for="sg_d20_target" class="form-label">SG d20 Target</label>
                <input type="text" name="sg_d20_target" id="sg_d20_target" class="form-control" value="{{ $prd->sg_d20_target }}">
            </div>

            <div class="col-md-4" id="rigra4" style="display: none">
                <label for="sg_d25_min" class="form-label">SG d25 Min</label>
                <input type="text" name="sg_d25_min" id="sg_d25_min" class="form-control" value="{{ $prd->sg_d25_min }}">
            </div>
            <div class="col-md-4" id="rigra5" style="display: none">
                <label for="sg_d25_max" class="form-label">SG d25 Max</label>
                <input type="text" name="sg_d25_max" id="sg_d25_max" class="form-control" value="{{ $prd->sg_d25_max }}">
            </div>
            <div class="col-md-4" id="rigra6" style="display: none">
                <label for="sg_d25_target" class="form-label">SG d25 Target</label>
                <input type="text" name="sg_d25_target" id="sg_d25_target" class="form-control" value="{{ $prd->sg_d25_target }}">
            </div>

            <div class="col-md-4" id="rigra7" style="display: none">
                <label for="ri_d20_min" class="form-label">RI d20 Min</label>
                <input type="text" name="ri_d20_min" id="ri_d20_min" class="form-control" value="{{ $prd->ri_d20_min }}">
            </div>
            <div class="col-md-4" id="rigra8" style="display: none">
                <label for="ri_d20_max" class="form-label">RI d20 Max</label>
                <input type="text" name="ri_d20_max" id="ri_d20_max" class="form-control" value="{{ $prd->ri_d20_max }}">
            </div>
            <div class="col-md-4" id="rigra9" style="display: none">
                <label for="ri_d20_target" class="form-label">RI d20 Target</label>
                <input type="text" name="ri_d20_target" id="ri_d20_target" class="form-control" value="{{ $prd->ri_d20_target }}">
            </div>

            <div class="col-md-4" id="rigra10" style="display: none">
                <label for="ri_d25_min" class="form-label">RI d25 Min</label>
                <input type="text" name="ri_d25_min" id="ri_d25_min" class="form-control" value="{{ $prd->ri_d25_min }}">
            </div>
            <div class="col-md-4" id="rigra11" style="display: none">
                <label for="ri_d25_max" class="form-label">RI d25 Max</label>
                <input type="text" name="ri_d25_max" id="ri_d25_max" class="form-control" value="{{ $prd->ri_d25_max }}">
            </div>
            <div class="col-md-4" id="rigra12" style="display: none">
                <label for="ri_d25_target" class="form-label">RI d25 Target</label>
                <input type="text" name="ri_d25_target" id="ri_d25_target" class="form-control" value="{{ $prd->ri_d25_target }}">
            </div>


        
            <div class="mt-3">
                <h3 class="pt-3">
                    FORMULA PRODUCT ===========================
                </h3>
            </div>


            <div id="inputContainer">
                <!-- Container for dynamic inputs -->
                @foreach ($persentase as $index => $persen)
                    <div class="d-flex">
                        <input type="text" class="me-1" name="persentase[]" id="persentase-{{ $index + 1 }}" value="{{ $persen }}" placeholder="Persentase"/>
                        <select class="select2 me-1" name="FAI_code_barang[]" id="FAI_code_barang-{{ $index + 1 }}">
                            <option value="">Select FAI Code</option>
                            @foreach ($brg as $barang)
                                <option value="{{ $barang->FAI_code }}" {{ ($FAI_code[$index] == $barang->FAI_code) ? 'selected' : '' }}>
                                    {{ $barang->FAI_code }}&nbsp;&nbsp;{{ $barang->name }}</option>
                            @endforeach
                            @foreach ($prd1   as $product)
                                    <option value="{{ $product->FAI_code ?? null }}">
                                        {{ $product->FAI_code ?? null }}&nbsp;&nbsp;{{ $product->product_name ?? null }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-info" onclick="removeInput('persentase-{{ $index + 1 }}', 'FAI_code_barang-{{ $index + 1 }}')">Hapus</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary" onclick="addInput()">Tambah Input</button>
            <button type="submit" class="btn btn-primary">Submit</button>

            <script>
                $(document).ready(function() {
                    $('.select2').select2({
                        theme: 'bootstrap',
                    });
                });
        
                let inputCount = {{ count($persentase) }};
        
                function addInput() {
                    inputCount++;
        
                    const inputContainer = document.getElementById('inputContainer');
        
                    const inputGroup = document.createElement('div');
                    inputGroup.innerHTML = `
                        <div class="d-flex mt-1">
                            <input type="text" class="me-1" name="persentase[]" id="persentase-${inputCount}" placeholder="Persentase"/>
                            <select class="select2 form-control me-1" name="FAI_code_barang[]" id="FAI_code_barang-${inputCount}">
                                <option value="">Select FAI Code</option>
                                @foreach ($brg as $barang)
                                    <option value="{{ $barang->FAI_code }}">
                                        {{ $barang->FAI_code }}&nbsp;&nbsp;{{ $barang->name }}</option>
                                @endforeach
                                @foreach ($prd1 as $product)
                                    <option value="{{ $product->FAI_code ?? null }}">
                                        {{ $product->FAI_code ?? null }}&nbsp;&nbsp;{{ $product->product_name ?? null }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-info" onclick="removeInput('persentase-${inputCount}', 'FAI_code_barang-${inputCount}')">Hapus</button>
                        </div>
                    `;
        
                    inputContainer.appendChild(inputGroup);
                    $('.select2').select2(); // Initialize Select2 for new inputs
                }
        
                function removeInput(persentaseId, FAI_codeId) {
                    const persentaseToRemove = document.getElementById(persentaseId);
                    const FAI_codeToRemove = document.getElementById(FAI_codeId);
                    persentaseToRemove.parentElement.remove();
                    FAI_codeToRemove.parentElement.remove();
                }
            </script>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var aspectcoy = document.getElementById('aspectcoy');
            var rigraElements = document.querySelectorAll('[id^="rigra"]');

            aspectcoy.addEventListener('change', function() {
                var selectedCategory = this.value;

                if (selectedCategory === 'LIQUID') {
                    rigraElements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                } else {
                    rigraElements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }
            });
        });
    </script>
@endsection
