@extends('layouts.app')
@section('content')
<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" rel="stylesheet">
<?php
$ipdomain = env('IPDOMAIN');
$finalurl = $ipdomain;
?>
<div class="row">
    <div class="col-12">
        <h5>{{ $p->name }}</h5>
        <p class="mb-1">{{ $p->description }}</p>
        <p>{{ $p->address }}</p>
        <div id="map" style="height: 50vh;"></div>
    </div>

    <div class="col-12 mt-4">
        <h5>Pharmacy Exclusive Products</h5>
        <div class="row">
            @foreach($ads as $product)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card text-center shadow-lg" style="cursor: pointer;" onclick="editproduct({{ json_encode($product) }})">
                        <img src="{{ $product->adpic_dir ? url($finalurl . '/' . $product->adpic_dir) : url('assets/images/logo_only.png') }}" 
                            class="card-img-top mx-auto d-block mt-3 border rounded rounded-3" alt="{{ $product->name }}" 
                            style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text mb-1">{{ $product->description ?? 'No description' }}</p>
                            <h6 class="text-primary">₱ {{ number_format($product->price, 2) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    let p = @json($p);
    let pharmaId = p.id;
    let lng = p.longitude;
    let lat = p.latitude;
    let marker;

    mapboxgl.accessToken = 'pk.eyJ1IjoicmF5bWFydG1hcGJveCIsImEiOiJjbTYwZXgwYjAwYWttMmlzNjc3dXIzbGF2In0.FdkeriCwxWxOVREolGHC4w';
    // Initialize the Mapbox map
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        zoom: 15
    });

    map.on('load', function () {
        if (lng && lat) {
            // Center the map on the existing coordinates
            map.setCenter([lng, lat]);

            // Place the marker on the existing coordinates
            marker = new mapboxgl.Marker()
                .setLngLat([lng, lat])
                .addTo(map);

        }
    });
</script>
@endsection