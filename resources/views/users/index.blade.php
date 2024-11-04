@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Usuarios</h1>
        
        <ul>
            @foreach ($users as $user)
                <li>
                    {{ $user->name }} - 
                    <x-sliderbar.linknab href="{{ route('users.edit', $user->id) }}" text="Asignar Rol a {{ $user->name }}"
                        icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v4.5m0 0H8.25M12 16.5h3.75m-3.75-9V12m0 0H8.25m3.75-3h3.75m-3.75 3v4.5" />
                        </svg>'
                    />
                </li>
            @endforeach
        </ul>
    </div>
@endsection
