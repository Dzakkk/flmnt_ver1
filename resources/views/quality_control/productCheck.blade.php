@extends('dashboard')

@section('qc_product')
    <div class="shadow table-responsive">
        <table class="table table-hover">
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
                        <a href="/qc/check/form/inhouse/{{ $i->no_production }}_{{ $i->stockl->no_LOT }}">Link</a>
                    </td>
                </tr>
                @endforeach
                @foreach ($brg as $i)
                <tr>
                    <td>{{ $i->NoSuratJalanMasuk_NoProduksi }}</td>
                    <td>{{ $i->stockL->no_LOT }}</td>
                    <td>{{ $i->barang->name }}</td>
                    <td>{{ $i->FAI_code }}</td>
                    <td>{{ $i->qc_check->test_methode ?? 'Need Verification' }}</td>
                    <td>{{ $i->qc_check->status ?? 'Need Verification' }}</td>
                    <td>
                        <a href="/qc/check/form/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }}">Link</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection