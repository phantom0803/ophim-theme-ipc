<?php

namespace Ophim\ThemeIpc;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeIpcServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/ipc')
        ], 'ipc-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'ipc' => [
                'name' => 'Theme IPC',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/theme-ipc',
                'publishes' => ['ipc-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommendations Limit',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 10,
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url',
                        'value' => "Phim bộ mới||type|series|15|/danh-sach/phim-bo\r\nPhim lẻ mới||type|single|15|/danh-sach/phim-bo\r\nPhim lẻ mới||type|single|15|/danh-sach/phim-bo\r\nPhim lẻ mới||type|single|15|/danh-sach/phim-bo",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit',
                        'value' => "Top phim lẻ||type|single|view_total|desc|4\r\nTop phim bộ||type|series|view_total|desc|4",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => 'class="home blog"',
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div id="footer">
                            <div class="container">
                                <div class="content">
                                    <div class="views-row">
                                        <div class="copy-right">
                                            <a title="Giới thiệu" href="">Giới thiệu</a> |
                                            <a title="Bản quyền" href="">Bản quyền</a> |
                                            <a title="Liên hệ" href="">Liên hệ</a> <br><a title="phim mới" href="">Phim mới</a> |
                                            <a title="Phim lẻ" href="">Phim lẻ</a> |
                                            <a title="Phim bộ" href="">Phim bộ</a> |
                                            <a title="Phim chiếu rạp" href="">Phim chiếu rạp</a> |
                                            <a title="Motphim" href="" target="_blank">Motphim</a><br>
                                            Website xem phim của chúng tôi được tổng hợp và sưu tầm trên Internet. Chúng tôi không chịu trách nhiệm đối với bất kỳ nội dung nào được đăng tải trên trang web này.<br>
                                            Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => <<<EOT
                        <img src="" alt="">
                        EOT,
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
