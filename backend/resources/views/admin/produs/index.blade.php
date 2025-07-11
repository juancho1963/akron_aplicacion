@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="p-4 text-black">Productos</h3>
                    <a href="{{ route('admin.produs.create')}}" class="btn btn-sm btn-primary">
                        <i class="fan fa-plus"></i>
                    </a>
                </div>
                <hr>
            </div>
            <div class="card-body">
                <table class="table">
                     <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Indice</th>
                            <th scope="col">Referencia</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Decripción</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produs as $key =>$produ)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td>{{ $produ->indice }}</td>
                            <td>{{ $produ->referencia }}</td>
                            <td>
                                @foreach ($produ->marcas as $marca)
                                    <span class="badge bg-light text-dark">
                                        {{ $marca->name}}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $produ->descripcion }}</td>
                            <td>{{ $produ->cantidad }}</td>
                            <td>{{ $produ->precio }}</td>
                            <td>{{ $produ->descuento }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <img src="{{ asset($produ->foto) }}" alt="{{ $produ->indice}}"
                                        class="img-fluid rounded mb-1 border border-muted"
                                        width="30" height="30">
                                </div>
                            </td>
                            <td>


                                <a href="{{ route('admin.produs.edit', $produ->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="#" onclick="deleteItem({{ $produ->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="{{ $produ->id}}"
                                    action="{{ route('admin.produs.destroy', $produ->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
