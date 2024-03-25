@extends('dashboard')

@section('data_lot')
<div class="form-floating mb-4">
    <form action="/lot/cari" method="GET" class="form-floating mb-3 d-flex">
        <div class="form-floating container-fluid">
            <input type="text" id="search" name="search" placeholder="Search..." class="form-control">
            <label for="search" class="form-label ms-3"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</label>
        </div>
        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
    </form>
</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">FAI code</th>
                <th scope="col">NO Lot</th>
                <th scope="col">weight</th>
                <th scope="col">unit</th>
                <th scope="col">Kemasan</th>
                <th scope="col">tanggal_produksi</th>
                <th scope="col">tanggal_expire</th>
                <th scope="col">Rak</th>
            </tr>
        </thead>
        <tbody id="search-results">
            @foreach ($stlot as $i)
                <tr>
                    <th scope="row">{{ $i->FAI_code }}</th>
                    <td>{{ $i->no_LOT }}</td>
                    <td>{{ $i->quantity }}</td>
                    <td>{{ $i->unit }}</td>
                    <td>{{ $i->jumlah_kemasan }}&nbsp;{{ $i->jenis_kemasan }}</td>
                    <td>{{ $i->tanggal_produksi }}</td>
                    <td>{{ $i->tanggal_expire }}</td>
                    <td>{{ $i->id_rak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
 

          <!-- Pagination with icons -->
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              {!! $stlot->links() !!}
            </ul>
          </nav><!-- End Pagination with icons -->

    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchTerm = $(this).val();

                $.ajax({
                    url: "{{ route('search.stock') }}",
                    type: "GET",
                    data: {
                        search: searchTerm
                    },
                    success: function(response) {
                        // Clear previous search results
                        $('#search-results').empty();

                        // Iterate over the search results and append them to the table
                        $.each(response.stlot, function(index, i) {
                            var row = '<tr>' +
                                '<td>' + i.FAI_code + '</td>' +
                                '<td>' + i.no_LOT + '</td>' +
                                '<td>' + i.quantity + '</td>' +
                                '<td>' + i.unit + '</td>' +
                                '<td>' + i.jumlah_kemasan + '&nbsp' + i.jenis_kemasan +
                                '</td>' +
                                '<td>' + i.tanggal_produksi + '</td>' +
                                '<td>' + i.tanggal_expire + '</td>' +
                                '<td>' + i.id_rak + '</td>' +
                                '<td><button type = "button" class = "btn btn-primary m-3" data-bs-toggle = "modal" data-bs-target = "#staticBackdrop" >Update</button></td>' +
                                '</tr>';


                            $('#search-results').append(row);
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
