<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\RechercheBiens;
use App\Form\ContactType;
use App\Form\RechercheBiensType;

use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Var PropertyRepository
     */
    
    private $repository ;

    public function __construct(PropertyRepository $repository)
    {
        
         $this->repository= $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(PaginatorInterface $paginator ,HttpFoundationRequest $request): Response
    {
        $recherche= new RechercheBiens();
        $form= $this->createForm(RechercheBiensType::class,$recherche);
        $form->handleRequest($request);
        $properties = $paginator->paginate(
            $this->repository->findAllVIsibleQuery($recherche),
        $request->query->getInt('page',1),
        12
        );
    
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'=>$properties ,
            'form' =>$form->createView()
        ]);
    }
    /** 
    * @Route("/biens/{slug}-{id}",name="property.show", requirements={"slug": "[a-z0-9\-]*"})
    */
    public function show(Property $property ,string $slug , Request $request,ContactNotification $notification):Response
    {

        if($property->getSlug()!==$slug)
        {
        return $this->redirectToRoute("property.show",[
            'id'=>$property->getId(),
            'slug'=>$property->getSlug()],301);
       }

       $contact=new Contact;
       $contact->setProperty($property);
       $form=$this->createForm(ContactType::class,$contact);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid() ){
        $notification->notify($contact);
        $this->addFlash("succes","votre message a ete envoye avec succe");

        return $this->redirectToRoute("property.show",[
            'id'=>$property->getId(),
            'slug'=>$property->getSlug()]);
 
       }

   
        return $this->render("property/show.html.twig",[
            "property"=>$property,
            'current_menu' => 'properties',
            'form'=>$form->createView()
           ]);
        
   }

}
