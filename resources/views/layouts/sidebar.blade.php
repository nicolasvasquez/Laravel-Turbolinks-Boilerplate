<div class="sidebar-menu">
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ url('/prueba') }}">Prueba</a></li>
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a data-toggle="collapse" data-target="#collapseAdm">Administracion</a></li>
        <div id="collapseAdm" class="collapse">
            <ul>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li><a href="{{ route('users.index') }}">Usuarios</a></li>
            </ul>
        </div>
    </ul>
</div>