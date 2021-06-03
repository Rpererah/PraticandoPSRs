<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizaHtmlTraid;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Alterar implements RequestHandlerInterface
{
    use RenderizaHtmlTraid;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
{

    $this->entityManager = $entityManager;
    $thisrepositoryCursos=$entityManager->getRepository(Curso::class);
}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $get=$request->getQueryParams();
        $id=filter_var($get['id'],FILTER_VALIDATE_INT);
        $resposta=new Response(302,['location'=>'listar-cursos']);
        if(is_null($id) || $id===false){
            return $resposta;
        }
        $curso=$this->repositoryCursos->find($id);
        $tituloPagina="Altera curso ";
        $html=$this->renderizaHtml('cursos/inserir-curso.php',['titulo'=>$tituloPagina,'curso'=>$curso]);
        return new Response(200,[],$html);

    }
}