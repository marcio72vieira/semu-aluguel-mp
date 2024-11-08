@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">DocumentosXXX - {{ $requerente->nomecompleto }} / CPF: {{ $requerente->cpf }} </h2>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span class="small text-danger p-3"><strong>Campo marcado com * é de preenchimento obrigatório!</strong></span>
            </div>

            <div class="card-body">

                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('POST')

                    <div class="row">
                        {{-- identificacao do requerente --}}
                        <input type="hidden" name="requerente_id_hidden" id="requerente_id_hidden" value="{{ $requerente->id }}">


                        {{-- url--}}
                        <div class="col-5">
                            <div class="form-group focused">
                                <label class="form-control-label" for="url">Arquivo do Documento (o arquivo deve ser do tipo .pdf)<span class="small text-danger">*</span></label>
                                <input type="file" id="url" style="display:block" name="url" value="{{ old('url') }}">
                                @error('url')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- tipodocumento_id --}}
                        <div class="col-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="tipodocumento_id">Documento<span class="small text-danger">*</span></label>
                                <select name="tipodocumento_id" id="tipodocumento_id" class="form-control select2" required>
                                    <option value="" selected disabled>Escolha...</option>
                                    @foreach($tiposdocumentos  as $tipodocumento)
                                        <option value="{{$tipodocumento->id}}" {{old('tipodocumento_id') == $tipodocumento->id ? 'selected' : ''}}>{{$tipodocumento->nome}}</option>
                                    @endforeach
                                </select>
                                @error('tipodocumento_id')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="col-2 flex-row d-md-flex justify-content-end">
                            <div style="margin-top: 15px">
                                {{-- <a class="btn btn-outline-secondary me-2" href="{{ url()->previous() }}" role="button">Cancelar</a> --}}
                                <a class="btn btn-outline-secondary me-2" href="{{ route('documento.index', ['requerente' => $requerente->id]) }}" role="button">Cancelar</a>
                                <button type="submit" class="btn btn-primary" style="width: 95px;"> Enviar </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
