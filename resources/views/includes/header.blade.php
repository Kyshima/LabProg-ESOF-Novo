<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}"> <!-- Comentarios em Laravel sao com as chavetas e tracos -->
                  <img src="{{URL::asset('/img/EternoCandidato.png')}}" alt="logo" height="50" width="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link">Home</a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('search')}}" class="nav-link">Search</a>
                      </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Register') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                                    <a class="dropdown-item" href="{{ url('/registerE') }}">
                                        {{ __('Registar Company') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ url('/registerC') }}">
                                        {{ __('Register Candidate') }}
                                    </a>
                                </div>
                            </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="right: 0; left: auto;">
                                    <a class="dropdown-item" href="{{ route('edit') }}">
                                        {{ __('Edit your Information') }}
                                    </a>
                                    <?php
                                        $user = Auth::user();
                                        if($user->type == 1){
                                            echo "<a class='dropdown-item' href="."/editPhoto".">Edit Your Photo</a>";
                                        }
                                    ?>
                                

                                    <a class="dropdown-item" href="{{ route('password.request') }}">
                                        {{ __('Edit your Credentials') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('delete') }}">
                                        {{ __('Delete Profile') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>   
            </div>   
        </nav>
    