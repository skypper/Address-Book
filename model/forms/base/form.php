<?php
interface Form {
    const ADD_OPERATION = 0;
    const EDIT_OPERATION = 1;
    
    public function getSubmitted();
    public function setSubmitted($submitted);
    public function getOperation();
    public function setOperation($operation);
}
?>
