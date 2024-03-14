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

    <div class="col-lg-9 d-flex">
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
                            <h5 class="card-title">Bahan Baku Terdaftar <span>| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-leaf-line"></i>
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
                            <h5 class="card-title">Product Terdaftar <span>| Today</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bx bxs-flask"></i>
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
                <table class="table table-hover">
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
            {{-- <div class="shadow">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td colspan="3">
                                Stock Terbesar
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FAI Code</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocksTerbesar as $i)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $i->FAI_code }}</td>
                                <td>{{ $i->total_quantity }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div> --}}
            <div class="col-xxl-8 col-md-12">
                <div class="d-flex me-2">
                    <div class="col-lg-6 me-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Stock Terbesar</h5>
                                <div id="barChart1"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#barChart1"), {
                                            series: [{
                                                data: [
                                                    @foreach ($stocksTerbesar as $i)
                                                        {{ $i->total_quantity }},
                                                    @endforeach

                                                ]
                                            }],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    borderRadius: 4,
                                                    horizontal: true,
                                                }
                                            },
                                            dataLabels: {
                                                enabled: true
                                            },
                                            xaxis: {
                                                categories: [
                                                    @foreach ($stocksTerbesar as $i)
                                                        '{{ $i->FAI_code }}',
                                                    @endforeach
                                                ],
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Bar Chart -->

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ms-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Stock Terkecil</h5>
                                <div id="barChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#barChart"), {
                                            series: [{
                                                data: [
                                                    @foreach ($stocksTerkecil as $i)
                                                        {{ $i->total_quantity }},
                                                    @endforeach

                                                ]
                                            }],
                                            chart: {
                                                type: 'bar',
                                                height: 350
                                            },
                                            plotOptions: {
                                                bar: {
                                                    borderRadius: 4,
                                                    horizontal: true,
                                                }
                                            },
                                            dataLabels: {
                                                enabled: true
                                            },
                                            xaxis: {
                                                categories: [
                                                    @foreach ($stocksTerkecil as $i)
                                                        '{{ $i->FAI_code }}',
                                                    @endforeach
                                                ],
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shadow">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td colspan="4">
                                Pengiriman Terakhir
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Customer</th>
                            <th scope="col">FAI Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($out as $i)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $i->tanggal_keluar }}</td>
                                <td>
                                    @if ($i->id_customer)
                                        {{ \App\Models\Customer::find($i->id_customer)->customer_name }}
                                    @else
                                        {{ $i->id_customer }}
                                    @endif
                                </td>
                                <td>{{ $i->FAI_code }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 ms-2">
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
                                <div class="activite-label" style="width: 3rem; font-size: 9">
                                    {{ $i->created_at->diffForHumans() }}</div>
                                @if ($i->event == 'created')
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                @elseif ($i->event == 'update')
                                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                @elseif ($i->event == 'deleted')
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                @else
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                                @endif

                                <div class="ms-1 activity-content">
                                    {{ $i->event }} - {{ $i->subject_id }} by @if ($i->causer_id)
                                        {{ \App\Models\User::find($i->causer_id)->name }}
                                    @else
                                        System
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-links mt-3">
                        {{-- {{ $lastActivity->onEachSide(1)->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
