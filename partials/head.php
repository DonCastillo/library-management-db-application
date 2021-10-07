<?php
    function Head($pageTitle)
    {
        echo 
        '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" 
                      rel="stylesheet" 
                      integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" 
                      crossorigin="anonymous"
                >

                <link rel="stylesheet" 
                      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/fontawesome.min.css"
                      integrity="sha512-Rcr1oG0XvqZI1yv1HIg9LgZVDEhf2AHjv+9AuD1JXWGLzlkoKDVvE925qySLcEywpMAYA/rkg296MkvqBF07Yw==" 
                      crossorigin="anonymous" 
                      referrerpolicy="no-referrer"
                >

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&family=Source+Sans+Pro:wght@300;700&display=swap" rel="stylesheet"> 

                <link rel="stylesheet" href="css/styles.css">

                <title>'.$pageTitle.'</title>
            </head>
            <body>
        ';
    }
?>