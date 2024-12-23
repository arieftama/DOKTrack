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

      <li class="nav-item">
        <a href="{{ route('tasklog.form') }}" class="nav-link">
          <i class="nav-icon fas fa-tasks"></i>
          <p>
            Task Log
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Logout</p>
        </a>
      </li>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </ul>
  </nav>
</div>
<!-- /.sidebar-menu -->