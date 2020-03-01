<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Compras-Ventas con Laravel y Vue Js- webtraining-it.com">
    <meta name="keyword" content="Sistema Compras-Ventas con Laravel y Vue Js">
    <title>Proyecto</title>
    <!-- Icons -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-line-icons.min.css" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!--PONER LOGO-->
        <!--<a class="navbar-brand" href="#"></a>-->
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Dashbord</a>
            </li>
           
        </ul>
        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">usuario </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i> Cerrar sesión</a>

                    <form id="logout-form" action="" method="POST" style="display: none;">
                      
                    </form>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">

       <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Dashbord</a>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>

                   
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-list"></i> Categorías</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-tasks"></i> Productos</a>
                    </li>
                      
            
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Compras</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-users"></i> Proveedores</a>
                    </li>
                       
                   
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-suitcase"></i> Ventas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-users"></i> Clientes</a>
                    </li>
                        
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-user"></i> Usuarios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-list"></i> Roles</a>
                    </li>
                        
                    
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Contenido Principal -->
        @yield('content')
        <!-- /Fin del contenido principal -->
    </div>   

    <footer class="app-footer">
        <span><a href="http://www.webtraining-it.com/">webtraining-it.com</a> &copy; 2019</span>
        <span class="ml-auto">Desarrollado por <a href="http://www.webtraining-it.com/">webtraining-it.com</a></span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="js/Chart.min.js"></script>
    <!-- GenesisUI main scripts -->
    <script src="js/template.js"></script>
</body>

</html>