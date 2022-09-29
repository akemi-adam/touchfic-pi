@if (session('success_msg'))
    <p class="msg msg-success">{{session('success_msg')}}</p>
@endif

@if (Auth::check())
    @if (!isset(Auth::user()->email_verified_at))
        <span class="msg msg-danger">
            <i class="fa-solid fa-triangle-exclamation"></i> Seu e-mail ainda não foi verificado! Se não recebeu o e-mail de verificação, clique aqui:

            <form action="{{ route('verification.send') }}" method="post" style="display: inline">
                @csrf
                <a href="" onclick="event.preventDefault(); this.closest('form').submit();">Reenviar e-mail</a>
            </form>
        </span>
    @endif
@endif