<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;


/**
 * @method string getUserIdentifier()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=25, unique=true)
	 */
	private $username;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $password;

	/**
	 * @ORM\Column(type="array")
	 */
	private $roles;

	public function __construct(string $username, string $password, array $roles)
	{
		$this->username = $username;
		$this->password = $password;
		$this->roles = $roles;
	}

	public function getRoles(): array
	{
		return $this->roles;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getSalt()
	{
		return null;
	}

	public function eraseCredentials()
	{
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function __call($name, $arguments)
	{
		// TODO: Implement @method string getUserIdentifier()
	}
}