<div class="sidebar right scrolling">
    <div class="fixed-sidebar-blank">
        @foreach ($tops as $top)
            <aside id="dtw_content-{{$loop->index}}" class="widget doothemes_widget">
                <h2 class="widget-title">{{$top['label']}}</h2>
                <div class="dtw_content">
                    @foreach ($top['data'] as $movie)
                        <article class="w_item_b">
                            <a title="{{$movie->name}}" href="{{$movie->getUrl()}}">
                                <div class="image"><img
                                        class="lazyload"
                                        data-src="{{$movie->getThumbUrl()}}"
                                        alt="{{$movie->name}}" /></div>
                                <div class="data">
                                    <h3>{{$movie->name}}</h3><span class="wdate">{{$movie->origin_name}}</span><span
                                        class="wextra"><b><i class="icon-star2"></i> {{ number_format($movie->rating_star, 1)}}</b><span class="year">{{$movie->publish_year}}</span>
                                        <span class='year'> {{$movie->episode_current}} </span></span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </aside>
        @endforeach
    </div>
</div>
