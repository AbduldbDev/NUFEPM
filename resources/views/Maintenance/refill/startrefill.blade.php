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
                    <a href="{{ route('maintenance.ShowMaintenanceExtinguishersMenu') }}">Inspections</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    Refill Extinguisher
                </div>
            </nav>
        </div>

        <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
            <form action="{{ route('maintenance.SubmitRefill') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $details->id }}">
                <div class="row">
                    <div class="col-12 mb-2">
                        <label for="extinguisher_id" class="form-label">Equipment ID: <span
                                class="text-danger">*</span></label>
                        <input type="text" id="extinguisher_id" name="extinguisher_id" class="form-control" readonly
                            value="{{ $details->extinguisher_id }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="refill_by" class="form-label">Refilled By: <span class="text-danger">*</span></label>
                        <input type="text" id="refill_by" name="refill_by" class="form-control" readonly
                            value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                    </div>

                    <div class="col-12  mb-2">
                        <label for="remarks" class="form-label">Remarks: <span class="text-danger">*</span></label>
                        <div class="px-2">
                            <div class="form-check  mt-1">
                                <input class="form-check-input" name="remarks" type="radio" value="good" required
                                    id="good">
                                <label class="form-check-label question-green fw-semibold " for="good">
                                    GOOD
                                </label>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" name="remarks" type="radio" value="undercharged"
                                    id="undercharged">
                                <label class="form-check-label question-red fw-semibold" for="undercharged">
                                    UNDERCHARGED
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" name="remarks" type="radio" value="overcharged"
                                    id="overcharged">
                                <label class="form-check-label  question-blue fw-semibold" for="overcharged">
                                    OVERCHARGED
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <button class="btn save-btn w-100 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit
                            Refill</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/submenu.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
