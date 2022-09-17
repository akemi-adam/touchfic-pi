@section('title', 'Notificações')
<article class="site-content">
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

            {{-- Likes notifications --}}
            @if ($notification->type === 'App\Notifications\StorieLikeNotification')
                <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
                <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>
                <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                    <button><i class="fa-regular fa-bookmark"></i></button>
                </form>
                <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                    <button>Remover</button>
                </form>
            @endif

            {{-- Comments notificatiosn --}}
            @if ($notification->type === 'App\Notifications\CommentNotification')
            
                {{-- Posts --}}
                @if (Arr::exists($notification->data, 'post'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou na sua <a href="{{ route('post.show', $notification->data['post']['id'])}}">postagem</a>
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button><i class="fa-regular fa-bookmark"></i></button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button>Remover</button>
                    </form>
                @endif

                {{-- Chapters --}}
                @if (Arr::exists($notification->data, 'chapter'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou em <a href="{{ route('chapter.show', $notification->data['chapter']['id']) }}">{{ $notification->data['storie']['title']}}:{{ $notification->data['chapter']['title'] }}</a>
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button><i class="fa-regular fa-bookmark"></i></button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button>Remover</button>
                    </form>
                @endif
            @endif

        @empty
            <h3>
                Nenhuma nova notificação foi encontrada
            </h3>
        @endforelse

        <hr>

        <h2>
            Notificações lidas
        </h2>
        @forelse (Auth::user()->readNotifications as $notification)
            @if ($notification->type === 'App\Notifications\StorieLikeNotification')
                <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
                <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>
                <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                    <button>Remover</button>
                </form>
            @endif

            {{-- Comments notificatiosn --}}
            @if ($notification->type === 'App\Notifications\CommentNotification')

                {{-- Posts --}}
                @if (Arr::exists($notification->data, 'post'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou na sua <a href="{{ route('post.show', $notification->data['post']['id'])}}">postagem</a>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button>Remover</button>
                    </form>
                @endif

                {{-- Chapters --}}
                @if (Arr::exists($notification->data, 'chapter'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou em <a href="{{ route('chapter.show', $notification->data['chapter']['id']) }}">{{ $notification->data['storie']['title']}}:{{ $notification->data['chapter']['title'] }}</a>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button>Remover</button>
                    </form>
                @endif
            @endif
        @empty
            <h3>
                Nenhuma notificação foi encontrada
            </h3>
        @endforelse
    @endif
</div>
</article>