@extends('layouts.app')
@section('content')

<div class="mobile-menu-overlay"></div>
<div class="main-container">

    <div class="col-12">
        <h4 class="fw-bold mb-1">Open Transactions</h4>
        <table class="table table-striped table-bordered" id="openTransactionsTbl">
            <thead>
            <tr>
                <th class="px-1 text-center">O.Id</th>
                <th class="px-1 text-center">Product</th>
                <th class="px-1 text-center">Qty</th>
                <th class="px-1 text-center">Amnt</th>
                <th class="px-1 text-center">Prep Status</th>
            </tr>
            <tbody>
                @forelse($ots as $ot)
                    <tr>
                        <td>{{ $ot->order_id }}</td>
                        <td>{{ $ot->med_name }}</td>
                        <td>{{ $ot->qty }}</td>
                        <td>{{ $ot->total_due }}</td>
                        <td>{{ $ot->prep_status }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No Open transactions</td>
                </tr>
                @endforelse
            </tbody>
            </thead>
        </table>
    </div>

    <div class="col-12 mt-4">
        <h4 class="fw-bold mb-1">Completed Transactions</h4>
        <table class="table table-striped table-bordered" id="closedTransactionsTbl">
            <thead>
                <tr>
                    <th class="px-1 text-center">Date</th>
                    <th class="px-1 text-center">Product</th>
                    <th class="px-1 text-center">Qty</th>
                    <th class="px-1 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cts as $ct)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($ct->created_at)->format('M d, Y') }}</td>
                        <td>{{ $ct->med_name }}</td>
                        <td>{{ $ct->qty }}</td>
                        <td>{{ $ct->total_due }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No Completed transactions</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$cts->links()}}
    </div>

</div>
@endsection