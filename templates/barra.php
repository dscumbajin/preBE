<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">

            <span class="dropdown-item dropdown-header"> <i class="far fa-user"></i> <?php echo $_SESSION['usuario'];?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="dropdown-divider"></div>

            <?php if ($_SESSION['nivel'] == 1) : ?>
            <a href="editar-admin.php?id=<?php echo $_SESSION['id'];?>" class="dropdown-item">
              <i class="fas fa-cogs"></i>
              <span class="float-right text-muted text-sm">Ajustes</span>
            </a>
            <?php endif; ?>
            <div class="dropdown-divider"></div>
            <a href="login.php?cerrar_sesion=true" class="dropdown-item">
              <i class="fas fa-users mr-2"></i>
              <span class="float-right text-muted text-sm">Cerrar Sesión</span>
            </a>


          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->