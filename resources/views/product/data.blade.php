@extends('dashboard')

@section('data_product')
    {{-- <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Tambah Supplier
</button> --}}
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

    <div class="form-floating mb-4">
        <form action="/product/cari" method="GET" class="form-floating mb-3 d-flex">
            <div class="form-floating container-fluid">
                <input type="text" id="search" name="search" placeholder="Search..." class="form-control">
                <label for="search" class="form-label ms-3"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</label>
            </div>
            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <a href="/product/store" class="btn btn-outline-primary mt-1 mb-1">Tambah Product Baru</a>
    {{-- <a href="/formula" class="btn btn-info mt-1 mb-1">Produksi</a> --}}
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">FAI Code</th>
                    {{-- <th scope="col">FINA Code</th> --}}
                    <th scope="col">Category</th>
                    <th scope="col">Aspect</th>
                    <th scope="col">Name</th>
                    <th scope="col">Build Product</th>
                    <th scope="col">Formula ID</th>
                    <th scope="col">Segment</th>
                    <th scope="col">Solubility</th>
                    {{-- <th scope="col">Created</th>
                <th scope="col">Release </th> --}}
                    <th scope="col">NOTE</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prd as $i)
                    <tr>
                        <th scope="row" style="font-size: 14px;">{{ $i->FAI_code }}</th>
                        {{-- <td style="font-size: 14px;">{{ $i->FINA_code }}</td> --}}
                        <td style="font-size: 14px;">{{ $i->category }}</td>
                        <td style="font-size: 14px;">{{ $i->aspect }}</td>
                        <td style="font-size: 14px;">{{ $i->product_name }}</td>
                        <td style="font-size: 14px;">{{ $i->build_product }}</td>
                        <td style="font-size: 14px;">{{ $i->formula_id }}</td>
                        <td style="font-size: 14px;">{{ $i->segment }}</td>
                        <td style="font-size: 14px;">{{ $i->solubility }}</td>
                        {{-- <td style="font-size: 14px;">{{ $i->created_date }}</td>
                    <td style="font-size: 14px;">{{ $i->release_date }}</td> --}}
                        <td style="font-size: 14px;">{{ $i->note }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-placement="top" title="Formula"
                                    data-bs-target="#viewModal-{{ $i->FAI_code }}"><i class="ri-flask-line"></i></button>
                                <button type="button" class="btn btn-success btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-placement="top" title="Production"
                                    data-bs-target="#produksi-{{ $i->FAI_code }}">
                                    <i class="bi bi-gear"></i>
                                </button>
                                <a href="/product/update/{{ $i->FAI_code }}" class="btn btn-warning btn-sm me-1"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                        class="ri-edit-line"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-placement="top" title="Delete"
                                    data-bs-target="#confirmDeleteModal-{{ $i->FAI_code }}"><i
                                        class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>


                    {{-- View Modal --}}

                    <div class="modal fade" id="viewModal-{{ $i->FAI_code }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Formula {{ $i->FAI_code }} -
                                        {{ $i->product_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        @php
                                            $FAI_codes = json_decode($i->formula->FAI_code_barang);
                                            $persentases = json_decode($i->formula->persentase);
                                        @endphp

                                        @if ($FAI_codes && $persentases)
                                            @for ($index = 0; $index < count($FAI_codes) && $index < count($persentases); $index++)
                                                <li class="underline">{{ $persentases[$index] }}% -
                                                    {{ $FAI_codes[$index] }} -
                                                    {{ \App\Models\Barang::find($FAI_codes[$index])->name }}
                                                </li>
                                            @endfor
                                        @else
                                            <li>No data available</li>
                                        @endif


                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="confirmDeleteModal-{{ $i->FAI_code }}" tabindex="-1"
                        aria-labelledby="confirmDeleteModalLabel-{{ $i->FAI_code }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->FAI_code }}">Confirm
                                        Deletion
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>

                                    <form action="{{ route('product.delete', $i->FAI_code) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- Produksi modal --}}

                    <div class="modal fade" id="produksi-{{ $i->FAI_code }}" tabindex="-1"
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
                                                <select name="id_rak" id="supplier" class="form-control select2"
                                                    required>
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
                                            {{-- <div class="col-md-6">
                                            <label for="" class="form-label">jumlah_kemasan</label>
                                            <input type="number" class="form-control" name="jumlah_kemasan">
                                        </div> --}}
                                            <div class="col-md-6">
                                                <label class="form-label" for="unit">Jenis Kemasan</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="golongan_select"
                                                        name="jenis_kemasan">

                                                        @foreach ($kemasan as $i)
                                                            <option value="{{ $i->FAI_code }}">{{ $i->nama_kemasan }} -
                                                                {{ $i->capacity }} Stock&nbsp;{{ $i->quantity }}
                                                            </option>
                                                        @endforeach
                                                        {{-- <option value="Alumunium Bottle">Alumunium Bottle</option>
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
                                                    <option value="Goody Bag">Goody Bag</option> --}}
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
                                            <div class="col-md-6 boo">
                                                <label for="customerCode" class="form-label">Kode Pelanggan</label>
                                                <select id="customerCode" class="form-control customer-code-select"
                                                    name="customer_code">
                                                    <option value="">Pilih Kode Pelanggan</option>
                                                    @foreach ($custList as $code)
                                                        <option value="{{ $code->customer_code }}">
                                                            {{ $code->customer_code }} - {{ $code->customer_name }}
                                                        </option>
                                                    @endforeach
                                                    <option value="new">Tambah Pelanggan Baru</option>
                                                </select>
                                            </div>

                                            <div id="customerNameSection" class="col-md-6 customer-name-section"
                                                style="display: none;">
                                                <label for="customerName" class="form-label">Nama Pelanggan</label>
                                                <input type="text" name="customer_name"
                                                    class="form-control customer-name-input">
                                            </div>

                                            <div id="newCustomerSection" class="col-md-6 new-customer-section"
                                                style="display: none;">
                                                <label for="newCustomerCode" class="form-label">Customer Item Code</label>
                                                <input type="text" name="customer_code"
                                                    class="form-control new-customer-code-input">
                                                <label for="newCustomerName" class="form-label">Customer Name</label>
                                                <input type="text" name="customer_name"
                                                    class="form-control new-customer-name-input">
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

                {{ $prd->links() }}
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
    // Initialize Select2 for all customer code selects
    $('.customer-code-select').each(function() {
        $(this).select2({
            dropdownParent: $(this).closest('.boo')
        });
    });

    // Add event listener for select change
    $('.customer-code-select').on('change', function() {
        var modal = $(this).closest('.modal-content');
        var customerNameSection = modal.find('.customer-name-section');
        var newCustomerSection = modal.find('.new-customer-section');
        var customerNameInput = modal.find('.customer-name-input');
        var newCustomerCodeInput = modal.find('.new-customer-code-input');
        var newCustomerNameInput = modal.find('.new-customer-name-input');

        if ($(this).val() === "new") {
            customerNameSection.hide();
            newCustomerSection.show();
            customerNameInput.val("");
            customerNameInput.removeAttr("readonly");
        } else {
            var selectedCustomerCode = $(this).val();
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
