<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Administrativo - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="h-full overflow-hidden flex bg-slate-50">

    <!-- Sidebar Mobile Toggle -->
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-slate-500 rounded-lg sm:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r border-slate-200 shadow-sm flex flex-col">
            <div class="flex items-center ps-2.5 mb-8">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center me-3 shadow-indigo-200 shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div>
                   <h1 class="text-xl font-bold text-slate-800 tracking-tight">Chatbot</h1>
                   <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Admin Panel</p>
                </div>
            </div>
            
            <ul class="space-y-1 font-medium flex-1">
                <li>
                    <a href="#" class="flex items-center p-2 text-slate-700 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                
                <li>
                   <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mt-6 mb-2">Administración</p>
                </li>

                <li>
                    <a href="{{ route('admin.areas.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/areas*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="ms-3">Áreas</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.ubicaciones.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/ubicaciones*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="ms-3">Ubicaciones</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.canales.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/canales*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="ms-3">Canales</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.horarios.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/horarios*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="ms-3">Horarios</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.documentos.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/documentos*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="ms-3">Documentos</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.medios.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/medios*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        <span class="ms-3">Medios</span>
                    </a>
                </li>

                <li>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mt-6 mb-2">Base de Conocimientos</p>
                </li>

                <li>
                    <a href="{{ route('admin.preguntas.index') }}" class="flex items-center p-2 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 group {{ request()->is('admin/preguntas*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="ms-3">Preguntas y Respuestas</span>
                    </a>
                </li>
            </ul>

            <div class="pt-4 border-t border-slate-100">
                <a href="#" class="flex items-center p-2 text-slate-500 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="ms-3">Cerrar sesión</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ms-0 sm:ms-64 h-full overflow-y-auto">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-30 shadow-sm shadow-slate-100/50">
            <h2 class="text-lg font-semibold text-slate-800">@yield('title', 'Dashboard')</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 text-sm font-medium text-slate-600">
                    <span>Admin</span>
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200">
                        <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8 pb-16">
            @yield('content')
        </div>
    </main>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col space-y-2">
        @if(session('success'))
            <x-toast type="success" :message="session('success')" />
        @endif
        @if(session('error'))
            <x-toast type="error" :message="session('error')" />
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
</body>

</html>
