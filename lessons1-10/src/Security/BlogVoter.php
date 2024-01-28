<?php
namespace App\Security;

use App\Entity\Blog;
use App\Entity\User;
use LogicException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BlogVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    public function __construct(private Security $security)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Blog) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Blog $blog */
        $blog = $subject;

        return match($attribute) {
            self::VIEW => $this->canView($blog, $user),
            self::EDIT => $this->canEdit($blog, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canView(Blog $blog, User $user): bool
    {
        return true;
    }

    private function canEdit(Blog $blog, User $user): bool
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return $user === $blog->getUser();
    }
}
