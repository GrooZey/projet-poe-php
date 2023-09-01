<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 45)]
    private string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private string $path;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $date;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private User $User_id;

    #[ORM\ManyToMany(targetEntity: Theme::class, inversedBy: 'pictures')]
    private Collection $Theme_id;

    public function __construct()
    {
        $this->Theme_id = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUserId(): User
    {
        return $this->User_id;
    }

    public function setUserId(User $User_id): static
    {
        $this->User_id = $User_id;

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getThemeId(): Collection
    {
        return $this->Theme_id;
    }

    public function addThemeId(Theme $themeId): static
    {
        if (!$this->Theme_id->contains($themeId)) {
            $this->Theme_id->add($themeId);
        }

        return $this;
    }

    public function removeThemeId(Theme $themeId): static
    {
        $this->Theme_id->removeElement($themeId);

        return $this;
    }
}
