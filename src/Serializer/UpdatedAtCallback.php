<?php
declare(strict_types=1);

namespace App\Serializer;

use DateTimeInterface;

class UpdatedAtCallback
{
    public function __invoke(null|string|DateTimeInterface $innerObject): DateTimeInterface|string|null
    {
        if ($innerObject === null) {
            return null;
        }

        if (!($innerObject instanceof DateTimeInterface)) {
            return $innerObject;
        }

        return $innerObject->format('H:i:s Y-m-d');
    }
}
