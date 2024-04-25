@extends('dashboard')

@section('editgd')
    <form action="/rak/update/{{ $rg->id_rak }}" method="POST" enctype="multipart/form-data" id="customerForm"
        class="form shadow">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID rak</label>
            <input type="text" name="id_rak" class="form-control" id="exampleInputEmail1" value="{{ $rg->id_rak }}">
        </div>
        <select name="id_gudang" id="FAI_code" class="form-control select2" required>
            <option value="" disabled selected>Pilih Gudang</option>
            @foreach ($gudang as $p)
                <option value="{{ $p->id_gudang }}">{{ $p->nama_gudang }}</option>
            @endforeach
        </select>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">keterangan</label>
            <input type="text" name="keterangan" class="form-control" id="exampleInputEmail1"
                value="{{ $rg->keterangan }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Posisi/Lokasi</label>
            <input type="text" name="posisi_lokasi" class="form-control" id="exampleInputPassword1"
                value="{{ $rg->posisi_lokasi }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">total kapasitas</label>
            <input type="text" name="total_capacity" class="form-control" id="exampleInputEmail1"
                value="{{ $rg->total_capacity }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
