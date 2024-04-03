@extends('dashboard')

@section('permintaan_data')
    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
        Permintaan Bahan
    </button>

    <form action="/permintaan/print" method="get" class="form d-flex m-2">

        <input type="date" name="tanggal" id="tanggal" class="form-control me-2">
        <button type="submit" class="btn btn-success rounded-circle"><i class="bi bi-printer"></i></button>

    </form>



    <div class="table-responsive shadow">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Kode</td>
                    <td>LOT</td>
                    <td>Quantity</td>
                    <td>Request By</td>
                    <td>Departemen</td>
                    <td>Tanggal</td>
                    <td>Keterangan</td>
                    <td>Status</td>
                    </th>
            </thead>
            <tbody>

                @foreach ($pr as $i)
                    <tr>
                        <td></td>
                        <td>{{ $i->nama }}</td>
                        <td>{{ $i->kode }}</td>
                        <td>{{ $i->LOT }}</td>
                        <td>{{ $i->quantity }}</td>
                        <td>{{ $i->request_by }}</td>
                        <td>{{ $i->departemen }}</td>
                        <td>{{ $i->tanggal }}</td>
                        <td>{{ $i->keterangan }}</td>
                        <td>{{ $i->status }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Permintaan Bahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container shadow pt-2 mt-2">
                        <form action="/permintaan/store" method="POST" enctype="multipart/form-data" id="customerForm"
                            class="resettable-form row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="exampleInputPassword1">
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#barang1').select2({
                                        dropdownParent: $('#ehe'),
                                        theme: 'bootstrap',
                                    });
                                });
                            </script>
                            <div class="col-md-6">
                                <label for="barang" class="form-label">Code & Name</label>
                                <div id="ehe" class="form-control">
                                    <select name="kode" id="barang1" class="form-control" style="width: 450px">
                                        <option value="" disabled selected>Select FAI</option>

                                        @foreach ($brg as $r)
                                            <option value="{{ $r->FAI_code }}">
                                                {{ $r->FAI_code }}&nbsp;-&nbsp;{{ $r->name }}</option>
                                        @endforeach
                                        @foreach ($prd as $r)
                                            <option value="{{ $r->FAI_code }}">
                                                {{ $r->FAI_code }}&nbsp;-&nbsp;{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lotlah" class="form-label">LOT</label>
                                <select name="LOT" class="form-control" id="lotlah">
                                    <option value="" disabled selected>Select LOT</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <label for="exampleInputEmail1" class="form-label">quantity</label>
                                <input type="number" name="quantity" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">status</label>
                                <input type="text" name="status" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">request_by</label>
                                <input type="text" name="request_by" class="form-control" id="exampleInputPassword1" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">departemen</label>
                                <input type="text" name="departemen" class="form-control" id="exampleInputPassword1" value="{{ Auth::user()->divisi }}">
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
        $(document).ready(function(){
            $('#barang1').change(function(){
                var kode = $(this).val();
                $.ajax({
                    url: '/get-lot', // Ganti dengan URL endpoint Anda
                    method: 'GET',
                    data: { kode: kode },
                    success: function(response){
                        $('#lotlah').empty();
                        $.each(response, function(index, item){
                            $('#lotlah').append('<option value="' + item.no_LOT + '">' + item.no_LOT + '</option>');
                        });
                    }
                });
            });
        });
    </script>

@endsection
