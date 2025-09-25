@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="p-4 text-black">Pedidos</h3>
                </div>

                    <hr>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                     <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Pedido</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Comprobante Pago</th>
                            <th scope="col">Fecha pedido</th>
                            <th scope="col">Fecha facturacion</th>
                            <th scope="col">Fecha entrega</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ( $pedids as $key => $pedid)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td scope="col">{{ $pedid->nameUser}}</td>
                            <td scope="col">{{ $pedid->id}}</td>
                            <td scope="col">{{ $pedid->montoTotalPed}}Bs</td>
                            <td scope="col">{{ $pedid->compPago}}</td>
                            <td scope="col">{{ $pedid->fechaPedido}}</td>
                            <td scope="col">
                                @if ($pedid->statusped == 1)
                                     <a href="{{route('admin.pedids.factura', $pedid->id) }}">
                                        <i class="fas fa-people-carry text-primary-emphasis mx-2"></i>
                                    </a>
                                @else
                                    <span class="badge bg-sucess">
                                        {{\Carbon\Carbon::parse($pedid->fechaFactura)->diffForHumans() }}
                                    </span>
                                @endif
                            </td>
                            <td scope="col">
                                @if ($pedid->statusped == 2)
                                    <a href="{{route('admin.pedids.update', $pedid->id) }}">
                                        <i class="fas fa-people-carry text-primary-emphasis mx-2"></i>
                                    </a>
                                @elseif ($pedid->statusped == 1)
                                    <span>--</span>
                                @else
                                    <span class="badge bg-sucess">
                                        {{\Carbon\Carbon::parse($pedid->fechaPagp)->diffForHumans() }}
                                    </span>
                                @endif
                            </td>
                            <td>

                                <a href="#" onclick="deleteItem({{ $pedid->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="{{ $pedid->id}}" action="{{ route('admin.pedids.delete', $pedid->id) }}" method="POST">
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
