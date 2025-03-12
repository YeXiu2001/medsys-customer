@extends('layouts.app')
@section('content')

<div class="mobile-menu-overlay"></div>
<div class="main-container">
    
    <div class="col-12">
        <h4 class="fw-bold mb-1">Open Transactions</h4>
        <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-striped table-bordered" id="openTransactionsTbl">
            <thead class="table-primary">
            <tr>
                <th class="px-1 text-center">Id</th>
                <th class="px-1 text-center">Date</th>
                <th class="px-1 text-center">Pharmacy</th>
                <th class="px-1 text-center">Total</th>
                <th class="px-1 text-center">Status</th>
            </tr>
            <tbody>
                @forelse ($ots as $ot)
                    <tr onclick="window.location='{{ route('viewItems', $ot->order_id) }}'">
                        <td class="px-1 text-center">{{ $ot->order_id }}</td>
                        <td class="px-1 text-center">{{ \Carbon\Carbon::parse($ot->created_at)->format('M d, Y') }}</td>
                        <td class="px-1 text-center">{{ $ot->pharmacy_name }}</td>
                        <td class="px-1 text-center">{{ $ot->total_due }}</td>
                        <td class="px-1 text-center">
                            @if($ot->prep_status == 'Pending')
                                <span class="badge bg-warning text-dark">{{ $ot->prep_status }}</span>
                            @elseif($ot->prep_status == 'Ready')
                                <span class="badge bg-success text-dark">{{ $ot->prep_status }}</span>
                            @endif
                        </td>
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
    </div>

    <div class="col-12 mt-4">
        <h4 class="fw-bold mb-1">Completed Transactions</h4>
        <table class="table table-striped table-bordered" id="closedTransactionsTbl">
            <thead>
                <tr>
                    <th class="px-1 text-center">Id</th>
                    <th class="px-1 text-center">Date</th>
                    <th class="px-1 text-center">Pharmacy</th>
                    <th class="px-1 text-center">Total</th>
                    <th class="px-1 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cts as $ct)
                    <tr onclick="window.location='{{ route('viewItems', $ct->order_id) }}'">
                        <td class="px-1 text-center">{{ $ct->order_id }}</td>
                        <td class="px-1 text-center">{{ \Carbon\Carbon::parse($ct->created_at)->format('M d, Y') }}</td>
                        <td class="px-1 text-center">{{ $ct->pharmacy_name }}</td>
                        <td class="px-1 text-center">{{ $ct->total_due }}</td>
                        <td class="px-1 text-center">
                            @if($ct->trans_status == 'Closed')
                                <span class="badge bg-success text-dark">{{ $ct->trans_status }}</span>
                            @elseif($ct->trans_status == 'Void')
                                <span class="badge bg-danger text-dark">{{ $ct->trans_status }}</span>
                            @endif
                        </td>
                    </tr>                    
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Closed transactions</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{$cts->links()}}
    </div>

</div>
<script>
$(document).ready(function() {
setInterval(function() {
    location.reload();
}, 10000);
});
</script>

@endsection