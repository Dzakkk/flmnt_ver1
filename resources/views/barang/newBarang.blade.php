@extends('dashboard')

@section('newBarang')
    {{-- <style>
        .hidden {
            display: none
        }
    </style>

    <label for="inputType">Pilih Tipe Form:</label>
    <select id="inputType">
        <option value="">Pilih Form</option>
        <option value="a">Barang</option>
        <option value="b">Kemasan</option>
    </select> --}}

    {{-- import data barang yang ada --}}

    {{-- <form action="/import" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Import</button>
    </form> --}}

    <div class="hidden" id="formA">
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
                    <label for="kategori_barang" class="form-label">kategori_barang</label>
                    <div class="input-group">
                        <select class="form-select" id="category" name="kategori_barang">
                            <option value="" selected>Pilih Kategori</option>
                            <option value="BASE(RM)">BASE(RM)</option>
                            <option value="FLAVOR(RM)">FLAVOR(RM)</option>
                            <option value="DILUTION">DILUTION</option>
                            <option value="PACKAGING">PACKAGING</option>
                            <option value="PRODUCT BASE">PRODUCT BASE</option>
                            <option value="PRODUCT FLAVOR">PRODUCT FLAVOR</option>
                            <option value="RM">RM</option>
                            <option value="LAIN LAIN">LAIN LAIN</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="aspect">aspect</label>
                    <div class="input-group">
                        <select class="form-select" id="aspectcoy" name="aspect">
                            <option value="">Pilih Kategori</option>
                            <option value="LIQUID">LIQUID</option>
                            <option value="POWDER">POWDER</option>
                            <option value="SOLID">SOLID</option>
                            <option value="FLEXIBLE">FLEXIBLE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="reOrder_qty" class="form-label">reOrder_qty</label>
                    <input type="text" name="reOrder_qty" id="reOrder_qty" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="unit">unit</label>
                    <div class="input-group">
                        <select class="form-select" id="golongan_select" name="unit">
                            <option value="">Pilih Kategori</option>
                            <option value="Kg">Kg</option>
                            <option value="Pcs">Pcs</option>
                            <option value="ml">ml</option>
                            <option value="Liter">Liter</option>
                            <option value="gram">gram</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="supplier" class="form-label">Supplier</label>
                    <select name="supplier" id="supplier" class="form-control select2" required>
                        <option value="" disabled selected>Select Supplier</option>
                        @foreach ($supp as $c)
                            <option value="{{ $c->id_supplier }}">{{ $c->supplier_name }}</option>
                        @endforeach
                        <option value="new">Tambah Supplier</option>
                    </select>
                </div>

                <div id="supplierNameSection" class="col-md-6" style="display: none;">
                    <label for="supplierName" class="form-label">Nama Supplier</label>
                    <input type="text" id="supplierName" name="supplier" class="form-control">
                </div>

                <div class="col-md-6" id="jenis_kemasan" style="display: none">
                    <label class="form-label" for="unit">Jenis Kemasan</label>
                    <div class="input-group">
                        <select class="form-select" id="golongan_select" name="packaging_type">
                            <option value="">Pilih Kemasan</option>
                            <option value="Alumunium Bottle">Alumunium Bottle</option>
                            <option value="Alumunium Pouch Pack">Alumunium Pouch Pack</option>
                            <option value="Bag">Bag</option>
                            <option value="Box with Alumunium Bottle">Box with Alumunium Bottle</option>
                            <option value="Box with Alumunium Pouch Pack">Box with Alumunium Pouch Pack
                            </option>
                            <option value="Carton">Carton</option>
                            <option value="Fiber Box">Fiber Box</option>
                            <option value="Fiber Drum">Fiber Drum</option>
                            <option value="Glass Bottle">Glass Bottle</option>
                            <option value="Jerry Can">Jerry Can</option>
                            <option value="Metal Can">Metal Can</option>
                            <option value="Metal Drum">Metal Drum</option>
                            <option value="Plastic Bottle">Plastic Bottle</option>
                            <option value="Plastic Container with Polyethylene Inner Bag">Plastic Container
                                with Polyethylene Inner Bag</option>
                            <option value="Plastic Drum">Plastic Drum</option>
                            <option value="Plastic Jar">Plastic Jar</option>
                            <option value="Sacks">Sacks</option>
                            <option value="Goody Bag">Goody Bag</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6" id="kemasan" style="display: none">
                    <label class="form-label" for="unit">Nama Kemasan</label>
                    <div class="input-group">
                        <select class="form-select" id="golongan_select" name="nama_kemasan">
                            <option value="">Pilih Kemasan</option>
                            <option value="Alumunium Bottle">Alumunium Bottle</option>
                            <option value="Alumunium Pouch Pack">Alumunium Pouch Pack</option>
                            <option value="Bag">Bag</option>
                            <option value="Box with Alumunium Bottle">Box with Alumunium Bottle</option>
                            <option value="Box with Alumunium Pouch Pack">Box with Alumunium Pouch Pack
                            </option>
                            <option value="Carton">Carton</option>
                            <option value="Fiber Box">Fiber Box</option>
                            <option value="Fiber Drum">Fiber Drum</option>
                            <option value="Glass Bottle">Glass Bottle</option>
                            <option value="Jerry Can">Jerry Can</option>
                            <option value="Metal Can">Metal Can</option>
                            <option value="Metal Drum">Metal Drum</option>
                            <option value="Plastic Bottle">Plastic Bottle</option>
                            <option value="Plastic Container with Polyethylene Inner Bag">Plastic Container
                                with Polyethylene Inner Bag</option>
                            <option value="Plastic Drum">Plastic Drum</option>
                            <option value="Plastic Jar">Plastic Jar</option>
                            <option value="Sacks">Sacks</option>
                            <option value="Goody Bag">Goody Bag</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="capacity" style="display: none">
                    <label class="form-label" for="capacity">capacity</label>
                    <input type="text" name="capacity" class="form-control" id="capacity">
                </div>
                <div class="col-md-6">
                    <label class="form-label">documentation</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="CoA" name="coa_documentation"
                                id="coa_checkbox">
                            <label class="form-check-label" for="coa_checkbox">CoA</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="TDS" name="tds_documentation"
                                id="tds_checkbox">
                            <label class="form-check-label" for="tds_checkbox">TDS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="MSDS" name="msds_documentation"
                                id="msds_checkbox">
                            <label class="form-check-label" for="msds_checkbox">MSDS</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="halal_certification">halal_certification</label>
                    <input type="text" name="halal_certification" class="form-control" id="halal_certification">
                </div>
                <div class="col-md-6" id="rigra1" style="display: none">
                    <label for="name" class="form-label">name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col-md-6" id="rigra2" style="display: none">
                    <label class="form-label" for="common_name">common_name</label>
                    <input type="text" name="common_name" class="form-control" id="common_name">
                </div>
                <div class="col-md-6" id="rigra3" style="display: none">
                    <label for="brandProduct_code" class="form-label">brandProduct_code</label>
                    <input type="text" name="brandProduct_code" id="brandProduct_code" class="form-control">
                </div>
                <div class="col-md-6" id="cmc" style="display: none;">
                    <label class="form-label" for="chemical_IUPACname">chemical_IUPACname</label>
                    <input type="text" name="chemical_IUPACname" class="form-control" id="chemical_IUPACname">
                </div>
                <div class="col-md-6" id="cas">
                    <label class="form-label" for="CAS_number">CAS_number</label>
                    <select name="CAS_number" id="CAS_number" class="form-control">
                        <option value="">Select CAS</option>
                        @foreach ($cas as $cs)
                            <option value="{{ $cs->CAS }}">{{ $cs->CAS }} || {{ $cs->nama_kimia }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="CAS_number" class="form-control" id="CAS_number"> --}}
                </div>
                <div class="col-md-6">
                    <label for="manufacturer" class="form-label">Manufacturer</label>
                    <select name="ex_origin" id="manufacturer" class="form-control select2" required>
                        <option value="" disabled selected>Select Manufacturer</option>
                        @foreach ($ex as $c)
                            <option value="{{ $c->manufacturer_name }}">{{ $c->manufacturer_name }}</option>
                        @endforeach
                        <option value="new">Add New Manufacturer</option>
                    </select>
                </div>

                <div id="manufacturerNameSection" class="col-md-6" style="display: none;">
                    <label for="manufacturerName" class="form-label">Manufacturer Name</label>
                    <input type="text" id="manufacturerName" name="ex_origin" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="initial_ex">initial_ex</label>
                    <input type="text" name="initial_ex" class="form-control" id="initial_ex">
                </div>
                <div class="col-md-6" id="rigra5" style="display: none">
                    <label for="country_of_origin" class="form-label">country_of_origin</label>
                    <input type="text" name="country_of_origin" id="country_of_origin" class="form-control">
                </div>
                <div class="col-md-6" id="rigra6" style="display: none">
                    <label class="form-label" for="remark">remark</label>
                    <input type="text" name="remark" class="form-control" id="remark">
                </div>
                <div class="col-md-6" id="rigra7" style="display: none">
                    <label for="usage_level" class="form-label">usage_level</label>
                    <input type="text" name="usage_level" id="usage_level" class="form-control">
                </div>
                <div class="col-md-6" id="rigra8" style="display: none">
                    <label class="form-label" for="harga_ex_work_USD">harga_ex_work_USD</label>
                    <input type="number" step="0.01" name="harga_ex_work_USD" class="form-control"
                        id="harga_ex_work_USD">
                </div>
                <div class="col-md-6" id="rigra9" style="display: none">
                    <label class="form-label" for="harga_CIF_USD">harga_CIF_USD</label>
                    <input type="number" step="0.01" name="harga_CIF_USD" class="form-control" id="harga_CIF_USD">
                </div>
                <div class="col-md-6" id="rigra10" style="display: none">
                    <label for="harga_MOQ_USD" class="form-label">harga_MOQ_USD</label>
                    <input type="number" step="0.01" name="harga_MOQ_USD" id="harga_MOQ_USD" class="form-control">
                </div>
                <div class="col-md-6" id="rigra11" style="display: none">
                    <label class="form-label" for="appearance">appearance</label>
                    <input type="text" name="appearance" class="form-control" id="appearance">
                </div>
                <div class="col-md-6" id="rigra12" style="display: none">
                    <label for="color_rangeColor" class="form-label">color_rangeColor</label>
                    <input type="text" name="color_rangeColor" id="color_rangeColor" class="form-control">
                </div>
                <div class="col-md-6" id="odour" style="display: none;">
                    <label class="form-label" for="odour_taste">odour_taste</label>
                    <input type="text" name="odour_taste" class="form-control" id="odour_taste">
                </div>

                <div class="col-md-12">
                    <label for="">Alergen</label>
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="alergen" id="alergen1">
                            <label class="form-check-label" for="alergen1">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alergen" id="alergen2">
                            <label class="form-check-label" for="alergen2">
                                No
                            </label>
                        </div>
                    </div>
                    
                </div>



                <div class="col-md-4" id="woogo1" style="display: none">
                    <label class="form-label" for="spesific_gravity_d20">sg_d20_min</label>
                    <input type="text" name="sg_d20_min" class="form-control" id="spesific_gravity_d20">
                </div>
                <div class="col-md-4" id="woogo2" style="display: none">
                    <label class="form-label" for="spesific_gravity_d25">sg_d20_max</label>
                    <input type="text" name="sg_d20_max" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo3" style="display: none">
                    <label for="refractive_index_d20" class="form-label">sg_d20_target</label>
                    <input type="text" name="sg_d20_target" id="refractive_index_d20" class="form-control">
                </div>

                <div class="col-md-4" id="woogo4" style="display: none">
                    <label class="form-label" for="spesific_gravity_d20">sg_d25_min</label>
                    <input type="text" name="sg_d25_min" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo5" style="display: none">
                    <label class="form-label" for="spesific_gravity_d25">sg_d25_max</label>
                    <input type="text" name="sg_d25_max" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo6" style="display: none">
                    <label for="refractive_index_d25" class="form-label">sg_d25_target</label>
                    <input type="text" name="sg_d25_target" id="refractive_index_d25" class="form-control">
                </div>

                <div class="col-md-4" id="woogo7" style="display: none">
                    <label class="form-label" for="spesific_gravity_d20">ri_d20_min</label>
                    <input type="text" name="ri_d20_min" class="form-control" id="spesific_gravity_d20">
                </div>
                <div class="col-md-4" id="woogo8" style="display: none">
                    <label class="form-label" for="spesific_gravity_d25">ri_d20_max</label>
                    <input type="text" name="ri_d20_max" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo9" style="display: none">
                    <label for="refractive_index_d20" class="form-label">ri_d20_target</label>
                    <input type="text" name="ri_d20_target" id="refractive_index_d20" class="form-control">
                </div>

                <div class="col-md-4" id="woogo10" style="display: none">
                    <label class="form-label" for="spesific_gravity_d20">ri_d25_min</label>
                    <input type="text" name="ri_d25_min" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo11" style="display: none">
                    <label class="form-label" for="spesific_gravity_d25">ri_d25_max</label>
                    <input type="text" name="ri_d25_max" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-4" id="woogo12" style="display: none">
                    <label for="refractive_index_d25" class="form-label">ri_d25_target</label>
                    <input type="text" name="ri_d25_target" id="refractive_index_d25" class="form-control">
                </div>



                <div class="col-md-6" id="material" style="display: none">
                    <label for="material" class="form-label">material</label>
                    <input type="text" name="material" id="material" class="form-control">
                </div>

                <div class="col-md-6" style="display: none">
                    <label for="berat_gram" class="form-label">berat_gram</label>
                    <input type="number" name="berat_gram" id="berat_gram" class="form-control">
                </div>
                <div class="col-12 pb-4">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
                <div class="col-12 pb-4">
                    <a href="/barang" class="btn btn-warning">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var aspectcoy = document.getElementById('aspectcoy');
            var rigraElements = document.querySelectorAll('[id^="woogo"]');

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


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.select2').forEach(function(select) {
                select.addEventListener('change', function() {
                    if (select.id === "supplier") {
                        var supplierNameSection = document.getElementById(
                            "supplierNameSection");
                        var supplierNameInput = document.getElementById("supplierName");
                        var selectedSupplier = select.value;

                        if (selectedSupplier === "new") {
                            supplierNameSection.style.display = "block";
                            supplierNameInput.value = "";
                        } else {
                            supplierNameSection.style.display = "none";
                            supplierNameInput.value = selectedSupplier;
                        }
                    }

                    if (select.id === "manufacturer") {
                        var manufacturerNameSection = document.getElementById(
                            "manufacturerNameSection");
                        var manufacturerNameInput = document.getElementById(
                            "manufacturerName");
                        var selectedManufacturer = select.value;

                        if (select.value === "new") {
                            manufacturerNameSection.style.display = "block";
                            manufacturerNameInput.value = "";
                        } else {
                            manufacturerNameSection.style.display = "none";
                            manufacturerNameInput.value = selectedManufacturer;
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#CAS_number').select2();
        });


        document.getElementById('category').addEventListener('change', function() {
            var celectedCategory = this.value;
            var chemical = document.getElementById('cmc');
            var casNumber = document.getElementById('cas');
            var kemasan = document.getElementById('kemasan')
            var odour = document.getElementById('odour');
            var capacity = document.getElementById('capacity');
            var jenisKemasan = document.getElementById('jenis_kemasan');
            var rigra1 = document.getElementById('rigra1');
            var rigra2 = document.getElementById('rigra2');
            var rigra3 = document.getElementById('rigra3');
            var rigra4 = document.getElementById('rigra4');
            var rigra5 = document.getElementById('rigra5');
            var rigra7 = document.getElementById('rigra7');
            var rigra8 = document.getElementById('rigra8');
            var rigra9 = document.getElementById('rigra9');
            var rigra10 = document.getElementById('rigra10');
            var rigra11 = document.getElementById('rigra11');
            var rigra12 = document.getElementById('rigra12');


            if (celectedCategory === 'PACKAGING') {
                chemical.style.display = 'none';
                casNumber.style.display = 'none';
                jenisKemasan.style.display = 'none';
                kemasan.style.display = 'block';
                capacity.style.display = 'block';
                odour.style.display = 'none';
                rigra1.style.display = 'none';
                rigra2.style.display = 'none';
                rigra3.style.display = 'none';
                rigra4.style.display = 'none';
                rigra5.style.display = 'none';
                rigra6.style.display = 'none';
                rigra7.style.display = 'none';
                rigra8.style.display = 'none';
                rigra9.style.display = 'none';
                rigra10.style.display = 'none';
                rigra11.style.display = 'none';
                rigra12.style.display = 'none';

            } else {
                chemical.style.display = 'block';
                casNumber.style.display = 'block';
                jenisKemasan.style.display = 'block';
                kemasan.style.display = 'none';
                capacity.style.display = 'none';
                odour.style.display = 'block';
                rigra1.style.display = 'block';
                rigra2.style.display = 'block';
                rigra3.style.display = 'block';
                rigra4.style.display = 'block';
                rigra5.style.display = 'block';
                rigra6.style.display = 'block';
                rigra7.style.display = 'block';
                rigra8.style.display = 'block';
                rigra9.style.display = 'block';
                rigra10.style.display = 'block';
                rigra11.style.display = 'block';
                rigra12.style.display = 'block';

            }
        })
    </script>
@endsection
