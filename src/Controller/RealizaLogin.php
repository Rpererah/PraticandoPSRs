<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMensagemTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizaLogin implements RequestHandlerInterface
{
    use FlashMensagemTrait;

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repositoryUser;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositoryUser = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post=$request->getParsedBody();
        $email=filter_var($post['Email'],FILTER_VALIDATE_EMAIL);
        $resposta=new Response(302,['location'=>'listar-cursos']);

        if(is_null($email) || $email===false){
            $this->renderizaFlashMensagem('danger',"E-mail invalido");
            return $resposta;

        }
        $senha=filter_var($post['Senha'],FILTER_SANITIZE_STRING);
        /**
         * @var Usuario $usuario
         */
        $usuario=$this->repositoryUser->findOneBy(['email'=>$email]);
        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)){

            $this->renderizaFlashMensagem('danger',"Usuario ou senha incorreta");
            return $resposta;

        }
        $_SESSION['logado']=true;
        return new Response(302,['location'=>'listar-cursos']);

    }
}