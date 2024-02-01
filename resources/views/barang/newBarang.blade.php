@extends('dashboard')

@section('newBarang')
    <style>
        .hidden {
            display: none
        }
    </style>

    <label for="inputType">Pilih Tipe Form:</label>
    <select id="inputType">
        <option value="a">Barang</option>
        <option value="b">Kemasan</option>
    </select>

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
                        <select class="form-select" id="golongan_select" name="kategori_barang">
                            <option value="">Pilih Kategori</option>
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
                    <label class="form-label" for="TMT">initial_code</label>
                    <div class="input-group">
                        <select class="form-select" id="golongan_select" name="initial_code">
                            <option value="">Pilih Kategori</option>
                            <option value="BFC">BFC</option>
                            <option value="MKC">MKC</option>
                            <option value="PIC">PIC</option>
                            <option value="RMC">RMC</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="number_code" class="form-label">number_code</label>
                    <input type="text" name="number_code" id="number_code" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="alokasi_penyimpanan">alokasi_penyimpanan</label>
                    <input type="text" name="alokasi_penyimpanan" class="form-control" id="alokasi_penyimpanan">
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
                            <option value="gram">gram</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="supplier" class="form-label">supplier</label>
                    <select name="supplier" id="supplier" class="form-control select2" required>
                        <option value="" disabled selected>Select Supplier</option>
                        @foreach ($supp as $c)
                            <option value="{{ $c->id_supplier }}">{{ $c->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <label for="name" class="form-label">name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="common_name">common_name</label>
                    <input type="text" name="common_name" class="form-control" id="common_name">
                </div>
                <div class="col-md-6">
                    <label for="brandProduct_code" class="form-label">brandProduct_code</label>
                    <input type="text" name="brandProduct_code" id="brandProduct_code" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="chemical_IUPACname">chemical_IUPACname</label>
                    <input type="text" name="chemical_IUPACname" class="form-control" id="chemical_IUPACname">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="CAS_number">CAS_number</label>
                    <input type="text" name="CAS_number" class="form-control" id="CAS_number">
                </div>
                <div class="col-md-6">
                    <label for="ex_origin" class="form-label">ex_origin</label>
                    <select name="ex_origin" id="ex_origin" class="form-control select2" required>
                        <option value="" disabled selected>Select ex_origin</option>
                        @foreach ($ex as $c)
                            <option value="{{ $c->manufacturer_name }}">{{ $c->manufacturer_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="initial_ex">initial_ex</label>
                    <input type="text" name="initial_ex" class="form-control" id="initial_ex">
                </div>
                <div class="col-md-6">
                    <label for="country_of_origin" class="form-label">country_of_origin</label>
                    <input type="text" name="country_of_origin" id="country_of_origin" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="remark">remark</label>
                    <input type="text" name="remark" class="form-control" id="remark">
                </div>
                <div class="col-md-6">
                    <label for="usage_level" class="form-label">usage_level</label>
                    <input type="text" name="usage_level" id="usage_level" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="harga_ex_work_USD">harga_ex_work_USD</label>
                    <input type="number" step="0.01" name="harga_ex_work_USD" class="form-control"
                        id="harga_ex_work_USD">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="harga_CIF_USD">harga_CIF_USD</label>
                    <input type="number" step="0.01" name="harga_CIF_USD" class="form-control" id="harga_CIF_USD">
                </div>
                <div class="col-md-6">
                    <label for="harga_MOQ_USD" class="form-label">harga_MOQ_USD</label>
                    <input type="number" step="0.01" name="harga_MOQ_USD" id="harga_MOQ_USD" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="appearance">appearance</label>
                    <input type="text" name="appearance" class="form-control" id="appearance">
                </div>
                <div class="col-md-6">
                    <label for="color_rangeColor" class="form-label">color_rangeColor</label>
                    <input type="text" name="color_rangeColor" id="color_rangeColor" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="odour_taste">odour_taste</label>
                    <input type="text" name="odour_taste" class="form-control" id="odour_taste">
                </div>
                <div class="col-md-6">
                    <label for="material" class="form-label">material</label>
                    <input type="text" name="material" id="material" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="spesific_gravity_d20">spesific_gravity_d20</label>
                    <input type="text" name="spesific_gravity_d20" class="form-control" id="spesific_gravity_d20">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="spesific_gravity_d25">spesific_gravity_d25</label>
                    <input type="text" name="spesific_gravity_d25" class="form-control" id="spesific_gravity_d25">
                </div>
                <div class="col-md-6">
                    <label for="refractive_index_d20" class="form-label">refractive_index_d20</label>
                    <input type="text" name="refractive_index_d20" id="refractive_index_d20" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="refractive_index_d25">refractive_index_d25</label>
                    <input type="text" name="refractive_index_d25" class="form-control" id="refractive_index_d25">
                </div>
                <div class="col-md-6">
                    <label for="berat_gram" class="form-label">berat_gram</label>
                    <input type="number" name="berat_gram" id="berat_gram" class="form-control">
                </div>
                {{-- <div class="col-md-6">
                <label for="golongan" class="form-label">golongan :</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="golongan">
                        <option value="">Pilih golongan</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="tingkat" class="form-label">Tingkat :</label>
                <div class="input-group">
                    <select class="form-select" id="tingkat_select" name="tingkat">
                        <option value="">Pilih tingkat</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
            </div> --}}
                <div class="col-12 pb-4">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
    <div class="hidden" id="formB">
        <div class="container shadow pt-2 mt-2" style="width: 800px">
            <form class="row g-3 d-flex" action="/package/masuk/" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <h5 for="nama_pendidikan" class="form-h5">Daftar Packaging</h5>
                </div>
                <div class="col-md-6">
                    <label for="inpnip" class="form-label">FAI_code</label>
                    <input type="text" name="FAI_code" class="form-control" id="inpFAI_code">
                </div>
                <div class="col-md-6">
                    <label for="supplier" class="form-label">supplier</label>
                    <select name="supplier" id="supplier" class="form-control select2" required>
                        <option value="" disabled selected>Select Supplier</option>
                        @foreach ($supp as $c)
                            <option value="{{ $c->id_supplier }}">{{ $c->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="unit">Jenis Kemasan</label>
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
                <div class="col-md-6">
                    <label for="quantity" class="form-label">quantity</label>
                    <input type="text" name="quantity" id="quantity" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">price</label>
                    <input type="text" name="price" id="price" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="id_rak" class="form-label">id_rak</label>
                    <input type="text" name="id_rak" id="id_rak" class="form-control">
                </div>
                <div class="col-12 pb-4">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Ambil elemen-elemen formulir dan pilihan input
        const inputType = document.getElementById('inputType');
        const formA = document.getElementById('formA');
        const formB = document.getElementById('formB');

        // Tambahkan event listener untuk mendeteksi perubahan pilihan
        inputType.addEventListener('change', function() {
            // Semua formulir disembunyikan terlebih dahulu
            formA.classList.add('hidden');
            formB.classList.add('hidden');

            // Tampilkan formulir yang sesuai dengan pilihan
            if (inputType.value === 'a') {
                formA.classList.remove('hidden');
            } else if (inputType.value === 'b') {
                formB.classList.remove('hidden');
            }
        });
    </script>
@endsection
