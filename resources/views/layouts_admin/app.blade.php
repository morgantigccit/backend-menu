<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <!-- Head section of your HTML -->
<link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            color: #F4EEFF!important; /* Light lavender background */
            background-color: #424874; /* Dark blue text for general readability */
        }
    
        .nav-link {
            color: #F4EEFF!important; /* Dark blue text */
            transition: background-color 0.3s;
        }
    
        .nav-link:hover,
        .nav-link:focus, {
            background-color: #DCD6F7; /* Lighter purple for hover */
            color: #424874;
        }
    
        .nav-link.active {
            background-color: #424874; /* Slightly darker purple for active state */
            color: #F4EEFF!important;
        }
    
        .menu-icon,
        .menu-arrow {
            color: #F4EEFF!important; /* Consistent icon colors */
        }
        .menu-icon:hover,
        .menu-icon:focus,
        .menu-arrow:hover ,
        .menu-arrow:focus {
            color: #424874!important; /* Consistent icon colors */
        }
    
         .nav-link {
            color: #F4EEFF!important; /* Ensuring sub-menu items are also readable */
        }
        .sub-menu .nav-link.active {
            color: #424874!important; /* Ensuring sub-menu items are also readable */
        }
        .sub-menu {
            color: #424874!important; /* Ensuring sub-menu items are also readable */

        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('partials.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('partials.settings-panel')
            @include('partials.sidebar')

            <div class="main-panel">
                <div class="content-wrapper p-3">
                    <div id="notifications"></div>
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>
                            from BootstrapDash.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All
                            rights reserved.</span>
                    </div>
                </footer>
                
                <!-- partial -->
            </div>
        </div>
        <!-- page-body-wrapper ends -->`
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Initialize Pusher
        Pusher.logToConsole = true; // Remove in production for security reasons

        var pusher = new Pusher('637497b6e9aaef2edcaa', {
            cluster: 'ap2'
        });

        // Notification for waiter calls
        var channel = pusher.subscribe('waiter-calls');
        channel.bind('WaiterCalled', function(data) {
            // Ensure the restaurant name from Laravel is correctly formatted as a JavaScript string
            var currentRestaurantName =
            "{{ auth()->user()->restaurant_name }}"; // Convert PHP variable to JavaScript string
            console.log(currentRestaurantName, "Current restaurant name for logged-in user");

            if (currentRestaurantName === data.restaurant_name) {
                var audio = new Audio('{{ asset('note.mp3') }}');
                audio.play();
                console.log(data, "Data received from the event");
                showNotificationPopup('Table number ' + data.tableNumber + ' called a waiter at ' + data
                    .restaurant_name);
            }
        });

        // Function to display notifications
        function showNotificationPopup(message) {
            var popup = document.createElement('div');
            popup.className = 'notification-popup';
            popup.innerHTML = '<span>' + message +
                '</span><span class="close-btn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
            document.body.appendChild(popup);
            setTimeout(function() {
                popup.classList.add('active');
            }, 100); // Delay for adding to the DOM
            setTimeout(function() {
                popup.classList.remove('active');
                setTimeout(function() {
                    popup.remove();
                }, 600);
            }, 8000); // Hide and remove after a delay
        }
        // Notification for order updates
        var channelOrders = pusher.subscribe('orders');

        channelOrders.bind('OrderUpdated', function(data) {
            var currentRestaurantName = "{{ auth()->user()->restaurant_name }}"; // Convert PHP variable to JavaScript string
            if (currentRestaurantName === data.restaurant_name) {

                var audio = new Audio('{{ asset('note.mp3') }}');
                audio.play();
                showNotificationPopup('Order updated for table number ' + data.tableNumber);
            }
        });

        // Show popup notification
    </script>

</body>

</html>
