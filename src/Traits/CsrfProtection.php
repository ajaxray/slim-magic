<?php
declare(strict_types=1);

namespace App\Traits;

use App\Service\Template;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;

trait CsrfProtection
{
    /**
     * @param ServerRequestInterface $request
     * @param Template $template
     * @param Guard $csrf
     */
    private function setCSRFFields(ServerRequestInterface $request, Template $template, Guard $csrf): void
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

    private function cleanCSRFFields(Guard $csrf, array &$data): void
    {
        unset($data[$csrf->getTokenNameKey()]);
        unset($data[$csrf->getTokenValueKey()]);
    }
}