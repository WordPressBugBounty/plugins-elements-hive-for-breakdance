<?php

namespace ElementsHiveForBreakdance;

use function Breakdance\Elements\c;
use function Breakdance\Elements\PresetSections\getPresetSection;


\Breakdance\ElementStudio\registerElementForEditing(
    "ElementsHiveForBreakdance\\OrbitingIcons",
    \Breakdance\Util\getdirectoryPathRelativeToPluginFolder(__DIR__)
);

class OrbitingIcons extends \Breakdance\Elements\Element
{
    static function uiIcon()
    {
        return 'CircleIcon';
    }

    static function tag()
    {
        return 'div';
    }

    static function tagOptions()
    {
        return [];
    }

    static function tagControlPath()
    {
        return false;
    }

    static function name()
    {
        return 'Orbiting Icons';
    }

    static function className()
    {
        return 'eh-orbiting-icons';
    }

    static function category()
    {
        return 'elements_hive';
    }

    static function badge()
    {
        return ['label' => 'EH', 'backgroundColor' => 'var(--yellow300)', 'textColor' => 'var(--black)'];
    }

    static function slug()
    {
        return __CLASS__;
    }

    static function template()
    {
        return file_get_contents(__DIR__ . '/html.twig');
    }

    static function defaultCss()
    {
        return file_get_contents(__DIR__ . '/default.css');
    }

    static function defaultProperties()
    {
        return ['content' => ['center_icon' => ['icon' => ['id' => 2536, 'slug' => 'icon-ningyo-mark', 'name' => 'ningyo mark', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" width="511" height="572" viewBox="0 0 511 572" fill="none">
<g filter="url(#filter0_d_702_126)">
<path d="M252.473 185.143C303.323 185.143 344.545 143.922 344.545 93.0717C344.545 42.2219 303.323 1 252.473 1C201.623 1 160.401 42.2219 160.401 93.0717C160.401 143.922 201.623 185.143 252.473 185.143Z" fill="url(#paint0_linear_702_126)"/>
</g>
<g filter="url(#filter1_d_702_126)">
<path d="M70.0538 345.672C108.191 345.672 139.108 314.756 139.108 276.618C139.108 238.481 108.191 207.564 70.0538 207.564C31.9164 207.564 1 238.481 1 276.618C1 314.756 31.9164 345.672 70.0538 345.672Z" fill="url(#paint1_linear_702_126)"/>
</g>
<g filter="url(#filter2_d_702_126)">
<path d="M439.029 345.672C477.167 345.672 508.083 314.756 508.083 276.618C508.083 238.481 477.167 207.564 439.029 207.564C400.892 207.564 369.976 238.481 369.976 276.618C369.976 314.756 400.892 345.672 439.029 345.672Z" fill="url(#paint2_linear_702_126)"/>
</g>
<g filter="url(#filter3_d_702_126)">
<path d="M470.054 428.297C449.038 395.16 411.058 380.362 375.45 386.936C356.599 390.417 337.463 382.419 326.195 366.911C315.546 352.254 313.941 333.161 321.075 316.507C332.957 288.766 326.7 255.111 302.297 233.602C275.247 209.758 233.836 209.758 206.785 233.602C182.382 255.111 176.125 288.766 188.008 316.507C195.141 333.161 193.536 352.254 182.887 366.911C171.619 382.419 152.484 390.416 133.633 386.936C98.0244 380.362 60.0452 395.159 39.0284 428.296C14.5551 466.883 22.5323 518.496 57.5336 547.87C98.8813 582.569 160.188 574.496 191.365 531.584C212.417 502.61 214.116 465.48 198.906 435.613C190.378 418.866 191.443 398.859 202.489 383.655L204.595 380.758C214.818 366.687 231.583 358.799 248.924 360.142C252.663 360.431 256.42 360.431 260.159 360.141C277.499 358.799 294.265 366.687 304.488 380.758L306.593 383.655C317.639 398.859 318.704 418.866 310.176 435.613C294.966 465.48 296.665 502.61 317.717 531.584C348.894 574.496 410.2 582.569 451.548 547.871C486.55 518.497 494.527 466.885 470.054 428.297Z" fill="url(#paint3_linear_702_126)"/>
</g>
<defs>
<filter id="filter0_d_702_126" x="159.401" y="0" width="188.144" height="188.144" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="1" dy="1"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_702_126"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_702_126" result="shape"/>
</filter>
<filter id="filter1_d_702_126" x="0" y="206.564" width="142.107" height="142.107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="1" dy="1"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_702_126"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_702_126" result="shape"/>
</filter>
<filter id="filter2_d_702_126" x="367.976" y="206.564" width="142.107" height="142.107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="1"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_702_126"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_702_126" result="shape"/>
</filter>
<filter id="filter3_d_702_126" x="23.3799" y="213.719" width="463.322" height="357.825" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dx="0.5"/>
<feGaussianBlur stdDeviation="1"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_702_126"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_702_126" result="shape"/>
</filter>
<linearGradient id="paint0_linear_702_126" x1="307.314" y1="29.175" x2="179.017" y2="140.869" gradientUnits="userSpaceOnUse">
<stop stop-color="#FF5900"/>
<stop offset="0.0677083" stop-color="#FE661B"/>
<stop offset="0.161458" stop-color="#FE772F"/>
<stop offset="0.25" stop-color="#FE8543"/>
<stop offset="0.359375" stop-color="#FE7E39"/>
<stop offset="0.401042" stop-color="#FF7A33"/>
<stop offset="0.484375" stop-color="#FF7729"/>
<stop offset="0.5625" stop-color="#FE6D20"/>
<stop offset="0.651042" stop-color="#FE6410"/>
<stop offset="0.739583" stop-color="#FF5900"/>
<stop offset="0.822917" stop-color="#FE6410"/>
<stop offset="0.895833" stop-color="#FE6D20"/>
<stop offset="1" stop-color="#FE6B17"/>
</linearGradient>
<linearGradient id="paint1_linear_702_126" x1="111.184" y1="228.696" x2="14.9617" y2="312.466" gradientUnits="userSpaceOnUse">
<stop stop-color="#FF5900"/>
<stop offset="0.0677083" stop-color="#FE661B"/>
<stop offset="0.161458" stop-color="#FE772F"/>
<stop offset="0.25" stop-color="#FE8543"/>
<stop offset="0.359375" stop-color="#FE7E39"/>
<stop offset="0.401042" stop-color="#FF7A33"/>
<stop offset="0.484375" stop-color="#FF7729"/>
<stop offset="0.5625" stop-color="#FE6D20"/>
<stop offset="0.651042" stop-color="#FE6410"/>
<stop offset="0.739583" stop-color="#FF5900"/>
<stop offset="0.822917" stop-color="#FE6410"/>
<stop offset="0.895833" stop-color="#FE6D20"/>
<stop offset="1" stop-color="#FE6B17"/>
</linearGradient>
<linearGradient id="paint2_linear_702_126" x1="480.16" y1="228.696" x2="383.937" y2="312.466" gradientUnits="userSpaceOnUse">
<stop stop-color="#FF5900"/>
<stop offset="0.0677083" stop-color="#FE661B"/>
<stop offset="0.161458" stop-color="#FE772F"/>
<stop offset="0.25" stop-color="#FE8543"/>
<stop offset="0.359375" stop-color="#FE7E39"/>
<stop offset="0.401042" stop-color="#FF7A33"/>
<stop offset="0.484375" stop-color="#FF7729"/>
<stop offset="0.5625" stop-color="#FE6D20"/>
<stop offset="0.651042" stop-color="#FE6410"/>
<stop offset="0.739583" stop-color="#FF5900"/>
<stop offset="0.822917" stop-color="#FE6410"/>
<stop offset="0.895833" stop-color="#FE6D20"/>
<stop offset="1" stop-color="#FE6B17"/>
</linearGradient>
<linearGradient id="paint3_linear_702_126" x1="391.334" y1="269.856" x2="144.297" y2="549.049" gradientUnits="userSpaceOnUse">
<stop stop-color="#1D1D1D"/>
<stop offset="0.0677083"/>
<stop offset="0.161458" stop-color="#1D1D1D"/>
<stop offset="0.25"/>
<stop offset="0.359375"/>
<stop offset="0.401042" stop-color="#1D1D1D"/>
<stop offset="0.484375" stop-color="#1D1D1D"/>
<stop offset="0.5625"/>
<stop offset="0.651042" stop-color="#1D1D1D"/>
<stop offset="0.739583" stop-color="#1D1D1D"/>
<stop offset="0.822917" stop-color="#1D1D1D"/>
<stop offset="0.895833"/>
<stop offset="1"/>
</linearGradient>
</defs>
</svg>', 'iconSetSlug' => 'uncategorized']]], 'design' => ['center_icon' => ['borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'topLeft' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'topRight' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'bottomLeft' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'bottomRight' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'editMode' => 'all']], 'shadow' => ['breakpoint_base' => ['shadows' => [['color' => '#00000025', 'x' => '2', 'y' => '2', 'blur' => '6', 'spread' => '0', 'position' => 'outset']], 'style' => '2px 2px 6px 0px #00000025']]], 'background' => '#FDFDFDFF', 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'right' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'top' => ['number' => 10, 'unit' => 'px', 'style' => '10px'], 'bottom' => ['number' => 10, 'unit' => 'px', 'style' => '10px']]]]]]];
    }

    static function defaultChildren()
    {
        return [['slug' => 'ElementsHiveForBreakdance\OrbitingIconsItem', 'defaultProperties' => ['content' => ['content' => ['icons' => [['icon' => ['id' => 2530, 'slug' => 'icon-postman', 'name' => 'postman', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="256" height="256" preserveAspectRatio="xMidYMid"><path d="M254.953 144.253c8.959-70.131-40.569-134.248-110.572-143.206C74.378-7.912 10.005 41.616 1.047 111.619c-8.959 70.003 40.569 134.248 110.572 143.334 70.131 8.959 134.248-40.569 143.334-110.7Z" fill="#FF6C37"/><path d="m174.2 82.184-54.007 54.007-15.229-15.23c53.11-53.11 58.358-48.503 69.236-38.777Z" fill="#FFF"/><path d="M120.193 137.47c-.384 0-.64-.128-.895-.384l-15.358-15.229a1.237 1.237 0 0 1 0-1.792c54.007-54.006 59.638-48.887 71.028-38.649.255.256.383.512.383.896s-.128.64-.383.896l-54.007 53.878c-.128.256-.512.384-.768.384Zm-13.437-16.509 13.437 13.438 52.087-52.087c-9.47-8.446-15.87-11.006-65.524 38.65Z" fill="#FF6C37"/><path d="m135.679 151.676-14.718-14.718 54.007-54.006c14.46 14.59-7.167 38.265-39.29 68.724Z" fill="#FFF"/><path d="M135.679 152.956c-.384 0-.64-.128-.896-.384l-14.718-14.718c-.256-.256-.256-.512-.256-.896s.128-.64.384-.895L174.2 82.056a1.237 1.237 0 0 1 1.791 0 15.58 15.58 0 0 1 4.991 11.902c-.256 14.206-16.38 32.25-44.28 58.614-.383.256-.767.384-1.023.384Zm-12.926-15.998c8.19 8.319 11.646 11.646 12.926 12.926 21.5-20.476 42.36-41.464 42.488-55.926.128-3.327-1.152-6.655-3.327-9.214l-52.087 52.214Z" fill="#FF6C37"/><path d="m105.22 121.345 10.878 10.878c.256.256.256.512 0 .768-.128.128-.128.128-.256.128l-22.524 4.863c-1.152.128-2.175-.64-2.431-1.791-.128-.64.128-1.28.512-1.664l13.053-13.054c.256-.256.64-.384.768-.128Z" fill="#FFF"/><path d="M92.934 139.262c-1.92 0-3.327-1.536-3.327-3.455 0-.896.384-1.792 1.024-2.432l13.053-13.054c.768-.64 1.792-.64 2.56 0l10.878 10.878c.768.64.768 1.792 0 2.56-.256.256-.512.384-.896.512l-22.524 4.863c-.256 0-.512.128-.768.128Zm11.902-16.51-12.542 12.543c-.256.256-.383.64-.128 1.024.128.383.512.511.896.383l21.116-4.607-9.342-9.342Z" fill="#FF6C37"/><path d="M202.739 52.238c-8.191-7.935-21.373-7.679-29.307.64-7.935 8.318-7.679 21.372.64 29.306A20.678 20.678 0 0 0 199.155 85l-14.59-14.59 18.174-18.172Z" fill="#FFF"/><path d="M188.405 89.223c-12.158 0-22.012-9.854-22.012-22.012 0-12.158 9.854-22.012 22.012-22.012 5.631 0 11.134 2.176 15.23 6.143.255.256.383.512.383.896s-.128.64-.384.895L186.357 70.41l13.566 13.566c.512.512.512 1.28 0 1.792l-.256.256c-3.327 2.047-7.295 3.199-11.262 3.199Zm0-41.337c-10.75 0-19.452 8.703-19.324 19.453 0 10.75 8.702 19.452 19.452 19.324 2.944 0 5.887-.64 8.575-2.047l-13.438-13.31c-.256-.256-.384-.512-.384-.896s.128-.64.384-.895l17.149-17.15c-3.456-2.943-7.807-4.479-12.414-4.479Z" fill="#FF6C37"/><path d="m203.122 52.622-.255-.256-18.301 18.044 14.461 14.462c1.408-.896 2.816-1.92 3.967-3.072a20.51 20.51 0 0 0 .128-29.178Z" fill="#FFF"/><path d="M199.155 86.28c-.384 0-.64-.128-.896-.384l-14.589-14.59c-.256-.256-.384-.512-.384-.896s.128-.64.384-.895l18.173-18.173a1.237 1.237 0 0 1 1.791 0l.384.256c8.575 8.574 8.575 22.396.128 31.098-1.28 1.28-2.687 2.432-4.223 3.328-.384.128-.64.256-.768.256Zm-12.798-15.87 12.926 12.926c1.024-.64 2.048-1.536 2.816-2.304 7.294-7.294 7.678-19.196.64-26.875L186.357 70.41Z" fill="#FF6C37"/><path d="M176.375 84.488a7.879 7.879 0 0 0-11.134 0l-48.247 48.247 8.063 8.063 51.062-44.792c3.328-2.816 3.584-7.807.768-11.134-.256-.128-.384-.256-.512-.384Z" fill="#FFF"/><path d="M124.929 142.077c-.384 0-.64-.128-.896-.383l-8.063-8.063a1.237 1.237 0 0 1 0-1.792l48.247-48.247a9.115 9.115 0 0 1 12.926 0 9.115 9.115 0 0 1 0 12.926l-.384.384-51.063 44.792c-.128.255-.384.383-.767.383Zm-6.143-9.342 6.27 6.271 50.167-44.024c2.816-2.304 3.072-6.527.768-9.342-2.303-2.816-6.526-3.072-9.342-.768-.128.128-.256.256-.512.384l-47.351 47.48Z" fill="#FF6C37"/><path d="M80.009 187.637c-.512.256-.768.768-.64 1.28l2.175 9.214c.512 1.28-.256 2.816-1.663 3.2-1.024.384-2.176 0-2.816-.768l-14.077-13.95 45.943-45.943 15.87.256 10.75 10.75c-2.56 2.175-18.045 17.149-55.542 35.961Z" fill="#FFF"/><path d="M78.985 202.61c-1.024 0-2.048-.383-2.688-1.151l-13.95-13.95c-.255-.256-.383-.512-.383-.896 0-.383.128-.64.384-.895l45.944-45.944c.256-.256.64-.384.895-.384l15.87.256c.383 0 .64.128.895.384l10.75 10.75c.256.256.384.64.384 1.024s-.128.64-.512.896l-.895.767c-13.566 11.902-31.995 23.804-54.902 35.194l2.175 9.086c.384 1.664-.384 3.456-1.92 4.352-.767.384-1.407.512-2.047.512Zm-14.078-15.997 13.182 13.054c.384.64 1.152.896 1.792.512.64-.384.896-1.152.512-1.792l-2.176-9.214c-.256-1.152.256-2.176 1.28-2.688 22.652-11.39 40.952-23.163 54.39-34.81l-9.47-9.47-14.718-.256-44.792 44.664Z" fill="#FF6C37"/><path d="m52.11 197.62 11.006-11.007 16.38 16.381-26.107-1.791c-1.151-.128-1.92-1.152-1.791-2.304 0-.512.128-1.024.512-1.28Z" fill="#FFF"/><path d="m79.497 204.146-26.236-1.791c-1.92-.128-3.199-1.792-3.071-3.712.128-.768.384-1.535 1.024-2.047L62.22 185.59a1.237 1.237 0 0 1 1.792 0l16.38 16.38c.385.385.512.897.257 1.408-.256.512-.64.768-1.152.768Zm-16.381-15.74-10.11 10.11c-.384.255-.384.895 0 1.151.127.128.255.256.511.256l22.652 1.536-13.053-13.054ZM104.452 146.557c-.768 0-1.28-.64-1.28-1.28 0-.384.128-.64.384-.896l12.414-12.414a1.237 1.237 0 0 1 1.792 0l8.062 8.063c.384.384.512.768.384 1.28-.128.384-.512.767-1.023.895l-20.477 4.352h-.256Zm12.414-11.902-8.446 8.446 13.821-2.943-5.375-5.503Z" fill="#FF6C37"/><path d="m124.8 140.926-14.077 3.071c-1.024.256-2.048-.384-2.303-1.408-.128-.64 0-1.28.511-1.791l7.807-7.807 8.063 7.935Z" fill="#FFF"/><path d="M110.467 145.277a3.168 3.168 0 0 1-3.2-3.2c0-.895.385-1.663.897-2.303l7.806-7.807a1.237 1.237 0 0 1 1.792 0l8.062 8.063c.384.384.512.768.384 1.28-.128.384-.512.767-1.023.895l-14.078 3.072h-.64Zm6.399-10.622-6.91 6.91c-.257.257-.257.512-.129.768s.384.384.768.384l11.774-2.56-5.503-5.502ZM203.25 64.907c-.256-.767-1.151-1.151-1.92-.895-.767.255-1.151 1.151-.895 1.92 0 .127.128.255.128.383.768 1.536.512 3.455-.512 4.863-.512.64-.384 1.536.128 2.048.64.512 1.536.384 2.048-.256 1.92-2.432 2.303-5.503 1.023-8.063Z" fill="#FF6C37"/></svg>', 'iconSetSlug' => 'uncategorized']], ['icon' => ['id' => 2535, 'slug' => 'icon-kubernetes', 'name' => 'kubernetes', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 722.8 702">
  <path style="fill:#326ce5;fill-opacity:1;stroke:#fff;stroke-width:0;stroke-miterlimit:4;stroke-opacity:1;stroke-dasharray:none" d="M365 185a47 46 0 0 0-18 4L103 306a47 46 0 0 0-25 32L18 600a47 46 0 0 0 6 35 47 46 0 0 0 3 4l169 210a47 46 0 0 0 36 18h271a47 46 0 0 0 37-18l169-210a47 46 0 0 0 9-39l-60-263a47 46 0 0 0-26-31L388 189a47 46 0 0 0-23-4z" transform="translate(-6 -175)"/>
  <path d="M368 274c-8 0-15 7-15 16v4l2 14 2 27c-1 3-3 6-5 7v7a190 190 0 0 0-122 58l-6-3c-2 0-5 1-8-1l-20-18-10-10-3-3c-3-2-7-4-10-4-5 0-9 2-12 5-5 7-3 16 4 22l3 3 12 7 22 15c2 2 3 7 3 8l5 5c-26 37-37 84-30 131l-6 2c-2 2-4 6-7 7l-26 4-14 1-4 1c-9 2-14 10-13 18 2 8 11 12 19 11h1v-1h4l13-5c9-4 17-7 25-8l9 3 6-1c15 45 45 82 84 105l-2 7c1 2 2 5 1 8l-13 24-8 11-2 4c-4 8-1 18 6 21 8 4 17 0 20-8l2-4 5-13c3-10 6-20 11-27l6-3 3-6a189 189 0 0 0 135 1l4 5c2 1 5 2 7 5l10 24 4 14 2 4c4 8 13 11 20 8 8-4 10-13 7-21l-2-4-8-12c-6-8-10-15-13-23-1-4 0-6 1-8l-2-6c40-24 70-62 84-106l6 1c2-2 4-4 8-3 8 1 16 4 26 7l13 5 4 1c9 2 17-3 19-10 2-8-4-16-12-18l-5-1-14-1c-10-1-18-2-26-5-3-1-5-5-6-6l-6-2a189 189 0 0 0-31-131l6-5c0-3 0-5 2-8 6-6 13-10 22-16l12-7 4-2c7-6 8-16 3-22s-15-7-22-1l-3 2-10 11c-7 7-13 13-19 17-3 2-7 2-9 1l-6 4c-31-33-75-54-121-58v-7c-2-2-5-3-5-7-1-8 0-16 1-27l2-14v-4c0-9-6-16-14-16zm-19 113-4 77a13 13 0 0 1-21 10l-63-44a151 151 0 0 1 88-43zm37 0c33 5 64 20 88 43l-63 44a13 13 0 0 1-21-10zm-148 71 58 52a13 13 0 0 1-5 22l-74 22c-4-35 4-68 21-96zm259 0a153 153 0 0 1 22 95l-74-21a13 13 0 0 1-5-22h-1l58-52zm-141 56h23l15 18-5 23-21 10-21-10-6-23zm75 62h3l77 13c-12 32-33 59-61 77l-30-72a13 13 0 0 1 11-18zm-128 1a13 13 0 0 1 12 18l-29 71c-27-18-49-44-61-77l76-12h2zm64 31c2-1 4 0 6 1 3 1 5 3 6 5l38 68a154 154 0 0 1-98-1l37-67c3-4 7-6 11-6z" style="font-size:medium;font-style:normal;font-variant:normal;font-weight:400;font-stretch:normal;text-indent:0;text-align:start;text-decoration:none;line-height:normal;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;text-anchor:start;baseline-shift:baseline;color:#000;fill:#fff;fill-opacity:1;stroke:#fff;stroke-width:.25;stroke-miterlimit:4;stroke-opacity:1;stroke-dasharray:none;marker:none;visibility:visible;display:inline;overflow:visible;enable-background:accumulate;font-family:Sans;-inkscape-font-specification:Sans" transform="translate(-6 -175)"/>
</svg>', 'iconSetSlug' => 'uncategorized']], ['icon' => ['id' => 2531, 'slug' => 'icon-rapidapi', 'name' => 'rapidapi', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64" fill-rule="evenodd"><path d="M.38 32C.38 49.463 14.536 63.62 32 63.62S63.62 49.463 63.62 32 49.464.38 32 .38.38 14.537.38 32z" fill="#1d4371"/><path d="M32 .001A31.79 31.79 0 0 0 9.374 9.373 31.79 31.79 0 0 0 0 32a31.78 31.78 0 0 0 9.374 22.627 31.79 31.79 0 0 0 22.625 9.372 31.78 31.78 0 0 0 22.627-9.374A31.79 31.79 0 0 0 64 32a31.79 31.79 0 0 0-9.374-22.627A31.79 31.79 0 0 0 31.999.001m0 .38C49.463.38 63.62 14.537 63.62 32S49.464 63.62 32 63.62.38 49.463.38 32 14.536.38 32 .38m21.182 45.816-6.3.5a2.634 2.634 0 0 1-1.848-.704l-2.28-2.197-2.258-2.12a1.32 1.32 0 0 0-.977-.307 1.306 1.306 0 0 0-1.192 1.224c-.02.302.064.603.24.85l3.993 4.774 1.42 1.55a2.11 2.11 0 0 1 .626 2.043 2.113 2.113 0 0 1-1.483 1.54 2.1 2.1 0 0 1-2.065-.55l-1.613-1.35-6.308-5.378a1.29 1.29 0 0 0-1.77.034l-6.105 5.607-1.562 1.4a2.105 2.105 0 0 1-3.598-.856 2.11 2.11 0 0 1 .567-2.074L22.04 48.6l3.8-4.873a1.39 1.39 0 0 0 .232-.903 1.313 1.313 0 0 0-1.237-1.178 1.316 1.316 0 0 0-.964.342l-2.18 2.2-2.196 2.283a2.63 2.63 0 0 1-1.822.772l-6.3-.273-2.104-.108a2.105 2.105 0 0 1-.077-4.209l2.097-.17 4.693-.584a2.644 2.644 0 0 0 2.112-2.638l-.27-14.543c-.144-7.758 6.028-14.165 13.787-14.3s14.165 6.028 14.3 13.787l.27 14.54a2.643 2.643 0 0 0 2.2 2.558l4.712.4 2.1.1a2.08 2.08 0 0 1 1.9.993c.397.656.422 1.48.04 2.152a2.1 2.1 0 0 1-1.87 1.064z" fill="#fff"/><path d="m41.553 23.552-5.108-3.3c-.91-.547-1.972.192-1.956 1.256.008.57.3.937.76 1.23l2.793 1.818-2.98 1.795c-.683.436-.835 1.214-.44 1.875.37.62 1.148.882 1.805.507l5.05-3c.8-.51.856-1.643.076-2.18m-13.18 2.64-2.746-1.638 2.714-1.763c.892-.584 1.12-1.37.626-2.1-.474-.696-1.266-.787-2.133-.228l-4.36 2.822c-1.214.793-1.192 1.92.057 2.668l4.408 2.607c.87.5 1.683.376 2.114-.336.436-.72.175-1.516-.68-2.034" fill="#1d4371"/></svg>', 'iconSetSlug' => 'uncategorized']]]]], 'design' => ['animation' => ['duration' => ['number' => 15, 'unit' => 's', 'style' => '15s']], 'circle_path' => ['stroke_color' => '#dadada']]], 'children' => []], ['slug' => 'ElementsHiveForBreakdance\OrbitingIconsItem', 'defaultProperties' => ['content' => ['content' => ['icons' => [['icon' => ['id' => 2534, 'slug' => 'icon-supabase', 'name' => 'supabase', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 109 113" fill="none">
<path d="M63.7076 110.284C60.8481 113.885 55.0502 111.912 54.9813 107.314L53.9738 40.0627L99.1935 40.0627C107.384 40.0627 111.952 49.5228 106.859 55.9374L63.7076 110.284Z" fill="url(#paint0_linear)"/>
<path d="M63.7076 110.284C60.8481 113.885 55.0502 111.912 54.9813 107.314L53.9738 40.0627L99.1935 40.0627C107.384 40.0627 111.952 49.5228 106.859 55.9374L63.7076 110.284Z" fill="url(#paint1_linear)" fill-opacity="0.2"/>
<path d="M45.317 2.07103C48.1765 -1.53037 53.9745 0.442937 54.0434 5.041L54.4849 72.2922H9.83113C1.64038 72.2922 -2.92775 62.8321 2.1655 56.4175L45.317 2.07103Z" fill="#3ECF8E"/>
<defs>
<linearGradient id="paint0_linear" x1="53.9738" y1="54.974" x2="94.1635" y2="71.8295" gradientUnits="userSpaceOnUse">
<stop stop-color="#249361"/>
<stop offset="1" stop-color="#3ECF8E"/>
</linearGradient>
<linearGradient id="paint1_linear" x1="36.1558" y1="30.578" x2="54.4844" y2="65.0806" gradientUnits="userSpaceOnUse">
<stop/>
<stop offset="1" stop-opacity="0"/>
</linearGradient>
</defs>
</svg>', 'iconSetSlug' => 'uncategorized']], ['icon' => ['id' => 2532, 'slug' => 'icon-workos', 'name' => 'workos', 'svgCode' => '<svg xmlns:x="ns_extend;" xmlns:i="ns_ai;" xmlns:graph="ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 55.4 48" style="enable-background:new 0 0 55.4 48;" width="250" height="250" xml:space="preserve">
 <style type="text/css">
  .st0{fill:#6363F1;}
 </style>
 <metadata>
  <sfw xmlns="ns_sfw;">
   <slices>
   </slices>
   <sliceSourceBounds bottomLeftOrigin="true" height="48" width="55.4" x="55.4" y="-228.6">
   </sliceSourceBounds>
  </sfw>
 </metadata>
 <g>
  <path id="logo-icon" class="st0" d="M0,24c0,1.1,0.3,2.1,0.8,3l9.7,16.8c1,1.7,2.5,3.1,4.4,3.7c3.6,1.2,7.5-0.3,9.4-3.5l2.3-4.1   l-9.2-16l9.8-16.9L29.5,3c0.7-1.2,1.6-2.2,2.7-3H17.2c-2.6,0-5.1,1.4-6.4,3.7L0.8,21C0.3,21.9,0,22.9,0,24z">
  </path>
  <path id="logo-icon_1_" class="st0" d="M55.4,24c0-1.1-0.3-2.1-0.8-3l-9.8-17c-1.9-3.3-5.8-4.7-9.4-3.5c-1.9,0.6-3.4,2-4.4,3.7   L28.7,8L38,24l-9.8,16.9L25.9,45c-0.7,1.2-1.6,2.2-2.7,3h15.1c2.6,0,5.1-1.4,6.4-3.7l10-17.3C55.1,26.1,55.4,25.1,55.4,24z">
  </path>
 </g>
</svg>', 'iconSetSlug' => 'uncategorized']], ['icon' => ['id' => 2533, 'slug' => 'icon-azure', 'name' => 'azure', 'svgCode' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96">
  <defs>
    <linearGradient id="a" x1="-1032.17" x2="-1059.21" y1="145.31" y2="65.43" gradientTransform="matrix(1 0 0 -1 1075 158)" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-color="#114a8b"/>
      <stop offset="1" stop-color="#0669bc"/>
    </linearGradient>
    <linearGradient id="b" x1="-1023.73" x2="-1029.98" y1="108.08" y2="105.97" gradientTransform="matrix(1 0 0 -1 1075 158)" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-opacity=".3"/>
      <stop offset=".07" stop-opacity=".2"/>
      <stop offset=".32" stop-opacity=".1"/>
      <stop offset=".62" stop-opacity=".05"/>
      <stop offset="1" stop-opacity="0"/>
    </linearGradient>
    <linearGradient id="c" x1="-1027.16" x2="-997.48" y1="147.64" y2="68.56" gradientTransform="matrix(1 0 0 -1 1075 158)" gradientUnits="userSpaceOnUse">
      <stop offset="0" stop-color="#3ccbf4"/>
      <stop offset="1" stop-color="#2892df"/>
    </linearGradient>
  </defs>
  <path fill="url(#a)" d="M33.34 6.54h26.04l-27.03 80.1a4.15 4.15 0 0 1-3.94 2.81H8.15a4.14 4.14 0 0 1-3.93-5.47L29.4 9.38a4.15 4.15 0 0 1 3.94-2.83z"/>
  <path fill="#0078d4" d="M71.17 60.26H29.88a1.91 1.91 0 0 0-1.3 3.31l26.53 24.76a4.17 4.17 0 0 0 2.85 1.13h23.38z"/>
  <path fill="url(#b)" d="M33.34 6.54a4.12 4.12 0 0 0-3.95 2.88L4.25 83.92a4.14 4.14 0 0 0 3.91 5.54h20.79a4.44 4.44 0 0 0 3.4-2.9l5.02-14.78 17.91 16.7a4.24 4.24 0 0 0 2.67.97h23.29L71.02 60.26H41.24L59.47 6.55z"/>
  <path fill="url(#c)" d="M66.6 9.36a4.14 4.14 0 0 0-3.93-2.82H33.65a4.15 4.15 0 0 1 3.93 2.82l25.18 74.62a4.15 4.15 0 0 1-3.93 5.48h29.02a4.15 4.15 0 0 0 3.93-5.48z"/>
</svg>', 'iconSetSlug' => 'uncategorized']]]]], 'design' => ['circle_path' => ['radius' => ['breakpoint_base' => ['number' => 120, 'unit' => 'px', 'style' => '120px']], 'stroke_color' => '#dadada'], 'animation' => ['direction' => 'reversed', 'duration' => null], 'icons' => ['background' => '#F3F3F3FF', 'borders' => ['radius' => ['breakpoint_base' => ['all' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'topLeft' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'topRight' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'bottomLeft' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'bottomRight' => ['number' => 999, 'unit' => 'px', 'style' => '999px'], 'editMode' => 'all']], 'shadow' => ['breakpoint_base' => ['shadows' => [['color' => '#0000003B', 'x' => '2', 'y' => '2', 'blur' => '6', 'spread' => '0', 'position' => 'outset']], 'style' => '2px 2px 6px 0px #0000003B']]], 'padding' => ['padding' => ['breakpoint_base' => ['left' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'right' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'top' => ['number' => 5, 'unit' => 'px', 'style' => '5px'], 'bottom' => ['number' => 5, 'unit' => 'px', 'style' => '5px']]]]]]], 'children' => []]];
    }

    static function cssTemplate()
    {
        $template = file_get_contents(__DIR__ . '/css.twig');
        return $template;
    }

    static function designControls()
    {
        return [c(
        "container",
        "Container",
        [c(
        "width",
        "Width",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      ), c(
        "height",
        "Height",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        true,
        false,
        [],
      )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), c(
        "center_icon",
        "Center Icon",
        [c(
        "size",
        "Size",
        [],
        ['type' => 'unit', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "color",
        "Color",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), c(
        "background",
        "Background",
        [],
        ['type' => 'color', 'layout' => 'inline'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\borders",
      "Borders",
      "borders",
       ['type' => 'popout']
     ), getPresetSection(
      "EssentialElements\\spacing_padding_all",
      "Padding",
      "padding",
       ['type' => 'popout']
     )],
        ['type' => 'section'],
        false,
        false,
        [],
      ), getPresetSection(
      "EssentialElements\\spacing_margin_y",
      "Spacing",
      "spacing",
       ['type' => 'popout']
     )];
    }

    static function contentControls()
    {
        return [c(
        "content",
        "Content",
        [c(
        "orbits",
        "Orbits",
        [],
        ['type' => 'add_registered_children', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      ), c(
        "center_icon",
        "Center Icon",
        [c(
        "icon",
        "Icon",
        [],
        ['type' => 'icon', 'layout' => 'vertical'],
        false,
        false,
        [],
      )],
        ['type' => 'section', 'layout' => 'vertical'],
        false,
        false,
        [],
      )];
    }

    static function settingsControls()
    {
        return [];
    }

    static function dependencies()
    {
        return false;
    }

    static function settings()
    {
        return false;
    }

    static function addPanelRules()
    {
        return false;
    }

    static public function actions()
    {
        return false;
    }

    static function nestingRule()
    {
        return ["type" => "container-restricted",   ];
    }

    static function spacingBars()
    {
        return [['cssProperty' => 'margin-top', 'location' => 'outside-top', 'affectedPropertyPath' => 'design.spacing.%%BREAKPOINT%%.margin_top'], ['cssProperty' => 'margin-bottom', 'location' => 'outside-bottom', 'affectedPropertyPath' => 'design.spacing.%%BREAKPOINT%%.margin_bottom']];
    }

    static function attributes()
    {
        return false;
    }

    static function experimental()
    {
        return false;
    }

    static function order()
    {
        return 9;
    }

    static function dynamicPropertyPaths()
    {
        return [];
    }

    static function additionalClasses()
    {
        return false;
    }

    static function projectManagement()
    {
        return false;
    }

    static function propertyPathsToWhitelistInFlatProps()
    {
        return false;
    }

    static function propertyPathsToSsrElementWhenValueChanges()
    {
        return false;
    }
}
