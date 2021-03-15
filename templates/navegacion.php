  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="login.php?cerrar_sesion=true" class="brand-link">
          <img src="img/logo-baterias.png" alt="Logo baterias" class="brand-image elevation-3" style="opacity: .8">
          <br>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

              <div class="info" style="color: white;">
                  

                  <?php
                    if ($_SESSION['user_nivel'] == 2) {

                        echo '<span class="badge badge-success">Administrador</span>';
                    } else {
                        echo '<span class="badge badge-primary">User</span>';
                    }
                    ?>
                    <a href="#" class="d-block">Usuario: <?php echo $_SESSION['user_name']; ?></a>
                    <a href="#" class="d-block"><?php echo $_SESSION['user_email']; ?></a>
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
                      <a href="lista-vendedor.php" class="nav-link">
                          <i class="nav-icon fas fa-universal-access"></i>

                          <p>
                              Vendedores
                              <i class="fas fa-angle-left right"></i>
                          </p>
                          
                      </a>
                      <!-- <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="lista-vendedor.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Ver Todos</p>
                              </a>
                          </li>
                      </ul> -->
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="lista-segmento.php" class="nav-link">
                          <i class=" nav-icon fas fa-building"></i>

                          <p>
                              Segmentos
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <!-- <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="lista-segmento.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Ver Todos</p>
                              </a>
                          </li>
                      </ul> -->
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Linea de negocio
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="lista-linea.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Administrar</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="lista-historial.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Cargar Historial Ventas</p>
                              </a>
                          </li>

                          <?php
                            try {
                                $sql = "SELECT * FROM listalinea WHERE estadoLinea = '1' ";
                                $resultado = $con->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while ($linea_negocio = $resultado->fetch_assoc()) { ?>
                              <li class="nav-item">
                                  <a href="lista-vendedor-linea.php?codLinea=<?php echo $linea_negocio['codLinea'] ?>&nomLinea=<?php echo $linea_negocio['nomLinea']; ?>" class="nav-link">
                                      <i class="nav-icon fas fa-plus-circle"></i>
                                      <p style="font-size: 12px;"><?php echo $linea_negocio['nomLinea']; ?></p>
                                  </a>
                              </li>
                          <?php } ?>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="lista-presupuestos-anio.php" class="nav-link">
                          <i class=" nav-icon fas fa-file-invoice-dollar"></i>
                          <p>
                              Presupuestos por año
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                     <!--  <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="lista-presupuestos-anio.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Ver Todos</p>
                              </a>
                          </li>
                      </ul> -->
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="lista-presupuestos-mes.php" class="nav-link">
                          <i class=" nav-icon fas fa-file-invoice-dollar"></i>
                          <p>
                              Presupuestos por mes
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <!-- <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="lista-presupuestos-mes.php" class="nav-link">
                                  <i class="nav-icon fas fa-list-ul"></i>
                                  <p>Ver Todos</p>
                              </a>
                          </li>
                      </ul> -->
                  </li>

                  <?php if ($_SESSION['user_nivel'] == 2 && $_SESSION['user_usuario'] == "admin") : ?>
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