@extends('dashboard')

@section('formula')
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
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID PRODUCT</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">PERSENTASE</th>
                <th scope="col">FAI CODE</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($frm as $i)
                <tr>
                    <th scope="row" style="font-size: 14px;">{{ $i->FAI_code }}</th>
                    <td style="font-size: 14px;">{{ $i->product_name }}</td>
                    <td style="font-size: 14px;">
                        <ul>
                            @foreach (json_decode($i->persentase) as $li)
                                <li>{{ $li }}%</li>
                            @endforeach
                        </ul>
                    </td>
                    <td style="font-size: 14px;">
                        <ul>
                            @foreach (json_decode($i->FAI_code_barang) as $li)
                                <li>{{ $li }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal-{{ $i->FAI_code }}">
                            Produksi
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{ $i->FAI_code }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Produksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container shadow pt-2 mt-2">
                                    <form action="/produksi/product" class="row g-3 d-flex" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <label for="" class="form-label">FAI code Product</label>
                                            <input type="text" class="form-control" name="FAI_code"
                                                value="{{ $i->FAI_code }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="product_name"
                                                value="{{ $i->product_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="supplier" class="form-label">Rak</label>
                                            <select name="id_rak" id="supplier" class="form-control select2" required>
                                                <option value="{{ $i->id_rak }}">{{ $i->id_rak }}</option>
                                                @foreach ($rak as $r)
                                                    <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Weight/Quantity</label>
                                            <input type="text" class="form-control" name="quantity">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="unit">Unit</label>
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
                                            <label for="" class="form-label">jumlah_kemasan</label>
                                            <input type="number" class="form-control" name="jumlah_kemasan">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="unit">Jenis Kemasan</label>
                                            <div class="input-group">
                                                <select class="form-select" id="golongan_select" name="jenis_kemasan">
                                                    <option value="{{ $i->jenis_kemasan }}">{{ $i->jenis_kemasan }}
                                                    </option>
                                                    <option value="Alumunium Bottle">Alumunium Bottle</option>
                                                    <option value="Alumunium Pouch Pack">Alumunium Pouch Pack</option>
                                                    <option value="Bag">Bag</option>
                                                    <option value="Box with Alumunium Bottle">Box with Alumunium Bottle
                                                    </option>
                                                    <option value="Box with Alumunium Pouch Pack">Box with Alumunium Pouch
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
                                                    <option value="Plastic Container with Polyethylene Inner Bag">Plastic
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
                                            <label for="" class="form-label">no_production</label>
                                            <input type="text" class="form-control" name="no_production">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">No.Work Order</label>
                                            <input type="text" class="form-control" name="no_work_order">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">no_LOT</label>
                                            <input type="text" class="form-control" name="no_LOT">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customerCode" class="form-label">Kode Pelanggan</label>
                                            <select id="customerCode-{{ $i->FAI_code }}" class="form-control customer-code-select" name="customer_code">
                                                <option value="">Pilih Kode Pelanggan</option>
                                                @foreach ($customerCodes as $code)
                                                    <option value="{{ $code->customer_code }}">{{ $code->customer_code }}</option>
                                                @endforeach
                                                <option value="new">Tambah Pelanggan Baru</option>
                                            </select>
                                        </div>
                                        
                                        <div id="customerNameSection-{{ $i->FAI_code }}" class="col-md-6" style="display: none;">
                                            <label for="customerName" class="form-label">Nama Pelanggan</label>
                                            <input type="text" id="customerName-{{ $i->FAI_code }}" name="customer_name" class="form-control">
                                        </div>
                                        
                                        <div id="newCustomerSection-{{ $i->FAI_code }}" class="col-md-6" style="display: none;">
                                            <label for="newCustomerCode" class="form-label">Kode Pelanggan Baru</label>
                                            <input type="text" name="customer_code" id="newCustomerCode-{{ $i->FAI_code }}" class="form-control">
                                            <label for="newCustomerName" class="form-label">Nama Pelanggan Baru</label>
                                            <input type="text" name="customer_name" id="newCustomerName-{{ $i->FAI_code }}" class="form-control">
                                        </div>
                                        
                                        

                                        <div class="col-md-6">
                                            <label for="" class="form-label">PO_customer</label>
                                            <input type="text" class="form-control" name="PO_customer">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">tanggal Produksi</label>
                                            <input type="date" class="form-control" name="tanggal_produksi">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">tanggal expire</label>
                                            <input type="date" class="form-control" name="tanggal_expire">
                                        </div>
                                        <div class="col-md-12 mt-2 mb-2">
                                            <button type="submit" class="btn btn-info mb-2">SUBMIT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                uhuh
                            </div>
                        </div>
                    </div>
                </div>
                
                
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.customer-code-select').forEach(function (select) {
                select.addEventListener('change', function () {
                    var customerNameSection = document.getElementById("customerNameSection-" + select.id.split("-")[1]);
                    var newCustomerSection = document.getElementById("newCustomerSection-" + select.id.split("-")[1]);
                    var customerNameInput = document.getElementById("customerName-" + select.id.split("-")[1]);
                    var newCustomerCodeInput = document.getElementById("newCustomerCode-" + select.id.split("-")[1]);
                    var newCustomerNameInput = document.getElementById("newCustomerName-" + select.id.split("-")[1]);
    
                    if (select.value === "new") {
                        customerNameSection.style.display = "none";
                        newCustomerSection.style.display = "block";
                        customerNameInput.value = "";
                        customerNameInput.removeAttribute("readonly");
                    } else {
                        var selectedCustomerCode = select.value;
                        var customerData = {!! json_encode($customerCodes) !!};
                        var customer = customerData.find(function (item) {
                            return item.customer_code == selectedCustomerCode;
                        });
    
                        if (customer) {
                            customerNameInput.value = customer.customer_name;
                            customerNameSection.style.display = "block";
                            newCustomerSection.style.display = "none";
                            newCustomerCodeInput.value = selectedCustomerCode;
                            newCustomerNameInput.value = customer.customer_name;
                        } else {
                            customerNameSection.style.display = "none";
                            newCustomerSection.style.display = "none";
                        }
                    }
                });
            });
        });
    </script>
    
@endsection
