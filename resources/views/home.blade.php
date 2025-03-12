@extends('layouts.app')
@section('content')
<?php
$ipdomain = env('IPDOMAIN');
$finalurl = $ipdomain;
?>
<div class="row">
    @foreach ($pharmacyinfos as $pi)
    @if(\Carbon\Carbon::now()->format('H:i:s') > $pi->o_time && \Carbon\Carbon::now()->format('H:i:s') < $pi->c_time)
    <div class="col-xl-4 col-sm-6">
        <div class="card" style="height: 100%;">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center pt-1 px-1 border-end">
                        <div class="avatar-sm mx-auto mb-3 mt-1"> 
                        <img src="<?= $finalurl ?>/{{ $pi->logo_dir ?? 'assets/images/logo_only.png' }}" 
                            onclick="window.location='{{ route('viewPharmacy', $pi->id) }}'"
                            alt="Avatar" 
                            class="avatar-title rounded-circle" 
                            style="width: 52px; height: 52px; object-fit: cover; cursor: pointer;">
                        </div>
                        <h5 onclick="window.location='{{ route('viewPharmacy', $pi->id) }}'" class="text-truncate pb-1" style="cursor: pointer;">{{$pi->name}}</h5>
                        <p>{{$pi->address}}</p>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="p-4 text-center text-xl-start">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-muted mb-2 text-truncate">Opens At</p>
                                    <h5>{{ \Carbon\Carbon::createFromFormat('H:i:s', $pi->o_time)->format('h:i A') }}</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <p class="text-muted mb-2 text-truncate">Closes At</p>
                                    <h5>{{ \Carbon\Carbon::createFromFormat('H:i:s', $pi->c_time)->format('h:i A') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="/customer/order/{{$pi->id}}" class="text-decoration-underline text-reset">Purchase Now <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center pt-1 px-1 border-end">
                        <div class="avatar-sm mx-auto mb-3 mt-1"> 
                        <img src="<?= $finalurl ?>/{{ $pi->logo_dir ?? 'assets/images/logo_only.png' }}" 
                            alt="Avatar" 
                            class="avatar-title rounded-circle" 
                            style="width: 52px; height: 52px; object-fit: cover;">
                        </div>
                        <h5 class="text-truncate pb-1">{{$pi->name}}</h5>
                        <p>{{$pi->address}}</p>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="p-4 text-center text-xl-start">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-muted mb-2 text-truncate">Opens At</p>
                                    <h5>{{ \Carbon\Carbon::createFromFormat('H:i:s', $pi->o_time)->format('h:i A') }}</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <p class="text-muted mb-2 text-truncate">Closes At</p>
                                    <h5>{{ \Carbon\Carbon::createFromFormat('H:i:s', $pi->c_time)->format('h:i A') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="javascript:void(0);" class="text-decoration-underline text-reset">CLOSED<i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection
