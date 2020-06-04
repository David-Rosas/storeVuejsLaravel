<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
        @if(Auth::check())
            @if(Auth::user()->idrol == 1)
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Dashbord</a>
            </li>
            @endif
             @if(Auth::user()->idrol == 1)
            <li class="nav-title">
                Menú
            </li>
            @endif
           @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2 || Auth::user()->idrol == 3 )
            <li @click="menu=1" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-list"></i> Categorías</a>
            </li>
            @endif
            @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2 || Auth::user()->idrol == 3)
            <li @click="menu=2" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-tasks"></i> Productos</a>
            </li>
              @endif
            @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 3)
            <li @click="menu=3" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Compras</a>
            </li>
            @endif
            @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 3)
            <li @click="menu=4" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Proveedores</a>
            </li>
             @endif       
             @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2)
            <li @click="menu=5" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-suitcase"></i> Ventas</a>
            </li>
            @endif
            @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 2)
            <li @click="menu=6" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-users"></i> Clientes</a>
            </li>
             @endif
             @if(Auth::user()->idrol == 1)            
            <li @click="menu=7" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-user"></i> Usuarios</a>
            </li>
            @endif
            @if(Auth::user()->idrol == 1)
            <li @click="menu=8" class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-list"></i> Roles</a>
            </li>
           @endif     
        @endif    
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>