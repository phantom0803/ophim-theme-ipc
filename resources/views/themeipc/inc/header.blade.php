@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<header id="header" class="main">
    <div class="hbox">
        <div class="fix-hidden">
            <div class="logo">
                <a href="/" title="{{ $title }}">
                    @if ($logo)
                        {!! $logo !!}
                    @else
                        {!! $brand !!}
                    @endif
                </a>
            </div>
            <div class="head-main-nav">
                <div class="menu-xem-phim-online-container">
                    <ul id="main_header" class="main-header">
                        @foreach ($menu as $item)
                            @if (count($item['children']))
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                    <a>{{ $item['name'] }}</a>
                                    <ul class="sub-menu">
                                        @foreach ($item['children'] as $children)
                                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                                <a href="{{ $children['link'] }}"
                                                    title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                    <a href="{{ $item['link'] }}" title="{{ $item['name'] }}">{{ $item['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="headitems ">
                <div id="advc-menu" class="search">
                    <form method="get" id="searchform" action="/">
                        <input type="text" placeholder="Tìm kiếm phim..." name="search"
                            value="{{ request('search') }}" autocomplete="off">
                        <button class="search-button" form="searchform" type="submit"><span
                                class="fas fa-search"></span></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="live-search ltr"></div>
    </div>
</header>

<div class="fixheadresp">
    <header class="responsive">
        <div class="nav"><a class="aresp nav-resp"></a></div>
        <div class="search"><a class="aresp search-resp"></a></div>
        <div class="logo">
            <a href="/" title="{{ $title }}">
                @if ($logo)
                    {!! $logo !!}
                @else
                    {!! $brand !!}
                @endif
            </a>
        </div>
    </header>
    <div class="search_responsive">
        <form method="get" id="form-search-resp" class="form-resp-ab" action="/"><input type="text"
                placeholder="Tìm kiếm phim..." name="search" value="{{ request('search') }}" autocomplete="off">
            <button type="submit" form="form-search-resp" class="search-button"><span
                    class="fas fa-search"></span></button>
        </form>
        <div class="live-search"></div>
    </div>
    <div id="arch-menu" class="menuresp">
        <div class="menu">
            <div class="menu-xem-phim-online-container">
                <ul id="main_header" class="resp">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                                <a>{{ $item['name'] }}</a>
                                <ul class="sub-menu">
                                    @foreach ($item['children'] as $children)
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                            <a href="{{ $children['link'] }}"
                                                title="{{ $children['name'] }}">{{ $children['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                                <a href="{{ $item['link'] }}" title="{{ $item['name'] }}">{{ $item['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
