<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - STPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Dashboard Super Admin</h1>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Logout</button>
            </form>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <p class="mb-2"><strong>Login sebagai:</strong> {{ auth()->user()->name }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p class="mb-0"><strong>Role:</strong> {{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>
</body>

</html>
