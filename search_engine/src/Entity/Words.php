<?php

namespace App\Entity;

use App\Repository\WordsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WordsRepository::class)
 */
class Words
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $word;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frequency;

    /**
     * @ORM\OneToMany(targetEntity=Searcher::class, mappedBy="word", orphanRemoval=true)
     */
    private $searchers;

    public function __construct()
    {
        $this->searchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setFrequency(?int $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * @return Collection|Searcher[]
     */
    public function getSearchers(): Collection
    {
        return $this->searchers;
    }

    public function addSearcher(Searcher $searcher): self
    {
        if (!$this->searchers->contains($searcher)) {
            $this->searchers[] = $searcher;
            $searcher->setWord($this);
        }

        return $this;
    }

    public function removeSearcher(Searcher $searcher): self
    {
        if ($this->searchers->contains($searcher)) {
            $this->searchers->removeElement($searcher);
            // set the owning side to null (unless already changed)
            if ($searcher->getWord() === $this) {
                $searcher->setWord(null);
            }
        }

        return $this;
    }
}
