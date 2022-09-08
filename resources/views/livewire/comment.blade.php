<div>
    <h4>
        Faça um comentário!
    </h4>
    <form wire:submit.prevent="store">
        <textarea wire:model="content" name="content" id="comment" cols="30" rows="10" placeholder="O que você pensa sobre isso?"></textarea>
        <button wire:click="$emit('listComments')">
            Enviar
        </button>
        <br>
    </form>
    @forelse ($comments as $comment)
        <img src="{{asset('storage/images/user/avatar/' . $comment->user->avatar)}}" class="avatar">
        <small><strong>{{ $comment->user->name }} respondeu: </strong></small>
        <p>
            {{ nl2br($comment->content) }}
        </p>
        @can('authenticated')
        @if ($comment->user_id === Auth::user()->id)
            <form action="{{ route($editRoute, $comment->id) }}">
                <button>
                    Editar
                </button>
            </form>
            <form wire:submit.prevent="delete({{$comment->id}})">
                <button>Remover comentário</button>
            </form>
        @endif
        @endcan
    @empty
        <h2>Ninguém comentou nessa história ainda. Seja o pioneiro!</h2>
    @endforelse
</div>