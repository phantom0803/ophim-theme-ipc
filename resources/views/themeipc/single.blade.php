@extends('themes::themeipc.layout')

@php
    $watch_url = '';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watch_url = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
@endphp

@section('content')
    <div class="content right">
        <div class="dt-breadcrumb breadcrumb_bottom">
            <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span>
                    </a>
                    <span class="fas fa-angle-right" itemprop="position" content="1"></span>
                </li>

                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" title="{{ $currentMovie->name }}" href="{{ $currentMovie->getUrl() }}">
                        <span itemprop="name">{{ $currentMovie->name }}</span>
                    </a>
                    <span itemprop="position" content="2"></span>
                </li>
            </ol>
        </div>

        <div class="sheader">
            <div class="poster">
                <img itemprop="image" src="{{ $currentMovie->getThumbUrl() }}" alt="{{ $currentMovie->name }}"
                    title="{{ $currentMovie->name }}">
                @if ($watch_url)
                    <div class="imdbpost">
                        <a class="button_play" href="{{ $watch_url }}"><i class="fa fa-play-circle"
                                aria-hidden="true"></i> Xem Phim</a>
                    </div>
                @endif
            </div>
            <div class="data">
                <h1>{{ $currentMovie->name }}</h1>
                <ul class="infomation-film">
                    <li>
                        <h2 class="title-film-detail-3"><span class='tagline'>{{ $currentMovie->origin_name }}</span></h2>
                    </li>
                    <li>Năm phát hành: <a href="" rel="tag">{{ $currentMovie->publish_year }}</a>
                    </li>
                    <li>
                        <div class="mepo1">
                            <p>Trạng thái <span class='quality1'><i class='fa fa-play-circle' aria-hidden='true'></i>
                                    {{ $currentMovie->episode_current }} {{ $currentMovie->language }}</span>
                            </p>
                        </div>
                    </li>
                    <li>Số tập:<span class='episode'> {{ $currentMovie->episode_total }}</span></li>
                    <li>Quốc gia:
                        {!! $currentMovie->regions->map(function ($region) {
                                return '<a href="' .
                                    $region->getUrl() .
                                    '" title="' .
                                    $region->name .
                                    '" rel="region tag">' .
                                    $region->name .
                                    '</a>';
                            })->implode(', ') !!}
                    <li>Thể loại:
                        {!! $currentMovie->categories->map(function ($category) {
                                return '<a href="' .
                                    $category->getUrl() .
                                    '" title="' .
                                    $category->name .
                                    '" rel="category tag">' .
                                    $category->name .
                                    '</a>';
                            })->implode(', ') !!}
                    </li>
                </ul>
                <div class="starstruck-ptype" style="">
                    <div>
                        <span class="hidden" itemprop="aggregateRating" itemscope
                            itemtype="http://schema.org/AggregateRating">
                            <meta itemprop="ratingValue" content="{{$currentMovie->getRatingStar()}}" />
                            <meta itemprop="ratingcount" content="{{$currentMovie->getRatingCount()}}">
                            <meta itemprop="bestRating" content="10" />
                            <meta itemprop="worstRating" content="1" />
                        </span>

                        <div class="starstruck-wrap">
                            <div class="dt_rating_data">
                                <div class="starstruck starstruck-main">
                                    <div id="star" data-score="{{$currentMovie->getRatingStar()}}"
                                        style="cursor: pointer;"></div>
                                </div>

                                <section class="nope starstruck-rating-wrap">Đánh giá của bạn:
                                    <span class="rating-yours">0</span>
                                </section>

                                <div class="starstruck-rating">
                                    <span
                                        class="dt_rating_vgs">{{$currentMovie->getRatingStar()}}</span><i
                                        class="fas fa-user-circle"></i>
                                    <span class="rating-count">{{$currentMovie->getRatingCount()}}</span>
                                    <span class="rating-text">đánh giá</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_tabs">
            <ul id="section" class="smenu idTabs">
                <li><a href="#info">Thông tin</a></li>
                <li><a href="#cast">Diễn viên</a></li>
                @if ($currentMovie->trailer_url)
                    <li><a href="#trailer">Trailer</a></li>
                @endif
                <li id="report_li"><a href="#report">Bình luận</a></li>
            </ul>
        </div>
        <div id="cast" class="sbox fixidtab">
            @if (count($currentMovie->directors))
                <h6>ĐẠO DIỄN</h6>
                <div class="persons">
                    @foreach ($currentMovie->directors as $directors)
                        <div class="person">
                            <div class="img"><a href="{{ $directors->getUrl() }}"><img
                                        alt="Đạo diễn {{ $directors->name }}"
                                        src="/themes/ipc/assets/img/no/cast.png" /></a>
                            </div>
                            <div class="data">
                                <div class="name"><a href="{{ $directors->getUrl() }}">{{ $directors->name }}</a>
                                </div>
                                <div class="caracter">Đạo Diễn</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if (count($currentMovie->actors))
                <h6>DIỄN VIÊN</h6>
                <div class="persons">
                    @foreach ($currentMovie->actors as $actor)
                        <div class="person" itemprop="actor" itemscope itemtype="http://schema.org/Person">
                            <meta itemprop="name" content="{{ $actor->name }}">
                            <div class="img"><a title="Diễn viên {{ $actor->name }}"
                                    href="{{ $actor->getUrl() }}"><img alt="Diễn viên {{ $actor->name }}"
                                        src="/themes/ipc/assets/img/no/cast.png" /></a>
                            </div>
                            <div class="data">
                                <div class="name"><a title="Diễn viên {{ $actor->name }}" itemprop="url"
                                        href="{{ $actor->getUrl() }}">{{ $actor->name }}</a></div>
                                <div class="caracter"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div id="report" class="sbox">
            <div class="comment-warning"><strong>CẢNH BÁO:</strong> Không bấm vào các đường link lạ ở khu vực
                bình luận. Việc truy cập vào các liên kết lạ ngoài iPhimChill có thể khiến bạn bị hack tài khoản
                Facebook.
            </div>
            <div id="comments" class="extcom">
                <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                    data-colorscheme="dark" data-numposts="5" data-order-by="reverse_time" data-lazy="true"></div>
            </div>
        </div>

        <div id="info" class="sbox fixidtab">
            <div itemprop="description" class="wp-content">
                <h2 style="text-align: center;">{{ $currentMovie->name }}
                    &#8211; {{ $currentMovie->origin_name }} {{ $currentMovie->quality }} {{ $currentMovie->language }}
                </h2>

                {!! $currentMovie->content !!}
            </div>
            <div class="the_tag_list">
                @foreach ($currentMovie->tags as $tag)
                    <a href="{{ $tag->getUrl() }}" rel="tag">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>

        @if ($currentMovie->trailer_url)
            @php
                parse_str(parse_url($currentMovie->trailer_url, PHP_URL_QUERY), $parse_url);
                $trailer_id = $parse_url['v'] ?? '';
            @endphp
            <div id="trailer" class="sbox fixidtab" style="display: block;">
                <h4>Trailer Phim {{ $currentMovie->name }} -
                    <span class="tagline">{{ $currentMovie->origin_name }}</span>
                </h4>
                <div class="videobox">
                    <div class="embed">
                        <iframe class="rptss lazyload" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
                            data-src="https://www.youtube.com/embed/{{ $trailer_id }}?autoplay=0&autohide=1"></iframe>
                    </div>
                </div>
            </div>
        @endif

        <div class='sbox'>
            <div class='dt_social_single'><span>Chia sẻ<b id='social_count'>0</b></span><a
                    data-id='{{ $currentMovie->id }}' rel='nofollow' href='javascript: void(0);'
                    onclick='window.open("https://facebook.com/sharer.php?u={{ $currentMovie->getUrl() }}","facebook","toolbar=0, status=0, width=650, height=450")'
                    class='facebook dt_social'><b>Facebook</b></a><a data-id='{{ $currentMovie->id }}' rel='nofollow'
                    href='javascript: void(0);'
                    onclick='window.open("https://twitter.com/intent/tweet?text={{ $currentMovie->name }}&url={{ $currentMovie->getUrl() }}","twitter","toolbar=0, status=0, width=650, height=450")'
                    data-rurl='{{ $currentMovie->getUrl() }}' class='twitter dt_social'><b>Twitter</b></a><a
                    data-id='{{ $currentMovie->id }}' rel='nofollow' href='javascript: void(0);'
                    onclick='window.open("https://pinterest.com/pin/create/button/?url={{ $currentMovie->getUrl() }}&media={{ $currentMovie->getPosterUrl() }}&description={{ $currentMovie->name }}","pinterest","toolbar=0, status=0, width=650, height=450")'
                    class='pinterest dt_social'><b>Pinterest</b></a><a data-id='{{ $currentMovie->id }}' rel='nofollow'
                    href='whatsapp://send?text={{ $currentMovie->name }}%20-%20{{ $currentMovie->getUrl() }}'
                    class='whatsapp dt_social'><b>WhatsApp</b></a>
            </div>
        </div>
        @include('themes::themeipc.inc.movie_related')
    </div>
@endsection

@push('scripts')
    <link href="{{ asset('/themes/ipc/libs/raty/jquery.raty.css') }}" rel="stylesheet" />
    <script src="{{ asset('/themes/ipc/libs/raty/jquery.raty.js') }}"></script>

    <script>
        var rated = false;
        jQuery(document).ready(function($) {
            $('#star').raty({
                number: 10,
                starHalf: '/themes/ipc/libs/raty/images/star-half.png',
                starOff: '/themes/ipc/libs/raty/images/star-off.png',
                starOn: '/themes/ipc/libs/raty/images/star-on.png',
                click: function(score, evt) {
                    if (!rated) {
                        $.ajax({
                            url: '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}',
                            data: JSON.stringify({
                                rating: score
                            }),
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                $('.rating-yours').html(score);
                                $('.rating-count').html(res.rating_count);
                                $('.dt_rating_vgs').html(res.rating_star);
                                $('#star').attr('data-score', res.rating_star);
                                rated = true;
                            }
                        });
                    }
                }
            });
        })
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
