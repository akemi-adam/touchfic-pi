@extends('layouts.main')

@section('title', 'Verificar e-mail')

@section('content')
    <div>
        <p>
            Nossa equipe enviou um email de verificação. Por favor, faça a verificação para ter pleno acesso ao site
        </p>
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button>
                Reenviar e-mail
            </button>
        </form>
    </div>
@endsection