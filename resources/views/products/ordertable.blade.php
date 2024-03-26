<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand"  href="{{ route('welcome') }}" style="color: white">Home</a>
        <a href="{{ route('products.index') }}" class="navbar-brand" style="color: white">List</a>
        
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Order Product</h1>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <button class="btn btn-primary order-btn">Order Now</button>
                        <form action="{{ route('order.place') }}" method="POST" class="mt-3 order-form" style="display: none;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="order_date">Order Date:</label>
                                <input type="date" id="order_date" name="order_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Confirm Order</button>
                            <div class="mt-3 order-success-message" style="display: none;">
                                <p>Order placed successfully!</p>
                                <p>Expected Delivery Date: <span class="delivery-date"></span></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderButtons = document.querySelectorAll('.order-btn');
            orderButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const form = this.nextElementSibling;
                    form.style.display = 'block';
                });
            });

            const orderForms = document.querySelectorAll('.order-form');
            orderForms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const orderDate = this.querySelector('#order_date').value;
                    const deliveryDate = new Date(orderDate);
                    deliveryDate.setDate(deliveryDate.getDate() + 3); // Assuming 3 days for delivery
                    const formattedDeliveryDate = deliveryDate.toDateString();
                    const successMessage = this.querySelector('.order-success-message');
                    successMessage.querySelector('.delivery-date').textContent = formattedDeliveryDate;
                    successMessage.style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>
