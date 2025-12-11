

@section('title', __( 'adminboard::lang.' . $title))

@extends('kamruldashboard::layouts.app_master')

@section('stylesheet')


<style>
    @media print {
        .print_only {
            display: block;
            visibility: visible;
        }
        body * {
            visibility: hidden;
        }
        #print_div, #print_div * {
            visibility: visible;
        }
        #print_div {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
@endsection
@section('javascript')

@endsection
@section('content')

<div class="row" id="print_div">
    <div class="col-lg-12">
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">@lang('adminboard::lang.registered_customers')</h4>
                <a href="{{ route('adminevent.download', $adminevent->id) }}"
                   class="btn btn-success btn-sm">
                    @lang('adminboard::lang.download_csv')
                </a>
            </div>

            <div class="card-body">
                @if($adminevent->registrations->count() > 0)
                    @php
                        // Get the dynamic keys from the first record
                        $firstFields = json_decode($adminevent->registrations->first()->customer_fields, true) ?? [];
                    @endphp

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            @foreach($firstFields as $key => $value)
                                <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                            @endforeach
                            <th>@lang('adminboard::lang.registered_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adminevent->registrations as $reg)
                            @php
                                $fields = json_decode($reg->customer_fields, true) ?? [];
                            @endphp
                            <tr>
                                <td>{{ $reg->id }}</td>

                                {{-- Loop dynamic fields --}}
                                @foreach($firstFields as $key => $v)
                                    <td>{{ $fields[$key] ?? '' }}</td>
                                @endforeach

                                <td>{{ $reg->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-center text-danger">@lang('adminboard::lang.no_registered_customer_found')</td>
                        </tr>
                    </table>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
