<?php

use Alura\Cursos\Controller\Alterar;
use Alura\Cursos\Controller\BuscarCursoEmJson;
use Alura\Cursos\Controller\BuscarCursosEmXml;
use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\Exclusao;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Login;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\RealizaLogin;

return [
   '/inserir-curso'=> FormularioInsercao::class,
    '/listar-cursos' => ListarCursos::class,
    "/salvar-curso" => Persistencia::class,
    "/excluir-curso"=> Exclusao::class,
    "/altera-curso" => Alterar::class,
    "/login"        => Login::class,
    "/realizaLogin"=>RealizaLogin::class,
    "/deslogar"=> Deslogar::class,
    "/json"=>BuscarCursoEmJson::class,
    "/xml"=> BuscarCursosEmXml::class
 ];