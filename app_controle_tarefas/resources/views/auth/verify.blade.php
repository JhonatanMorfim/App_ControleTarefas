@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifique seu endereço de email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           Reenviamos um e-mail com um link de validação.
                        </div>
                    @endif

                    Antes de prosseguir procurre no seu e-mail por um link de validação
                    Caso não o tenha recebido,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click aqui para solicitar um novo</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
