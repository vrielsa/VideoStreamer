<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Collection\User\UserRoleCollection;
use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRole;
use App\Domain\Repository\UserRepositoryInterface;

class UserFixtures implements FixtureInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(): iterable
    {
        $this->userRepository->drop();

        foreach ($this->generate() as $user) {
            $this->userRepository->create($user);

            yield $user;
        }
    }

    private function generate(): iterable
    {
        // password = password
        $password = '$argon2i$v=19$m=1024,t=2,p=2$R1NLOUc3Rlk2MzVVVm5URQ$jMnecwv6RwAk96Wmh8J7l01hhmpCQ9TJOO167o3XQxc';

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb3',
            'ash',
            'ash.ketchum@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::admin())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb4',
            'misty',
            'misty@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb5',
            'brock',
            'brock@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb6',
            'jessie',
            'jessie@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb7',
            'james',
            'james@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb8',
            'oak',
            'oak@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffb9',
            'may',
            'may@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffc1',
            'serena',
            'misty@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );

        yield User::load(
            'd57b15ea-60dc-4712-9757-543c3e1fffc2',
            'dawn',
            'dawn@dispostable.com',
            $password,
            new UserRoleCollection(UserRole::standardUser())
        );
    }
}
