<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostType;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route ("/form",name="app_form")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){

        $post = new Posts();
        $post->setTitle('');
        $post->setBody('');
        $post->setUserID($this->getUser());
        $post->setDateTime(new DateTimeImmutable());
        $form = $this->createForm(PostType::class,$post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('app_form');
        }
        return $this->render('title/index.html.twig',[
            'title_form' => $form->createView()
        ]);

    }


    /**
     * @Route ("/titles/{slug}",name="all_titles")
     * @param $slug
     * @return Response
     */
    public function allTitles($slug){
        $data = $this->getDoctrine()->getRepository(Posts::class)->findAll();
        return $this->render('allTitles/titles.html.twig',[
            'titles' => ucwords(str_replace('%20','-',$slug)),
            'Data' => $data,
        ]);
    }


    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response(array $data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

}
