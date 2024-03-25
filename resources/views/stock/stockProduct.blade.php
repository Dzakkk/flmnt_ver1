@extends('dashboard')

@section('stock_product')
    <table class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">FAI code</th>
                <th scope="col">Product Name</th>
                <th scope="col">FINA code</th>
                <th scope="col">Aspect</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $i)
            @php
            $targetOrder = $i->product->target_order;
            $totalQuantity = $i->stockLot->sum('quantity');
        @endphp
        <tr class="{{ $targetOrder !== null && $totalQuantity <= $targetOrder ? 'table-danger' : '' }}">
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->product_name }}</td>
                    <td>{{ $i->FINA_code }}</td>
                    <td>{{ $i->aspect }}</td>
                    <td>{{ $totalQuantity }}</td>
                    <td>{{ $i->unit }}</td>
                    <td>{{ $i->qc_check->status ?? 'Need Verification' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
