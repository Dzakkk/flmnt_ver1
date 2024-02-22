@extends('dashboard')

@section('rekap_barang')
{{-- <div class="container">
    @foreach ($monthlyUsages as $month => $usages)
        <h4>{{ $month }}</h4>
        <ul>
            @foreach ($usages as $FAI_code => $pemakaian)
                <li>FAI_code {{ $FAI_code }}, pemakaian {{ $pemakaian }} Kg</li>
            @endforeach
        </ul>
    @endforeach
</div> --}}
@php
    $currentYear = \Carbon\Carbon::now()->year;
@endphp
<table class="table table-hover shadow mt-3">
    <thead>
        <tr>
            <th scope="col">Rekap 
                {{ $currentYear }}
            </th>
            <th>
                
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($monthlyUsages as $month => $usages)
            <tr>
                <td data-bs-toggle="collapse" data-bs-target="#collapseExample-{{ $month }}"
                    aria-expanded="false" aria-controls="collapseExample-{{ $month }}"
                    style="cursor: pointer">{{ $month }}
                    <div class="collapse multi-collapse" id="collapseExample-{{ $month }}">
                        <div class="">
                            <div>
                                <ul>
                                    @foreach ($usages as $FAI_code => $pemakaian)
                                    <li>Local Code {{ $FAI_code }} - Usage {{ $pemakaian }} Kg</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="/export/usage/{{ $month }}" class="btn btn-sm btn-success">Export Data {{ $month }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
