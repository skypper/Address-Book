<?php

include 'inc/template_helpers.php';

class Template {

    private $header;
    private $menu;
    private $content;
    private $footer;

    public function render() {
        print $this->header;
        print $this->menu;
        print $this->content;
        print $this->footer;
    }

    public static function getContext() {
        return substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], 'index.php'));
    }

    public function prepareHeader($module) {
        $context = Template::getContext();
        ob_start();
        require 'views/template/header.php';
        $this->header = ob_get_clean();
    }

    public function prepareMenu() {
        ob_start();
        require 'views/template/menu.php';
        $this->menu = ob_get_clean();
    }

    public function prepareContent($templateName, array $dataModel) {
        ob_start();
        extract($dataModel);
        require 'views/' . $templateName . '.php';
        $this->content = ob_get_clean();
    }

    public function prepareFooter() {
        ob_start();
        require 'views/template/footer.php';
        $this->footer = ob_get_clean();
    }

}

?>
