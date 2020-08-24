<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserManagementController extends AbstractController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var PaginatorInterface
     */
    protected $paginator;

    /**
     * @param UserRepository     $userRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(UserRepository $userRepository, PaginatorInterface $paginator)
    {
        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/user/list", name="app_userlist")
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $userList = $this->userRepository->getList();
        $pagination = $this->paginator->paginate(
            $userList,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('security/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/user/toggle/{username}", name="app_toggleuser")
     * @param string $username
     * @return Response
     * @throws \Exception
     * @throws NotFoundHttpException
     */
    public function toggleUserAction(string $username): Response
    {
        if ($this->getUser() && $username == $this->getUser()->getUsername()) {
            throw new \Exception('Cannot disable yourself', 401);
        }

        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            throw new NotFoundHttpException();
        }

        $isDisabled = false;
        if (isset($user['disabled']) && $user['disabled']) {
            $isDisabled = true;
        }

        $this->userRepository->setUserDisabled($username, !$isDisabled);

        return $this->redirectToRoute('app_userlist');
    }
}
