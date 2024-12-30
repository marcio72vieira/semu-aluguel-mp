@extends('layout.login')

@section('content')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                {{-- <h3 class="text-center font-weight-light my-4">ALUGUEL MARIA DA PENHA<br>Login</h3> --}}
            </div>
            <div class="card-body">

                <x-alert />
                <h3 style="margin-left: 70px; color:  #8d0376; ">ALUGUEL MARIA DA PENHA</h3>

                <form action="{{ route('login.processalogin') }}" method="POST" style="padding: 10px;">
                    @csrf
                    @method('POST')

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control"  style="border: 1px solid #8d0376;" id="email" placeholder="E-mail do usuário" value="{{ old('email') }}">
                        <label for="email">E-mail</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" style="border: 1px solid #8d0376;" id="password" placeholder="Senha">
                        <label for="password">Senha</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a href="{{ route('forgot-password.show') }}" class="small text-decoration-none">Esqueceu a senha?</a>
                        <button type="submit" class="btn btn-sm" style="background-color: #8d0376; color: white;">Acessar</button>
                    </div>
                </form>
            </div>
            {{-- <div class="card-footer text-center py-3">
                <div class="small">
                    Precisa de uma conta?
                    <a href="{{ route('login.create-user') }}" class="text-decoration-none">Inscrever-se!</a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
