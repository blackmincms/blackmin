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

use BlackMin\View\View;

abstract class Base
{
    protected $view;

    public abstract function __invoke(array $parameters = []);

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function result(array $parameters = [])
    {
        ob_start();
        $self = clone $this;
        $self($parameters);
        return ob_get_clean();
    }
}
