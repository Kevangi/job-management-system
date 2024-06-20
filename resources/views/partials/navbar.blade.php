<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Job Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                @elseif(Auth::user()->role == 'employer')
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('employer.dashboard') }}">Dashboard</a>
                    </li>
                @elseif(Auth::user()->role == 'jobSeeker')
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('jobSeeker.dashboard') }}">Dashboard</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>