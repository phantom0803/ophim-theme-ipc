@extends('themes::themeipc.layout')

@section('content')
    <div id="single" class="dtsingle">
        <div class="content right">
            <div class='dooplay_player'>
                <div id='playcontainer' class='play'>
                    <div id='dooplay_player_response'></div>
                </div>
                <h3>CHỌN NGUỒN PHÁT</h3>
                <div id='playeroptions' class='options'>
                    <ul id='playeroptionsul' class='ajax_mode'>
                        @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                            <a data-id="{{ $server->id }}" data-link="{{ $server->link }}" data-type="{{ $server->type }}"
                                onclick="chooseStreamingServer(this)" class="streaming-server">
                                <li class="dooplay_player_option">
                                    <i class='fas fa-play-circle'></i>
                                    <span class='title'>VIP #{{ $loop->index + 1 }}</span>
                                    <span class='loader'></span>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                    <div class='thongbaoserver'>Nếu không xem được vui lòng đổi nguồn phát hoặc tải lại trang!</div>
                </div>
            </div>
            <div class="sbox">
                <div class="khungepih1">
                    <h1 class="epih1">{{ $currentMovie->name }} ({{ $currentMovie->origin_name }}) &#8211; Tập
                        {{ $episode->name }}</h1>
                </div>
                <div class="starstruck-ptype" style="">
                    <div>
                        <span class="hidden" itemprop="aggregateRating" itemscope
                            itemtype="http://schema.org/AggregateRating">
                            <meta itemprop="ratingValue" content={{ number_format($currentMovie->rating_star ?? 0, 1) }} />
                            <meta itemprop="ratingcount" content="{{ $currentMovie->rating_count ?? 0 }}">
                            <meta itemprop="bestRating" content="10" />
                            <meta itemprop="worstRating" content="1" />
                        </span>

                        <div class="starstruck-wrap">
                            <div class="dt_rating_data">
                                <div class="starstruck starstruck-main">
                                    <div id="star" data-score="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"
                                        style="cursor: pointer;"></div>
                                </div>

                                <section class="nope starstruck-rating-wrap">Đánh giá của bạn:
                                    <span class="rating-yours">0</span>
                                </section>

                                <div class="starstruck-rating">
                                    <span
                                        class="dt_rating_vgs">{{ number_format($currentMovie->rating_star ?? 0, 1) }}</span><i
                                        class="fas fa-user-circle"></i>
                                    <span class="rating-count">{{ $currentMovie->rating_count ?? 0 }}</span>
                                    <span class="rating-text">đánh giá</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                    <div id='serie_contenido' style='padding-top: 5px'>
                        <div id='seasons'>
                            <div class='se-c'>
                                <span class="se-t se-o"><span class="server_name"> DANH SÁCH TẬP: {{ $server }}</span></span>
                                <div class='se-a' style='display:block'>
                                    <ul class='episodios'>
                                        @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                            <li
                                                class='mark-{{ $loop->index + 1 }} @if ($item->contains($episode)) active @endif'>
                                                <div class='episodiotitle'>
                                                    <a title='{{ $name }}'
                                                        href='{{ $item->sortByDesc('type')->first()->getUrl() }}'>{{ $name }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="khunginfo">
                <div itemprop="description" class="wp-content"></div>
            </div>
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

            <div class="khung">
                <div id="comments" class="extcom">
                    <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                        data-colorscheme="dark" data-numposts="5" data-order-by="reverse_time" data-lazy="true"></div>
                </div>
            </div>

            <div style="padding: 5px">
                @include('themes::themeipc.inc.movie_related')
            </div>
            <div class="dt-breadcrumb breadcrumb_bottom">
                <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span>
                        </a>
                        <span class="fas fa-angle-right" itemprop="position" content="1"></span>
                    </li>

                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" title="{{ $currentMovie->type == 'single' ? 'Phim lẻ' : 'Phim bộ' }}"
                            href="/danh-sach/{{ $currentMovie->type == 'single' ? 'phim-le' : 'phim-bo' }}">
                            <span itemprop="name">{{ $currentMovie->type == 'single' ? 'Phim lẻ' : 'Phim bộ' }}</span>
                        </a>
                        <span class="fas fa-angle-right" itemprop="position" content="2"></span>
                    </li>

                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a itemprop="item" title="{{ $currentMovie->name }}" href="{{ $currentMovie->getUrl() }}">
                            <span itemprop="name">{{ $currentMovie->name }}</span>
                        </a>
                        <span class="fas fa-angle-right" itemprop="position" content="3"></span>
                    </li>

                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span
                            itemprop="name">Tập {{ $episode->name }}</span><span itemprop="position"
                            content="4"></span></li>
                </ol>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/themes/ipc/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/ipc/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('html, body').animate({
                scrollTop: jQuery('#dooplay_player_response').offset().top - 40
            }, 'slow');
        });
    </script>

    <script>
        var episode_id = {{$episode->id}};
        const wrapper = document.getElementById('dooplay_player_response');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.getElementsByClassName('dooplay_player_option')[0].classList.remove('on');
                server.getElementsByClassName('dooplay_player_option')[0].getElementsByClassName('loader')[0].style
                    .display = 'none';
            })
            el.getElementsByClassName('dooplay_player_option')[0].classList.add('on');
            el.getElementsByClassName('dooplay_player_option')[0].getElementsByClassName('loader')[0].style.display =
                'inline-block';

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/ipc/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        jQuery("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="445px" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{$episode->id}}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

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
