@extends('layouts.main')

@section('title', 'Editar comentário')

@section('content')
<article class="site-content">
    <div class="container-textarea">
        <div class="div-textarea">
            <form action="{{ route('post.comment.update', $comment->id) }}" method="post">
                @csrf
                @method('put')
                <textarea style="margin: 0 auto" name="content" id="content" cols="60" rows="10" placeholder="No que você está pensando?" autofocus>{{ $comment->content }}</textarea>
                <div class="container-submit">
                    <button class="submit-button">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</article>
@endsection