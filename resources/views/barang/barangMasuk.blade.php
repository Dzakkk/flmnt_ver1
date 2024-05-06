@extends('dashboard')

@section('barangMasuk')
    <style>
        .custom-select {
            position: relative;
        }

        .custom-select select,
        .custom-select input {
            width: 100%;
            padding: 8px 10px;
            font-size: 16px;
        }

        .custom-select select {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .custom-select input {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .custom-select select:focus,
        .custom-select input:focus {
            outline: none;
        }

        .custom-select input[type="text"] {
            display: none;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('staticBackdrop');
            var modalCloseButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
            var customerForm = document.getElementById('customerForm');

            modalElement.addEventListener('shown.bs.modal', function() {});

            modalElement.addEventListener('hidden.bs.modal', function() {
                customerForm.reset();
            });

            if (modalCloseButton && customerForm) {
                modalCloseButton.addEventListener('click', function() {
                    customerForm.reset();
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#barang-masuk').select2({
                dropdownParent: $('#ehe2'),
                theme: 'bootstrap',
            });
        });
    </script>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container-fluid me-2">

        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Bahan Baku Masuk
        </button>
        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
            Bahan Kemasan Masuk
        </button>


        <form action="/kedatangan" method="get" class="form d-flex m-2">

            <input type="date" name="tanggal" id="tanggal" class="form-control me-2">
            <button type="submit" class="btn btn-success rounded-circle"><i class="bi bi-printer"></i></button>

        </form>

    </div>

    {{-- import data barang masuk --}}
    {{-- <form action="/import/masuk" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Import</button>
    </form> --}}

    <div class="table-responsive">
        <table class="table table-hover shadow">
            <thead>
                <tr>
                    <th scope="col">Jenis Penerimaan</th>
                    <th scope="col">Tanggal&nbsp;Masuk</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">No Produksi</th>
                    <th scope="col">NO PO/WO</th>
                    <th scope="col">Kategori Barang</th>
                    <th scope="col">Dokumen</th>
                    <th scope="col">FAI code</th>
                    <th scope="col">no LOT</th>
                    <th scope="col">Jenis Kemasan</th>
                    <th scope="col">Quantity/LOT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($brgmasuk as $i)
                    <tr>
                        <th scope="row" style="font-size: 14px;">{{ $i->jenis_penerimaan }}</th>
                        <td style="font-size: 14px;">{{ $i->tanggal_masuk }}</td>
                        <td style="font-size: 14px;">{{ \App\Models\Supplier::find($i->id_supplier)->supplier_name ?? '' }}
                        </td>
                        <td style="font-size: 14px;">{{ $i->NoSuratJalanMasuk_NoProduksi }}</td>
                        <td style="font-size: 14px;">{{ $i->NoPO_NoWO }}</td>
                        <td style="font-size: 14px;">{{ $i->kategori_barang }}</td>
                        <td style="font-size: 14px;">{{ $i->dokumen }}</td>
                        <td style="font-size: 14px;">{{ $i->FAI_code }}</td>
                        <td style="font-size: 14px;">{{ $i->no_LOT }}</td>
                        <td style="font-size: 14px;">{{ $i->jenis_kemasan }}</td>
                        <td style="font-size: 14px;">{{ $i->qty_masuk_LOT }}</td>
                        <td style="font-size: 14px;">
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm me-1 open-modal" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop-{{ $i->id_penerimaan }}">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-placement="top" title="Document"
                                    data-bs-target="#dokumen-{{ $i->id_penerimaan }}">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal-{{ $i->id_penerimaan }}"><i
                                        class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="confirmDeleteModal-{{ $i->id_penerimaan }}" tabindex="-1"
                        aria-labelledby="confirmDeleteModalLabel-{{ $i->id_penerimaan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->id_penerimaan }}">Confirm
                                        Deletion
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                    {{-- <form action="{{ route('supplier.delete', $i->id_penerimaan) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop-{{ $i->id_penerimaan }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Barang Masuk Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container shadow pt-2 mt-2">
                                        <form action="/barang/masuk/{{ $i->id_penerimaan }}/edit" method="POST"
                                            enctype="multipart/form-data" id="customerForm"
                                            class="resettable-form row g-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="col">
                                                <label class="form-label" for="TMT">Jenis Penerimaan</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="jenis_penerimaan">
                                                        <option value="{{ $i->jenis_penerimaan }}">
                                                            {{ $i->jenis_penerimaan }}</option>
                                                        <option value="Barang Hasil Produksi">Barang Hasil Produksi
                                                        </option>
                                                        <option value="Bahan Baku Produksi">Bahan Baku Produksi</option>
                                                        <option value="PSS">PSS</option>
                                                        <option value="Sample">Sample</option>
                                                        <option value="Barang Lainnya">Barang Lainnya</option>
                                                        <option value="Stock Opname">Stock Opname</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputPassword1" class="form-label">Tanggal
                                                    Masuk</label>
                                                <input type="date" name="tanggal_masuk" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $i->tanggal_masuk }}">
                                            </div>
                                            <div class="col">
                                                <label for="supplier" class="form-label">Supplier</label>
                                                <select name="id_supplier" id="supplier" class="form-control select2"
                                                    required>
                                                    <option value="{{ $i->id_supplier }}">{{ $i->id_supplier }} -
                                                        {{ \App\Models\Supplier::find($i->supplier)->supplier_name ?? null }}
                                                    </option>
                                                    @foreach ($supp as $c)
                                                        <option value="{{ $c->id_supplier }}">{{ $c->id_supplier }} -
                                                            {{ $c->supplier_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Surat Jalan</label>
                                                <input type="text" name="NoSuratJalanMasuk_NoProduksi"
                                                    class="form-control" id="exampleInputPassword1"
                                                    value="{{ $i->NoSuratJalanMasuk_NoProduksi }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">NO PO/WO</label>
                                                <input type="text" name="NoPO_NoWO" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $i->NoPO_NoWO }}">
                                            </div>
                                            <div class="col">
                                                <label for="kategori_barang" class="form-label">Kategori Barang</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="kategori_barang">
                                                        <option value="{{ $i->kategori_barang }}">
                                                            {{ $i->kategori_barang }}
                                                        </option>
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
                                            {{-- <div class="col">
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
                                            </div> --}}
                                            <div class="col">
                                                <label for="barang" class="form-label">FAI Code</label>
                                                <div id="ehe" class="form-control ehe">
                                                    <select name="FAI_code" id="" class="form-control select21"
                                                        style="width: 450px">
                                                        <option value="{{ $i->FAI_code }}">{{ $i->FAI_code }}</option>
                                                        @foreach ($brg as $r)
                                                            <option value="{{ $r->FAI_code }}">
                                                                {{ $r->FAI_code }}&nbsp;-&nbsp;{{ $r->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputPassword1" class="form-label">No LOT</label>
                                                <input type="text" name="no_LOT" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $i->no_LOT }}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                                    Produksi</label>
                                                <input type="date" name="tanggal_produksi" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $i->tanggal_produksi }}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputPassword1"
                                                    class="form-label">tanggal_expire</label>
                                                <input type="date" name="tanggal_expire" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $i->tanggal_expire }}">
                                            </div>
                                            <div class="col">
                                                <label for="exampleInputEmail1" class="form-label">qty_masuk_LOT</label>
                                                <input type="string" name="qty_masuk_LOT" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $i->qty_masuk_LOT }}">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="unit">unit</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select" name="unit">
                                                        <option value="{{ $i->unit }}">{{ $i->unit }}</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Pcs">Pcs</option>
                                                        <option value="ml">ml</option>
                                                        <option value="gram">gram</option>
                                                        <option value="Liter">Liter</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="unit">Jenis Kemasan</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="jenis_kemasan">
                                                        <option value="{{ $i->jenis_kemasan }}">{{ $i->jenis_kemasan }}
                                                        </option>
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
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1"
                                                    class="form-label">satuan_QTY_kemasan</label>
                                                <input type="number" name="satuan_QTY_kemasan" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $i->satuan_QTY_kemasan }}">
                                            </div>
                                            {{-- <div class="col-md-3">
                                                <label for="exampleInputEmail1"
                                                    class="form-label">total_QTY_kemasan</label>
                                                <input type="number" name="total_QTY_kemasan" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $i->total_QTY_kemasan }}">
                                            </div> --}}
                                            <div class="col">
                                                <label for="exampleInputPassword1" class="form-label">status</label>
                                                <input type="text" name="status" class="form-control"
                                                    id="exampleInputPassword1" value="{{ $i->status }}">
                                            </div>
                                            <div class="col">
                                                <label for="supplier" class="form-label">Rak</label>
                                                <select name="id_rak" id="supplier" class="form-control select2"
                                                    required>
                                                    <option value="{{ $i->id_rak }}">{{ $i->id_rak }}</option>
                                                    @foreach ($rak as $r)
                                                        <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                                                    @endforeach
                                                </select>
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
                    <div class="modal fade" id="dokumen-{{ $i->id_penerimaan }}" tabindex="-1"
                        aria-labelledby="confirmDokumen-{{ $i->id_penerimaan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDokumen-{{ $i->id_penerimaan }}">
                                        Document
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Document of {{ $i->FAI_code }} -
                                    @if ($barang = \App\Models\Barang::find($i->FAI_code))
                                        {{ $barang->name }}
                                    @elseif($product = \App\Models\Product::find($i->FAI_code))
                                        {{ $product->product_name }}
                                    @elseif($packaging = \App\Models\Packaging::find($i->FAI_code))
                                        {{ $packaging->nama_kemasan }}
                                    @else
                                        No document found
                                    @endif
                                    <div>
                                        <strong>Files CoA:</strong>
                                        @if ($i->file)
                                            @php
                                                $files = json_decode($i->file, true);
                                                if (is_array($files)) {
                                                    echo '<ul>';
                                                    foreach ($files as $file) {
                                                        echo '<li><a href="' .
                                                            asset('file_masuk/' . $file) .
                                                            '" target="_blank">' .
                                                            $file .
                                                            '</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo '<p>No files found</p>';
                                                }
                                            @endphp
                                        @endif

                                    </div>
                                    <div>
                                        <strong>Other Files:</strong>
                                        @if ($barang)
                                            @php
                                                $files = json_decode($barang->file, true);
                                                if (is_array($files)) {
                                                    echo '<ul>';
                                                    foreach ($files as $file) {
                                                        echo '<li><a href="' .
                                                            asset('document_barang/' . $file) .
                                                            '" target="_blank">' .
                                                            $file .
                                                            '</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo '<p>No files found</p>';
                                                }
                                            @endphp
                                        @elseif ($product)
                                            @php
                                                $files = json_decode($product->file, true);
                                                if (is_array($files)) {
                                                    echo '<ul>';
                                                    foreach ($files as $file) {
                                                        echo '<li><a href="' .
                                                            asset('document_product/' . $file) .
                                                            '" target="_blank">' .
                                                            $file .
                                                            '</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo '<p>No files found</p>';
                                                }
                                            @endphp
                                        @else
                                            <p>No files found</p>
                                        @endif
                                    </div>



                                    <form action="/masuk/add/file/{{ $i->id_penerimaan }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="file" class="form-label">Unggah File</label>
                                            <i>Max 10 Mb</i>
                                            <div class="file-input-container">
                                                <input type="file" name="file[]" class="form-control" multiple>
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
                                        </script> --}}
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
                                    <form action="/masuk/update/file/{{ $i->id_penerimaan }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="currentFile" class="form-label">Pilih File yang akan
                                                Diganti:</label>
                                            <select class="form-select" id="currentFile" name="deleted_file">
                                                <option value="">Pilih File yang akan Diganti</option>
                                                @if ($i->file)
                                                    @php
                                                        $files = json_decode($i->file, true);
                                                    @endphp
                                                    @foreach ($files as $fileName)
                                                        <option value="{{ $fileName }}">{{ $fileName }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newFile" class="form-label">Pilih File Baru:</label>
                                            <input type="file" class="form-control" id="newFile" name="file[]">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                    <form action="/masuk/delete/file/{{ $i->id_penerimaa }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-3">
                                            <label for="currentFile" class="form-label">Pilih File yang akan
                                                Dihapus:</label>
                                            <select class="form-select" id="currentFile" name="deleted_file">
                                                <option value="">Pilih File yang akan Dihapus</option>
                                                @if ($i->file)
                                                    @php
                                                        $files = json_decode($i->file, true);
                                                    @endphp
                                                    @foreach ($files as $fileName)
                                                        <option value="{{ $fileName }}">{{ $fileName }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger">delete Perubahan</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $brgmasuk->links() }}

    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Barang Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/barang/masuk" method="POST" enctype="multipart/form-data" id="customerForm"
                            class="resettable-form row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label" for="TMT">jenis_penerimaan</label>
                                <div class="input-group">
                                    <select class="form-select" id="golongan_select" name="jenis_penerimaan">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option value="Barang Hasil Produksi">Barang Hasil Produksi</option>
                                        <option value="Bahan Baku Produksi">Bahan Baku Produksi</option>
                                        <option value="PSS">PSS</option>
                                        <option value="Sample">Sample</option>
                                        <option value="Barang Lainnya">Barang Lainnya</option>
                                        <option value="Stock Opname">Stock Opname</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="supplier" class="form-label">Supplier</label>
                                <select name="id_supplier" id="supplier" class="form-control select2" required>
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
                            <div class="mb-2">
                                <label for="exampleInputPassword1" class="form-label">Surat Jalan</label>
                                <input type="text" name="NoSuratJalanMasuk_NoProduksi" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">NO PO/WO</label>
                                <input type="text" name="NoPO_NoWO" class="form-control" id="exampleInputEmail1">
                            </div>


                            <div class="col-md-8">
                                <label for="barang" class="form-label">FAI Code</label>
                                <div id="ehe2" class="form-control">
                                    <select name="FAI_code" id="barang-masuk" class="form-control" style="width: 450px">
                                        <option value="" disabled selected>Select FAI code</option>
                                        @foreach ($brg as $r)
                                            <option value="{{ $r->FAI_code }}">
                                                {{ $r->FAI_code }}&nbsp;-&nbsp;{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="exampleInputPassword1" class="form-label">no_LOT</label>
                                <input type="text" name="no_LOT" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Produksi</label>
                                <input type="date" name="tanggal_produksi" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">tanggal_expire</label>
                                <input type="date" name="tanggal_expire" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">documentation</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="CoA"
                                            name="coa_documentation" id="coa_checkbox">
                                        <label class="form-check-label" for="coa_checkbox">CoA</label>
                                    </div>
                                    {{-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="TDS"
                                            name="tds_documentation" id="tds_checkbox">
                                        <label class="form-check-label" for="tds_checkbox">TDS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="MSDS"
                                            name="msds_documentation" id="msds_checkbox">
                                        <label class="form-check-label" for="msds_checkbox">MSDS</label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label for="file" class="form-label">Uploud File</label>
                                <div id="file-input-container">
                                    <input type="file" name="file[]" class="form-control" multiple>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm mt-1"
                                    onclick="addFileInput()">Tambah
                                    File</button>
                            </div>
                            <script>
                                function addFileInput() {
                                    var fileInput = '<input type="file" name="file[]" class="form-control mt-2" multiple>';
                                    $('#file-input-container').append(fileInput);
                                }
                            </script>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">qty_masuk_LOT</label>
                                <input type="string" name="qty_masuk_LOT" class="form-control" id="exampleInputEmail1">
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
                            <div class="col-md-12">
                                <label class="form-label" for="unit">Jenis Kemasan</label>
                                <div class="input-group custom-select">
                                    <select class="form-select" id="options" name="jenis_kemasan">
                                        <option value="">Pilih Kemasan</option>
                                        @foreach ($jenis as $j)
                                            <option value="{{ $j->jenis }}">{{ $j->jenis }}</option>
                                        @endforeach
                                        <option value="custom">Add New</option>
                                        {{-- <option value="Alumunium Bottle">Alumunium Bottle</option>
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
                                        <option value="Goody Bag">Goody Bag</option> --}}
                                    </select>
                                    <input type="text" id="customInput" style="display: none;" name="jenis_kemasan"
                                        class="form-control" placeholder="Enter custom value">

                                </div>
                            </div>
                            <div class="col-md-12">

                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputPassword1" class="form-label">satuan_QTY_kemasan</label>
                                <input type="number" name="satuan_QTY_kemasan" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">total_QTY_kemasan</label>
                                <input type="number" name="total_QTY_kemasan" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">status</label>
                                <input type="text" name="status" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6" id="gdh">
                                <label for="supplier" class="form-label">Rak</label>
                                <select name="id_rak" id="gd" class="form-control select2" required>
                                    <option value="" disabled selected>Select Rak</option>
                                    @foreach ($gudang as $g)
                                        <optgroup label="{{ $g->nama_gudang }}">
                                            @foreach ($rak as $r)
                                                @if ($r->id_gudang == $g->id_gudang)
                                                    <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary m-2">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop2" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Packaging</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/kemasan/masuk" method="POST" enctype="multipart/form-data" id="customerForm"
                            class="resettable-form row g-3">
                            @csrf

                            <div class="col-md-6">
                                <label class="form-label" for="TMT">jenis_penerimaan</label>
                                <div class="input-group">
                                    <select class="form-select" id="golongan_select" name="jenis_penerimaan">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option value="Barang Hasil Produksi">Barang Hasil Produksi</option>
                                        <option value="Bahan Baku Produksi">Bahan Baku Produksi</option>
                                        <option value="PSS">PSS</option>
                                        <option value="Sample">Sample</option>
                                        <option value="Barang Lainnya">Barang Lainnya</option>
                                        <option value="Stock Opname">Stock Opname</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" class="form-control"
                                    id="exampleInputPassword1">
                            </div>

                            <div class="col-md-6">
                                <label for="supplier" class="form-label">Supplier</label>
                                <select name="id_supplier" id="supplier2" class="form-control select2" required>
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach ($supp as $c)
                                        <option value="{{ $c->id_supplier }}">{{ $c->supplier_name }}</option>
                                    @endforeach
                                    <option value="new">Tambah Supplier</option>
                                </select>
                            </div>
                            <div id="supplier2section" class="col-md-6" style="display: none;">
                                <label for="supplierName" class="form-label">Nama Supplier</label>
                                <input type="text" id="supplierName2" name="supplier" class="form-control">
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
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">NO PO/WO</label>
                                <input type="text" name="NoPO_NoWO" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputPassword1" class="form-label">Surat Jalan</label>
                                <input type="text" name="NoSuratJalanMasuk_NoProduksi" class="form-control"
                                    id="exampleInputPassword1">
                            </div>


                            <div class="col-md-7">
                                <label for="barang" class="form-label">FAI Code</label>
                                <select name="FAI_code" class="form-control">
                                    <option value="" disabled selected>Select FAI code</option>
                                    @foreach ($pcr as $r)
                                        <option value="{{ $r->FAI_code }}">
                                            {{ $r->FAI_code }}&nbsp;-&nbsp;{{ $r->nama_kemasan }}&nbsp;-&nbsp;{{ $r->capacity }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-5">
                                <label for="exampleInputPassword1" class="form-label">no_LOT</label>
                                <input type="text" name="no_LOT" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Produksi</label>
                                <input type="date" name="tanggal_produksi" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">tanggal_expire</label>
                                <input type="date" name="tanggal_expire" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">documentation</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="CoA"
                                            name="coa_documentation" id="coa_checkbox">
                                        <label class="form-check-label" for="coa_checkbox">CoA</label>
                                    </div>
                                    {{-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="TDS"
                                            name="tds_documentation" id="tds_checkbox">
                                        <label class="form-check-label" for="tds_checkbox">TDS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="MSDS"
                                            name="msds_documentation" id="msds_checkbox">
                                        <label class="form-check-label" for="msds_checkbox">MSDS</label>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="col-md-7">
                                <label for="file" class="form-label">Uploud File</label>
                                <div id="file-input-container">
                                    <input type="file" name="file[]" class="form-control" multiple>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label for="exampleInputEmail1" class="form-label">qty_masuk_LOT</label>
                                <input type="string" name="quantity" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="col-md-5">
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
                            {{-- <div class="col-md-6">
                                <label class="form-label" for="unit">Jenis Kemasan</label>
                                <div class="input-group">
                                    <select class="form-select" id="golongan_select" name="jenis_kemasan">
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
                            </div> --}}
                            {{-- <div class="col-md-3">
                                <label for="exampleInputPassword1" class="form-label">satuan_QTY_kemasan</label>
                                <input type="number" name="satuan_QTY_kemasan" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="form-label">total_QTY_kemasan</label>
                                <input type="number" name="total_QTY_kemasan" class="form-control"
                                    id="exampleInputEmail1">
                            </div> --}}
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">status</label>
                                <input type="text" name="status" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="supplier" class="form-label">Rak</label>
                                <select name="id_rak" id="supplier" class="form-control select2" required>
                                    <option value="" disabled selected>Select Rak</option>
                                    @foreach ($gudang as $g)
                                        <optgroup label="{{ $g->nama_gudang }}">
                                            @foreach ($rak as $r)
                                                @if ($r->id_gudang == $g->id_gudang)
                                                    <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary m-2">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="/masuk/export" class="btn btn-success">Export</a>
    </div>
    <script>
        $(document).ready(function() {
            $('#options').change(function() {
                if ($(this).val() === 'custom') {
                    $('#customInput').show();
                } else {
                    $('#customInput').hide();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select21').select2({
                dropdownParent: $('.ehe'),
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.select2').forEach(function(select) {
                select.addEventListener('change', function() {
                    if (select.id === "supplier") {
                        var supplierNameSection = document.getElementById("supplierNameSection");
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

                    if (select.id === "supplier2") {
                        var manufacturerNameSection = document.getElementById(
                            "supplier2section");
                        var manufacturerNameInput = document.getElementById("supplierName2");
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
    </script>
@endsection
