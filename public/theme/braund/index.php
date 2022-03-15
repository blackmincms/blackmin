<?php

use BlackMin\Database\Database;
use BlackMin\Plugin\Menu;
use BlackMin\Plugin\Meta;
use BlackMin\Plugin\Posts;
use BlackMin\Plugin\Widget;
use BlackMin\Router\Router;
use BlackMin\Settings;

function data_format($datetime, $foramt_czasu) {

    $date = date_create($datetime);

    $datetime_format = date_format($date, $foramt_czasu);

    return $datetime_format;

}

$database = new Database();
$settings = new Settings($database);
$this->settings = $settings->loadSettings();
$parameters = [
    'bm_name_site' => 'motyw braund',
    'bm_description_site' => 'motyw braund',
    'bm_keywords' => 'motyw braund'
];
$parameters = array_merge($this->settings, $parameters);

$meta = new Meta($this);
$meta($parameters);
$meta->addLink('css', 'jquery_ui');
$meta->addLink('css', $this->settings["url_server"] . 'public/files/css/timonix_styles_rezult.css', 'bm');
$meta->addLink('css', 'css/braund.css');
$meta->addLink('js', 'jquery', 'bm');
$meta->addLink('js', 'jquery_ui', 'bm');

$router = new Router($parameters);
if($router->bm_url()["checked_url"] === "post_page"){
    $meta->addLink('js', 'js/post_page.js');
}

if($router->bm_url()["checked_url"] === "root"){
    $meta->addLink('js', 'js/home.js');
}

if($router->bm_url()["checked_url"] === "search_page"){
    $meta->addLink('js', 'js/home.js');
}

$widget = new Widget($this);
$widget($parameters);

$menu = new Menu($this, $database);
$menu($parameters);

$posts = new Posts($this, $database);
$parameters['bm_url'] = $router->bm_url();
$posts($parameters);

$this->meta = $meta;
$this->menu = $menu;
$this->widget = $widget;
$this->posts = $posts;
$this->router = $router;