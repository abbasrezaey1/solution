@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('shipments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.gpsposition.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.gpsposition.inputs.longitude')</h5>
                    <span>{{ $gpsposition->longitude ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gpsposition.inputs.latitude')</h5>
                    <span>{{ $gpsposition->latitude ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gpsposition.inputs.device')</h5>
                    <span>{{ $gpsposition->shipment->gpsdevice_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.gpsposition.inputs.datetime')</h5>
                    <span>{{ $gpsposition->utc_timestamp ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('gpsposition.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
