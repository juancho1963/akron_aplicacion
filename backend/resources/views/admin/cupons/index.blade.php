@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="p-4 text-black">Cupones</h3>
                    <a href="{{ route('admin.cupons.create')}}" class="btn btn-sm btn-primary">
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
                            <th scope="col">Descuento</th>
                            <th scope="col">Validez</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ( $cupons as $key => $cupon)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td>{{ $cupon->name }}</td>
                            <td>{{ $cupon->descuento }}</td>
                            <td>
                                @if ($cupon->checkIfValid())
                                    <span class="bg-success p-1 text-white">
                                    Caduca {{ \Carbon\carbon::parse($cupon->validoHasta)->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="bg-danger p-1 text-white">
                                    Caducado
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.cupons.edit',$cupon->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="deleteItem({{ $cupon->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="{{ $cupon->id}}" action="{{ route('admin.cupons.destroy', $cupon->id)}}" method="POST">
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
