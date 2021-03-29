let mix = require('laravel-mix');
const purgeCss = require('@fullhuman/postcss-purgecss');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));
const source = 'platform/themes/' + directory;
const dist = 'public/themes/' + directory + '/dist';
const node_module_path = 'node_modules/'
console.log(source, dist, directory, path.resolve(__dirname))
mix
    .sass(
        source + '/public/sass/style.scss',
        dist + '/css',
        {},
        [
            // purgeCss({
            //     content: [
            //         source + '/layouts/*.blade.php',
            //         source + '/partials/*.blade.php',
            //         source + '/partials/**/*.blade.php',
            //         source + '/views/*.blade.php',
            //         source + '/views/**/*.blade.php',
            //         source + '/widgets/**/templates/frontend.blade.php',
            //         'platform/plugins/contact/resources/views/forms/contact.blade.php'
            //     ],
            //     defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || [],
            //     safelist: [
            //         /^navigation-/,
            //         /^language-/,
            //         /language_bar_list/,
            //         /show-admin-bar/,
            //         /breadcrumb/,
            //         /active/,
            //         /show/,
            //         /^owl-/,
            //         /^nav/
            //     ],
            // })
        ]
    )
    .js(source + '/public/js/app.js', dist + '/js')
    .copyDirectory(dist + '/css', source + '/public/dist/css')
    .copyDirectory(dist + '/js', source + '/public/dist/js')
    .copyDirectory(source + '/public/images', dist + '/images')
    .copyDirectory(source + '/public/images', source + '/public/dist/images')
    .copyDirectory(source + '/public/fonts', dist + '/fonts')
    .copyDirectory(source + '/public/fonts', source + '/public/dist/fonts')
    .copyDirectory(node_module_path + '@fortawesome/fontawesome-free/webfonts', dist + '/webfonts')
    .copyDirectory(node_module_path + 'slick-carousel/slick/fonts', dist + '/slick-fonts')
    .copyDirectory(node_module_path + 'lightbox2/dist', dist + '/lightbox2');
