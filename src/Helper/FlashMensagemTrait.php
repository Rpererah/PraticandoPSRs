<?php


namespace Alura\Cursos\Helper;


trait FlashMensagemTrait
{
    public function renderizaFlashMensagem(string $tipo,string $mensagem):void
    {
        $_SESSION['tipo_mensagem']=$tipo;
        $_SESSION['mensagem']=$mensagem;
    }
}