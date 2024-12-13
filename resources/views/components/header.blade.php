<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand item-logo" style="font-weight: 500; font-family: sans-serif; font-size: 25px;" href="">Ghost Exchange</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('wallets') }}">Wallet</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li> <li class="nav-item">
            <a class="nav-link" href="">Supports</a>
          </li> 
          @if (auth()->check())
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Manage
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href=""
                  >Category</a
                >
              </li>
              <li>
                <a class="dropdown-item" href="">Tag</a>
              </li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item" href=""
                  >Post</a
                >
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <td>
                <button
                  class="btn btn-danger nav-link authStyle"
                  style="color: white"
                  role="button"
                  >Logout</button
                >
              </td>
            </form>
          </li>
          
          @else
          
          <li class="nav-item">
            <a class="btn btn-success nav-link authStyle" style="color: white" href="{{ route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-success nav-link authStyle" style="color: white" href="{{ route('Register') }}">Register</a>
          </li>
          @endif
          
          
        </ul>
      </div>
    </div>
  </nav>