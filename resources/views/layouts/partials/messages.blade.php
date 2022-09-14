@if (session('success_msg'))
    <p class="msg msg-success">{{session('success_msg')}}</p>
@endif

@if (Auth::check())
    @if (!isset(Auth::user()->email_verified_at))
        <p class="msg msg-danger">
            Seu e-mail ainda não foi verificado! Caso não tenha recebido, clique aqui:
        </p>
        <form action="{{ route('verification.send') }}" method="post" style="display: inline">
            @csrf
            <a href="" onclick="event.preventDefault(); this.closest('form').submit();">reenviar e-mail</a>
        </form>
    @endif
@endif