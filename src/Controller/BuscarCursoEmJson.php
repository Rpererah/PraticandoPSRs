<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BuscarCursoEmJson implements RequestHandlerInterface
{
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repositoryCursos;

    public function __construct(EntityManagerInterface $entityManager)
{
    $this->repositoryCursos=$entityManager->getRepository(Curso::class);
}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $cursos=$this->repositoryCursos->findAll();
        return new Response(200,[],json_encode($cursos));
    }
}