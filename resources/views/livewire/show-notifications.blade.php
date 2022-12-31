@section('title', 'Notificações')

<div>
    @if (!Auth::user()->notifications())
    <div class="central-msg-container">
        <h2 class="central-msg">
            Você não tem nenhuma notificação
        </h2>
    </div>
    @else
        <h2 class="title">
            Notificações não lidas
        </h2>

        @forelse (Auth::user()->unreadNotifications as $notification)
        <div class="notifications-container">
            {{-- Likes notifications --}}
            <div class="notifications-box">
                @if ($notification->type === 'App\Notifications\StorieLikeNotification')
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button class="edit-storie"><i class="fa-solid fa-bookmark"></i>Marcar como lida</button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
                @endif
            </div>

            {{-- Deleted posts notifications --}}
            <div class="notifications-box">
                @if ($notification->type === 'App\Notifications\PostDeletedNotification')
                    <span>A administração removeu a sua postagem criada em {{ $notification->data['created_at'] }}: {{ $notification->data['content'] }}</span>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button class="edit-storie"><i class="fa-solid fa-bookmark"></i>Marcar como lida</button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
                @endif
            </div>

            {{-- Comments notificatiosn --}}
            @if ($notification->type === 'App\Notifications\CommentNotification')
            
            <div class="notifications-box">
                {{-- Posts --}}
                @if (Arr::exists($notification->data, 'post'))
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}"><img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar"></a>
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou na sua <a href="{{ route('post.show', $notification->data['post']['id'])}}">postagem</a>
                    
                    <div class="nots-buttons">
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button class="edit-storie"><i class="fa-solid fa-bookmark"></i>Marcar como lida</button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
                @endif
            </div>

            <div class="notifications-box">
                {{-- Chapters --}}
                @if (Arr::exists($notification->data, 'chapter'))
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}"><img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar"></a>
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou em <a href="{{ route('chapter.show', $notification->data['chapter']['id']) }}">{{ $notification->data['storie']['title']}}:{{ $notification->data['chapter']['title'] }}</a>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button class="edit-storie"><i class="fa-solid fa-bookmark"></i>Marcar como lida</button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
                @endif
            @endif
            </div>
        </div>
        @empty
        <div class="central-msg-container">
            <h3 class="central-msg">
                Nenhuma notificação não lida
            </h3>
        </div>
        @endforelse

        <hr>
        
        <h2 class="title">
            Notificações lidas
        </h2>
        
        @forelse (Auth::user()->readNotifications as $notification)
        <div class="notifications-container">

            <div class="notifications-box">
                @if ($notification->type === 'App\Notifications\StorieLikeNotification')
                
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['reader_avatar']) }}" class="avatar">
                    <a href="{{ route(  'user.show', $notification->data['reader_id']) }}">{{ $notification->data['reader_name'] }}</a> curtiu a sua história <a href="{{ route('storie.show', $notification->data['storie_id']) }}">{{ $notification->data['storie_title'] }}</a>

                    <div class="nots-buttons">
                        <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                            <button class="delete-storie">Remover</button>
                        </form>
                    </div>
            
                @endif
            </div>

            {{-- Deleted posts notifications --}}
            <div class="notifications-box">
                @if ($notification->type === 'App\Notifications\PostDeletedNotification')
                    <span>A administração removeu a sua postagem criada em {{ $notification->data['created_at'] }}: {{ $notification->data['content'] }}</span>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="readNotification('{{ $notification->id }}')">
                        <button class="edit-storie"><i class="fa-solid fa-bookmark"></i>Marcar como lida</button>
                    </form>
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
                @endif
            </div>

            {{-- Comments notifications --}}
            @if ($notification->type === 'App\Notifications\CommentNotification')

            <div class="notifications-box">
                {{-- Posts --}}
                @if (Arr::exists($notification->data, 'post'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou na sua <a href="{{ route('post.show', $notification->data['post']['id'])}}">postagem</a>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
            
                @endif
            </div>
            
            <div class="notifications-box">
                {{-- Chapters --}}
                @if (Arr::exists($notification->data, 'chapter'))
                    <img src="{{ asset('storage/images/user/avatar/' . $notification->data['author']['avatar']) }}" class="avatar">
                    <a href="{{ route('user.show', $notification->data['author']['id']) }}">{{ $notification->data['author']['name'] }}</a> comentou em <a href="{{ route('chapter.show', $notification->data['chapter']['id']) }}">{{ $notification->data['storie']['title']}}:{{ $notification->data['chapter']['title'] }}</a>

                    <div class="nots-buttons">
                    <form wire:submit.prevent="removeNotification('{{ $notification->id }}')">
                        <button class="delete-storie">Remover</button>
                    </form>
                    </div>
            
                @endif
            </div>
            @endif
        </div>
        @empty
        <div class="central-msg-container">
            <h3 class="central-msg">
                Nenhuma notificação lida
            </h3>
        </div>
        @endforelse
    @endif
</div>
