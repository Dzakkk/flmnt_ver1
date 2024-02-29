@extends('dashboard')

@section('home')
    <style>
        .pagination-links svg {
            width: 16px !important;
            height: 16px !important;
        }

        .flex-1.sm\:hidden {
            display: none;
        }
    </style>

    <div class="col-lg-8 d-flex">
        <div class="col-xxl-8 col-md-12">
            <div class="d-flex me-2">
                <div class="col-xxl-8 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                        <a href="/customer" class="card-body">
                            <h5 class="card-title">Customer <span>| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $cust }}</h6>
                                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xxl-8 col-md-6 ms-2">
                    <div class="card info-card revenue-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <a href="/supplier" class="card-body">
                            <h5 class="card-title">Supplier <span>| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $supp }}</h6>
                                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                                    class="text-muted small pt-2 ps-1">increase</span> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @php
                $thisMonth = \Carbon\Carbon::now()->format('F');
            @endphp
            <div class="shadow">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td colspan="3">
                                Usage <b>{{ $thisMonth }}</b>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FAI Code</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($usage->isEmpty())
                            <tr>
                                <td colspan="3">Belum ada data penggunaan untuk bulan {{ $thisMonth }}.</td>
                            </tr>
                        @else
                            @foreach ($usage as $i)
                                @php
                                    $usageDate = Carbon\Carbon::parse($i->tanggal_penggunaan);
                                @endphp

                                <tr>
                                    @if ($usageDate->month == now()->month)
                                        <th scope="row">1</th>
                                        <td>{{ $i->FAI_code }}</td>
                                        <td>{{ $i->total_usage }}</td>
                                    @endif
                                </tr>
                                {{ $usage->links() }}
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 ms-2">
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                    <div class="activity">
                        @foreach ($lastActivity as $i)
                            <div class="activity-item d-flex">
                                <div class="activite-label" style="width: 7rem">{{ $i->created_at->diffForHumans() }}</div>
                                @if ($i->event == 'created')
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                @elseif ($i->event == 'update')
                                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                @elseif ($i->event == 'delete')
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                @else
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                                @endif

                                <div class="ms-1 activity-content">
                                    {{ $i->event }} - {{ $i->subject_id }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-links mt-3">
                        {{ $lastActivity->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
