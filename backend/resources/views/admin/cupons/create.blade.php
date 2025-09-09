@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4 text-black">Nuevo cupón</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.cupons.store')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="floatingInput" placeholder="Cupón"
                                value="{{ old('name') }}">
                              <label for="floatingInput">Cupón</label>
                              @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="form-floating mb-3">
                              <input type="number" class="form-control @error('descuento') is-invalid @enderror" name="descuento"
                                id="floatingInput" placeholder="Descuento"
                                value="{{ old('descuento') }}">
                              <label for="floatingInput">Descuento</label>
                              @error('descuento')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="form-floating mb-3">
                              <input type="datetime-local" class="form-control @error('validoHasta') is-invalid @enderror" name="validoHasta"
                                id="floatingInput" placeholder="Fecha de validez"
                                min="{{ \Carbon\carbon::now()->addDays(1) }}"
                                value="{{ \Carbon\carbon::now()->format('Y-m-d\Th:i:s') }}">
                              <label for="floatingInput">Fecha de validez</label>
                              @error('validoHasta')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Crear Cupón
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

