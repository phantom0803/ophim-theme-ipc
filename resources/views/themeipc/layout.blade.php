@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 8]);
                try {
                    $data[] = [
                        'label' => $label,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link rel='stylesheet' id='google-fonts-css'
        href='https://fonts.googleapis.com/css?family=Roboto+Condensed%3A300%2C400%2C500%2C700' type='text/css'
        media='all' />
    <link rel="stylesheet" href="{{ asset('/themes/ipc/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('/themes/ipc/css/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('/themes/ipc/css/custom.css') }}" />
@endpush

@section('body')
    <div id="dt_contenedor">
        @include('themes::themeipc.inc.header')
        <div id="contenedor">
            <div class="module">
                @yield('content')
                @include('themes::themeipc.inc.sidebar')
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {!! get_theme_option('footer') !!}
    <script type='text/javascript' src='{{ asset('/themes/ipc/js/jquery/jquery.min.js') }}' id='jquery-core-js'></script>

    <script>
        jQuery(document).ready(function($) {
            $("#featured-titles").owlCarousel({
                autoPlay: !1,
                items: 5,
                stopOnHover: !0,
                pagination: !1,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [980, 4],
                itemsTablet: [768, 3],
                itemsTabletSmall: !1,
                itemsMobile: [479, 3]
            });
            $(".nextf").click(function() {
                $("#featured-titles").trigger("owl.next")
            });
            $(".prevf").click(function() {
                $("#featured-titles").trigger("owl.prev")
            });
            $("#dt-episodes").owlCarousel({
                autoPlay: !1,
                pagination: !1,
                items: 3,
                stopOnHover: !0,
                itemsDesktop: [900, 3],
                itemsDesktopSmall: [750, 3],
                itemsTablet: [500, 2],
                itemsMobile: [320, 1]
            });
            $(".next").click(function() {
                $("#dt-episodes").trigger("owl.next")
            });
            $(".prev").click(function() {
                $("#dt-episodes").trigger("owl.prev")
            });
            $("#dt-seasons").owlCarousel({
                autoPlay: !1,
                items: 5,
                stopOnHover: !0,
                pagination: !1,
                itemsDesktop: [1199, 5],
                itemsDesktopSmall: [980, 5],
                itemsTablet: [768, 4],
                itemsTabletSmall: !1,
                itemsMobile: [479, 3]
            });
            $(".next2").click(function() {
                $("#dt-seasons").trigger("owl.next")
            });
            $(".prev2").click(function() {
                $("#dt-seasons").trigger("owl.prev")
            });
            $("#slider-movies").owlCarousel({
                autoPlay: !1,
                items: 2,
                stopOnHover: !0,
                pagination: !0,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 2],
                itemsTabletSmall: [600, 1],
                itemsMobile: [479, 1]
            });
            $("#slider-tvshows").owlCarousel({
                autoPlay: !1,
                items: 2,
                stopOnHover: !0,
                pagination: !0,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 2],
                itemsTabletSmall: [600, 1],
                itemsMobile: [479, 1]
            });
            $("#slider-movies-tvshows").owlCarousel({
                autoPlay: !1,
                items: 2,
                stopOnHover: !0,
                pagination: !0,
                itemsDesktop: [1199, 2],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 2],
                itemsTabletSmall: [600, 1],
                itemsMobile: [479, 1]
            });
            $(".reset").click(function(event) {
                if (!confirm(dtGonza.reset_all)) {
                    event.preventDefault()
                }
            });
            $(".addcontent").click(function(event) {
                if (!confirm(dtGonza.manually_content)) {
                    event.preventDefault()
                }
            })
        });
    </script>
    <script>
        var dtAjax = {
            "url": "",
            "player_api": "",
            "play_ajaxmd": "1",
            "play_method": "wp_json",
            "googlercptc": null,
            "classitem": "5",
            "loading": "Loading..",
            "afavorites": "Add to favorites",
            "rfavorites": "Remove of favorites",
            "views": "l\u01b0\u1ee3t xem",
            "remove": "Remove",
            "isawit": "I saw it",
            "send": "Data send..",
            "updating": "Updating data..",
            "error": "Error",
            "pending": "Pending review",
            "ltipe": "Download",
            "sending": "Sending data",
            "enabled": "Enable",
            "disabled": "Disable",
            "trash": "Delete",
            "lshared": "Links Shared",
            "ladmin": "Manage pending links",
            "sendingrep": "Please wait, sending data..",
            "ready": "Ready",
            "deletelin": "Do you really want to delete this link?"
        }
    </script>
    <script>
        jQuery(document).ready(function(a) {
            a(".scrolling").mCustomScrollbar({
                theme: "minimal-dark",
                scrollInertia: 200,
                scrollButtons: {
                    enable: !0
                },
                callbacks: {
                    onTotalScrollOffset: 100,
                    alwaysTriggerOffsets: !1
                }
            })
        })
    </script>
    <script>
        var dtGonza = {
            "api": "",
            "glossary": "",
            "nonce": "3e09b1c43c",
            "area": ".live-search",
            "button": ".search-button",
            "more": "Xem t\u1ea5t c\u1ea3 k\u1ebft qu\u1ea3",
            "mobile": "false",
            "reset_all": "Really you want to restart all data?",
            "manually_content": "They sure have added content manually?",
            "loading": "Loading..",
            "loadingplayer": "Loading player..",
            "selectaplayer": "Select a video player",
            "playeradstime": null,
            "autoplayer": "1",
            "livesearchactive": "1"
        }
    </script>
    <script src="{{ asset('/themes/ipc/js/main.js') }}" defer></script>
    {!! setting('site_scripts_google_analytics') !!}
@endsection
