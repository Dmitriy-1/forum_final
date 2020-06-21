<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text_comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_comment;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_comment;

    /**
     * @ORM\ManyToOne(targetEntity=topic::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticket_comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextComment(): ?string
    {
        return $this->text_comment;
    }

    public function setTextComment(string $text_comment): self
    {
        $this->text_comment = $text_comment;

        return $this;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->date_comment;
    }

    public function setDateComment(\DateTimeInterface $date_comment): self
    {
        $this->date_comment = $date_comment;

        return $this;
    }

    public function getUserComment(): ?user
    {
        return $this->user_comment;
    }

    public function setUserComment(?user $user_comment): self
    {
        $this->user_comment = $user_comment;

        return $this;
    }

    public function getTicketComment(): ?topic
    {
        return $this->ticket_comment;
    }

    public function setTicketComment(?topic $ticket_comment): self
    {
        $this->ticket_comment = $ticket_comment;

        return $this;
    }
    public function __toString()

    {
        return strval($this->user_comment->getUsername());

    }
}
