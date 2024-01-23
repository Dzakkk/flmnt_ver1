@extends('dashboard')

@section('barang')
    <?php
    $row = 1;
    ?>

    <style>
        .low-stock {
            background-color: #FFA07A;
        }
    </style>

    <a class="btn btn-info m-1" href="/newBarang">
        Pendaftaran Barang
    </a>
    <table class="table table-hover shadow mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">FAI_code</th>
                <th scope="col">FINA_code</th>
                <th scope="col">kategori_barang</th>
                <th scope="col">aspect</th>
                <th scope="col">initial_code</th>
                <th scope="col">number_code</th>
                <th scope="col">alokasi_penyimpanan</th>
                <th scope="col">reOrder_qty</th>
                <th scope="col">unit</th>
                <th scope="col">supplier</th>
                <th scope="col">packaging_type</th>
                <th scope="col">documentation</th>
                <th scope="col">halal_certification</th>
                <th scope="col">name</th>
                <th scope="col">common_name</th>
                <th scope="col">brandProduct_code</th>
                <th scope="col">chemical_IUPACname</th>
                <th scope="col">CAS_number</th>
                <th scope="col">ex_origin</th>
                <th scope="col">initial_ex</th>
                <th scope="col">country_of_origin</th>
                <th scope="col">remark</th>
                <th scope="col">usage_level</th>
                <th scope="col">harga_ex_work_USD</th>
                <th scope="col">harga_CIF_USD</th>
                <th scope="col">harga_MOQ_USD</th>
                <th scope="col">appearance</th>
                <th scope="col">color_rangeColor</th>
                <th scope="col">odour_taste</th>
                <th scope="col">material</th>
                <th scope="col">spesific_gravity_d20</th>
                <th scope="col">spesific_gravity_d25</th>
                <th scope="col">refractive_index_d20</th>
                <th scope="col">refractive_index_d25</th>
                <th scope="col">berat_gram</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brg as $item)
                <tr>
                    <th scope="row">{{ $row }}</th>
                    <td>{{ $item->FAI_code }}</td>
                    <td>{{ $item->FINA_code }}</td>
                    <td>{{ $item->kategori_barang }}</td>
                    <td>{{ $item->aspect }}</td>
                    <td>{{ $item->initial_code }}</td>
                    <td>{{ $item->number_code }}</td>
                    <td>{{ $item->alokasi_penyimpanan }}</td>
                    <td>{{ $item->reOrder_qty }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>{{ $item->packaging_type }}</td>
                    <td>{{ $item->documentation }}</td>
                    <td>{{ $item->halal_certification }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->common_name }}</td>
                    <td>{{ $item->brandProduct_code }}</td>
                    <td>{{ $item->chemical_IUPACname }}</td>
                    <td>{{ $item->CAS_number }}</td>
                    <td>{{ $item->ex_origin }}</td>
                    <td>{{ $item->initial_ex }}</td>
                    <td>{{ $item->country_of_origin }}</td>
                    <td>{{ $item->remark }}</td>
                    <td>{{ $item->usage_level }}</td>
                    <td>{{ $item->harga_ex_work_USD }}</td>
                    <td>{{ $item->harga_CIF_USD }}</td>
                    <td>{{ $item->harga_MOQ_USD }}</td>
                    <td>{{ $item->appearance }}</td>
                    <td>{{ $item->color_rangeColor }}</td>
                    <td>{{ $item->odour_taste }}</td>
                    <td>{{ $item->material }}</td>
                    <td>{{ $item->spesific_gravity_d20 }}</td>
                    <td>{{ $item->spesific_gravity_d25 }}</td>
                    <td>{{ $item->refractive_index_d20 }}</td>
                    <td>{{ $item->refractive_index_d25 }}</td>
                    <td>{{ $item->berat_gram }}</td>
                    <td>
                        <div class="">
                            <a href="/petugas/updatePangkat/{{ $item->FAI_code }}"
                                class="btn btn-outline-primary btn-sm me-1 mb-1">Ubah</a>
                        </div>
                    </td>
                </tr>
                <?php
                $row++;
                ?>
            @endforeach
        </tbody>
    </table>
@endsection
