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
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Produksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
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
                                            <label for="" class="form-label">unit</label>
                                            <input type="text" class="form-control" name="unit">
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
                                            <label for="" class="form-label">customer_name</label>
                                            <input type="text" class="form-control" name="customer_name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">customer_code</label>
                                            <input type="text" class="form-control" name="customer_code">
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
                                        <div class="col-md-12 mt-2">
                                            <button type="submit" class="btn btn-info">SUBMIT</button>
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
        $(document).ready(function() {
            $('#barang').change(function() {
                var FAI_code = $(this).val();
                // Send AJAX request to fetch Rak options
                $.ajax({
                    url: '/getRakOption',
                    type: 'GET',
                    data: {
                        FAI_code: FAI_code
                    },
                    success: function(response) {
                        // Clear existing options
                        $('#rak').empty();
                        // Append new options based on the response
                        $.each(response.options, function(index, option) {
                            $('#rak').append('<option value="' + option.id_rak + '">' +
                                option.id_rak + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
