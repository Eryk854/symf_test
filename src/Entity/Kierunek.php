                                                                                                                                                                                                                                                                                                                                        <?php

namespace App\Entity;

use App\Repository\KierunekRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KierunekRepository::class)
 */
class Kierunek
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $informacje;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="kierunek")
     * @ORM\JoinColumn(nullable=false)
     */
    private $program;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInformacje(): ?string
    {
        return $this->informacje;
    }

    public function setInformacje(string $informacje): self
    {
        $this->informacje = $informacje;

        return $this;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

        return $this;
    }
}
