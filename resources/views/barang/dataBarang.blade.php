@extends('dashboard')

@section('barang')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <?php
    $row = 1;
    ?>

    <style>
        .low-stock {
            background-color: #FFA07A;
        }
    </style>


    <div class="form-floating mb-4">
        <form action="/barang/cari" method="GET" class="form-floating mb-3 d-flex">
            <div class="form-floating container-fluid">
                <input type="text" id="search" name="search" placeholder="Search..." class="form-control">
                <label for="search" class="form-label ms-3"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</label>
            </div>
            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <a class="btn btn-info shadow m-2" href="/newBarang">
        Pendaftaran Barang
    </a>
    @php
        $row = ($brg->currentPage() - 1) * $brg->perPage() + 1;
    @endphp
    <a href="/barangMasuk" class="btn btn-info shadow m-2">Barang Masuk</a>
    <a href="/barangKeluar" class="btn btn-info shadow m-2">Barang keluar</a>

    <div class="table-responsive respon-table shadow">

        <table class="table table-hover table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">FAI_code</th>
                    {{-- <th scope="col">FINA_code</th> --}}
                    <th scope="col">Name</th>
                    {{-- <th scope="col">common_name</th> --}}
                    <th scope="col">kategori barang</th>
                    <th scope="col">aspect</th>
                    <th scope="col">reOrder qty</th>
                    <th scope="col">unit</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody id="search-results">
                @foreach ($brg as $item)
                    <tr>
                        <th scope="row" style="font-size: 13px;">{{ $row }}</th>
                        <td style="font-size: 13px;">{{ $item->FAI_code }}</td>
                        {{-- <td style="font-size: 13px;">{{ $item->FINA_code }}</td> --}}
                        <td style="font-size: 13px;">{!! str_replace(' ', '&nbsp;', $item->name) !!}</td>
                        {{-- <td style="font-size: 13px;">{{ $item->common_name }}</td> --}}
                        <td style="font-size: 13px;">{{ $item->kategori_barang }}</td>
                        <td style="font-size: 13px;">{{ $item->aspect }}</td>
                        <td style="font-size: 13px;">{{ $item->reOrder_qty }}</td>
                        <td style="font-size: 13px;">{{ $item->unit }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm m-1 btn-update" data-bs-toggle="modal"
                                title="Edit" data-bs-target="#viewBackdrop-{{ str_replace('.', '_', $item->FAI_code) }}"
                                data-item-id="{{ $item->FAI_code }}">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm m-1 btn-update" data-bs-toggle="modal"
                                title="Halal" data-bs-target="#halal-{{ str_replace('.', '_', $item->FAI_code) }}"
                                data-item-id="{{ $item->FAI_code }}">
                                حلال                            
                            </button>
                            <button type="button" class="btn btn-warning btn-sm m-1 btn-update" data-bs-toggle="modal"
                                title="Edit" data-bs-target="#staticBackdrop-{{ str_replace('.', '_', $item->FAI_code) }}"
                                data-item-id="{{ $item->FAI_code }}">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-sm m-1" data-bs-toggle="modal"
                                data-bs-placement="top" title="Document"
                                data-bs-target="#dokumen-{{ str_replace('.', '_', $item->FAI_code) }}">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                    $row++;
                    ?>


                    {{-- Document --}}

                    <div class="modal fade" id="halal-{{ str_replace('.', '_', $item->FAI_code) }}" tabindex="-1"
                        aria-labelledby="confirmhalal-{{ str_replace('.', '_', $item->FAI_code) }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="halalReplacementModalLabel">Halal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/update/halal/barang/{{ str_replace('.', '_', $item->FAI_code) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col m-1">
                                            <label class="form-label"
                                                for="halal_certification">Halal Certification</label>
                                            <input type="text" name="halal_certification" class="form-control"
                                                id="halal_certification" value="{{ $item->halal_certification }}">
                                        </div>
                                        <div class="col m-1">
                                            <label for="form-label">Active Until</label>
                                            <input type="date" name="halal_date" id="" class="form-control" value="{{ $item->halal_date }}">
                                        </div>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </form>
                                </div>
                                <div class="modal-footer"> 
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="dokumen-{{ str_replace('.', '_', $item->FAI_code) }}" tabindex="-1"
                        aria-labelledby="confirmDokumen-{{ str_replace('.', '_', $item->FAI_code) }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDokumen--{{ str_replace('.', '_', $item->FAI_code) }}">
                                        Document
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Document of {{ $item->FAI_code }} - {{ $item->name }}
                    
                                    <div>
                                        <strong>Files:</strong>
                                        @if ($item->file)
                                            <ul>
                                                @php
                                                    $files = json_decode($item->file, true);
                                                    if (is_array($files)) {
                                                        foreach ($files as $file) {
                                                            echo '<li>';
                                                            echo '<a href="' .
                                                                asset('document_barang/' . $file) .
                                                                '" target="_blank">' .
                                                                $file .
                                                                '</a>';
                                                            echo '</li>';
                                                        }
                                                    } else {
                                                        echo '<li>No files found</li>';
                                                    }
                                                @endphp
                                            </ul>
                                        @else
                                            <p>No files found</p>
                                        @endif
                                        <form action="/barang/add/file/{{ str_replace('.', '_', $item->FAI_code) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                    
                                            <div>
                                                <label for="file" class="form-label">Unggah File</label>
                                                <i>Max 10 Mb</i>
                                                <div class="file-input-container">
                                                    <input type="file" name="file[]" class="form-control mt-2" multiple>
                                                </div>
                                                {{-- <button type="button" class="btn btn-success btn-sm mt-1"
                                                    onclick="addFileInput()">Tambah File</button> --}}
                                                <button type="submit" class="btn btn-primary btn-sm mt-1">Submit</button>
                                            </div>
                    
                                            {{-- <script>
                                                function addFileInput() {
                                                    var fileInput = `<input type="file" name="file[]" class="form-control mt-2">`;
                                                    $('.file-input-container').append(fileInput);
                                                }
                                            </script>
                     --}}
                                        </form>
                                    </div>
                    
                                    <form action="/barang/update/file/{{ str_replace('.', '_', $item->FAI_code) }}" method="post"
                                        enctype="multipart/form-data" id="fileReplacementForm">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="currentFile" class="form-label">Pilih File yang akan Diganti:</label>
                                            <select class="form-select" id="currentFile" name="deleted_file">
                                                <option value="">Pilih</option>
                                                @if ($item->file)
                                                    @php
                                                        $files = json_decode($item->file, true);
                                                    @endphp
                                                    @foreach ($files as $fileName)
                                                        <option value="{{ $fileName }}">{{ $fileName }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>No files found</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newFile" class="form-label">Pilih File Baru:</label>
                                            <input type="file" class="form-control" id="newFile" name="file[]">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                    </form>
                                </div>
                                
                            </div>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fileReplacementModalLabel">Ganti File</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/barang/delete/file/{{ str_replace('.', '_', $item->FAI_code) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-3">
                                            <label for="currentFile" class="form-label">Pilih File yang akan
                                                Dihapus:</label>
                                            <select class="form-select" id="currentFile" name="deleted_file">
                                                <option value="">Pilih File yang akan Dihapus</option>
                                                @if ($item->file)
                                                    @php
                                                        $files = json_decode($item->file, true);
                                                    @endphp
                                                    @foreach ($files as $fileName)
                                                        <option value="{{ $fileName }}">{{ $fileName }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </div>
                                <div class="modal-footer"> 
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    {{-- View Modal --}}

                    <div class="modal fade" id="viewBackdrop-{{ str_replace('.', '_', $item->FAI_code) }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->FAI_code }} -
                                        {{ $item->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        @php
                                        $reOrderQty = $item->reOrder_qty;
                                        $lot = $item->stock;
                                        $totalQuantity = 0;
                                        $weekUsage = null;
                                    
                                        // Periksa apakah $lot tidak null sebelum menggunakan metode where()
                                        if ($lot) {
                                            $lot = $lot->where('FAI_code', $item->FAI_code)->get();
                                            $totalQuantity = $lot->sum('quantity');
                                        }
                                    
                                        // Periksa apakah $usageQuantities tidak null sebelum menggunakan metode where()
                                        if ($usageQuantities) {
                                            $weekUsage = $usageQuantities->where('FAI_code', $item->FAI_code)->first();
                                        }
                                    @endphp
                                    
                                    @if(!$lot)
                                        <!-- Tambahkan kode yang ingin ditampilkan jika $lot kosong -->
                                        <p>Data lot tidak tersedia.</p>
                                    @endif
                                    
                                    @if(!$weekUsage)
                                        <!-- Tambahkan kode yang ingin ditampilkan jika $weekUsage kosong -->
                                        <p>Data penggunaan mingguan tidak tersedia.</p>
                                    @endif
                                    

                                        <div>
                                            Total Quantity = {{ $totalQuantity }}&nbsp;{{ $item->Kg }}
                                        </div>
                                        <div>
                                            Usage Month
                                            @if ($weekUsage)
                                                {{ $weekUsage->total_usage }}
                                            @else
                                                0
                                            @endif
                                            kg
                                        </div>

                                        @if($lot)
    <ul>
        <li>Lot - Qty - Rak</li>
        @foreach ($lot as $i)
            <li>{{ $i->no_LOT }} - {{ $i->quantity }} - {{ $i->id_rak }}</li>
        @endforeach
    </ul>
@else
    <p>Tidak ada data lot yang tersedia.</p>
@endif

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- edit modal --}}
                    <div class="modal fade modal-dialog-scrollable"
                        id="staticBackdrop-{{ str_replace('.', '_', $item->FAI_code) }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container shadow pt-2 mt-2">
                                        <form action="/barang/update/{{ $item->FAI_code }}" method="POST"
                                            enctype="multipart/form-data" id="customerForm"
                                            class="row g-3">
                                            @method('PUT')
                                            @csrf
                                            <div class="col">
                                                <label for="exampleInputPassword1" class="form-label">FAI_code</label>
                                                <input type="text" name="FAI_code" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $item->FAI_code }}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputPassword1" class="form-label">FINA_code</label>
                                                <input type="text" name="FINA_code" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $item->FINA_code }}">
                                            </div>
                                            <div class="col">
                                                <label for="kategori_barang" class="form-label">kategori barang</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="kategori_barang">
                                                        <option value="{{ $item->kategori_barang }}">
                                                            {{ $item->kategori_barang }}</option>
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
                                            <div class="col">
                                                <label class="form-label" for="aspect">aspect</label>
                                                <div class="input-group">

                                                    <select class="form-select" id="golongan_select" name="aspect">
                                                        <option value="{{ $item->aspect }}">{{ $item->aspect }}</option>
                                                        <option value="LIQUID">LIQUID</option>
                                                        <option value="POWDER">POWDER</option>
                                                        <option value="SOLID">SOLID</option>
                                                        <option value="FLEXIBLE">FLEXIBLE</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col">
                                                <label class="form-label"
                                                    for="alokasi_penyimpanan">alokasi_penyimpanan</label>
                                                <input type="text" name="alokasi_penyimpanan" class="form-control"
                                                    id="alokasi_penyimpanan" value="{{ $item->alokasi_penyimpanan }}">
                                            </div> --}}
                                            <div class="col">
                                                <label for="reOrder_qty" class="form-label">reOrder_qty</label>
                                                <input type="text" name="reOrder_qty" id="reOrder_qty"
                                                    class="form-control" value="{{ $item->reOrder_qty }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="unit">unit</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select" name="unit">
                                                        <option value="{{ $item->unit }}">{{ $item->unit }}</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Pcs">Pcs</option>
                                                        <option value="ml">ml</option>
                                                        <option value="gram">gram</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="supplier" class="form-label">supplier</label>
                                                <select name="supplier" id="supplier" class="form-control select2">
                                                    <option value="{{ $item->supplier }}">{{ $item->supplier }}
                                                    </option>
                                                    @foreach ($supp as $c)
                                                        <option value="{{ $c->supplier_name }}">{{ $c->supplier_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="unit">Jenis Kemasan</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="packaging_type">
                                                        <option value="{{ $item->packaging_type }}">
                                                            {{ $item->packaging_type }}</option>
                                                        <option value="Alumunium Bottle">Alumunium Bottle</option>
                                                        <option value="Alumunium Pouch Pack">Alumunium Pouch Pack</option>
                                                        <option value="Bag">Bag</option>
                                                        <option value="Box with Alumunium Bottle">Box with Alumunium Bottle
                                                        </option>
                                                        <option value="Box with Alumunium Pouch Pack">Box with Alumunium
                                                            Pouch
                                                            Pack
                                                        </option>
                                                        <option value="Carton">Carton</option>
                                                        <option value="Fiber Box">Fiber Box</option>
                                                        <option value="Fiber Drum">Fiber Drum</option>
                                                        <option value="Glass Bottle">Glass Bottle</option>
                                                        <option value="Jerry Can">Jerry Can</option>
                                                        <option value="Metal Can">Metal Can</option>
                                                        <option value="Metal Drum">Metal Drum</option>
                                                        <option value="Plastic Bottle">Plastic Bottle</option>
                                                        <option value="Plastic Container with Polyethylene Inner Bag">
                                                            Plastic
                                                            Container
                                                            with Polyethylene Inner Bag</option>
                                                        <option value="Plastic Drum">Plastic Drum</option>
                                                        <option value="Plastic Jar">Plastic Jar</option>
                                                        <option value="Sacks">Sacks</option>
                                                        <option value="Goody Bag">Goody Bag</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="form-label">documentation</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="CoA"
                                                            name="coa_documentation" id="coa_checkbox">
                                                        <label class="form-check-label" for="coa_checkbox">CoA</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="TDS"
                                                            name="tds_documentation" id="tds_checkbox">
                                                        <label class="form-check-label" for="tds_checkbox">TDS</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" value="MSDS"
                                                            name="msds_documentation" id="msds_checkbox">
                                                        <label class="form-check-label" for="msds_checkbox">MSDS</label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col">
                                                <label class="form-label"
                                                    for="halal_certification">halal_certification</label>
                                                <input type="text" name="halal_certification" class="form-control"
                                                    id="halal_certification" value="{{ $item->halal_certification }}">
                                            </div> --}}
                                            <div class="col">
                                                <label for="name" class="form-label">name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $item->name }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="common_name">common_name</label>
                                                <input type="text" name="common_name" class="form-control"
                                                    id="common_name" value="{{ $item->common_name }}">
                                            </div>
                                            <div class="col">
                                                <label for="brandProduct_code"
                                                    class="form-label">brandProduct_code</label>
                                                <input type="text" name="brandProduct_code" id="brandProduct_code"
                                                    class="form-control" value="{{ $item->brandProduct_code }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label"
                                                    for="chemical_IUPACname">chemical_IUPACname</label>
                                                <input type="text" name="chemical_IUPACname" class="form-control"
                                                    id="chemical_IUPACname" value="{{ $item->chemical_IUPACname }}">
                                            </div>
                                            <div class="col-md-12" id="cas2">
                                                <label class="form-label" for="CAS_number">CAS number</label>
                                                <input type="text" name="CAS_number" class="form-control CAS_number_uh" id="CAS_number_uhe" value="{{ $item->CAS_number }}">
                                            </div>
                                            <div class="uhek col" id="uh">
                            
                                            </div>
                                            <div class="col">
                                                <label for="ex_origin" class="form-label">ex_origin</label>
                                                <select name="ex_origin" id="ex_origin" class="form-control select2">
                                                    <option value="{{ $item->ex_origin }}">{{ $item->ex_origin }}
                                                    </option>
                                                    @foreach ($ex as $c)
                                                        <option value="{{ $c->manufacturer_name }}">
                                                            {{ $c->manufacturer_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="initial_ex">initial_ex</label>
                                                <input type="text" name="initial_ex" class="form-control"
                                                    id="initial_ex" value="{{ $item->initial_code }}">
                                            </div>
                                            <div class="col">
                                                <label for="country_of_origin"
                                                    class="form-label">country_of_origin</label>
                                                <input type="text" name="country_of_origin" id="country_of_origin"
                                                    class="form-control" value="{{ $item->country_of_origin }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="remark">remark</label>
                                                <input type="text" name="remark" class="form-control" id="remark"
                                                    value="{{ $item->remark }}">
                                            </div>
                                            <div class="col">
                                                <label for="usage_level" class="form-label">usage_level</label>
                                                <input type="text" name="usage_level" id="usage_level"
                                                    class="form-control" value="{{ $item->usage_level }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label"
                                                    for="harga_ex_work_USD">harga_ex_work_USD</label>
                                                <input type="number" step="0.01" name="harga_ex_work_USD"
                                                    class="form-control" id="harga_ex_work_USD"
                                                    value="{{ $item->harga_ex_work_USD }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="harga_CIF_USD">harga_CIF_USD</label>
                                                <input type="number" step="0.01" name="harga_CIF_USD"
                                                    class="form-control" id="harga_CIF_USD"
                                                    value="{{ $item->harga_CIF_USD }}">
                                            </div>
                                            <div class="col">
                                                <label for="harga_MOQ_USD" class="form-label">harga_MOQ_USD</label>
                                                <input type="number" step="0.01" name="harga_MOQ_USD"
                                                    id="harga_MOQ_USD" class="form-control"
                                                    value="{{ $item->harga_MOQ_USD }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="appearance">appearance</label>
                                                <input type="text" name="appearance" class="form-control"
                                                    id="appearance" value="{{ $item->appearance }}">
                                            </div>
                                            <div class="col">
                                                <label for="color_rangeColor" class="form-label">color_rangeColor</label>
                                                <input type="text" name="color_rangeColor" id="color_rangeColor"
                                                    class="form-control" value="{{ $item->color_rangeColor }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="odour_taste">odour_taste</label>
                                                <input type="text" name="odour_taste" class="form-control"
                                                    id="odour_taste" value="{{ $item->odour_taste }}">
                                            </div>

                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d20">sg_d20_min</label>
                                                <input type="text" name="sg_d20_min" class="form-control"
                                                    id="spesific_gravity_d20" value="{{ $item->sg_d20_min }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d25">sg_d20_max</label>
                                                <input type="text" name="sg_d20_max" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->sg_d20_max }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label for="refractive_index_d20" class="form-label">sg_d20_target</label>
                                                <input type="text" name="sg_d20_target" id="refractive_index_d20"
                                                    class="form-control" value="{{ $item->sg_d20_target }}">
                                            </div>

                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d20">sg_d25_min</label>
                                                <input type="text" name="sg_d25_min" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->sg_d25_min }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d25">sg_d25_max</label>
                                                <input type="text" name="sg_d25_max" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->sg_d25_max }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label for="refractive_index_d25" class="form-label">sg_d25_target</label>
                                                <input type="text" name="sg_d25_target" id="refractive_index_d25"
                                                    class="form-control" value="{{ $item->sg_d25_target }}">
                                            </div>

                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d20">ri_d20_min</label>
                                                <input type="text" name="ri_d20_min" class="form-control"
                                                    id="spesific_gravity_d20" value="{{ $item->ri_d20_min }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d25">ri_d20_max</label>
                                                <input type="text" name="ri_d20_max" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->ri_d20_max }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label for="refractive_index_d20" class="form-label">ri_d20_target</label>
                                                <input type="text" name="ri_d20_target" id="refractive_index_d20"
                                                    class="form-control" value="{{ $item->ri_d20_target }}">
                                            </div>

                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d20">ri_d25_min</label>
                                                <input type="text" name="ri_d25_min" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->ri_d25_min }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label class="form-label" for="spesific_gravity_d25">ri_d25_max</label>
                                                <input type="text" name="ri_d25_max" class="form-control"
                                                    id="spesific_gravity_d25" value="{{ $item->ri_d25_max }}">
                                            </div>
                                            <div class="col-md-4" id="rigra">
                                                <label for="refractive_index_d25" class="form-label">ri_d25_target</label>
                                                <input type="text" name="ri_d25_target" id="refractive_index_d25"
                                                    class="form-control" value="{{ $item->ri_d25_target }}">
                                            </div>

                                            <div class="col">
                                                <label for="material" class="form-label">material</label>
                                                <input type="text" name="material" id="material"
                                                    class="form-control" value="{{ $item->material }}">
                                            </div>

                                            <div class="col">
                                                <label for="berat_gram" class="form-label">berat_gram</label>
                                                <input type="number" name="berat_gram" id="berat_gram"
                                                    class="form-control" value="{{ $item->berat_gram }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary m-2">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        {{-- @if ()
            
        @endif
        {{ $brg->links() }} --}}
        {{ $brg->links() }}


    </div>


    <a href="/barang/export" class="btn btn-success">export excel <i class="ri-file-excel-2-fill"></i></a>
    <script>
        $(document).ready(function(){
            $('.CAS_number_uh').on('focusout', function(){
                var CAS_number = $(this).val();
                $.ajax({
                    url: '/get-cas', // Ubah dengan URL endpoint Anda
                    method: 'GET', // Gunakan metode GET
                    data: { CAS_number: CAS_number },
                    success: function(response){
                        $('.uhek').empty();
                        if (response.length > 0) {
                            $.each(response, function(index, item){
                                $('.uhek').append('<p class="bg-success text-white p-2 rounded-pill ">Positive List ' + item.nama_kimia + '</p>');
                            });
                        } else {
                            $('.uhek').append('<p class="bg-warning p-2 rounded-pill">Data tidak ditemukan atau bukan termasuk dalam positive list.</p>');
                        }
                    }
                });
            });
        });
    </script>
    <script>

        function updateModalTargets(searchResults) {
            $('.btn-update').each(function() {
                var itemId = $(this).data('bs-target'); // Mengambil nilai dari data-bs-target
                var modalTarget = searchResults.find(itemId); // Mencari modal dengan ID yang sesuai
                $(this).attr('data-bs-target', itemId);
            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            var customerForm = document.getElementById('customerForm');

            $('#staticBackdrop').on('hidden.bs.modal', function() {
                if (customerForm) {
                    customerForm.reset();
                }
            });
        });
    </script>


    
@endsection
