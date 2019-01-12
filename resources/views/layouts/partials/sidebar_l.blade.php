  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLTE-2.4.5/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Eduardo González</p> -->

          <!-- Status -->

      <!-- <a href="#"><i class="fa fa-circle text-success"></i> Bienvenido</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ DE NAVEGACIÓN</li>
        <!-- Optionally, you can add icons to the links -->

        @foreach(Sidebar::get() as $drop)

        @if($drop->url == '#')

        <li class="treeview">
          <a href="#"><i class="{{ $drop->icono }}"></i> <span>{{ $drop->nombre }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @foreach($drop->dropdowns as $h_drop)
            <li><a href="{{ $h_drop->url }}"><i class="{{ $h_drop->icono }}"></i> {{ $h_drop->nombre }}</a></li>
            @endforeach
            
          </ul>
        </li>
        
        @else

        <li class="@yield($drop->nombre, ' ')">
          <a href="{{ $drop->url }}"><i class="{{ $drop->icono }}"></i> 
            <span>{{ $drop->nombre }}</span>
          </a>
        </li>

        @endif
        @endforeach

        <!-- /.sidebar-menu -->

      </section>
      <!-- /.sidebar -->
      
</aside>