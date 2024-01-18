@extends('dashboard')

@section('barangKeluar')
    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Barang Keluar
    </button>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Jenis Penerimaan</th>
                <th scope="col">Tanggal Masuk</th>
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
            @foreach ($brgkeluar as $i)
                <tr>
                    <th scope="row">{{ $i->jenis_pengeluaran }}</th>
                    <td>{{ $i->tanggal_keluar }}</td>
                    <td>{{ $i->shipment }}</td>
                    <td>{{ $i->customer }}</td>
                    <td>{{ $i->NoPO_NoWO }}</td>
                    <td>{{ $i->NoSuratJalankeluar_NoProduksi }}</td>
                    <td>{{ $i->dokumen }}</td>
                    <td>{{ $i->FAI_code }}</td>
                    <td>{{ $i->no_LOT }}</td>
                    <td>{{ $i->jenis_kemasan }}</td>
                    <td>{{ $i->total_qty_keluar_LOT }}</td>
                    <td>
                        <div class="">
                            <a href="/supplier/update/{{ $i->id_pengeluaran }}"
                                class="btn btn-outline-primary btn-sm me-1 mb-1">Ubah</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal-{{ $i->id_pengeluaran }}">Delete</button>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="confirmDeleteModal-{{ $i->id_pengeluaran }}" tabindex="-1"
                    aria-labelledby="confirmDeleteModalLabel-{{ $i->id_pengeluaran }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->id_pengeluaran }}">Confirm
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

                                {{-- <form action="{{ route('supplier.delete', $i->id_pengeluaran) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </form> --}}

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/barang/keluar" method="POST" enctype="multipart/form-data" id="customerForm"
                            class="resettable-form">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label" for="TMT">jenis_pengeluaran</label>
                                <div class="input-group">
                                    <select class="form-select" id="golongan_select" name="jenis_pengeluaran">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option value="Pemakaian Produksi">Pemakaian Produksi</option>
                                        <option value="Pemakaian Sample Lab">Pemakaian Sample Lab</option>
                                        <option value="Pemusnahan">Pemusnahan</option>
                                        <option value="Pengiriman">Pengiriman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Keluar</label>
                                <input type="date" name="tanggal_keluar" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="TMT">shipment</label>
                                <div class="input-group">
                                    <select class="form-select" id="golongan_select" name="shipment">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <option value="AKAS CARGO">AKAS CARGO</option>
                                        <option value="ALS CARGOTAMA">ALS CARGOTAMA</option>
                                        <option value="AS EXPRESS">AS EXPRESS</option>
                                        <option value="AWAN SOLUSINDO EXPRESS">AWAN SOLUSINDO EXPRESS</option>
                                        <option value="BENNY CARGO">BENNY CARGO</option>
                                        <option value="BY CUSTOMER">BY CUSTOMER</option>
                                        <option value="CINTA SAUDARA MANDIRI">CINTA SAUDARA MANDIRI</option>
                                        <option value="DAKOTA CARGO">DAKOTA CARGO</option>
                                        <option value="DELIVEREE LOGISTIC">DELIVEREE LOGISTIC</option>
                                        <option value="DIAMBIL CUSTOMER">DIAMBIL CUSTOMER</option>
                                        <option value="EXPEDISI KRAMAT JATI">EXPEDISI KRAMAT JATI</option>
                                        <option value="FAI - ALBUMI">FAI - ALBUMI</option>
                                        <option value="FAI - ARIEF">FAI - ARIEF</option>
                                        <option value="FAI - IMAN">FAI - IMAN</option>
                                        <option value="FAI - KISWO">FAI - KISWO</option>
                                        <option value="FAI - NANDA">FAI - NANDA</option>
                                        <option value="FAI - RIZAL">FAI - RIZAL</option>
                                        <option value="FAI - WIBOWO">FAI - WIBOWO</option>
                                        <option value="GEMILANG ASRI MAJU">GEMILANG ASRI MAJU</option>
                                        <option value="GEMILANG EXPRESS">GEMILANG EXPRESS</option>
                                        <option value="GO BOX">GO BOX</option>
                                        <option value="GO CAR">GO CAR</option>
                                        <option value="GOJEK">GOJEK</option>
                                        <option value="GRAB CAR">GRAB CAR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="supplier" class="form-label">customer</label>
                                <select name="id_customer" id="customer" class="form-control select2" required>
                                    <option value="" disabled selected>Select customer</option>
                                    @foreach ($cust as $c)
                                        <option value="{{ $c->id_customer }}">{{ $c->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Surat Jalan</label>
                                <input type="text" name="NoSuratJalankeluar_NoProduksi" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">NO PO/WO</label>
                                <input type="text" name="NoPO_NoWO" class="form-control" id="exampleInputEmail1">
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
                            <div class="col-md-6">
                                <label for="barang" class="form-label">FAI</label>
                                <select name="FAI_code" id="barang" class="form-control select2" required>
                                    <option value="" disabled selected>Select FAI</option>
                                    @foreach ($brg as $r)
                                        <option value="{{ $r->FAI_code }}">
                                            {{ $r->FAI_code }}&nbsp;&nbsp;{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">no_LOT</label>
                                <input type="text" name="no_LOT" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Produksi</label>
                                <input type="date" name="tanggal_produksi" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">tanggal_expire</label>
                                <input type="date" name="tanggal_expire" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">total_qty_keluar_LOT</label>
                                <input type="number" name="total_qty_keluar_LOT" class="form-control" id="exampleInputEmail1">
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
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">berat_per_kemasan_KG</label>
                                <input type="number" name="berat_per_kemasan_KG" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">total_QTY_kemasan</label>
                                <input type="number" name="total_QTY_kemasan" class="form-control"
                                    id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">status</label>
                                <input type="text" name="status" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="rak" class="form-label">Rak</label>
                                <select name="id_rak" id="rak" class="form-control select2" required>
                                    <option value="" disabled selected>Select Rak</option>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('staticBackdrop');
            var modalCloseButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
            var customerForm = document.getElementById('customerForm');

            modalElement.addEventListener('shown.bs.modal', function() {
                // Tindakan yang dijalankan ketika modal ditampilkan
            });

            modalElement.addEventListener('hidden.bs.modal', function() {
                // Tindakan yang dijalankan ketika modal ditutup
                customerForm.reset();
            });

            if (modalCloseButton && customerForm) {
                modalCloseButton.addEventListener('click', function() {
                    // Mengosongkan nilai formulir
                    customerForm.reset();
                });
            }
        });
    </script>
@endsection
