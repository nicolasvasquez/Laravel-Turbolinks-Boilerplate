<div class="sidebar-menu panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ url('/prueba') }}">Prueba</a></li>
            <li><a data-toggle="collapse" data-target="#collapseAdm">Administracion</a></li>
            <div id="collapseAdm" class="collapse">
                <ul class="nav nav-pills nav-stacked col-md-offset-1">
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('users.index') }}">Usuarios</a></li>
                </ul>
            </div>
        </ul>
    </div>
</div>