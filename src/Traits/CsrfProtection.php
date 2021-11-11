<?php

namespace App\Traits;

use App\Service\TemplateService;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;

trait CsrfProtection
{
    /**
     * @param ServerRequestInterface $request
     * @param TemplateService $template
     * @param Guard $csrf
     */
    private function setCSRFFields(ServerRequestInterface $request, TemplateService $template, Guard $csrf): void
    {
        $nameKey = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();

        $template->set([
            'nameKey' => $nameKey,
            'valueKey' => $valueKey,
            'name' => $request->getAttribute($nameKey),
            'value' => $request->getAttribute($valueKey),
        ]);
    }
}