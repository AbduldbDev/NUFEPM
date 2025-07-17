@extends('layouts.app')
@section('content')
    @include('layouts.components.alerts')
    <div class="main-container container ">
        <div class="title">
            <span class="menu-title-icon"><i class="fa-solid fa-fire-extinguisher"></i></span> &nbsp;

            <span class="crumb">
                <span class="breadcrumbs">
                    <a href="#" onclick="history.back(); return false;">Return</a>
                    &gt;
                </span>
            </span>
            <span class="breadcrumbs">Refill Extinguisher</span>
        </div>
        <hr>
        <div class="card shadow-sm rounded-3 mb-3 border-bottom p-3" style="border-left: 4px solid #35408e">
            <form action="{{ route('maintenance.SubmitRefill') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $details->id }}">
                <div class="row">
                    <div class="col-12 mb-2">
                        <label for="extinguisher_id" class="form-label">Extinguisher ID: <span
                                class="text-danger">*</span></label>
                        <input type="text" id="extinguisher_id" name="extinguisher_id" class="form-control" readonly
                            value="{{ $details->extinguisher_id }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="refill_by" class="form-label">Refilled By: <span class="text-danger">*</span></label>
                        <input type="text" id="refill_by" name="refill_by" class="form-control" readonly
                            value="{{ Auth::user()->lname }}, {{ Auth::user()->fname }}">
                    </div>

                    <div class="col-12 mb-2">
                        <label for="refill_date" class="form-label">Refill Date: <span class="text-danger">*</span></label>
                        <input type="date" id="refill_date" name="refill_date" class="form-control">
                    </div>

                    <div class="col-12 mb-2">
                        <label for="remarks" class="form-label">Remarks: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="5"></textarea>
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
