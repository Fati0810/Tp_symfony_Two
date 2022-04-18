<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user_list")
     */
    public function adminUserList(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render("admin/user_list.html.twig", ['users' => $users]);
    }

    /**
     * @Route("/admin/user/{id}", name="admin_user_show")
     */
    public function adminUserShow($id, UserRepository $userRepository){
        $user = $userRepository->find($id);

        return $this->render("admin/user_show.html.twig", ['user' => $user]);
    }


    /**
     * @Route("/{id}/update", name="admin_update_user")
     */
    public function adminUserUpdate(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $userPasswordHasherInterface
    ) {
        $user = $userRepository->find($id);

        $userForm = $this->createForm(UserFormType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $user->setRoles(["ROLE_USER"]);
            $plainPassword = $userForm->get('password')->getData();
            $hashedPassword = $userPasswordHasherInterface->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user_form.html.twig', ['userForm' => $userForm->createView()]);
    }




    /**
     * @Route("/delete/{id}", name="admin_delete_user")
     */
    public function adminDeleteUse($id, EntityManagerInterface $entityManagerInterface, UserRepository $userRepository)
    {
        $user = userRpository->find($id);

        $entityManagerInterface->remove($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('admin_user_list');
    }
}
