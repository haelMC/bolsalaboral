@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuario: {{ $user->name }}</h1>

        <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
            @csrf
            <label for="role">Asignar rol:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="empresa">Empresa</option>
                <option value="usuario">Usuario</option>
            </select>
            <button type="submit">Asignar Rol</button>
        </form>
    </div>
@endsection
