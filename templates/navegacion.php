  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="login.php?cerrar_sesion=true" class="brand-link">
      <img src="img/logo-baterias.png" alt="Logo baterias" class="brand-image elevation-3" style="opacity: .8" >
      <br>
    </a>



    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info" style="color: white;">
          <a href="#" class="d-block"><?php echo $_SESSION['user_name']; ?></a>

          <?php
          if ($_SESSION['user_nivel'] == 2) {

            
            echo 'Usuario: <span class="badge badge-success">Administrador</span>';
          } else {
            echo 'Usuario: <span class="badge badge-primary">User</span>';
          }
          ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-header">Menú de adminstración</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin-area.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>

              <p>
                Vendedor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-vendedor.php" class="nav-link">
                  <i class="nav-icon fas fa-list-ul"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Linea
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-programa.php" class="nav-link">
                  <i class="nav-icon fas fa-list-ul"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-building"></i>

              <p>
                Segmento
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-portafolio.php" class="nav-link">
                  <i class="nav-icon fas fa-list-ul"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Presupuestos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-presupuestos.php" class="nav-link">
                  <i class="nav-icon fas fa-list-ul"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
            </ul>
          </li>


          <?php if ($_SESSION['user_nivel'] == 2) : ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">

                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Adminstradores
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-admin.php" class="nav-link">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>Ver Todos</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>