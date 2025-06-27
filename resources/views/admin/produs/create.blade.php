@extends('admin.layouts.app')

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9 mx-auto">
            <div class="row">
                <h3 class="p-4 text-black">Nuevo Producto</h3>
                <hr>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.produs.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-3"><!-- Indice -->
                              <input type="text" class="form-control @error('indice') is-invalid @enderror" name="indice"
                                id="floatingInput" placeholder="Indice del Producto"
                                value="{{ old('indice')}}">
                              <label for="floatingInput">Indice del Producto</label>
                              @error('indice')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="form-floating mb-3"><!-- Referencia -->
                              <input type="text" class="form-control @error('referencia') is-invalid @enderror" name="referencia"
                                id="floatingInput" placeholder="Referencia del Producto"
                                value="{{ old('referencia')}}">
                              <label for="floatingInput">Referencia del Producto</label>
                              @error('referencia')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="mb-3"><!-- Marcas -->
                                <label for="marca_id" class="my-2 text-black">Selecciona las Marcas</label>
                                <select name="marca_id[]" id="marca_id"
                                    class="form-control @error('marca_id') is-invalid @enderror" multiple>
                                    @foreach($marcas as $marca)
                                        <option @if(collect(old('marca_id'))->contains($marca->id)) selected @endif
                                        value="{{ $marca->id }}">

                                        {{ $marca->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('marca_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3"><!-- Descripcion -->
                              <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                id="floatingInput" placeholder="Descripcion del Producto"
                                value="{{ old('descripcion')}}">
                              <label for="floatingInput">Descripcion del Producto</label>
                              @error('descripcion')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>


                            <div class="form-floating mb-3"><!-- Cantidad -->
                              <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                id="floatingInput" placeholder="Cantidad"
                                value="{{ old('cantidad')}}">
                              <label for="floatingInput">Cantidad</label>
                              @error('cantidad')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="form-floating mb-3"> <!-- Precio -->
                              <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio"
                                id="floatingInput" placeholder="Precio"p
                                value="{{ old('precio')}}">
                              <label for="floatingInput">Precio</label>
                              @error('precio')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="form-floating mb-3"> <!-- Descuento -->
                              <input type="number" class="form-control @error('descuento') is-invalid @enderror" name="descuento"
                                id="floatingInput" placeholder="descuento"p
                                value="{{ old('descuento')}}">
                              <label for="floatingInput">Descuento</label>
                              @error('descuento')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                              @enderror
                            </div>


                            <div class="mb-3"> <!-- Foto -->
                                <label for="foto" class="my-2 text-black">Foto del Producto</label>
                                <input type="file" class="form-control
                                @error('foto') is-invalid @enderror" name="foto"
                                id="foto">
                                @error('foto')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-2"> <!--vista previa foto-->
                                <img src="#" id="foto_preview"
                                class="d-none img-fluid rounded mb-2"
                                width="100"
                                heigh="100">
                            </div>

                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach

                            <div class="mb-2">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Crear producto
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


