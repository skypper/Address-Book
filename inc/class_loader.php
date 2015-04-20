<?php

spl_autoload_register(function($class_name) {
    if ($class_name === 'DBConnection') {
        $path = 'model/services/base/db_conn.php';
        if (file_exists($path)) {
            require $path;
            return;
        }
    }

    $locations = array(
        'actions/%s.php',
        'model/entities/%s.class.php',
        'model/dao/%s.php',
        'model/forms/%s.php',
        'model/forms/validators/%s.php',
        'model/services/%s.php',
        'model/forms/base/%s.php',
        'model/forms/validators/base/%s.php',
    );
    $file_name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $class_name));
    foreach ($locations as $location) {
        $path = sprintf($location, $file_name);
        if (file_exists($path)) {
            include $path;
            return;
        }
    }
    // TODO Display errors
    print 'Class ' . $class_name . ' not found!';
});
?>
