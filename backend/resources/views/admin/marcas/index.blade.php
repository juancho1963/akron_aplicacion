@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="p-4 text-black">Marcas</h3>
                    <a href="{{ route('admin.marcas.create')}}" class="btn btn-sm btn-primary">
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ( $marcas as $key => $marca)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td>{{ $marca->name }}</td>
                            <td>
                                <a href="{{ route('admin.marcas.edit',$marca->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="deleteItem({{ $marca->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="{{ $marca->id}}" action="{{ route('admin.marcas.destroy', $marca->id)}}" method="POST">
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
