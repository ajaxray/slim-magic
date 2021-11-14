<?php

namespace App\Service;

/**
 * Render a php template with providing variable values (view arguments)
 */
class Template
{
    /**
     * Template constructor.
     *
     * @param array $viewVars
     */
    public function __construct(
        private array $viewVars = []
    )
    {
    }

    /**
     * @param string $templateFile
     * @return string
     */
    public function render(string $templateFile): string
    {
        ob_start();
        extract($this->viewVars, EXTR_SKIP);
        include __DIR__ ."/../../templates/{$templateFile}.php";
        return ob_get_clean();
    }

    /**
     * @param array $params Assign template variables as associative array
     * @return $this
     */
    public function set(array $params): self
    {
        foreach ($params as $key => $value) {
            $this->viewVars[$key] = $value;
        }

        return $this;
    }
}