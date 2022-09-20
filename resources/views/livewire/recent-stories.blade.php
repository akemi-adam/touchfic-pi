<div>
    <h2>
        Histórias recentes:
    </h2>
    @forelse ($this->index() as $storie)
            <div class="carousel">
                <div>
                    <h3>
                        <a href="{{ route('storie.show', $storie->id) }}">{{ $storie->title }}</a>
                    </h3>
                    <a href="{{ route('storie.show', $storie->id) }}">
                        <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" alt="{{ $storie->title }}" style="width: 500px">
                    </a>
                </div>
            </div>
        @empty
            <h2>
                Nenhuma história foi cadastrada
            </h2>
        @endforelse
</div>
