<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>

    <!-- Estrutura da pagina -->

    <!-- Cabeçalho -->

    <!-- Opções -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <i class="bi bi-bag-heart" style="font-size: 3rem; color: #EB5353;"></i>
            </a>

            <!-- Opcoes -->
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="{{ route('states.index') }}" class="nav-link px-2 link-dark">Estados</a></li>
                <li><a href="{{ route('cities.index') }}" class="nav-link px-2 link-dark">Cidades</a></li>
                <li><a href="{{ route('products.index') }}" class="nav-link px-2 link-dark">Produtos</a></li>
                <li><a href="{{ route('people.index') }}" class="nav-link px-2 link-dark">Pessoas</a></li>
                <li><a href="{{ route('purchases.index') }}" class="nav-link px-2 link-dark">Compras</a></li>
            </ul>

            <div class="col-md-3 text-end">
                @if (Auth::check())
                <!-- Logged -->
                {{ Auth::user()->name }}
                <!-- Logout -->
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">Logout</button>
                </form>
                @else
                <!-- Login -->
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Sign-up</a>
                @endif
            </div>
        </header>
    </div>

    <!-- Mensagem -->
    @if(session('success'))
    <div class="container">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Mensagem -->
    @if(session('error-message'))
    <div class="container">
        <div class="alert alert-danger">
            {{ session('error-message') }}
        </div>
    </div>
    @endif

    <!-- Erros -->
    <div class="container">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- CONTEUDO DA PAGINA -->
    <div id="content" class="container">
        @yield('conteudo')
    </div>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- JS -->
    <script src=" {{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>