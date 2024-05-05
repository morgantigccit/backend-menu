@extends('layouts_admin.app')



@section('content')
<style>
    .border-left-pending {
        border-left: 4px solid #ffc107;
    }

    .border-left-canceled {
        border-left: 4px solid #dc3545;
    }

    .border-left-complete {
        border-left: 4px solid #28a745;
    }

    .order-card {
        margin-top: 20px;
    }

    .order-card-header {
        cursor: pointer;
    }

    .order-card-body {
        padding: 10px;
    }

    .order-details {
        margin-top: 10px;
    }

    .order-action-buttons {
        margin-top: 10px;
    }

    .waiter-call-card {
        margin-top: 20px;
    }

    .waiter-call-card-body {
        padding: 10px;
    }
    .nav-linki{
        color:#424874!important 
    }
    .nav-link.active{
        color:#424874!important 

    }
</style>


<div class="container mt-5">
    <h2 class="mb-4">Orders</h2>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="orderStatusTabs">
        <li class="nav-item">
            <a class="nav-linki nav-link active" data-bs-toggle="tab" href="#pending" role="tab">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-linki nav-link" data-bs-toggle="tab" href="#canceled" role="tab">Canceled</a>
        </li>
        <li class="nav-item">
            <a class="nav-linki nav-link" data-bs-toggle="tab" href="#complete" role="tab">Complete</a>
        </li>
        <li class="nav-item">
            <a class="nav-linki nav-link" data-bs-toggle="tab" href="#waiterCalls" role="tab">Waiter Calls</a>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="ordersContainer">
        <div class="tab-pane fade show active" id="pending" role="tabpanel"></div>
        <div class="tab-pane fade" id="canceled" role="tabpanel"></div>
        <div class="tab-pane fade" id="complete" role="tabpanel"></div>
        <div class="tab-pane fade" id="waiterCalls" role="tabpanel">
            <!-- Waiter calls will be displayed here -->
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script> <!-- This file should now include your Laravel Echo setup -->

<script>
    Echo.channel('orders')
    .listen('.OrderUpdated', (e) => {
        console.log(e);
    });

    $(document).ready(function() {
        // Existing function definitions for fetchWaiterCalls and fetchOrders

        // Start listening for real-time events
        window.Echo.channel('orders')
            .listen('.order.updated', (e) => { // Listen for an event named "order.updated"
                console.log('Order updated event received:', e);
                fetchOrders(); // Re-fetch orders to update the UI
            })
            .listen('.waiter.call', (e) => { // Listen for a waiter call event
                console.log('Waiter call event received:', e);
                fetchWaiterCalls(); // Re-fetch waiter calls to update the UI
            });
    });
</script>
    <script src="{{ mix('./js.js') }}"></script>
    <script>
        $(document).ready(function() {
            function fetchWaiterCalls() {
                $.ajax({
                    url: "{{ route('api.waiter-calls.fetch') }}", // Make sure this renders the correct URL
                    type: "GET",
                    success: function(response) {
                        const data = response.data; // Access the nested data
                        console.log("Success callback data:",
                            data); // Debug: Log data to ensure it's as expected

                        const waiterCallsContainer = $('#waiterCalls');
                        if (waiterCallsContainer.length === 0) {
                            console.error("waiterCalls container not found");
                            return;
                        }

                        waiterCallsContainer.empty(); // Clear previous calls

                        if (!data || data.length === 0) {
                            waiterCallsContainer.append('<p>No waiter calls found.</p>');
                            return;
                        }

                        data.forEach(call => {
                            const callHtml = `
                    <div class="card mt-3">
                        <div class="card-body">
                            Waiter called for table ${call.table_number} at ${new Date(call.created_at).toLocaleString()}

                            <h3>Type:${call.type} </h3>
                        </div>
                    </div>`;
                            waiterCallsContainer.append(callHtml);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch waiter calls:", error);
                    }
                });
            }

            function fetchOrders() {
                $.ajax({
                    url: "{{ route('orders.fetch') }}", // Ensure this is the correct endpoint
                    type: "GET",
                    success: function(data) {
                        console.log(data);
                        const statusContainers = {
                            pending: '#pending',
                            canceled: '#canceled',
                            complete: '#complete'
                        };
                        Object.values(statusContainers).forEach(selector => $(selector).empty());

                        data.forEach(order => {
                            const normalizedStatus = order.order_status.toLowerCase();
                            const containerSelector = statusContainers[normalizedStatus];
                            let itemsHtml = order.items.map(item =>
                                    `<li>${item.menu.name} - Quantity: ${item.quantity}</li>`)
                                .join('');
                            let orderHtml = `
                        <div class="card mt-3 border-left-${normalizedStatus}">
                            <div class="card-header" data-bs-toggle="collapse" href="#collapseOrder${order.id}" role="button" aria-expanded="false" aria-controls="collapseOrder${order.id}">
                                Order #${order.id} - Table: ${order.table_id} - Total Price: SAR ${order.total_price}
                            </div>
                            <div class="collapse" id="collapseOrder${order.id}">
                                <div class="card-body">
                                    <h5 class="card-title">Status: ${order.order_status}</h5>
                                    <ul>${itemsHtml}</ul>
                                    <button onclick="updateOrderStatus(${order.id}, 'complete')" class="btn btn-success">Mark as Complete</button>
                                    <button onclick="updateOrderStatus(${order.id}, 'canceled')" class="btn btn-danger">Cancel Order</button>
                                </div>
                            </div>
                        </div>`;
                            $(containerSelector).append(orderHtml);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to fetch orders: ", error);
                    }
                });
            }
            window.updateOrderStatus = function(orderId, newStatus) {
                console.log(`Updating order ${orderId} status to ${newStatus}`);
                $.ajax({
                    url: `https://app.morgantigcc.com/menu/public/orders/${orderId}/status/update`,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        status: newStatus,
                    },
                    success: function(response) {
                        console.log('Order status updated successfully');
                        fetchOrders
                    (); // Make sure this function correctly refreshes the orders list
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to update order status: ", error);
                    }
                });
            };


            setInterval(fetchOrders, 12000); // Fetch orders every 2 minutes
            setInterval(fetchWaiterCalls, 10000); // Fetch orders every 2 minutes
            fetchOrders(); // Initial fetch
            fetchWaiterCalls();

        });


        // Call fetchWaiterCalls() along with fetchOrders() to populate the data
        $(document).ready(function() {
            fetchOrders();
            // Consider setting an interval for fetchWaiterCalls if you want live updates
            fetchWaiterCalls(); // Fetch waiter calls on page load
        });
    </script>
@endsection
