<?php

namespace App\Entity;

use App\Repository\WebpageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebpageRepository::class)
 */
class Webpage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=700)
     */
    private $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="float")
     */
    private $pagerank;

    /**
     * @ORM\OneToMany(targetEntity=Searcher::class, mappedBy="webpage", orphanRemoval=true)
     */
    private $searchers;

    /**
     * @ORM\Column(type="integer")
     */
    private $realindex;

    public function __construct()
    {
        $this->searchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPagerank(): ?float
    {
        return $this->pagerank;
    }

    public function setPagerank(float $pagerank): self
    {
        $this->pagerank = $pagerank;

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
            $searcher->setWebpage($this);
        }

        return $this;
    }

    public function removeSearcher(Searcher $searcher): self
    {
        if ($this->searchers->contains($searcher)) {
            $this->searchers->removeElement($searcher);
            // set the owning side to null (unless already changed)
            if ($searcher->getWebpage() === $this) {
                $searcher->setWebpage(null);
            }
        }

        return $this;
    }

    public function getRealindex(): ?int
    {
        return $this->realindex;
    }

    public function setRealindex(int $realindex): self
    {
        $this->realindex = $realindex;

        return $this;
    }
}
