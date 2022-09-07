<div>
    @if (!Auth::user()->notifications())
        <h2>
            Você não tem nenhuma notificação
        </h2>
    @else
        @forelse (Auth::user()->unreadNotifications as $notification)
            <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
            <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>
        @empty
            <h2>
                Você não tem nenhuma nova notificação
            </h2>
        @endforelse
    @endif
</div>
