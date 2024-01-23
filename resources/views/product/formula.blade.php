@extends('dashboard')

@section('formula')
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID PRODUCT</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">BRG</th>
                <th scope="col">PERSEN</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($frm as $i)
                <tr>
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->product_name }}</td>
                    <td>
                        <ul>
                            @foreach (json_decode($i->persentase) as $li)
                                <li>{{ $li }}%</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
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
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Storage</label>
                                            <input type="text" class="form-control" name="storage">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Weight/Quantity</label>
                                            <input type="text" class="form-control" name="weight">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">unit</label>
                                            <input type="text" class="form-control" name="unit">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <button type="submit" class="btn btn-info">SUBMIT</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
