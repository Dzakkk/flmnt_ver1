@extends('dashboard')

@section('stock')
    <table class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">FAI code</th>
                <th scope="col">Product Name</th>
                <th scope="col">Common Name</th>
                <th scope="col">Aspect</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit</th>
                <th scope="col">penggunaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $item)
                @php
                    $reOrderQty = $item->barang->reOrder_qty;
                    $totalQuantity = $item->stockLots->sum('quantity');
                @endphp
                <tr class="{{ $reOrderQty !== null && $totalQuantity <= $reOrderQty ? 'table-danger' : '' }}">
                    <th scope="row">{{ $item->FAI_code }}</th>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->common_name }}</td>
                    <td>{{ $item->aspect }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $totalQuantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>
                        @php
                            $monthlyUsage = $usageQuantity->where('FAI_code', $item->FAI_code)->first();
                        @endphp
                        @if($monthlyUsage)
                            {{ $monthlyUsage->total_usage }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
