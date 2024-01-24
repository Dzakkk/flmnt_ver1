@extends('dashboard')

@section('stock_product')
    <table class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">FAI code</th>
                <th scope="col">Product Name</th>
                <th scope="col">FINA code</th>
                <th scope="col">storage</th>
                <th scope="col">quantity</th>
                <th scope="col">unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $i)
                {{-- @php
                        $reOrderQty = $i->barang->reOrder_qty;
                    @endphp
                    <tr class="{{ ($reOrderQty !== null && $i->quantity <= $reOrderQty) ? 'table-danger' : '' }}"> --}}
                <tr>
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->product_name }}</td>
                    <td>{{ $i->FINA_code }}</td>
                    <td>{{ $i->storage }}</td>
                    <td>{{ $i->weight }}</td>
                    <td>{{ $i->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
