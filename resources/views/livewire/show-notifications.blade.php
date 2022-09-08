@section('title', 'Notificações')

<div>
    @if (!Auth::user()->notifications())
        <h2>
            Você não tem nenhuma notificação
        </h2>
    @else
        <h2>
            Notificações não lidas
        </h2>
        @forelse (Auth::user()->unreadNotifications as $notification)
            <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
            <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>
            <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                <button><i class="fa-regular fa-bookmark"></i></button>
            </form>
            <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                <button>Remover</button>
            </form>
            <hr>
        @empty
            <h3>
                Nenhuma nova notificação foi encontrada
            </h3>
        @endforelse
        <h2>
            Notificações lidas
        </h2>
        @forelse (Auth::user()->readNotifications as $notification)
            <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
            <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>
            <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                <button>Remover</button>
            </form>
        @empty
            <h3>
                Nenhuma notificação foi encontrada
            </h3>
        @endforelse
    @endif
</div>
