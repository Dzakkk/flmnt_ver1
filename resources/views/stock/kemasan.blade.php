@extends('dashboard')

@section('kemasan')
    

<table class="table table-hover shadow">
    <thead>
        <tr>
            <th scope="col">FAI code</th>
            <th scope="col">Nama Kemasan</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Penyimpanan</th>
            <th scope="col">Supplier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($package as $item)
            {{-- @php
                $reOrderQty = $item->barang->reOrder_qty;
                $totalQuantity = $item->stockLots->sum('quantity');
            @endphp
            <tr class="{{ $reOrderQty !== null && $totalQuantity <= $reOrderQty ? 'table-danger' : '' }}"> --}}
            <tr>
                <th scope="row">{{ $item->FAI_code }}</th>
                <td>{{ $item->nama_kemasan }}</td>
                <td>{{ $item->quantity }}&nbsp;Pcs</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->id_rak }}</td>
                <td>{{ $item->supplier }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection