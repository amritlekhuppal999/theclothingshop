
  <aside class="main-sidebar elevation-4 sidebar-dark-purple ">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex ">
        <div class="image">
          <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- Admin Name --}}
          <a href="#" class="d-block">Super Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent " data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

          {{-- Products --}}
          <li class="nav-item has-treeview {{ (request()->is('admin/products*')) ? "menu-open" : ""}} ">
            <a href="#" class="nav-link {{ (request()->is('admin/products*')) ? "active" : ""}}">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <i class="nav-icon fas fa-tshirt"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{ (request()->is('admin/products')) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products-stock" class="nav-link {{ (request()->is('admin/products-stock')) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/products-add" class="nav-link {{ (request()->is('admin/products-add')) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Products</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Categories --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Categories</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/category-add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/sub-category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Category</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Attributes --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Attributes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            {{-- Size --}}
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/attribute" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Attributes</p>
                </a>
              </li>

              {{-- Color --}}
              <li class="nav-item">
                <a href="/admin/attribute-add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attributes</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Orders --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/orders" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/orders-completed" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed Orders</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/orders-cancelled" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancelled Orders</p>
                </a>
              </li>

              {{-- Pendiing Orders --}}
              <li class="nav-item">
                <a href="/admin/orders-pending" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendiing Orders</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Sales --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-rupee-sign"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/orders" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Users --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/category-add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Users</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Logout --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          
          


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>