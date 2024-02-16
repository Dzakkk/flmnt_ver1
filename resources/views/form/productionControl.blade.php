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
    </style>
    <div class="container mt-4 bg-white">
        <form action="/production/control/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="container-fluid border mt-2">
                    <div class="d-flex">
                        <label for="noProduction" class="col-sm-2 col-form-label custom-label">No. Production</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="noProduction" name="no_production"
                                value="{{ $no_production }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="productionDate" class="col-sm-2 col-form-label custom-label">Production Date</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="date" class="form-control short-input border-0" id="productionDate" name="tanggal_produksi"
                                value="{{ $tanggal_produksi }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="noWorkOrder" class="col-sm-2 col-form-label custom-label">No. Work Order</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="noWorkOrder" name="no_work_order"
                                value="{{ $no_work_order }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="productName" class="col-sm-2 col-form-label custom-label">Product Name</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0 " id="productName" name="product_name"
                                value="{{ $product_name }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="qtyProduction" class="col-sm-2 col-form-label custom-label">Qty. Production</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="qtyProduction" name="quantity"
                                value="{{ $quantity }}">
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
                            :<input type="text" class="form-control short-input border-0" id="customerName" name="customer_name"
                                value="{{ $customer_name }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="customerCode" class="col-sm-2 col-form-label custom-label">Customer Code</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="customerCode" name="customer_code"
                                value="{{ $customer_code }}">
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="poCustomer" class="col-sm-2 col-form-label custom-label">PO. Customer</label>
                        <div class="col-sm-10 d-flex">
                            :<input type="text" class="form-control short-input border-0" id="poCustomer" name="PO_customer"
                                value="{{ $PO_customer }}">
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
                            <th>CHANGE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang_array as $index => $barang_data)
                            <tr>
                                <td></td>
                                <td>
                                    <select name="FAI_code_barang[]" id="" class="form-select">
                                        <option class="border-0" value="{{ $barang_data['FAI_code_barang'] }}">
                                            {{ $barang_data['product_name'] }}</option>
                                        @foreach ($prd as $p)
                                            <option value="{{ $p->FAI_code }}" class="form-control border-0">{{ $p->product_name }}
                                            </option>
                                        @endforeach
                                        @foreach ($brg as $p)
                                            <option value="{{ $p->FAI_code }}" class="form-control border-0">{{ $p->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="persentase_array[]" value="{{ ($persentase_array[$index] / 100) * $quantity }}" class="form-control border-0"></td>
                                <td>{{ $barang_data['no_LOT'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td>{{ $quantity }}</td>
                            <td></td>
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
@endsection
