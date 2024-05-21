<?php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class BlogDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly ?string $title,
        #[Assert\NotBlank]
        public readonly ?string $description,
        #[Assert\NotBlank]
        public readonly ?string $text,
        public readonly ?string $tags
    ) {
    }
}
