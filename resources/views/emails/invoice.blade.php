<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007BFF;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            line-height: 1.6;
            font-size: 16px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice Details</h1>
        <p>Here are the details of your invoice:</p>
        @if(!empty($data['orders']) && $data['orders']->isNotEmpty())
            @foreach($data['orders'] as $order)
                <p><strong>Order ID:</strong> {{ $order['orderId'] }}</p>
                <p><strong>Total Amount:</strong> {{ number_format($order['totalPrice'], 2) }} SAR</p>
                <ul>
                    @foreach($order['items'] as $item)
                        <li>{{ $item['name'] }} - {{ $item['quantity'] }} x {{ number_format($item['price'], 2) }} SAR</li>
                    @endforeach
                </ul>
            @endforeach
        @else
            <p>Order ID: N/A</p>
            <p>Total Amount: 0.00 SAR</p>
        @endif
        <p><strong>Table Number:</strong> {{ $data['tableNumber'] }}</p>
        <p><strong>Restaurant Name:</strong> {{ $data['restaurantName'] }}</p>
        <div class="footer">
            Thank you for your visit!
        </div>
    </div>
</body>
</html>
