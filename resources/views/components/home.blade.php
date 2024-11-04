@extends('layouts.app')

@section('content')
    <!-- Componente de Banner -->
    <x-banner />

    <!-- Sección de estadísticas -->
    <div class="mt-10">
        <h2 class="text-3xl font-semibold text-center mb-6">Sección de Beneficios</h2>
        <x-benefits />
    </div>
@endsection
