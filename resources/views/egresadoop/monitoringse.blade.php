<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header" style="font-size: 14px; font-family:courier;">
                {{ __('Monitoreodetalles') }}
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert" style="opacity: 0.5">
                        {{ session('status') }}
                    </div>
                @endif

                <br>
                <table class="table table-dark table-responsive" style="font-size: 14px">
                    <thead class="table-secondary" style="text-align: center; font-family:courier;">
                        <tr style="background-color:#7D3C98">
                            <th>RECOMENDACION</th>
                            <th>DESCRIPCION </th>
                            <th>DATO_DE_MONITOREO</th>
                            <th>MONITOREO_CREADO</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($monitoreos as $monitoreo)
                        <tr>
                            <td>{{ $monitoreo->recommendation }}</td>
                            <td>{{ $monitoreo->description }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($monitoreo->date_monitoring)) }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($monitoreo->created_at)) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


