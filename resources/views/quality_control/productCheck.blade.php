@extends('dashboard')

@section('qc_product')
    <style>
        td {
            font-size: 13px;
        }
    </style>
    <div class="container-fluid d-flex">
        <div class=" me-1">
            <h5>Inhouse</h5>
            <table class="shadow table table-hover">
                <thead>
                    <tr>
                        <td>No Production</td>
                        <td>No Lot</td>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Test</td>
                        <td>Status</td>
                        <td>Check</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pro as $i)
                        <tr>
                            <td>{{ $i->no_production }}</td>
                            <td>{{ $i->stockl->no_LOT }}</td>
                            <td>{{ $i->product->product_name }}</td>
                            <td>{{ $i->FAI_code }}</td>
                            <td>{{ $i->qc_check->test_methode ?? 'Need Verification' }}</td>
                            <td>{{ $i->qc_check->status ?? 'Need Verification' }}</td>
                            <td>
                                <a href="
                                @if (!$i->qc_check) 
                                    /qc/check/form/inhouse/{{ $i->no_production }}_{{ $i->stockl->no_LOT }}
                                @else
                                /qc/check/update/inhouse/{{ $i->no_production }}_{{ $i->stockl->no_LOT }} @endif"
                                    class="btn btn-primary
                                    @if ($i->qc_check && $i->qc_check->status == 'PASS') btn-success
                                    @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                        btn-danger @endif">

                                    @if (($i->qc_check && $i->qc_check->status == 'PASS') || ($i->qc_check && $i->qc_check->status == 'REJECT'))
                                        Review
                                    @else
                                        Check
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class=" ms-1">
            <h5>Incoming</h5>
            <table class="shadow table table-hover">
                <thead>
                    <tr>
                        <td>No Production</td>
                        <td>No Lot</td>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Test</td>
                        <td>Status</td>
                        <td>Check</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brg as $i)
                        <tr>
                            <td>{{ $i->NoSuratJalanMasuk_NoProduksi }}</td>
                            <td>{{ $i->stockL->no_LOT }}</td>
                            <td>{{ $i->barang->name }}</td>
                            <td>{{ $i->FAI_code }}</td>
                            <td>{{ $i->qc_check->test_methode ?? 'Need Verification' }}</td>
                            <td>{{ $i->qc_check->status ?? 'Need Verification' }}</td>
                            <td>
                                {{-- <a href="/qc/check/form/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }}"
                                    class="btn btn-primary @if ($i->qc_check && $i->qc_check->status == 'PASS') btn-success
                                @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                    btn-danger @endif">

                                    @if (($i->qc_check && $i->qc_check->status == 'PASS') || ($i->qc_check && $i->qc_check->status == 'REJECT'))
                                        Review
                                    @else
                                        Check
                                    @endif --}}
                                    <a href="
                                @if (!$i->qc_check) 
                                    /qc/check/form/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }}
                                @else
                                /qc/check/update/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }} @endif"
                                    class="btn btn-primary
                                    @if ($i->qc_check && $i->qc_check->status == 'PASS') btn-success
                                    @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                        btn-danger @endif">

                                    @if (($i->qc_check && $i->qc_check->status == 'PASS') || ($i->qc_check && $i->qc_check->status == 'REJECT'))
                                        Review
                                    @else
                                        Check
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
