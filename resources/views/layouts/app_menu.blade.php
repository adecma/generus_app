@role('master')
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            ACL <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('permission.index') }}">Permission</a></li>
            <li><a href="{{ route('role.index') }}">Role</a></li>
        </ul>
    </li>
    <li><a href="{{ route('user.index') }}">User</a></li>
    <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
    <li><a href="{{ route('kelompok.index') }}">Kelompok</a></li>
@endrole

@role(['master', 'kelompok', 'viewer'])
    <li><a href="{{ route('generus.index') }}">Generus</a></li>
    <li><a href="{{ route('jurnal.index') }}">Jurnal</a></li>
@endrole