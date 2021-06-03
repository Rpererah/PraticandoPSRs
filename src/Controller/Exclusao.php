<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMensagemTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
{
    use FlashMensagemTrait;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
{

    $this->entityManager = $entityManager;
}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $get=$request->getQueryParams();
        $id=filter_var($get['id'],FILTER_VALIDATE_INT);
        $resposta=new Response(302,['location'=>'listar-cursos']);
        if(is_null($id) || $id===false){
            $this->renderizaFlashMensagem('danger','Curso inexistente');
            return $resposta;
        }
        $curso=$this->entityManager->getReference(Curso::class,$id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->renderizaFlashMensagem('success','Curso excluido com sucesso');
        return $resposta;
    }
}