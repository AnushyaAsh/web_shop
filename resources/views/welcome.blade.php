<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome to Our Webshop</h1>
        <div class="row mt-5">
            <div class="col-md-4">
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-block">List Of Products</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('products.create') }}" class="btn btn-success btn-block">Add Product</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('products.order.table') }}" class="btn btn-info btn-block">Order Product</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
