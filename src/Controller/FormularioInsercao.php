<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Helper\RenderizaHtmlTraid;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioInsercao implements RequestHandlerInterface
{
    use RenderizaHtmlTraid;

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
        $html=$this->renderizaHtml('cursos/inserir-curso.php',['titulo'=>'inserir curso']);
        return new Response(200,[],$html);
    }
}