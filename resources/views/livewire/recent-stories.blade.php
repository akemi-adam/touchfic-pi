<section class="dashboard-container">

<div>
    <h2 class="subtitle">
        Histórias recentes
    </h2>
    @forelse ($this->index() as $storie)
    <div class="dashboard-content">
            <div class="carousel">
                <div class="carousel-slider">
                    <div class="storie-card">
                        <a href="{{ route('storie.show', $storie->id) }}">
                            <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" alt="{{ $storie->title }}" style="width: 300px">
                        </a>

                        <h3>
                            <a href="{{ route('storie.show', $storie->id) }}">{{ $storie->title }}</a>
                        </h3>
                    </div>
                </div>
            </div>
    </div>
        @empty
        <div class="central-msg-container">
            <h2 class="central-msg">
                Nenhuma história foi cadastrada
            </h2>
        </div>
        @endforelse
</div>
</section>
