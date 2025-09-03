@extends('layouts.app')
@section('content')
    <div class="main-container container ">
        <div class="breadcrumb-container">
            <div class="breadcrumb-back">
                <a href="javascript:history.back()" class="back-button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="breadcrumb-icon">
                <i class="fa-solid fa-fire-extinguisher"></i>
            </div>
            <nav class="breadcrumb-nav">
                <div class="breadcrumb-item">
                    <span class="breadcrumbs"><a href="{{ route('dashboard') }}">Home</a> </span>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    {{ $extinguisher->extinguisher_id }}
                </div>
            </nav>
        </div>
        <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
            <h5 class=" text-center fw-bold text-primary">Inspection Questions</h5>
            <div class="text-center text-muted">
                Time Elapsed : <span id="elapsed-display">0m 0s</span>
            </div>
            <div class="d-flex justify-content-between px-2 fw-medium mt-2">
                <div id="current-date">Loading date...</div>
                <div id="current-time">Loading time...</div>
            </div>
        </div>
        <div class=" rounded-4 animated-container">

            <form method="POST" action="{{ route('maintenance.SubmitInspection') }}">
                <input type="hidden" name="time" id="inspection_time">
                @csrf

                <input type="hidden" name="id" value="{{ $extinguisher->id }}">
                @foreach ($questions as $index => $item)
                    <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                        <p class="fw-semibold mb-3">{{ $index + 1 }}. {{ $item->question }} <span
                                class="text-danger">*</span></p>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $item->id }}]"
                                    id="yes-{{ $item->id }}" value="yes" required>
                                <label class="form-check-label fw-semibold text question-green"
                                    for="yes-{{ $item->id }}">
                                    Yes
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $item->id }}]"
                                    id="no-{{ $item->id }}" value="no">
                                <label class="form-check-label fw-semibold question-red" for="no-{{ $item->id }}">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
                @php
                    $lastIndex = count($questions) + 1;
                @endphp
                <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                    <p class="fw-semibold mb-3">{{ $lastIndex }}. Examine where the gauge needle is. A needle
                        within the
                        green zone is<span class="question-green"> <b>GOOD</b>.</span> A needle in
                        the left red zone means that the fire extinguisher is undercharged and warrants a
                        <span class="question-red"><b>RECHARGE</b>,</span> while a needle in the
                        right red zone
                        signals a danger of being
                        <span class="question-blue"><b>OVERCHARGED</b></span> <span class="text-danger">*</span>
                    </p>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="good" required
                                id="good">
                            <label class="form-check-label question-green fw-semibold " for="good">
                                GOOD
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="undercharged"
                                id="undercharged">
                            <label class="form-check-label question-red fw-semibold" for="undercharged">
                                UNDERCHARGED
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="overcharged"
                                id="overcharged">
                            <label class="form-check-label  question-blue fw-semibold" for="overcharged">
                                OVERCHARGED
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                    <p class="fw-semibold mb-3">{{ $lastIndex + 1 }}. Remarks <span class="text-danger">*</span></p>
                    <textarea class="form-control" name="remarks" cols="30" rows="5" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-2 w-100"> <i class="fa-solid fa-check"></i>
                        Complete Inspection</button>
                </div>
            </form>

        </div>
    </div>
    <script>
        let startTime = Date.now();
        setInterval(() => {
            let elapsedMs = Date.now() - startTime;
            let elapsedSec = Math.floor(elapsedMs / 1000);
            let minutes = Math.floor(elapsedSec / 60);
            let seconds = elapsedSec % 60;

            document.getElementById("elapsed-display").innerText =
                `${minutes}m ${seconds}s`;

            document.getElementById("inspection_time").value = elapsedSec;
        }, 1000);

        function updateDateTime() {
            const now = new Date();

            const dateOptions = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const timeOptions = {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            };

            const formattedDate = now.toLocaleDateString('en-US', dateOptions);
            const formattedTime = now.toLocaleTimeString('en-US', timeOptions).toUpperCase();

            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = formattedTime;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
