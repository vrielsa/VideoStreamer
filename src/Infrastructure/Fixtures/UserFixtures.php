<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Collection\UserRoleCollection;
use App\Domain\Model\User;
use App\Domain\Model\UserRole;
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
        $collection = $this->userRepository->getCollection();
        $collection->drop();

        foreach ($this->generate() as $user) {
            $this->userRepository->save($user);

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
    }
}
