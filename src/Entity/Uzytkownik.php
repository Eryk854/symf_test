<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class Uzytkownik implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nazwisko;

    /**
     * @ORM\OneToMany(targetEntity=Sylabus::class, mappedBy="koordynatorZajec")
     */
    private $koordynowaneSylabusy;

    /**
     * @ORM\ManyToMany(targetEntity=Sylabus::class, mappedBy="prowadzacyZajecia")
     */
    private $prowadzoneSylabusy;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $login;

    public function __construct()
    {
        $this->koordynowaneSylabusy = new ArrayCollection();
        $this->prowadzoneSylabusy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(?string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(?string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getKoordynowaneSylabusy(): Collection
    {
        return $this->koordynowaneSylabusy;
    }

    public function addKoordynowaneSylabusy(Sylabus $sylabus): self
    {
        if (!$this->koordynowaneSylabusy->contains($sylabus)) {
            $this->koordynowaneSylabusy[] = $sylabus;
            $sylabus->setKoordynatorZajec($this);
        }

        return $this;
    }

    public function removeKoordynowaneSylabusy(Sylabus $sylabus): self
    {
        if ($this->koordynowaneSylabusy->contains($sylabus)) {
            $this->koordynowaneSylabusy->removeElement($sylabus);
            // set the owning side to null (unless already changed)
            if ($sylabus->getKoordynatorZajec() === $this) {
                $sylabus->setKoordynatorZajec(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sylabus[]
     */
    public function getProwadzoneSylabusy(): Collection
    {
        return $this->prowadzoneSylabusy;
    }

    public function addProwadzoneSylabusy(Sylabus $prowadzoneSylabusy): self
    {
        if (!$this->prowadzoneSylabusy->contains($prowadzoneSylabusy)) {
            $this->prowadzoneSylabusy[] = $prowadzoneSylabusy;
            $prowadzoneSylabusy->addProwadzacyZajecium($this);
        }

        return $this;
    }

    public function removeProwadzoneSylabusy(Sylabus $prowadzoneSylabusy): self
    {
        if ($this->prowadzoneSylabusy->contains($prowadzoneSylabusy)) {
            $this->prowadzoneSylabusy->removeElement($prowadzoneSylabusy);
            $prowadzoneSylabusy->removeProwadzacyZajecium($this);
        }

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function __toString()
    {
        return $this->getImie().' '.$this->getNazwisko();
    }
}
