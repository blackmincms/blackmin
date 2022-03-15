<?php
/**
 * This file is part of the blackmin package.
 *
 * (c) BlackMin
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BlackMin\Plugin;

class Meta extends Base
{
    private const META_PROPERTY = 0;
    private const META_CONTENT = 1;

    private $metaLinks = ['js' => [], 'css' => []];

    private $meta = [];

    private $robots = '';

    private $title = '';

    private $currentLang = 'pl';

    private $icon = ['ico' => '', 'icon' => ''];

    private $generator = 'BlackMinCMS ';

    private $siteUrl = '';

    private $activeTheme = '';

    public function __invoke(array $parameters = [])
    {
        $this->title = $parameters['bm_name_site'] ?? null;
        $description = $parameters['bm_description_site'] ?? null;
        $keywords = $parameters['bm_keywords'] ?? null;
        $this->siteUrl = $parameters['url_server'] ?? null;
        $this->currentLang = $parameters['bm_lang_site'] ?? null;
        $this->icon['ico'] = $parameters['bm_icon_site'] ?? null;
        $this->icon['icon'] = $parameters['bm_icon_png_site'] ?? null;
        $this->activeTheme = $parameters['bm_theme_active'] ?? null;
        $this->generator .= '3.0';
        $this->addMeta('title', $this->title);
        $this->addMeta('description', $description);
        $this->addMeta('keywords', $keywords);
        $this->addMeta('og:title', $this->title, 'property');
        $this->addMeta('og:site_name', $this->title, 'property');
        $this->addMeta('og:description', $description, 'property');
        $this->addMeta('og:keywords', $keywords, 'property');
        $this->addMeta('og:url', $this->siteUrl, 'property');


    }

    public function renderHtml(): void
    {
        $renderTitle = $this->renderTitle();
        $renderRobots = $this->renderRobots();
        $renderMeta = $this->renderMeta();
        $renderCss = $this->renderLinks('css');
        $renderJs = $this->renderLinks('js');
        $iconIco = $this->icon['ico'];
        $icon = $this->icon['icon'];

echo <<<END
	<title>$renderTitle</title>    
	<!-- Konczenie Znaczników meta i meta_data i metadata i robots-->
	<!-- Dodawanie nowych znaczników meta ON -->
	$renderMeta
	<link rel="shortcut icon" type="image/x-icon" href="$iconIco"/>               
	<link rel="icon" type="image/png" href="$icon" />
	<meta property="og:image" content="$icon">
	<meta property="og:image:width" content="100">
    <meta property="og:image:height" content="100">
    <meta property="og:type" content="website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
	<meta http-equiv="Page-Enter" content="revealTrans(Duration=10, Transition=23)">
	<meta http-equiv="Content-Language" content="$this->currentLang">
	<meta name="Author" content="Black Min CMS">
    <meta http-equiv="Expires" content="Fri, 28 Dec 2019 17:45:14 GMT">
    <meta name="Authoring_tool" content="$this->generator">
	<meta name="generator" content="$this->generator">
	<!-- Dodawanie nowych znaczników meta OFF -->
	$renderRobots
	<!-- Dodawanie nowych stylów css ON -->
	$renderCss
	<!-- Dodawanie nowych stylów css OFF -->
	<!-- Dodawanie nowych skryptów javascript ON -->
	$renderJs
	<!-- Dodawanie nowych skryptów javascript OFF -->
END;
    }

    public function setRobots($robots): void
    {
        $this->robots = $robots;
    }

    public function addLink($type, $link, $flag = null): void
    {
        if ($type === 'css') {
            if ($link === "jquery_ui") {
                $this->metaLinks[$type][] = '<link rel="stylesheet" href="'.$this->siteUrl.'public/files/global/jquery/jquery-ui.css" />'. " \n ";
            } elseif ($flag === "bm" || $flag === "black_min" || $flag === "blackmin") {
                $this->metaLinks[$type][] = '<link rel="stylesheet" href="'. $link .'">'. " \n ";
            } else {
                $this->metaLinks[$type][] = '<link rel="stylesheet" href="'.$this->siteUrl. "public/theme/" . $this->activeTheme . "/" . $link .'">'. " \n ";
            }
        }

        if ($type === 'js') {
            if ($link === "jquery"){
                $this->metaLinks[$type][] = '<script src="'.$this->siteUrl.'public/files/global/jquery/jquery.min.js"></script>'. " \n ";
            } elseif ($link === "jquery_ui") {
                $this->metaLinks[$type][] = '<script src="'.$this->siteUrl.'public/files/global/jquery/jquery-ui.min.js"></script>'. " \n ";
            } elseif ($flag === "bm" || $flag === "black_min" || $flag === "blackmin") {
                $this->metaLinks[$type][] = '<script src="'. $link .'"></script>'. " \n ";
            } else {
                $this->metaLinks[$type][] = '<script src="'.$this->siteUrl. "public/theme/" . $this->activeTheme  . "/" . $link .'"></script>'. " \n ";
            }
        }
    }

    public function addMeta($type, $value, $property = 'name'): void
    {
        $this->meta[$type] = [$property, $value];
    }

    private function renderLinks($type): string
    {
        $links = $this->metaLinks[$type] ?? null;
        $result = '';
        if (!empty($links)) {
            $result = implode('', $links);
        }

        return $result;
    }

    private function renderMeta(): string
    {
        $meta = $this->meta;
        $result = '';
        if (!empty($meta)) {
            foreach ($meta as $type => $value) {
                 $result .= '<meta '.$value[self::META_PROPERTY].'="'.$type.'" content="'.$value[self::META_CONTENT].'">'."\n";
            }
        }

        return $result;
    }

    private function renderRobots(): string
    {
        return '<meta name="robots" content="'.$this->robots.'">'."\n";
    }

    private function renderTitle(): string
    {
        return $this->title . ' | Black Min CMS';
    }
}
