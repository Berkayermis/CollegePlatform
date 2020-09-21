<?php

namespace App\Controller;

use App\Entity\Title;
use App\Form\TitleType;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TitleController extends AbstractController
{
    /**
     * @Route ("/form",name="app_form")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){

        $title = new Title();
        $title->setTitle('');
        $title->setBody('');
        $title->setUserID($this->getUser());
        $title->setDateTime(new DateTimeImmutable());
        $form = $this->createForm(TitleType::class,$title);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $title = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($title);
            $entityManager->flush();
            return $this->redirectToRoute('app_form');
        }
        return $this->render('title/index.html.twig',[
            'title_form' => $form->createView(),
            'titleOfForm' => $title->getTitle()
        ]);

    }



    /**
     * @Route ("/titles/{id}",name="all_titles",methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function getTitles($id){
        $data = $this->getDoctrine()->getRepository(Title::class);
        return $this->response((array)$data->find($id)->getTitle());
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
