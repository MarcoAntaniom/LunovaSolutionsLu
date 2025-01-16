      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="fa-solid fa-house-chimney"></i>
                  <p>Escritorio</p>
                </a>
               </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-users"></i>
                  <p>Usuarios<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="crear_usuario.php" class="nav-link">
                      <i class="fa-solid fa-user-plus"></i>
                      <p>Crear Usuario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="listado_usuarios.php" class="nav-link">
                      <i class="fa-solid fa-users"></i>
                      <p>Listado de Usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="crear_tipo_trabajador.php" class="nav-link">
                      <i class="fa-solid fa-user-plus"></i>
                      <p>Crear Tipo de Trabajador</p> 
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="listado_tipo_trabajador.php" class="nav-link">
                      <i class="fa-solid fa-users"></i>
                      <p>Listado de Tipos de Trabajador</p>
                    </a>
                  </li>
                </ul>
               </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>