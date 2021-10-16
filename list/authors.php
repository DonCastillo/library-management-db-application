<?php

    include '../config.php';
    include '../head.php';
    include '../footer.php';

    $head = new Head();
    $head->setTitle('Home');
    $head->addStyle('../css/styles.css');
    $head->drawHead();
    $head->drawMenu();
   
    echo '
    
    <div class="right p-5">
        <div style="width: 100%;background: white;min-height: 550px;border-radius: 8px; padding: 20px">
            <h1>Home</h1>
            <hr>
        </div>
    </div>
    
    ';

    $footer = new Footer();
    $footer->addScript('../js/site.js');
    $footer->drawFooter();
?>