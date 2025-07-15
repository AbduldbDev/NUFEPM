@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-qrcode"></i></span> &nbsp;
            {{-- <span class="crumb">
                <span class="breadcrumbs"><a href="{{ route('admin.ShowAdminInspectionMenu') }}">Inspections</a> &gt; </span>
            </span> --}}
            <span class="crumb">
                <span class="breadcrumbs"><a href="#" onclick="history.back(); return false;">Return</a> &gt; </span>
            </span>
            <span class="breadcrumbs">{{ $details->extinguisher->extinguisher_id }}</span>
        </div>
        <hr>
        <div class="animated-container">
            <div class="card shadow-sm rounded-3 p-3 mb-3" style="border-left: 4px solid #35408e;">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-clipboard-check me-2"></i>Inspection Answers</h5>
                <div class="row fw-medium px-0">
                    <div class="col-12 col-md-6 mb-2">
                        <span class="text-muted">Inspected By:</span><br>
                        <span class="fw-semibold">
                            @if ($details->user && $details->user->lname && $details->user->fname)
                                {{ $details->user->lname }}, {{ $details->user->fname }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>

                    <div class="col-12 col-md-6">
                        <span class="text-muted">Inspected At:</span><br>
                        <span class="fw-semibold">
                            {{ optional($details->inspected_at ? \Carbon\Carbon::parse($details->inspected_at) : null)->format('F d, Y') ?? 'N/A' }}
                            {{ optional($details->inspected_at ? \Carbon\Carbon::parse($details->inspected_at) : null)->format('h:i a') ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class=" rounded-4">

                @php
                    $answers = $items->keyBy('question_id');
                @endphp
                @foreach ($items as $index => $item)
                    <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                        <p class="fw-semibold mb-3">{{ $index + 1 }}. {{ $item->questions->question }}</p>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $item->id }}]"
                                    id="yes-{{ $item->id }}" value="yes"
                                    {{ $item->answer === 'yes' ? 'checked' : '' }} disabled>
                                <label class="form-check-label fw-semibold text question-green"
                                    for="yes-{{ $item->id }}">
                                    Yes
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $item->id }}]"
                                    id="no-{{ $item->id }}" value="no"
                                    {{ $item->answer === 'no' ? 'checked' : '' }} disabled>
                                <label class="form-check-label  fw-semibold question-red" for="no-{{ $item->id }}">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach

                @php
                    $lastIndex = count($items) + 1;
                @endphp
                <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                    <p class="fw-semibold mb-3">{{ $lastIndex }}. Examine where the gauge needle is...</p>
                    @php
                        $status = $details->status ?? null;
                    @endphp
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="good" id="good"
                                {{ $status === 'Good' ? 'checked' : '' }} disabled>
                            <label class="form-check-label question-green fw-semibold " for="good">GOOD</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="undercharged"
                                id="undercharged" {{ $status === 'Undercharged' ? 'checked' : '' }} disabled>
                            <label class="form-check-label question-red fw-semibold" for="undercharged">UNDERCHARGED</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="radio" value="overcharged"
                                id="overcharged" {{ $status === 'Overcharged' ? 'checked' : '' }} disabled>
                            <label class="form-check-label question-blue fw-semibold" for="overcharged">OVERCHARGED</label>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
                    <p class="fw-semibold mb-3">{{ $lastIndex + 1 }}. Remarks <span class="text-danger">*</span></p>
                    <textarea class="form-control" name="remarks" cols="30" rows="5" readonly>{{ $details->remarks }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
