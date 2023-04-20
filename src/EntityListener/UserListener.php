<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserListener
 *  @author Tresor-ilunga <ilungat82@gmail.com>
 */
class UserListener
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $hasher;

    /**
     * UserListener constructor.
     *
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * Encode password before persisting user
     *
     * @param User $user
     * @return void
     */
    public function prePersist(User $user): void
    {
        $this->encodePassword($user);
    }

    /**
     * Encode password before updating user
     *
     * @param User $user
     * @return void
     */
    public function preUpdate(User $user): void
    {
        $this->encodePassword($user);
    }

    /**
     * Encode password based on plain password
     *
     * @param User $user
     * @return void
     */
    public function encodePassword(User $user): void
    {
        if ($user->getPlainPassword() === null)
        {
            return;
        }
        $user->setPassword
        (
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
            )
        );
    }
}