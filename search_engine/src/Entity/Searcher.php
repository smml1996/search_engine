<?php

namespace App\Entity;

use App\Repository\SearcherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearcherRepository::class)
 */
class Searcher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Words::class, inversedBy="searchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $word;

    /**
     * @ORM\ManyToOne(targetEntity=Webpage::class, inversedBy="searchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $webpage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $occurences;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?Words
    {
        return $this->word;
    }

    public function setWord(?Words $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getWebpage(): ?Webpage
    {
        return $this->webpage;
    }

    public function setWebpage(?Webpage $webpage): self
    {
        $this->webpage = $webpage;

        return $this;
    }

    public function getOccurences(): ?int
    {
        return $this->occurences;
    }

    public function setOccurences(?int $occurences): self
    {
        $this->occurences = $occurences;

        return $this;
    }
}
