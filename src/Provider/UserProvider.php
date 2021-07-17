<?php


namespace App\Provider;


use App\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Translation\Provider\ProviderInterface;
use function PHPUnit\Framework\throwException;

/**
 * @method UserInterface loadUserByIdentifier(string $identifier)
 */
class UserProvider implements UserProviderInterface
{

	public function loadUserByUsername(string $username)
	{

	}

	public function refreshUser(UserInterface $user)
	{
		if (!$user instanceof User)
			throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
	}

	public function supportsClass(string $class): bool
	{
		return User::class || is_subclass_of($class, User::class);
	}

	public function __call($name, $arguments)
	{
		// TODO: Implement @method UserInterface loadUserByIdentifier(string $identifier)
	}
}