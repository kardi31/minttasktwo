<?php
declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * @var bool
     */
    protected $disabled;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string The hashed password
     */
    private $password;

    /**
     * @var string[]
     */
    private $roles;

    /**
     * @param string $username
     * @param string $password
     * @param bool   $disabled
     */
    public function __construct(string $username, string $password, bool $disabled = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->disabled = $disabled;
        $this->roles = ['ROLE_USER'];
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
