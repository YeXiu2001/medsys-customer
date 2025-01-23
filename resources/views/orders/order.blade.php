@extends('layouts.app')
@section('content')

<div class="mobile-menu-overlay"></div>
<div class="main-container">

<style>
    .select2-results {
        max-height: 12rem; /* Adjust this to control the dropdown list's height */
        overflow-y: auto;
    }

    #cartTableDiv {
        height: 60vh;
        overflow-y: auto;
        border: 1px solid #dee2e6;
    }

    #cartTable {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    #cartTable thead {
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 1;
    }
</style>
    <div class="col-12 text-end">
        <button type="button" id="orderbtn" onclick="order()" class="btn btn-primary btn-sm"> <i class="bx bx-plus"></i> Order Meds</button>
    </div>

    <h4 class="fw-bold">My Cart</h4>
    <div class="col-12 mt-3" id="cartTableDiv">
        <table id="cartTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Med Name</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
               <!-- Populate when add to cart -->
            </tbody>
        </table>
    </div>
    <div class="row mt-1 d-flex align-items-center">
        <div class="col-6">
            <span class="fw-bold text-success">Total Bill:</span> <span id="totalBill" class="fw-bold">₱0.00</span>
        </div>
        <div class="col-6 text-end">
            <button type="button" onclick="checkout()" class="btn btn-primary btn-md"> <i class="bx bx-cart"></i> Checkout</button>
        </div>
    </div>
    

    <!-- Ordering Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Search Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="cartForm" method="POST" class="pb-0 mb-0">
        <div class="modal-body pb-0 mb-0">
            @csrf
            <div class="mb-1">
                <label for="meds" class="form-label mb-0" >Product Name<span style="color: red">*</span></label>
                <select id="meds" name="meds" class="select2 form-select" required style="width: 100%; max-height: 10px;">
                    <option value="">Select...</option>
                    @forelse ($meds as $m)
                        <option value="{{$m->pharmed_id}}">{{$m->medname}}</option>
                    @empty
                        <option value="0">No Product Found</option>
                    @endforelse
                </select>  
            </div>
            <div class="mb-1">
                <label for="quantity" class="form-label mb-0">Quantity<span style="color: red">*</span></label>
                <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" value="1" required>
            </div>
            <div class="mb-2">
                <label for="description" class="form-label mb-0">Description</label>
                <textarea class="form-control form-control-sm" id="description" name="description" rows="1" readonly></textarea>
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Dosage: </span> <!-- `me-2` adds margin to the right of the span -->
                <p id="dosage" name="dosage" class="mb-0"></p> <!-- `mb-0` removes bottom margin from <p> -->
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Price: </span>
                <p id="medprice" name="medprice" class="mb-0"></p>
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Stocks Left: </span>
                <p id="stocks" name="stocks" class="mb-0"></p>
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Prescribed: </span>
                <span id="isprescribed" name="isprescribed" class="mb-0"></span>
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Yellow Prescribed: </span>
                <span id="isyellow" name="isyellow" class="mb-0"></span>
            </div>
            <div class="mb-1 d-flex align-items-center">
                <span class="fw-semibold me-2">Availability: </span>
                <span id="avail" name="avail" class="mb-0"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="addtoCartBtn" type="submit" class="btn btn-primary">Add to Cart</button>
        </div>
        </form>
        </div>
    </div>
    </div>

</div>
<script>
    let medinfo = {!! json_encode($meds) !!};
    let user = {!! json_encode($user) !!};
    let pharmaId =  {!! json_encode($pharmaId) !!};
    let cart = {
        pharmacy_id: pharmaId,
        customer_id: user.id,
        subtotal_amnt: 0,
        total_due: 0,
        items: []
    };
    $(document).ready(function(){
     
    });

    function order(){
        $('#addtoCartBtn').prop('disabled', false);
        $('#cartForm').trigger('reset');
        $('#dosage').text('');
        $('#medprice').text('');
        $('#isprescribed').html('');
        $('#isyellow').html('');
        $('#stocks').text('');
        $('#avail').html('');

        $('#orderModal').modal('show');
    }

    $('#orderModal').on('shown.bs.modal', function () {
        $('#meds').select2({
            dropdownParent: $('#orderModal'),
            theme: 'bootstrap',
        });
    });

    // event listener for meds select
    let med;
    $('#meds').on('change', function(){
        let medid = $(this).val(); // Get the selected medication ID
        med = medinfo.find(m => m.pharmed_id == medid); // Find the medication object from the array
        if (!med) {
            console.error('Product Info not found');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Contact Your System Administrator',
            })
        }
        $('#dosage').text(med.dosage ? med.dosage : 'No Dosage Information found');
        $('#medprice').text(med.price);
        if (med.is_prescribed == 1) {
            $('#isprescribed').html(`<span class="badge bg-warning" data-ip="${med.isprescribed}">Needs Prescription</span>`);
        } else {
            $('#isprescribed').html(`<span class="badge bg-success" data-ip="${med.isprescribed}">Non Prescribed</span>`);
        }

        if (med.is_yellow == 1) {
            console.log('Yellow Prescribed');
            $('#isyellow').html('<span class="badge bg-danger">Yellow Prescribed</span>');
        } else {
            $('#isyellow').html('<span class="badge bg-success">Non Prescribed</span>');
        }

        $('#description').val(med.description ? med.description : 'No description found');
        $('#stocks').text(med.stocks);
        if (med.stocks < 10) {
            $('#avail').html('<span class="badge bg-danger">Not Available for Pre-Order</span>');
        } else {
            $('#avail').html('<span class="badge bg-success">Available</span>');
        }

        if ( med.is_yellow == 1 || med.stocks < 10) {
            $('#addtoCartBtn').prop('disabled', true);
        }else{
            $('#addtoCartBtn').prop('disabled', false);
        }

        validateBtn(med);
    });

    function validateBtn(med) {
        let vqty = $('#quantity').val();
        if (vqty < 1 || med.is_yellow == 1 || med.stocks < 10 || vqty > med.stocks) {
            $('#addtoCartBtn').prop('disabled', true);
        } else {
            $('#addtoCartBtn').prop('disabled', false);
        }
    }

    $('#quantity').on('input', function() {
        if (med) {
            validateBtn(med);
        }
    });

    // on order submission
    $('#cartForm').on('submit', function(e){
        e.preventDefault();

        let pharmedid = $('#meds').val();
        let med = medinfo.find(m => m.pharmed_id == pharmedid);
        let qty = Number($('#quantity').val());
        let medname = $('#meds option:selected').text();
        let totalamount = med.price * qty;

        if (qty > med.stocks) {
            Swal.fire({
                icon: 'error',
                title: 'Not Enough Stocks',
                text: 'Not Enough Stocks',
            });
            return;
        }
        
        let floatAmount = parseFloat(totalamount).toFixed(2); //with qty
        let floatPrice = parseFloat(med.price).toFixed(2); //base price

        let formattedAmount = parseFloat(floatAmount).toLocaleString('en-PH', {style: 'currency', currency: 'PHP'});
        let formattedPrice = parseFloat(floatPrice).toLocaleString('en-PH', {style: 'currency', currency: 'PHP'});

        let cartRow = `<tr>
            <td>${medname}</td>
            <td>${qty}</td>
            <td>${formattedAmount}</td>
        </tr>`;

        $('#cartTable tbody').append(cartRow);

        cart.items.push({
            pharmed_id: pharmedid,
            med_id: med.medId,
            medname: medname,
            qty: qty,
            base_price: floatPrice,
            total_price: floatAmount
        });

        let subt = Number(cart.subtotal_amnt) + Number(floatAmount);
        cart.subtotal_amnt = parseFloat(subt).toFixed(2);
        cart.total_due = cart.subtotal_amnt;
        $('#totalBill').text(parseFloat(cart.total_due).toLocaleString('en-PH', {style: 'currency', currency: 'PHP'}));
        $('#orderModal').modal('hide');
    });

    function checkout(){
        if (cart.items.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Data',
                text: 'No items in cart',
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "/customer/checkout",
            data: JSON.stringify({ cart: cart }),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Order Placed Successfully',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseJSON.message);
                console.log(xhr.responseJSON.error_details);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: xhr.responseJSON.message,
                });
            }
        });
    }
</script>
@endsection