<article id="post-{{ $movie->id }}" class="item tvshows">
    <div class="poster"><img src="{{ $movie->thumb_url }}" alt="{{ $movie->name }}">
        <span class='ribbon'>
            <i class='fa fa-play-circle' aria-hidden='true'></i> {{ $movie->episode_current }}
        </span>
        <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
            <div class="see"></div>
        </a>
    </div>
    <div class="data">
        <h3>
            <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">{{ $movie->name }}</a>
        </h3>
        <span>
            <span class='tagline'>{{ $movie->origin_name }}</span>
        </span>
    </div>
</article>
