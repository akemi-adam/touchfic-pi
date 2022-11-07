<div>
    <div class="comment-container">
    <div class="comment-box">

        <div class="comment-area">
            @if (Auth::check())
            <img src="{{ FileSupport::getAvatar(Auth::user()->avatar) }}" class="avatar" alt="Avatar do usuário">
            @endif
            <form wire:submit.prevent="store">
                <textarea wire:model="content" name="content" id="comment" cols="60" rows="8" placeholder="O que você pensa sobre isso?"></textarea>
        </div>
            <div class="comment-btn">
                <button wire:click="$emit('listComments')">
                    Comentar
                </button>
            </form>
            </div>
    </div>
    </div>
    @forelse ($comments as $comment)
    <section class="comments">
        <div class="comment-card">
        <a href="{{ route('user.show', $comment->user_id) }}"><img src="{{ FileSupport::getAvatar($comment->user->avatar) }}" class="avatar"></a>
        <small><strong> <a href="{{ route('user.show', $comment->user_id) }}">{{ $comment->user->name }}</a> respondeu: </strong></small>
        <p>
            {{ nl2br($comment->content) }}
        </p>
        @can('authenticated')
        @if ($comment->user_id === Auth::user()->id)
        <div class="storie-crud">
            <form action="{{ route($editRoute, $comment->id) }}">
                <button class="edit-storie">
                    Editar
                </button>
            </form>
            <form wire:submit.prevent="delete({{$comment->id}})">
                <button class="delete-storie">Remover</button>
            </form>
        </div>
        </div>
    </section>
        @endif
        @endcan

    @empty
        <h2>Ninguém comentou aqui ainda. Seja o pioneiro!</h2>
    @endforelse
</div>