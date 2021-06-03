<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Helper\RenderizaHtmlTraid;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Login implements RequestHandlerInterface
{
    use RenderizaHtmlTraid;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $tituloPagina='Login';
        $html=$this->renderizaHtml("login/formulario.php",['titulo'=>$tituloPagina]);
        return new Response(200,[],$html);
    }
}