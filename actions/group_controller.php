<?php

class GroupController {
    
    public static function manageAction() {
        
        render('Group List', 'group_mgmt');
    }
    
    public static function connectAction() {
        
        header('Location: ' . url_to('/group/manage'));
    }
    
}

?>
