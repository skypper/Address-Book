<?php

/**
 * 
 * @param string $action
 * @return string
 */
function url_to($action) {
    return Template::getContext() . 'index.php' . $action;
}

/**
 * 
 * @param string $module
 * @param string $template
 * @param array $dataModel
 */
function render($module, $templateName, $dataModel = array()) {
    $template = new Template();
    $template->prepareHeader($module);
    $template->prepareMenu();
    $template->prepareContent($templateName, $dataModel);
    $template->prepareFooter();
    $template->render();
}

?>
