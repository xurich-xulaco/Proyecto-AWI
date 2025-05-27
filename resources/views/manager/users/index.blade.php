@extends('layouts.app')
@section('title','Usuarios')
@section('content')
<h2>Usuarios</h2>
<table class="table">
  <thead><tr><th>Nombre</th><th>Email</th><th>Rol</th><th>Acción</th></tr></thead>
  <tbody>
    @foreach($users as $u)
    <tr>
      <td>{{ $u->name }}</td>
      <td>{{ $u->email }}</td>
      <td>{{ $u->role->name }}</td>
      <td>
        <form method="POST" action="{{ route('manager.users.destroy',$u) }}">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
