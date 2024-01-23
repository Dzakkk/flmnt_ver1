@extends('dashboard')

@section('data_lot')

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">FAI code</th>
        <th scope="col">NO Lot</th>
        <th scope="col">weight</th>
        <th scope="col">unit</th>
        <th scope="col">tanggal_produksi</th>
        <th scope="col">tanggal_expire</th>
        <th scope="col">Rak</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($stlot as $i)
      <tr>
        <th scope="row">{{ $i->FAI_code }}</th>
        <td>{{ $i->no_LOT }}</td>
        <td>{{ $i->weight }}</td>
        <td>{{ $i->unit }}</td>
        <td>{{ $i->tanggal_produksi }}</td>
        <td>{{ $i->tanggal_expire }}</td>
        <td>{{ $i->brgMasuk->id_rak }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
    
@endsection