@extends('dashboard')

@section('dataProduction')
    
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">no_production</th>
            <th scope="col">FAI Code</th>
            <th scope="col">cleanless</th>
            <th scope="col">oddorless</th>
            <th scope="col">preparation_start</th>
            <th scope="col">preparation_finish</th>
            <th scope="col">wheiging_start</th>
            <th scope="col">wheiging_finish</th>
            <th scope="col">RPM</th>
            <th scope="col">Temperature</th>
            <th scope="col">Setting Time Mixing</th>
            <th scope="col">QC Checked </th>
            <th scope="col">Warehouse</th>
            <th scope="col">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prd as $i)
            <tr>
                <th scope="row" style="font-size: 14px;">{{ $i->no_production }}</th>
                <td style="font-size: 14px;">{{ $i->FAI_code }}</td>
                <td style="font-size: 14px;">{{ $i->cleanless }}</td>
                <td style="font-size: 14px;">{{ $i->oddorless }}</td>
                <td style="font-size: 14px;">{{ $i->preparation_start }}</td>
                <td style="font-size: 14px;">{{ $i->preparation_finish }}</td>
                <td style="font-size: 14px;">{{ $i->wheiging_start }}</td>
                <td style="font-size: 14px;">{{ $i->wheiging_finish }}</td>
                <td style="font-size: 14px;">{{ $i->rpm }}</td>
                <td style="font-size: 14px;">{{ $i->temperature }}</td>
                <td style="font-size: 14px;">{{ $i->setting_time_mixing }}</td>
                <td style="font-size: 14px;">{{ $i->QC_checked }}</td>
                <td style="font-size: 14px;">{{ $i->warehouse }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/product/update/{{ $i->FAI_code }}"
                            class="btn btn-outline-primary btn-sm me-1">Ubah</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal-{{ $i->FAI_code }}">Delete</button>
                    </div>
                </td>
            </tr>
            <div class="modal fade" id="confirmDeleteModal-{{ $i->FAI_code }}" tabindex="-1"
                aria-labelledby="confirmDeleteModalLabel-{{ $i->FAI_code }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->FAI_code }}">Confirm Deletion
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                            {{-- <form action="{{ route('product.delete', $i->FAI_code) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                            </form> --}}

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
<a href="/export/production/control" class="btn btn-primary">export excel</a>
@endsection