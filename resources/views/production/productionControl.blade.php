@extends('dashboard')

@section('productionControlAfter')
    <style>
        img {
            height: 5rem;
            object-fit: cover;
            object-position: center top;
            overflow: hidden;
            cursor: pointer;
        }

        .preview-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .preview-image {
            width: 30%;
            height: auto;
        }

        .close-preview {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #fff;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>

    <div class="d-flex">
        @foreach ($pc as $p)
            <div class="card ms-2" style="width: 18rem;">
                <img src="{{ asset($p->file) }}" class="card-img-top preview-trigger" alt="Production Control">
                <div class="card-body">
                    <h5 class="card-title">{{ $p->no_production }}</h5>
                    <p class="card-text"></p>
                    <a href="/after/production/{{ $p->no_production }}" class="btn btn-primary">INPUT PRODUCTION DATA</a>
                </div>
            </div>
            <div class="preview-overlay preview-overlay-{{ $p->no_production }}">
                <img src="{{ asset($p->file) }}" class="preview-image" alt="Preview">
                <button class="close-preview">Close Preview</button>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var previewTriggers = document.querySelectorAll(".preview-trigger");
    previewTriggers.forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            var noProduction = this.parentNode.querySelector('.card-title').innerText;
            var modifiedId = noProduction.replace(/\//g, '-'); // Ganti '/' dengan '-'
            var previewOverlay = document.querySelector('.preview-overlay-' + modifiedId);
            if (previewOverlay) {
                previewOverlay.style.display = 'flex'; // Gunakan ID yang telah dimodifikasi
            }
        });
    });

    document.querySelectorAll('.close-preview').forEach(function(closeButton) {
        closeButton.addEventListener('click', function() {
            this.parentNode.style.display = 'none';
        });
    });
});

    </script>
@endsection
