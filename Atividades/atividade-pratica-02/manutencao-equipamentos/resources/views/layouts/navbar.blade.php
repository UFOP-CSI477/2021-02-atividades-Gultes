 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('index') }}" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('login') }}" class="nav-link">Login</a>
         </li>
         @if (Auth::user())
             <li class="nav-item d-none d-sm-inline-block">
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit" class="btn btn-outline-danger">Logout</button>
                 </form>
             </li>
         @endif
     </ul>

     <ul class="navbar-nav ml-auto">
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt"></i>
             </a>
         </li>
     </ul>
 </nav>
