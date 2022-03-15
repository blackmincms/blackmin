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

namespace BlackMin\View;

final class View
{
    /**
     * @var string
     */
    private $templateDirectory = __DIR__.'/../../public/theme/';

    /**
     * @var string
     */
    private $themeName;

    /**
     * @var string
     */
    private $templateExtension = '.phtml';

    /**
     * @var array
     */
    private $variables = [];

    private function __construct()
    {
    }

    public static function createInstance(string $themeName, View $fromView = null): self
    {
        if ($fromView) {
            $view = clone $fromView;
            $view->variables = [];
        } else {
            $view = new self();
        }
        $view->themeName = $themeName;

        return $view;
    }

    public function __isset($key): bool
    {
        return array_key_exists($key, $this->variables);
    }
    
    public function __set($key, $value): void
    {
        $this->variables[$key] = $value;
    }

    public function __get($key)
    {
        return $this->variables[$key] ?? null;
    }

    public function render($template, array $payload = []): void
    {
        foreach ($payload as $key => $value){
            $this->{$key} = $value;
        }

        $templatePath = $this->templateDirectory . $this->themeName . '/' . $template . $this->templateExtension;
        $templateVariablePath = $this->templateDirectory . $this->themeName . '/' . $template . '.php';

        if (file_exists($templateVariablePath)) {
            include_once $templateVariablePath;
        }

        if (file_exists($templatePath)) {
            include_once $templatePath;
        }
    }

    private function renderViewOnly($template)
    {
        $templatePath = $this->templateDirectory . $this->themeName . '/' . $template . $this->templateExtension;
        ob_start();
        include_once $templatePath;
        return ob_get_clean();
    }
}
