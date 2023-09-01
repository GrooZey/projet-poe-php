<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 45)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $email;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_picture = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Role $Role_id;

    #[ORM\ManyToMany(targetEntity: Picture::class)]
    private Collection $Favorite;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->Favorite = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): static
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getRoleId(): Role
    {
        return $this->Role_id;
    }

    public function setRoleId(?Role $Role_id): static
    {
        $this->Role_id = $Role_id;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getFavorite(): Collection
    {
        return $this->Favorite;
    }

    public function addFavorite(Picture $favorite): static
    {
        if (!$this->Favorite->contains($favorite)) {
            $this->Favorite->add($favorite);
        }

        return $this;
    }

    public function removeFavorite(Picture $favorite): static
    {
        $this->Favorite->removeElement($favorite);

        return $this;
    }
}
