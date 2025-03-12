@extends('layouts.app')

@section('content')
<div class="mobile-menu-overlay"></div>
<div class="main-container">
    <div class="container">
        <div class="col-12 text-start">
            <a href="{{ url('/customer/index') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
        <div class="row justify-content-center">
            @forelse ($items as $i)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0" style="height: 100%;">
                        <div class="card-body d-flex flex-column justify-content-center text-center">
                            <h5 class="card-title">{{ $i->med_name }} <span class="text-muted">x {{ $i->qty }}</span></h5>
                            <p class="card-text font-weight-bold text-success mb-1">Total: ₱{{ number_format($i->total_price, 2) }}</p>
                            <p class="text-muted mb-1">{{ $i->med_description ?? "No Description" }}</p>

                            <div class="mb-2">
                                @if($i->is_prescribed == 1)
                                    <span class="badge bg-danger">Needs Prescription</span>
                                @elseif($i->is_prescribed == 0)
                                    <span class="badge bg-success">No Prescription Needed</span>
                                @endif
                            </div>

                            <div class="mb-2">
                                @if($i->is_yellow == 1)
                                    <span class="badge bg-warning text-dark">Yellow Prescription</span>
                                @elseif($i->is_yellow == 0)
                                    <span class="badge bg-secondary">Not Yellow Prescription</span>
                                @endif
                            </div>

                            <p class="text-muted mb-1">
                                <strong>Dosage:</strong> 
                                @if($i->dosage != null)
                                    {{ $i->dosage }}
                                @else
                                    No Dosage Information
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No items available.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
