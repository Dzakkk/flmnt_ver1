@extends('dashboard')

@section('updateProduct')
    
@livewireStyles
    <div class="container shadow pt-2 mt-2" style="width: 800px">
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
                        <option value="{{ $prd->category }}">Pilih Kategori</option>
                        <option value="PRODUCT BASE">PRODUCT BASE</option>
                        <option value="PRODUCT FLAVOR">PRODUCT FLAVOR</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="aspect">Aspect</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="aspect">
                        <option value="{{ $prd->aspect }}">Pilih Kategori</option>
                        <option value="LIQUID">LIQUID</option>
                        <option value="POWDER">POWDER</option>
                        <option value="SOLID">SOLID</option>
                        <option value="FLEXIBLE">FLEXIBLE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $prd->product_name }}">
            </div>
            <div class="col-md-6">
                <label for="build_product" class="form-label">Build Product</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="build_product">
                        <option value="{{ $prd->build_product }}">Pilih Kategori</option>
                        <option value="OSF">OSF</option>
                        <option value="FAI">FAI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="formula_id" class="form-label">Formula id</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="formula_id">
                        <option value="{{ $prd->formula_id }}" >Pilih Kategori</option>
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
                <label for="segment" class="form-label">Segment</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="segment">
                        <option value="{{ $prd->segment }}">Pilih Kategori</option>
                        <option value="SAVORY">SAVORY</option>
                        <option value="SWEET">SWEET</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="solubility" class="form-label">Solubility</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="solubility">
                        <option value="{{ $prd->solubility }}" >Pilih Kategori</option>
                        <option value="OS">OS</option>
                        <option value="WS">WS</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="created_date">Created Date</label>
                <input type="date" name="created_date" class="form-control" id="created_date" value="{{ $prd->created_date }}">
            </div>
            <div class="col-md-6">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control" value="{{ $prd->release_date }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="created_by">Created by</label>
                <input type="text" name="created_by" class="form-control" id="created_by" value="{{ $prd->created_by }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="note">Note</label>
                <textarea name="note" id="note" cols="30" rows="1" class="form-control">{{ $prd->note }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">Storage</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="storage">
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($gdg as $g)
                            <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="target_order">Target Order</label>
                <input type="number" name="target_order" class="form-control" id="target_order" value="{{ $prd->target_order }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">Unit</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="unit">
                        <option value="{{ $prd->unit }}">Pilih Kategori</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="ml">ml</option>
                        <option value="gram">gram</option>
                    </select>
                </div>
            </div>
            <div class="mt-3">
                <h3 class="pt-3">
                    FORMULA PRODUCT ===========================
                </h3>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="persentase-0">Persentase:</label>
                <input type="text" id="persentase-0" name="persentase[]" required class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="kandungan-0">Kandungan:</label>
                <select name="FAI_code_barang[]" id="kandungan-0" class="form-control select2" required>
                    <option value="{{ $prd->FAI_code_barang }}" >{{ $prd->FAI_code_barang }}</option>
                    @foreach ($brg as $c)
                        <option value="{{ $c->FAI_code }}">{{ $c->FAI_code }}</option>
                    @endforeach
                </select>
            </div>


            @livewire('formula-product')
            <button type="submit" class="btn btn-primary" id="add-input">buat</button>
            @livewireScripts

        </form>
    </div>


@endsection