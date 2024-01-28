<?php
namespace App\Filter;

use App\Entity\User;

class BlogFilter
{
    private ?string $title = null;

    public function __construct(private ?User $user = null)
    {}

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
