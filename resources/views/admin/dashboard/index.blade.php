@extends('layouts_admin.app')


@section('content')
<style>
    .card-title{
        color: white !important;
    }
</style>
<div class="container">
    <h2>Dashboard</h2>
    <div class="row my-3">
        <!-- Card for Categories Count -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $categoriesCount }}</h5>
                    <p class="card-text">Total number of categories.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary   mb-3">
                <div class="card-header">Menu Items</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $menuItemsCount }}</h5>
                    <p class="card-text">Total number of menu items.</p>
                </div>
            </div>
        </div>

        <!-- Card for Tables Count -->
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Tables</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $tablesCount }}</h5>
                    <p class="card-text">Total number of tables.</p>
                </div>
            </div>
        </div>

        <!-- Card for Waiter Calls Count -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Waiter Calls</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $waiterCallsCount }}</h5>
                    <p class="card-text">Total number of waiter calls.</p>
                </div>
            </div>
        </div>

        <!-- Cards for Order Statuses Counts (Example for Pending) -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Pending Orders</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ordersStatusCount['pending']->total ?? 0 }}</h5>
                    <p class="card-text">Total number of pending orders.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Complete Orders</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ordersStatusCount['complete']->total ?? 0 }}</h5>
                    <p class="card-text">Total number of complete orders.</p>
                </div>
            </div>
        </div>
        <!-- Add more cards for Menu Items, Tables, Waiter Calls here -->

        <!-- Card for Order Status Pie Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Order Statuses</div>
                <div class="card-body">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Card for Monthly KPIs Bar Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Current Month KPIs</div>
                <div class="card-body">
                    <canvas id="monthlyKPIsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts for Chart.js -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        var monthlyKPIsCtx = document.getElementById('monthlyKPIsChart').getContext('2d');

        // Order Status Pie Chart
        var orderStatusChart = new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: [@foreach ($ordersStatusCount as $status => $details) "{{ ucfirst($status) }}", @endforeach],
                datasets: [{
                    data: [@foreach ($ordersStatusCount as $status => $details) {{ $details->total }}, @endforeach],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Monthly KPIs Bar Chart
        var monthlyKPIsChart = new Chart(monthlyKPIsCtx, {
            type: 'bar',
            data: {
                labels: ['Total Orders', 'Total Revenue', 'Average Order Value'],
                datasets: [{
                    label: 'Current Month KPIs',
                    data: [{{ $monthlyKPIs['totalOrders'] }}, {{ $monthlyKPIs['totalRevenue'] }}, {{ $monthlyKPIs['averageOrderValue'] }}],
                    backgroundColor: ['#4BC0C0', '#FF6384', '#36A2EB']
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection
