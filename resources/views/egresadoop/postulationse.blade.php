<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="font-size: 14px; font-family:courier;">
                    {{ __('POSTULACIONES') }}
                    &nbsp;
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrar" style="font-family:courier;">Crear </button>
                    &nbsp;
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert" style="opacity: 0.5">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-responsive" style="font-size: 14px">
                        <thead class="table-secondary" style="text-align: center; font-family:courier;">
                            <tr>
                                <th>ID</th>
                                <th>CV</th>
                                <th>SCORE</th>
                                <th>STATUS</th>
                                <th>GRADUATED_ID</th>
                                <th>JOBOFFER_ID</th>
                                <th>CREADO</th>
                                <th>ACTUALIZADO</th>
                                <th colspan="2">ACCIONES</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($postulaciones as $postulacion)
                            <tr>
                                <td>{{ $postulacion->id }}</td>
                                <td>{{ $postulacion->cv }}</td>
                                <td>{{ $postulacion->score }}</td>
                                <td>{{ $postulacion->status }}</td>
                                <td>{{ $postulacion->graduate->user->name }}</td>
                                <td>{{ $postulacion->joboffer_id }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($postulacion->created_at)) }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($postulacion->updated_at)) }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $postulacion->id }}" class="btn btn-sm btn-success">Editar</a>
                                </td>

                                <!-- Modal de Postulación-->
                                <div class="modal fade" id="modalEditar{{ $postulacion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:courier;">Modificar Postulación</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        <div class="modal-body" style="font-family:courier;">
                                            <form action="{{ route('postulacion.edit', $postulacion->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="formFile" class="form-label">Elejir CV</label>
                                                    <input class="form-control" type="file" id="formFile" name="cv" onChange>
                                                </div>

                                                <div class="form-group">
                                                    <label>Seleccione Trabajo *</label>
                                                    <select name="joboffer_id" class="form-control" required>
                                                        @foreach ($trabajos as $trabajo)
                                                            <option value="{{ $trabajo->id }}" {{ $trabajo->id == $postulacion->joboffer_id ? 'selected' : ''}}>{{ $trabajo->title.' - '.$trabajo->companie->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin Modal de edición-->
                                <td>
                                    <a href="{{ route('postulation.anular', $postulacion->id) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿ Desea anular la postulación ?')">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal de Postulación-->
 <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:courier;">Nueva Postulación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body" style="font-family:courier;">
            <form action="{{ route('postulacion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="formFile" class="form-label">Elejir CV</label>
                    <input class="form-control" type="file" id="cv" name="cv">
                    <embed id="preview" type="application/octet-stream" width="300" height="100" toolbar=1>
                </div>

                <div class="form-group">
                    <label>Seleccione Trabajo *</label>
                    <select name="joboffer_id" class="form-control" required>
                        @foreach ($trabajos as $trabajo)
                            <option value="{{ $trabajo->id }}">{{ $trabajo->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    document.querySelector('#cv').addEventListener('change', () =>{
    let documentFile = document.querySelector('#cv').files[0];
    let documentFileURL = URL.createObjectURL(documentFile);
    document.querySelector('#preview').setAttribute('src', documentFileURL);
    });
</script>
<!-- Fin Modal de edición-->
