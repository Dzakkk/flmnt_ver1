@extends('dashboard')

@section('qc_check')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td rowspan="2">Lot</td>
                    <td rowspan="2">Code</td>
                    <td rowspan="2">Product Name</td>
                    <td rowspan="2">Qty</td>
                    <td rowspan="2">Customer</td>
                    <td rowspan="2">Tanggal Produksi</td>
                    {{-- <td rowspan="2">Test Methode</td>
                    <td colspan="3">Appereance</td>
                    <td colspan="3">Range Color</td>
                    <td colspan="3">Odour Taste</td>
                    <td colspan="5">Spesific Gravity d20</td>
                    <td colspan="5">Spesific Gravity d25</td>
                    <td colspan="5">Refractive Index d20</td>
                    <td colspan="5">Refractive Index d25</td> --}}
                    <td rowspan="2">Note</td>
                    <td rowspan="2">status</td>
                </tr>
                {{-- <tr>
                    <td>Parameter</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Parameter</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Parameter</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Target</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Target</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Target</td>
                    <td>Value</td>
                    <td>Result</td>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Target</td>
                    <td>Value</td>
                    <td>Result</td>
                </tr> --}}
            </thead>
            <tbody>
                @foreach ($qc as $i)
                    
                <tr>
                    <td>{{ $i->LOT }}</td>
                    <td>{{ $i->FAI_code }}</td>
                    <td>{{ $i->product_name }}</td>
                    <td>{{ $i->qty }}</td>
                    <td>{{ $i->customer }}</td>
                    <td>{{ $i->tanggal_produksi }}</td>
                    {{-- <td>{{ $i->test_methode }}</td>
                    <td>{{ $i->appereance }}</td>
                    <td>{{ $i->color_value }}</td>
                    <td>{{ $i->color_result }}</td>
                    <td>{{ $i->appereance }}</td>
                    <td>{{ $i->odour_value }}</td>
                    <td>{{ $i->odour_result }}</td>
                    <td>{{ $i->appereance }}</td>
                    <td>{{ $i->taste_value }}</td>
                    <td>{{ $i->taste_result }}</td>
                    <td>{{ $i->sg_d20_min }}</td>
                    <td>{{ $i->sg_d20_max }}</td>
                    <td>{{ $i->sg_d20_target }}</td>
                    <td>{{ $i->sg_d20_value }}</td>
                    <td>{{ $i->sg_d20_result }}</td>
                    <td>{{ $i->sg_d25_min }}</td>
                    <td>{{ $i->sg_d25_max }}</td>
                    <td>{{ $i->sg_d25_target }}</td>
                    <td>{{ $i->sg_d25_value }}</td>
                    <td>{{ $i->sg_d25_result }}</td>
                    <td>{{ $i->ri_d20_min }}</td>
                    <td>{{ $i->ri_d20_max }}</td>
                    <td>{{ $i->ri_d20_target }}</td>
                    <td>{{ $i->ri_d20_value }}</td>
                    <td>{{ $i->ri_d20_result }}</td>
                    <td>{{ $i->ri_d25_min }}</td>
                    <td>{{ $i->ri_d25_max }}</td>
                    <td>{{ $i->ri_d25_target }}</td>
                    <td>{{ $i->ri_d25_value }}</td>
                    <td>{{ $i->ri_d25_result }}</td> --}}
                    <td>{{ $i->note }}</td>
                    <td>{{ $i->status }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection