<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'Dashboard') ? 'active': '' }}" aria-current="page" href="/dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'Post') ? 'active': '' }}" href="/post">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'Post Category') ? 'active': '' }}" href="/post-category">Post Category</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
            </ul>
          </li>
          <li class="nav-item">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item">
                    Logout
                </button>
            </form>
          </li>
        @else
        
          <li class="nav-item">
            <a class="nav-link {{ ($active === 'Login') ? 'active': '' }}" href="/login">Login</a>
          </li>
        
        @endauth
        </ul>
      </div>
    </div>
  </nav>