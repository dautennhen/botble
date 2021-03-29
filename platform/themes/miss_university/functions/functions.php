<?php

register_page_template([
    'no-sidebar' => __('Noo sidebar'),
    'default'=>'Default',
    'more-template' => __('More template'),
]);
register_sidebar([
    'id'          => 'top_sidebar',
    'name'        => __('Top sidebar'),
    'description' => __('Area for widgets on the top sidebar'),
]);


add_shortcode('youtube-video', __('Youtube video'), __('Add youtube video'), function ($shortCode) {
    $shortCode->content=str_replace('https://youtu.be/', 'https://www.youtube.com/watch?v=', $shortCode->content);
    return Theme::partial('short-codes.youtube-video', ['url' => $shortCode->content]);
});

shortcode()->setAdminConfig('youtube-video', Theme::partial('short-codes.youtube-video-admin-config'));

add_shortcode('featured-posts', __('Featured posts'), __('Featured posts'), function () {
    return Theme::partial('short-codes.featured-posts');
});

add_shortcode('recent-posts', __('Recent posts'), __('Recent posts'), function ($shortCode) {
    return Theme::partial('short-codes.recent-posts', ['title' => $shortCode->title]);
});

shortcode()->setAdminConfig('recent-posts', Theme::partial('short-codes.recent-posts-admin-config'));

add_shortcode('featured-categories-posts', __('Featured categories posts'), __('Featured categories posts'),
    function ($shortCode) {
        return Theme::partial('short-codes.featured-categories-posts', ['title' => $shortCode->title]);
    });



theme_option()->setField([
    'id'         => 'site_description',
    'section_id' => 'opt-text-subsection-general',
    'type'       => 'textarea',
    'label'      => __('Site description'),
    'attributes' => [
        'name'    => 'site_description',
        'value'   => null,
        'options' => [
            'class'        => 'form-control',
            'data-counter' => 255,
        ],
    ],
]);
theme_option()
    ->setField([
        'id'         => 'facebook_comment_enabled_in_post',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'select',
        'label'      => __('Enable Facebook comment in post detail page?'),
        'attributes' => [
            'name'    => 'facebook_comment_enabled_in_post',
            'list'    => [
                'yes' => trans('core/base::base.yes'),
                'no'  => trans('core/base::base.no'),
            ],
            'value'   => 'yes',
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ]);

theme_option()
    ->setField([
        'id' => 'round_number',
        'section_id' => 'opt-text-subsection-general',
        'type' => 'select', // select or customSelect
        'label' => 'Chọn vòng hiện tại',
        'attributes' => [
            'name' => 'round_number',
            'data' => [ // Array options for select
                1 => 'Vòng loại',
                2 => 'Top 200',
                3 => 'Top 40',
                4 => 'Vòng cuối',
            ],
            'value' => 1, // default value
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ]);

add_action('init', function () {
    config([
        'filesystems.disks.public.root' => public_path('storage'),
        'filesystems.disks.public.url'  => str_replace('/index.php', '', url('storage')),
    ]);
}, 124);
RvMedia::addSize('featured', 565, 375)->addSize('medium', 540, 360)
        ->addSize('list', 450, 450)->addSize('profile', 600, 600);
