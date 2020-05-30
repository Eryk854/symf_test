<?php

namespace App\Security\Voter;

use App\Entity\Sylabus;
use App\Entity\Uzytkownik;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class EditSylabusVoter extends Voter
{
    public const SYLABUS_VIEW = 'SYLABUS_VIEW';
    public const SYLABUS_EDIT = 'SYLABUS_EDIT';
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::SYLABUS_EDIT, self::SYLABUS_VIEW])
            && $subject instanceof \App\Entity\Sylabus;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof Uzytkownik) {
            return false;
        }

        // ROLE_ADMIN can access all
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        switch ($attribute) {
            case self::SYLABUS_EDIT:
                return $this->canEdit($subject, $user);
            case self::SYLABUS_VIEW:
                return true;
        }

        return false;
    }

    private function canEdit(Sylabus $sylabus, Uzytkownik $user)
    {
        return $user->getId() === $sylabus->getKoordynatorZajec()->getId();
    }
}
