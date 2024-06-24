<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Weather App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-5 px-5 py-2">
        <a class="navbar-brand" href="{{ url('/') }}">Weather App</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="collapsibleNavId">
            <ul class="navbar-nav mt-lg-0 mr-auto mt-2">
            </ul>
            <ul class="navbar-nav my-lg-0 ml-auto mt-2 text-right">
                @if (Auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{ Auth()->user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">Log
                                    Out</a>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="dropdown-item" href="{{ route('login') }}"> Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

        <div class="container-fluid weather-data my-4">
            <div class="row">
                <div class="col-xxl-3 col-md-4 px-lg-4">
                    <h5 class="h5 text-center">Search By City</h5>
                    @if (Auth()->check())
                        <form onsubmit="return false;">

                            <input type="text" id="city-input" class="form-control py-2"
                                placeholder="E.g., New York, London, Tokyo">
                            <button id="search-btn" class="btn btn-primary w-100 mb-2 mt-3 py-2">Search</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2 mt-3 py-2">Login To
                            Continue</a>
                        <div class="text-center">
                            or
                        </div>
                        <a href="{{ route('register') }}" class="btn btn-primary w-100 mb-2 mt-3 py-2">Register Your
                            Account</a>
                    @endif
                </div>
                <div class="col-xxl-9 col-md-8 mt-md-1 pe-lg-4 mt-4">
                    <div class="current-weather bg-primary rounded-3 px-4 py-2 text-white">
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                <h3 class="fw-bold">_______ ( ______ )</h3>
                                <h6 class="my-3 mt-3">Temperature: __°C</h6>
                                <h6 class="my-3">Wind: __ M/S</h6>
                                <h6 class="my-3">Humidity: __%</h6>
                            </div>
                        </div>
                    </div>
                    <h4 class="fw-bold my-4">5-Day Forecast</h4>
                    <div
                        class="days-forecast row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 justify-content-between">
                        <div class="col mb-3">
                            <div class="card bg-secondary border-0 text-white">
                                <div class="card-body p-3 text-white">
                                    <h5 class="card-title fw-semibold">( ______ )</h5>
                                    <h6 class="card-text my-3 mt-3">Temp: __°C</h6>
                                    <h6 class="card-text my-3">Wind: __ M/S</h6>
                                    <h6 class="card-text my-3">Humidity: __%</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="card bg-secondary border-0 text-white">
                                <div class="card-body p-3 text-white">
                                    <h5 class="card-title fw-semibold">( ______ )</h5>
                                    <h6 class="card-text my-3 mt-3">Temp: __°C</h6>
                                    <h6 class="card-text my-3">Wind: __ M/S</h6>
                                    <h6 class="card-text my-3">Humidity: __%</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="card bg-secondary border-0 text-white">
                                <div class="card-body p-3 text-white">
                                    <h5 class="card-title fw-semibold">( ______ )</h5>
                                    <h6 class="card-text my-3 mt-3">Temp: __°C</h6>
                                    <h6 class="card-text my-3">Wind: __ M/S</h6>
                                    <h6 class="card-text my-3">Humidity: __%</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="card bg-secondary border-0 text-white">
                                <div class="card-body p-3 text-white">
                                    <h5 class="card-title fw-semibold">( ______ )</h5>
                                    <h6 class="card-text my-3 mt-3">Temp: __°C</h6>
                                    <h6 class="card-text my-3">Wind: __ M/S</h6>
                                    <h6 class="card-text my-3">Humidity: __%</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="card bg-secondary border-0 text-white">
                                <div class="card-body p-3 text-white">
                                    <h5 class="card-title fw-semibold">( ______ )</h5>
                                    <h6 class="card-text my-3 mt-3">Temp: __°C</h6>
                                    <h6 class="card-text my-3">Wind: __ M/S</h6>
                                    <h6 class="card-text my-3">Humidity: __%</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="{{ url('asset/script.js') }}" defer></script>

</html>
