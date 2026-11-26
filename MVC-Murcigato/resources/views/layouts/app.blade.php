<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Multitareas Murcigato') · Herramientas personales</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="app-shell">
        <aside class="app-sidebar" id="appSidebar" aria-label="Navegación principal">
            <a href="{{ url('/') }}" class="app-brand">
                <span class="app-brand-icon">
                    <img src="{{ asset('images/Diooona.png') }}" alt="Logo" width="44" height="44"
                        class="rounded">
                </span>
                <span>
                    <strong>Multitareas Murcigato</strong>
                    <small>Herramientas varias :D</small>
                </span>
            </a>

            <div class="sidebar-label">MENÚ PRINCIPAL</div>
            <nav class="sidebar-nav">
                @foreach ([['listaTareas.index', 'listaTareas.*', 'bi-check2-square', 'Lista de tareas'], ['propinas.index', 'propinas.*', 'bi-calculator', 'Calculadora de propinas'], ['passwords.index', 'passwords.*', 'bi-shield-lock', 'Generador de contraseñas'], ['gestorGastos.index', 'gestorGastos.*', 'bi-wallet2', 'Gestor de gastos'], ['reservas.index', 'Reservas.*', 'bi-calendar2-check', 'Sistema de reservas'], ['gestorNotas.index', 'gestorNotas.*', 'bi-journal-text', 'Gestor de notas'], ['cronometro.index', 'cronometro.*', 'bi-clock-history', 'Cronómetro']] as [$route, $pattern, $icon, $label])
                    <a href="{{ route($route) }}"
                        class="sidebar-link {{ request()->routeIs($pattern) ? 'active' : '' }}"
                        @if (request()->routeIs($pattern)) aria-current="page" @endif>
                        <i class="bi {{ $icon }}" aria-hidden="true"></i>
                        <span>{{ $label }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="sidebar-footer">
                <i class="bi bi-lightbulb" aria-hidden="true"></i>
                <span>Un espacio para trabajar varias cosas a la vez owo.</span>
            </div>
        </aside>

        <button class="sidebar-backdrop" id="sidebarBackdrop" type="button" aria-label="Cerrar menú"></button>

        <div class="app-main">
            <header class="app-topbar">
                <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Abrir menú"
                    aria-controls="appSidebar" aria-expanded="false">
                    <i class="bi bi-list" aria-hidden="true"></i>
                </button>
                <div>
                    <div class="topbar-eyebrow">ESPACIO INTERSTELAR</div>
                    <div class="topbar-title">Herramientas para tu día a día</div>
                </div>
                <div class="topbar-date">
                    <i class="bi bi-calendar3 me-2" aria-hidden="true"></i>{{ now()->format('d/m/Y') }}
                </div>
            </header>

            <main class="page-content">
                @if (session()->has('success') || session()->has('ok'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2" aria-hidden="true"></i>
                        {{ session('success', session('ok')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Revisa los datos:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="app-footer">
                <span>Multitareas Murcigato</span>
                <span>Hecho para ser algo de confianza</span>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
