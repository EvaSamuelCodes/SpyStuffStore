<?php


//The file is exactly what it seems to be.
//We'll bootstrap the app to make sure we have all the parts we need to run it.
//Assemble the class and traits list.
$app_files = [];
$classes = scandir(FILE_ROOT . '/app/classes');
$traits = scandir(FILE_ROOT . '/app/traits');
$models = scandir(FILE_ROOT . '/app/models');
$misc = scandir(FILE_ROOT . '/app/pasted');

foreach ($misc as $key => $etc) {
    if (strlen($etc) > 4) {
        $app_files[] = FILE_ROOT . '/app/pasted/' . $etc;
    }
}

foreach ($traits as $key => $trait) {
    if (strlen($trait) > 4) {
        $app_files[] = FILE_ROOT . '/app/traits/' . $trait;
    }
}
foreach ($models as $key => $model) {
    if (strlen($model) > 4) {
        $app_files[] = FILE_ROOT . '/app/models/' . $model;
    }
}

foreach ($classes as $key => $class) {
    if (strlen($class) > 4) {
        $app_files[] = FILE_ROOT . '/app/classes/' . $class;
    }
}



//Include them all!

foreach ($app_files as $include_me) {
    if (file_exists($include_me)) //just to make sure
    //print $include_me . "<br/>\n";
        require_once($include_me);
}

//Start the session

session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        'hash' => session_id(),
        'items' => []
    ];
    $_SESSION['total_items'] = 0; //less math if it's a static number.
} 