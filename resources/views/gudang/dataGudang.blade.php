@extends('dashboard')

@section('gudang')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <?php $row = 1; ?>
    <table class="table table-hover shadow mt-3">
        <button class="btn btn-primary me-1 " type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse"
            aria-expanded="false"
            aria-controls="@foreach ($gudang as $i)
            collapseExample-{{ $i->id_gudang }} @endforeach">
            Lihat Rak
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tambah Rak
        </button>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAMA GUDANG</th>
                <th scope="col">Jumlah Rak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gudang as $item)
                <tr>
                    <th scope="row">{{ $row }}</th>
                    <td data-bs-toggle="collapse" data-bs-target="#collapseExample-{{ $item->id_gudang }}"
                        aria-expanded="false" aria-controls="collapseExample-{{ $item->id_gudang }}"
                        style="cursor: pointer">{{ $item->nama_gudang }}
                        <div class="collapse multi-collapse" id="collapseExample-{{ $item->id_gudang }}">
                            <div class="">
                                <div>
                                    <ul>
                                        <li>
                                            <ul class="list-group list-group-horizontal">
                                                <li class="list-group-item w-25">RAK</li>
                                                <li class="list-group-item w-25">Keterangan</li>
                                                <li class="list-group-item w-25">Lokasi</li>
                                                <li class="list-group-item w-25">Kapasitas/Kg</li>
                                            </ul>
                                        </li>
                                        @foreach ($item->rak as $rg)
                                            <li>
                                                <ul class="list-group list-group-horizontal">
                                                    <li class="list-group-item w-25">{{ $rg->id_rak }}</li>
                                                    <li class="list-group-item w-25">{{ $rg->keterangan }}</li>
                                                    <li class="list-group-item w-25">{{ $rg->posisi_lokasi }}</li>
                                                    <li class="list-group-item w-25">{{ $rg->kapasitas }} Kg</li>
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ $item->rak->count() }}
                    </td>
                </tr>
                <?php $row++; ?>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/rak/store" method="POST" enctype="multipart/form-data" id="customerForm"
                        class="resettable-form">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">ID rak</label>
                            <input type="text" name="id_rak" class="form-control" id="exampleInputEmail1">
                        </div>
                        <select name="id_gudang" id="FAI_code" class="form-control select2" required>
                            <option value="" disabled selected>Pilih Gudang</option>
                            @foreach ($gudang as $p)
                                <option value="{{ $p->id_gudang }}">{{ $p->nama_gudang }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">keterangan</label>
                            <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Posisi/Lokasi</label>
                            <input type="text" name="posisi_lokasi" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">kapasitas</label>
                            <input type="text" name="kapasitas" class="form-control" id="exampleInputEmail1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
