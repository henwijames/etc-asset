<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="autumn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Erick Trading Co. Asset Management System')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">

    <!-- Sidebar -->
    <div class="drawer text-white">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="bg-primary w-full">
                <div class="navbar container mx-auto justify-between">
                    <div class="flex-none lg:hidden">
                        <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block h-6 w-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="mx-2 px-2 lg:flex-none flex-1 flex items-center gap-2">
                        <img src={{ asset('assets/etclogo.jpeg') }} alt="etclogo" width="20">
                        Erick Trading Co.
                    </div>
                    <div class="hidden flex-none lg:block">
                        <ul class="menu menu-horizontal gap-2">
                            <!-- Navbar menu content here -->
                            <li>
                                <a href={{ route('dashboard') }}
                                    class="{{ request()->routeIs('dashboard') ? 'bg-secondary' : '' }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('') ? 'bg-secondary' : '' }}">
                                    Assets
                                </a>
                            </li>
                            <li>
                                <a href={{ route('departments.index') }}
                                    class="{{ request()->routeIs('departments*') ? 'bg-secondary' : '' }}">
                                    Departments
                                </a>
                            </li>
                            <form action={{ route('logout') }} method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary text-white">
                                    <i data-lucide="log-out"class="w-4"></i>
                                    Logout
                                </button>
                            </form>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-primary min-h-full w-80 p-4 gap-2">
                <div class=" px-2 flex items-center gap-2">
                    <img src={{ asset('assets/etclogo.jpeg') }} alt="etclogo" width="20">
                    Erick Trading Co.
                </div>
                <!-- Sidebar content here -->
                <li><a href={{ route('dashboard') }}
                        class="{{ request()->routeIs('dashboard') ? 'bg-secondary' : '' }}">
                        Dashboard
                    </a></a></li>
                <li><a>Sidebar Item 2</a></li>
                <li class="mt-auto">
                    <a href="" class="flex gap-2 items-center"><i data-lucide="log-out"class="w-4"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-6 container mx-auto">
        @yield('content')
    </main>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#00C111",
                }).showToast();
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 3000,
                    gravity: "bottom",
                    position: "right",
                    style.background: "#C10011",
                }).showToast();
            })
        </script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                document.addEventListener("DOMContentLoaded", function() {
                    Toastify({
                        text: "{{ $error }}",
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#C10011",
                    }).showToast();
                })
            @endforeach
        </script>
    @endif


</body>

</html>
