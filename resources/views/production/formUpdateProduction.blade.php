@extends('dashboard')

@section('update_data_production')
    <div class="container-fluid shadow p-3">
        <form action="/produksi/product/update/{{ $stockl->no_production }}" class="row g-3 d-flex" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="col-md-6">
                <label for="" class="form-label">FAI code Product</label>
                <input type="text" class="form-control" name="FAI_code" value="{{ $stockl->FAI_code }}">
            </div>

            <div class="col-md-6">
                <label for="" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" value="{{ $stockl->product->product_name }}">
            </div>
            <div class="col-md-6">
                <label for="supplier" class="form-label">Rak</label>
                <select name="id_rak" id="supplier" class="form-control select2" required>
                    <option value="{{ $stockl->id_rak }}">{{ $stockl->id_rak }}</option>
                    @foreach ($rak as $r)
                        <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">Weight/Quantity</label>
                <input type="text" class="form-control" name="quantity" value="{{ $stockl->quantity }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">Unit</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="unit">
                        <option value="{{ $stockl->unit }}">{{ $stockl->unit }}</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="ml">ml</option>
                        <option value="gram">gram</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">no_production</label>
                <input type="text" class="form-control" name="no_production" value="{{ $stockl->no_production }}">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">No.Work Order</label>
                <input type="text" class="form-control" name="no_work_order" value="{{ $stockl->no_work_order }}">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">no_LOT</label>
                <input type="text" class="form-control" name="no_LOT" value="{{ $stockl->no_LOT }}">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">tanggal Produksi</label>
                <input type="date" class="form-control" name="tanggal_produksi" value="{{ $stockl->tanggal_produksi }}">
            </div>
            <div class="col-md-6">
                <label for="" class="form-label">tanggal expire</label>
                <input type="date" class="form-control" name="tanggal_expire" value="{{ $stockl->tanggal_expire }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="unit">Jenis Kemasan</label>
                <div class="input-group">
                    <select class="form-select" id="golongan_select" name="jenis_kemasan">
                        {{-- <option value="{{ $stockl->kemasan->FAI_code }}">{{ $stockl->kemasan->nama_kemasan }} -
                            {{ $stockl->kemasan->capacity }} Stock&nbsp;{{ $stockl->kemasan->quantity }}
                        </option> --}}
                        @foreach ($kemasan as $stockl)
                            <option value="{{ $stockl->FAI_code }}">{{ $stockl->nama_kemasan }} -
                                {{ $stockl->capacity }} Stock&nbsp;{{ $stockl->quantity }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <script></script>
            <div class="col-md-6">
                <label for="customerCode" class="form-label">Kode Pelanggan</label>
                <select id="customerCode" class="form-control customer-code-select" name="customer_code">
                    <option value="">Pilih Kode Pelanggan</option>
                    @foreach ($custList as $code)
                        <option value="{{ $code->customer_code }}">
                            {{ $code->customer_code }} - {{ $code->customer_name }}
                        </option>
                    @endforeach
                    <option value="new">Tambah Pelanggan Baru</option>
                </select>
            </div>


            <div id="customerNameSection" class="col-md-6 customer-name-section" style="display: none;">
                <label for="customerName" class="form-label">Nama Pelanggan</label>
                <input type="text" name="customer_name" class="form-control customer-name-input">
            </div>

            <div id="newCustomerSection" class="col-md-6 new-customer-section" style="display: none;">
                <label for="newCustomerCode" class="form-label">Customer Item Code</label>
                <input type="text" name="customer_code" class="form-control new-customer-code-input">
                <label for="newCustomerName" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" class="form-control new-customer-name-input">
            </div>


            <div class="col-md-6">
                <label for="" class="form-label">PO_customer</label>
                <input type="text" class="form-control" name="PO_customer">
            </div>

            <div class="col-md-12 mt-2 mb-2">
                <button type="submit" class="btn btn-info mb-2" name="btn1">SUBMIT</button>
                <button type="submit" class="btn btn-info mb-2" name="btn2"
                    formaction="/produksi/product/update/redirect/{{ $stockl->no_production }}">Submit and
                    Redirect</button>
            </div>
        </form>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.customer-code-select').forEach(function(select) {
                select.addEventListener('change', function() {

                    var customerNameSection = document.querySelector('.customer-name-section');
                    var newCustomerSection = document.querySelector('.new-customer-section');
                    var customerNameInput = document.querySelector('.customer-name-input');
                    var newCustomerCodeInput = document.querySelector('.new-customer-code-input');
                    var newCustomerNameInput = document.querySelector('.new-customer-name-input');


                    if (select.value === "new") {
                        customerNameSection.style.display = "none";
                        newCustomerSection.style.display = "block";
                        customerNameInput.value = "";
                        customerNameInput.removeAttribute("readonly");
                    } else {
                        var selectedCustomerCode = select.value;
                        var customerData = {!! json_encode($custList) !!};
                        var customer = customerData.find(function(item) {
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
    </script> --}}

    <script>
        // Initialize Select2 once the DOM is ready
        $(document).ready(function() {
            $('#customerCode').select2();
    
            // Event listener for select change
            $('.customer-code-select').on('change', function() {
                var select = this;
                var customerNameSection = $('.customer-name-section');
                var newCustomerSection = $('.new-customer-section');
                var customerNameInput = $('.customer-name-input');
                var newCustomerCodeInput = $('.new-customer-code-input');
                var newCustomerNameInput = $('.new-customer-name-input');
    
                if (select.value === "new") {
                    customerNameSection.hide();
                    newCustomerSection.show();
                    customerNameInput.val("");
                    customerNameInput.removeAttr("readonly");
                } else {
                    var selectedCustomerCode = select.value;
                    var customerData = {!! json_encode($custList) !!};
                    var customer = customerData.find(function(item) {
                        return item.customer_code == selectedCustomerCode;
                    });
    
                    if (customer) {
                        customerNameInput.val(customer.customer_name);
                        customerNameSection.show();
                        newCustomerSection.hide();
                        newCustomerCodeInput.val(selectedCustomerCode);
                        newCustomerNameInput.val(customer.customer_name);
                    } else {
                        customerNameSection.hide();
                        newCustomerSection.hide();
                    }
                }
            });
        });
    </script>
    

@endsection
