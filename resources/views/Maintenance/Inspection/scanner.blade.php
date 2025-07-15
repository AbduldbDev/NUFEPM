@extends('layouts.app')
@section('content')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-qrcode"></i></span> &nbsp;
            <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> &gt; </span>
            </span>
            <span class="breadcrumbs">Scanner</span>
        </div>
        <hr>

        <div id="reader" style="width:100%" class="animated-container">
            <div id="loadingSpinner" class="d-flex justify-content-center align-items-center" style="height: 200px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div id="error" style="margin-top: 10px; color: red;"></div>
    </div>
    <script>
        let hasScanned = false;
        const spinner = document.getElementById('loadingSpinner');

        function onScanSuccess(decodedText, decodedResult) {
            if (hasScanned) return;
            hasScanned = true;
            document.getElementById('error').innerText = '';

            html5QrCode.stop().then(() => {
                window.location.href = `/Inspection/Details/${encodeURIComponent(decodedText)}`;
            }).catch(err => {
                document.getElementById('error').innerText = `Stop scanner error: ${err}`;
            });
        }

        const html5QrCode = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const backCamera = devices.find(device => device.label.toLowerCase().includes('back')) ||
                    devices[devices.length - 1];

                html5QrCode.start(
                    backCamera.id, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    onScanSuccess,
                ).then(() => {
                    spinner.style.display = 'none';
                }).catch(err => {
                    spinner.style.display = 'none';
                    document.getElementById('error').innerText = `Start scanner error: ${err}`;
                });
            }
        }).catch(err => {
            spinner.style.display = 'none';
            document.getElementById('error').innerText = `Camera error: ${err}`;
        });
    </script>
@endsection
@push('css')
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
