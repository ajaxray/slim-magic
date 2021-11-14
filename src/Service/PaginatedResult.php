<?php

namespace App\Service;

class PaginatedResult
{
    public function __construct(
        public array $items,
        public bool $hasNext,
        public bool $hasPrevious,
    )
    {
        // ValueObject - Simple pagination with just next previous links
    }
}