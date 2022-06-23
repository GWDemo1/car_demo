<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Customer;
use App\Repository\CarRepository;
use App\Repository\CustomerRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends Controller
{
    /**
     * @Route("/car",name="car_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository(Car::class)->findAll();

        return $this->render('car/index.html.twig', array(
            'cars' => $cars,
        ));
    }

  /**
   * Finds and displays a car entity.
   *
   * @Route("/car/{id}", name="car_show")
   */
  public function showAction(Car $car)
  {
    return $this->render('car/show.html.twig', array(
      'car' => $car,
    ));
  }


    /**
   * @Route("/customers/all/ascending", name="ascsending")
   */
  public function OrderedAsc(CustomerRepository $repo): Response
  {
        $customer = $repo->findAllAsc();
        return $this->json($customer);
  }

  
  /**
   * @Route("/customers/all/descending", name="decsending")
   */
  public function OrderedDesc(CustomerRepository $repo): Response
  {
        $customer = $repo->findAllDesc();
        return $this->json($customer);
  }


  /**
   * @Route("/cars/BMW", name="MakeCar")
   */
  public function makeFunction(CarRepository $repo): Response
  {
        $car = $repo->Carform();
        return $this->json($car);
  }





  //EDIT CUSTOMER
    /**
     * @Route("/edit/customer/{id}", name="editcustomer")
     */
    public function editCustomer(Request $req, ManagerRegistry $res, CustomerRepository $repo, int $id): Response
    {
        $customer = $repo->find($id); //animal by id
        $form = $this->createForm(AnimalType::class, $customer);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $customer->getName($data->getName());
            $customer->getBirthDate($data->getBirthday());

            $entity->persist($customer);
            $entity->flush();
            return $this->json(['id'=> $customer->getID()]);
        }
        return $this->render("car/index.html.twig",[
            'form'=>$form->createView()
        ]);  
    }

}
