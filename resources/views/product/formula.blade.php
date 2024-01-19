@extends('dashboard')

@section('formula')
    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Tambah Supplier
    </button>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID PRODUCT</th>
                <th scope="col">PRODUCT NAME</th>
                <th scope="col">BRG</th>
                <th scope="col">PERSEN</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($frm as $i)
                <tr>
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->product_name }}</td>
                    <td>
                        <ul>
                            @foreach (json_decode($i->persentase) as $li)
                                <li>{{ $li }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach (json_decode($i->FAI_code_barang) as $li)
                                <li>{{ $li }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
