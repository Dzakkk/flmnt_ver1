@extends('dashboard')

@section('qc_product')
    <style>
        td {
            font-size: 13px;
        }

        #slideshow {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .slide-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            flex: 0 0 100%;
            max-width: 100%;
            transition: opacity 0.5s ease-in-out;
        }

        .pagination {
            margin-top: 20px;
            /* Sesuaikan dengan kebutuhan Anda */
            text-align: center;
        }

        .prev,
        .next {
            background: #ccc;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
    <div class="" id="slideshow">
        <div class="slide-container">
            <div class="slide">
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
                                @if (!$i->qc_check) /qc/check/form/inhouse/{{ $i->no_production }}_{{ $i->stockl->no_LOT }}
                                @else
                                /qc/check/update/inhouse/{{ $i->no_production }}_{{ $i->stockl->no_LOT }} @endif"
                                        class="btn btn-primary btn-sm
                                    @if ($i->qc_check && $i->qc_check->status == 'PASS') btn-success btn-sm
                                    @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                        btn-danger btn-sm @endif">

                                        @if ($i->qc_check && $i->qc_check->status == 'PASS')
                                            Review <i class="bi bi-patch-check"></i>
                                        @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                            Review <i class="bi bi-patch-exclamation"></i>
                                        @else
                                            Check <i class="bi bi-patch-question"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="slide">
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
                                @if (!$i->qc_check) /qc/check/form/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }}
                                @else
                                /qc/check/update/incoming/{{ $i->created_at }}_{{ $i->stockl->no_LOT }}_{{ $i->barang->name }} @endif"
                                        class="btn btn-primary btn-sm
                                    @if ($i->qc_check && $i->qc_check->status == 'PASS') btn-success btn-sm
                                    @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                        btn-danger btn-sm @endif">

                                        @if (($i->qc_check && $i->qc_check->status == 'PASS') || ($i->qc_check && $i->qc_check->status == 'REJECT'))
                                            Review <i class="bi bi-patch-check"></i>
                                        @elseif ($i->qc_check && $i->qc_check->status == 'REJECT')
                                            Review <i class="bi bi-patch-exclamation"></i>
                                        @else
                                            Check <i class="bi bi-patch-question"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="controls">
            <button onclick="nextSlide()" class="btn btn-primary">Pindah</button>
        </div>
    </div>
    <script>
        var slidesContainer = document.querySelector('.slide-container');
        var slides = document.querySelectorAll('.slide');
        var currentSlide = 0;

        function showSlide(n) {
            currentSlide = (n + slides.length) % slides.length;
            slidesContainer.style.transform = 'translateX(-' + currentSlide * 100 + '%)';
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }
    </script>
@endsection
