<!-- filepath: /C:/laragon/www/DOKTrack/resources/views/layouts/sidebar.blade.php -->
<div class="sidebar" style="background-color: black">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3" style="background-color: #2c3e50; padding: 10px; border-radius: 5px; color: #ecf0f1;">
    <div class="info" style="margin-bottom: 5px;">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
  </div> 

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('attendance.form') }}" class="nav-link">
          <i class="nav-icon fas fa-calendar-check"></i>
          <p>
            Attendance
          </p>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('tasklog.*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tasks"></i>
          <p>
            Task Log
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('tasklog.create') }}" class="nav-link {{ request()->routeIs('tasklog.create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Task</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tasklog.index') }}" class="nav-link {{ request()->routeIs('tasklog.index') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Task Log</p>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item {{ request()->routeIs('messages.*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-envelope"></i>
          <p>
            Messages
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('messages.index') }}" class="nav-link {{ request()->routeIs('messages.index') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Message List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('messages.create') }}" class="nav-link {{ request()->routeIs('messages.create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Message</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item {{ request()->routeIs('account.*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Account
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('account.index') }}" class="nav-link {{ request()->routeIs('account.index') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>User List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('account.create') }}" class="nav-link {{ request()->routeIs('account.create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Create User</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ route('report.index') }}" class="nav-link">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Laporan
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Logout</p>
        </a>
      </li>
    </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </ul>
  </nav>
</div>
<!-- /.sidebar-menu -->