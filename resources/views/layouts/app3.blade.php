<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App Name</title>
    <!-- Add your CSS and JavaScript links here -->
</head>
<body>
    <header>
        <!-- Navigation Bar -->
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <!-- Add more navigation links here -->
                @if(Auth::check())
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('registerform') }}">Register</a></li>
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content') <!-- Area konten utama akan digantikan oleh tampilan yang sesuai -->
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>
</html>
