<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMensagemTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMensagemTrait;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ObjectRepository
     */
    private $repository;


    public function __construct(EntityManagerInterface $entityManager)
{

    $this->entityManager = $entityManager;
    $this->repository=$entityManager->getRepository(Curso::class);

}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post=$request->getParsedBody();
        $descricao=filter_var($post['descricao'],FILTER_SANITIZE_STRING);

        $curso=new Curso();
        $curso->setDescricao($descricao);

        $get=$request->getQueryParams();
        $id=filter_var($get['id'],FILTER_VALIDATE_INT);

        $tipo='success';
        if(!is_null($id) && $id!==false)
        {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->renderizaFlashMensagem($tipo,'Curso atualizado com sucesso');
        }else{
            $this->entityManager->persist(($curso));
            $this->renderizaFlashMensagem($tipo,'Curso inserido com sucesso');
        }
        $this->entityManager->flush();
        return new Response(302,['location'=>'listar-cursos']);;

    }
}