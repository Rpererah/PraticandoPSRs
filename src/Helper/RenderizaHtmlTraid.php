<?php


namespace Alura\Cursos\Helper;


trait RenderizaHtmlTraid
{
    public function renderizaHtml(string $template,array $dados):string
    {
        extract($dados);
        ob_start();
        require __DIR__."./../../view/".$template;
        $html=ob_get_clean();
        return $html;
    }
}