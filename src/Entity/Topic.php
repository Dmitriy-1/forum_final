<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopicRepository::class)
 */
class Topic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title_topic;

    /**
     * @ORM\Column(type="text")
     */
    private $text_topic;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_create_topic;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $section_topic;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="topics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_topic;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="ticket_comment", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleTopic(): ?string
    {
        return $this->title_topic;
    }

    public function setTitleTopic(string $title_topic): self
    {
        $this->title_topic = $title_topic;

        return $this;
    }

    public function getTextTopic(): ?string
    {
        return $this->text_topic;
    }

    public function setTextTopic(string $text_topic): self
    {
        $this->text_topic = $text_topic;

        return $this;
    }

    public function getDateCreateTopic(): ?\DateTimeInterface
    {
        return $this->date_create_topic;
    }

    public function setDateCreateTopic(\DateTimeInterface $date_create_topic): self
    {
        $this->date_create_topic = $date_create_topic;

        return $this;
    }

    public function getSectionTopic(): ?string
    {
        return $this->section_topic;
    }

    public function setSectionTopic(string $section_topic): self
    {
        $this->section_topic = $section_topic;

        return $this;
    }

    public function getUserTopic(): ?user
    {
        return $this->user_topic;
    }

    public function setUserTopic(?user $user_topic): self
    {
        $this->user_topic = $user_topic;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTicketComment($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTicketComment() === $this) {
                $comment->setTicketComment(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->title_topic);
    }
}
