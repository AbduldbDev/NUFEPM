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
                    <a href="{{ route('dashboard') }}">Home</a>
                </div>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <div class="breadcrumb-item active">
                    <span>Inspection Guide</span>
                </div>
            </nav>
        </div>
        <header class="custom-bg-primary text-white text-center py-4 mb-4 rounded">
            <div class="header-icon mb-2">
                <i class="bi bi-fire-extinguisher"></i>
            </div>
            <h1 class="fw-bold">Fire Extinguisher Inspection</h1>
            <p class="lead mb-2">Complete Step-by-Step Guide</p>
            <p class="mb-0">Follow these steps ensure your fire extinguisher is in proper working condition</p>
        </header>

        <!-- Main Content -->
        <div class="card custom-card mb-4 border-0">
            <div class="card-header custom-bg-primary text-white text-center py-3">
                <h2 class="h5 mb-0 fw-bold">Monthly Inspection Checklist</h2>
            </div>
            <div class="card-body p-4">
                <!-- Checklist -->
                <div class="custom-bg-primary-light p-4 rounded mb-4">
                    <h3 class="h6 fw-bold custom-text-primary mb-3">
                        <i class="bi bi-clipboard-check"></i> Quick Checklist
                    </h3>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Pressure gauge in green zone
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Seal and tamper indicator intact
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> No physical damage or corrosion
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Easily accessible and visible
                    </div>
                    <div class="checklist-item">
                        <i class="bi bi-check-circle-fill"></i> Inspection tag present and updated
                    </div>
                </div>

                <!-- Steps -->
                <div class="row g-4">
                    <!-- Step 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">1</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Verify Location</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step1.jpg') }}"
                                        alt="Step 1 - Verify Location">
                                </div>
                                <p class="card-text">Check that the fire extinguisher is installed in its designated
                                    location and easily accessible.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">2</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Ensure Accessibility</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step2.jpg') }}"
                                        alt="Step 2 - Ensure Accessibility">
                                </div>
                                <p class="card-text">Confirm that the fire extinguisher is fully visible and not blocked by
                                    equipment, furniture, or other obstacles.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">3</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Check Pressure Gauge</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step3.jpg') }}"
                                        alt="Step 3 - Check Pressure Gauge">
                                </div>
                                <p class="card-text">Ensure the pressure gauge or indicator needle is within the operable
                                    range, confirming the extinguisher is properly charged.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">4</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Confirm Extinguisher Fullness</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step4.jpg') }}"
                                        alt="Step 4 - Confirm Extinguisher Fullness">
                                </div>
                                <p class="card-text">Check that the extinguisher feels full by weighing or gently lifting
                                    (“hefting”) it to ensure it has not been discharged.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">5</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Inspect Physical Condition</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step5.jpg') }}"
                                        alt="Step 5 - Inspect Physical Condition">
                                </div>
                                <p class="card-text">Examine the extinguisher’s tires, wheels, carriage, hose, and nozzle
                                    (for wheeled units) to ensure all parts are in good working condition.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Step 6 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">6</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Test Indicator Function</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step6.jpg') }}"
                                        alt="Step 6 - Test Indicator Function">
                                </div>
                                <p class="card-text">Verify that the push-to-test indicators on non-rechargeable models are
                                    functioning correctly to confirm readiness.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">7</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Verify Instructions Label</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step7.jpg') }}"
                                        alt="Step 7 - Verify Instructions Label">
                                </div>
                                <p class="card-text">Ensure the operating instructions on the nameplate are clear, legible,
                                    and facing outward for easy visibility during emergencies.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">8</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">TITLE</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step8.jpg') }}" alt="">
                                </div>
                                <p class="card-text">aa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 9 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">9</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Check for Damage or Leaks</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step9.jpg') }}"
                                        alt="Step 9 - Check for Damage or Leaks">
                                </div>
                                <p class="card-text">Examine the extinguisher for any visible dents, corrosion, leakage, or
                                    a clogged nozzle that could affect its performance.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 10 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">10</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Agitate Extinguisher Powder</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step10.jpg') }}"
                                        alt="Step 10 - Agitate Extinguisher Powder">
                                </div>
                                <p class="card-text">Invert and gently shake the extinguisher to loosen compacted powder at
                                    the bottom of the cylinder, ensuring proper discharge when needed.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 11 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header custom-bg-primary-light d-flex align-items-center py-3">
                                <div class="step-number">11</div>
                                <h3 class="h6 mb-0 fw-bold custom-text-primary">Update Inspection Record</h3>
                            </div>
                            <div class="card-body">
                                <div class="step-image mb-3">
                                    <img class="step-img" src="{{ asset('Image/Guide/step11.jpg') }}"
                                        alt="Step 11 - Update Inspection Record">
                                </div>
                                <p class="card-text">Record the inspection date and the initials of the person who
                                    performed it on the extinguisher’s inspection tag or log.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/components/menu.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/components/inspectionguide.css') }}?v={{ time() }}" rel="stylesheet">
@endpush
