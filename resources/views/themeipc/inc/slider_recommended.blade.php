<header>
    <h2>Phim Đề Cử</h2>
    <div class="nav_items_module">
        <a class="btn prevf"><i class="fas fa-caret-left"></i></a>
        <a class="btn nextf"><i class="fas fa-caret-right"></i></a>
    </div>
</header>
<div id="featured-titles" class="items normal featured">
    @foreach ($recommendations as $movie)
        @include('themes::themeipc.inc.movie_card')
    @endforeach
</div>
