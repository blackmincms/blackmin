<?php
/**
 * This file is part of the blackmin package.
 *
 * (c) BlackMin
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/../config/config.php';

$view = BlackMin\View\View::createInstance('braund');

$view->render('index');