<?php 

use Carbon\Carbon;?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo api Drogueria Hofmann</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="container-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Código</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersList as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['code'] }}</td>
                    <td>{{ number_format($user['amount'], 0, ",", ".")}}</td>
                    <td>{{ Carbon::parse($user['date'])->format('d-m-Y') }}</td>
                    <td>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user['id']}}">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($usersList as $modalUser)
    <div class="modal fade" id="exampleModal{{$modalUser['id']}}" tabindex="-1" aria-labelledby="exampleModal{{$modalUser['id']}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModal{{$modalUser['id']}}Label">Hofmann</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('enviar-datos') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input required type="text" class="form-control" value="{{$modalUser['id']}}" name="id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Código</label>
                            <select name="code" class="form-select" aria-label="Default select example">
                                @foreach ($getUsers as $user )
                                <option value="{{$user['code']}}">{{$user['code']}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Monto</label>
                            <input required type="text" class="form-control" value="{{$modalUser['amount']}}" name="amount">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input required type="datetime-local" class="form-control" value="{{Carbon::parse($modalUser['date'])->format('Y-m-d\TH:i')}}" name="date">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @endforeach

</body>

</html>