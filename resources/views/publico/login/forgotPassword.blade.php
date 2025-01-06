@extends('layout.login')
@section('content')
    <div class="col-lg-5">
        <div class="mt-5 border-0 rounded-lg shadow-lg card">
            <div class="card-header">
                {{-- <h3 class="my-4 text-center font-weight-light">Recuperar Senha</h3> --}}
            </div>
            <div class="card-body">

                <x-alert />
                <h3 style="margin-left: 140px; color:  #8d0376; ">Recuperar Senha</h3>

                <form action="{{ route('forgot-password.submit') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3 form-floating">
                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail do usuário" value="{{ old('email') }}">
                        <label for="email">E-mail</label>
                    </div>


                    <div class="mt-4 mb-0 d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="this.innerText = 'Recuperando...'">Recuperar</button>
                    </div>
                </form>
            </div>
            <div class="py-3 text-center card-footer">
                <div class="small">
                    <a href="{{ route('login.index') }}" class="text-decoration-none">Clique aqui</a> para acessar
                </div>
            </div>
        </div>
    </div>
@endsection

