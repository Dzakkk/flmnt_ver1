@extends('dashboard')

@section('productionControlBefore')
    <style>
        .short-input {
            width: 470px;
            /* Sesuaikan lebar sesuai kebutuhan */
        }

        .custom-label {
            width: 140px;
        }

        .prs {
            width: max-content;
        }
    </style>

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

    @php
        $no = 1;
    @endphp


    <div class="container mt-4 bg-white">
        <form action="/production/control/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="container-fluid border mt-2">
                    <div class="d-flex">
                        <label for="noProduction" class="col-sm-2 col-form-label custom-label">No. Production</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="noProduction"
                                name="no_production" value="{{ $no_production }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="productionDate" class="col-sm-2 col-form-label custom-label">Production Date</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="date" class="form-control short-input border-0" id="productionDate"
                                name="tanggal_produksi" value="{{ $tanggal_produksi }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="noWorkOrder" class="col-sm-2 col-form-label custom-label">No. Work Order</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="noWorkOrder"
                                name="no_work_order" value="{{ $no_work_order }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="productName" class="col-sm-2 col-form-label custom-label">Product Name</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0 " id="productName"
                                name="product_name" value="{{ $product_name }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="qtyProduction" class="col-sm-2 col-form-label custom-label">Qty. Production</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="qtyProduction"
                                name="quantity" value="{{ $quantity }}">
                        </div>
                    </div>
                </div>

                <div class="container-fluid border mt-2">
                    <div class="d-flex">
                        <label for="lotNumber" class="col-sm-2 col-form-label custom-label">Lot. Number</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="lotNumber" name="no_LOT"
                                value="{{ $no_LOT }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="localCode" class="col-sm-2 col-form-label custom-label">Local Code</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="localCode" name="FAI_code"
                                value="{{ $FAI_code }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="customerName" class="col-sm-2 col-form-label custom-label">Customer Name</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="customerName"
                                name="customer_name" value="{{ $customer_name }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="customerCode" class="col-sm-2 col-form-label custom-label">Customer Code</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="customerCode"
                                name="customer_code" value="{{ $customer_code }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="poCustomer" class="col-sm-2 col-form-label custom-label">PO. Customer</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="poCustomer"
                                name="PO_customer" value="{{ $PO_customer }}">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h4>PRODUCT FORMULA</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>RAW MATERIAL</th>
                            <th>QTY</th>
                            <th>LOT NUMBER</th>
                            <th>EXPIRED DATE</th>
                            <th>SUPPLIER</th>
                            {{-- <th>Info</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            $(document).ready(function(){
                                $('.select2').select2({
                                });
                            });
                        </script>
                        @foreach ($barang_array as $index => $barang_data)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>
                                    
                                    <select name="FAI_code_barang[]" id="FAI_code_barang_{{ $index }}"
                                        class="form-select FAI_code_barang select2" data-index="{{ $index }}">
                                        @php
                                            $lot = \App\Models\Stock::where(
                                                'FAI_code',
                                                $barang_data['FAI_code_barang'],
                                            )->value('no_LOT');
                                            $stock = \App\Models\Stock::where(
                                                'FAI_code',
                                                $barang_data['FAI_code_barang'],
                                            )->value('quantity');
                                        @endphp
                                        <option class="border-0" value="{{ $barang_data['FAI_code_barang'] }}"
                                            data-lot="{{ $lot }}" data-stock="{{ $stock }}">
                                            {{ $barang_data['product_name'] }} - {{ $barang_data['FAI_code_barang'] }}
                                        </option>
                                        @foreach ($prd as $p)
                                            @php
                                                $lot = \App\Models\Stock::where('FAI_code', $p->FAI_code)->value(
                                                    'no_LOT',
                                                );
                                                $stock = \App\Models\Stock::where('FAI_code', $p->FAI_code)->value(
                                                    'quantity',
                                                );
                                            @endphp
                                            <option value="{{ $p->FAI_code }}" class="form-control border-0"
                                                data-lot="{{ $lot }}" data-stock="{{ $stock }}">
                                                {{ $p->product_name }} - {{ $p->FAI_code }}</option>
                                        @endforeach
                                        @foreach ($brg as $p)
                                            @php
                                                $lot = \App\Models\Stock::where('FAI_code', $p->FAI_code)->value(
                                                    'no_LOT',
                                                );
                                                $stock = \App\Models\Stock::where('FAI_code', $p->FAI_code)->value(
                                                    'quantity',
                                                );
                                            @endphp
                                            <option value="{{ $p->FAI_code }}" class="form-control border-0"
                                                data-lot="{{ $lot }}" data-stock="{{ $stock }}">
                                                {{ $p->product_name }} - {{ $p->FAI_code }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="prs"><input type="text" name="persentase_array[]"
                                        value="{{ ($persentase_array[$index] / 100) * $quantity }}"
                                        class="form-control border-0 persentase"></td>
                                <td class="lot">{{ $barang_data['no_LOT'] }}</td>
                                <td class="no_LOT">
                                    <span class="stock-info"></span>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        
                        @php
                            $no++;
                        @endphp





                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td>{{ $quantity }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Export PDF</button>
        </form>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let persentase_inputs = document.querySelectorAll('.persentase');
            persentase_inputs.forEach(function(input) {
                let index = input.dataset.index;
                let FAI_select = document.querySelector('.FAI_code_barang[data-index="' + index + '"]');
                if (FAI_select) {
                    let selected_option = FAI_select.options[FAI_select.selectedIndex];
                    let available_stock = parseFloat(selected_option.dataset.stock);
                    input.addEventListener('input', function() {
                        checkStock(input, available_stock);
                    });
                } else {
                    console.error('Persentase input element not found.');
                }
            });

            function checkStock(element, stock) {
                let input_value = parseFloat(element.value);
                let stockInfo = element.parentElement.nextElementSibling.querySelector('.stock-info');
                if (input_value > stock) {
                    element.classList.add('bg-danger');
                    stockInfo.textContent = 'Stock kurang';
                    stockInfo.classList.add('text-danger');
                } else {
                    element.classList.remove('bg-danger');
                    stockInfo.textContent = 'Stock cukup';
                    stockInfo.classList.remove('text-danger');
                }
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            let FAI_selects = document.querySelectorAll('.FAI_code_barang');
            FAI_selects.forEach(function (select) {
                select.addEventListener('change', function () {
                    let index = select.dataset.index;
                    let persentase_input = document.querySelector('.persentase[data-index="' + index + '"]');
                    let option = select.options[select.selectedIndex];
                    let lot = option.dataset.lot;
                    // Update lot
                    let lot_td = select.parentElement.nextElementSibling.nextElementSibling;
                    lot_td.textContent = lot;
                    // Update persentase
                    persentase_input.value = (parseFloat(persentase_input.value) / 100) * parseFloat(option.dataset.stock);
    
                    // Cek apakah persentase melebihi stok
                    checkStock(persentase_input, option.dataset.stock);
                });
            });
    
            let persentase_inputs = document.querySelectorAll('.persentase');
            persentase_inputs.forEach(function (input) {
                input.addEventListener('input', function () {
                    let index = input.dataset.index;
                    let FAI_select = document.querySelector('.FAI_code_barang[data-index="' + index + '"]');
                    let selected_option = FAI_select.options[FAI_select.selectedIndex];
                    let available_stock = parseFloat(selected_option.dataset.stock);
                    let input_value = parseFloat(input.value);
                    checkStock(input, available_stock);
                });
            });
    
            function checkStock(element, stock) {
                let input_value = parseFloat(element.value);
                if (input_value > stock) {
                    element.classList.add('bg-danger');
                    element.nextElementSibling.textContent = 'Stock kurang';
                } else {
                    element.classList.remove('bg-danger');
                    element.nextElementSibling.textContent = '';
                }
            }
        });
    
    </script> --}}



    {{-- ini yang pertama --}}

    {{-- <script>
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('FAI_code_barang')) {
                var selectedOption = e.target.options[e.target.selectedIndex];
                var row = e.target.closest('tr');
                var noLotField = row.querySelector('.lot');
                var lots = selectedOption.getAttribute('data-lot').split(',');
                var totalNeeded = {{ ($persentase_array[$index] / 100) * $quantity }};
                var totalAvailable = 0;
                noLotField.textContent = lots.join(', ');

            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function cekStock(index, stock, persentase) {
                if (stock < (persentase / 100) * {{ $quantity }}) {
                    $('.no_LOT:eq(' + index + ')').text('Stock Tidak mencukupi');
                } else {
                    $('.no_LOT:eq(' + index + ')').text('Stock Cukup');
                }
            }

            $('.FAI_code_barang').change(function() {
                var index = $(this).attr('id').split('_')[3];
                var stock = $(this).find(':selected').data('lot');
                var persentase = $('input[name="persentase_array[]"]').eq(index).val();
                cekStock(index, stock, persentase);
            });

            @foreach ($barang_array as $index => $barang_data)
                var stock = {{ $barang_data['no_LOT'] }};
                var persentase = {{ ($persentase_array[$index] / 100) * $quantity }};
                cekStock({{ $index }}, stock, persentase);
            @endforeach
        });
    </script> --}}
@endsection
