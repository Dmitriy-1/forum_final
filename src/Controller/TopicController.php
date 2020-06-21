<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Topic;
use App\Form\TopicType;
use App\Form\CommentsType;
use App\Repository\TopicRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/topic")
 */
class TopicController extends AbstractController
{
    /**
     * @Route("/", name="topic_index", methods={"GET"})
     */
    public function index(TopicRepository $topicRepository): Response
    {
        return $this->render('topic/index.html.twig', [
            'topics' => $topicRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="topic_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $topic = new Topic();
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $topic->setDateCreateTopic(new \DateTime("now"));
            $topic->setUserTopic($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirectToRoute('topic_index');
        }

        return $this->render('topic/new.html.twig', [
            'topic' => $topic,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="topic_show", methods={"GET","POST"})
     */
    public function show(Topic $topic, Request $request): Response
    {
        $comments = new Comments();
        $form = $this->createForm(CommentsType::class, $comments);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comments->setUserComment($this->getUser());
            $comments->setTicketComment($topic);
            $comments->setDateComment(new \DateTime("now"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comments);
            $entityManager->flush();
            return $this->redirectToRoute('topic_show', ['id' => $topic->getId()
                ]);

        }
        return $this->render('topic/show.html.twig', [
            'topic' => $topic,
            'comments' => $comments,

            'form' => $form->createView(),
        ]);
    }
}
