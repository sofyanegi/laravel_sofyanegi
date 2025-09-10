<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">🏥 HMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('hospital*') ? 'active' : '' }}" href="/hospital">Rumah
                        Sakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('patients*') ? 'active' : '' }}" href="/patient">Pasien</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    {{ auth()->user()->username ?? 'Guest' }}
                </span>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
