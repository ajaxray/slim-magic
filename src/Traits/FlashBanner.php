<?php
declare(strict_types=1);

namespace App\Traits;

use App\Service\Template;

trait FlashBanner
{
    function setFlashData(Template $template, array $queryParams): void
    {
        if (isset($queryParams['success'])) {
            $template->set([
                'flash_type' => 'success', // No error/failure flash message so far
                'flash_message' => ucfirst($queryParams['success']) . " {$queryParams['action']} successfully",
            ]);
        }
    }
}