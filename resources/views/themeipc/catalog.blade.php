@extends('themes::themeipc.layout')

@php
    $years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
        return \Ophim\Core\Models\Movie::select('publish_year')
            ->distinct()
            ->pluck('publish_year')
            ->sortDesc();
    });
@endphp

@section('content')
    <div class="content right normal">
        <div class="dt-breadcrumb breadcrumb_bottom">
            <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span>
                    </a>
                    <span class="fas fa-angle-right" itemprop="position" content="1"></span>
                </li>

                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                    <a itemprop="item" title="{{ $section_name ?? 'Danh Sách Phim' }}"
                        href="{{ url()->current() }}">
                        <span itemprop="name">{{ $section_name ?? 'Danh Sách Phim' }}</span>
                    </a>
                    <span itemprop="position" content="2"></span>
                </li>
            </ol>
        </div>

        <header>
            <h1>{{ $section_name }}</h1>
        </header>
        <div id="archive-content" class="animation-2 items normal">
            @if (count($data))
                @foreach ($data as $movie)
                    @include('themes::themeipc.inc.movie_card')
                @endforeach
            @else
                <p>Không có dữ liệu liên quan</p>
            @endif
        </div>
        {{ $data->appends(request()->all())->links('themes::themeipc.inc.pagination') }}
    </div>
@endsection
