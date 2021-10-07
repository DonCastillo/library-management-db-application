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

                <link rel="stylesheet" 
                      href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
                      integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
                      crossorigin="anonymous"
                >

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&family=Source+Sans+Pro:wght@300;700&display=swap" rel="stylesheet"> 

                <link rel="stylesheet" href="css/styles.css">

                <title>'.$pageTitle.'</title>
            </head>
            <body>
            <div class="body-wrapper d-flex">
            <div class="left menu p-3">
                <ul>
                    <li>
                        <a href="">
                            <i class="fas fa-bookmark"></i>    
                            <div>Add an author</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fas fa-book"></i>
                            <div>Add a book</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fas fa-user"></i>
                            <div>Register a borrower</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fas fa-file-export"></i>    
                            <div>Rent a book</div>
                        </a>
                    </li>
                </ul>

                <ul>
                    <li>
                        <a href="">
                            <i class="far fa-list-alt"></i>    
                            <div>List all authors</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="far fa-list-alt"></i>    
                            <div>List all books</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="far fa-list-alt"></i>    
                            <div>List all borrowers</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="far fa-list-alt"></i>    
                            <div>List of unreturned books</div>
                        </a>
                    </li>
                </ul>
            </div>
            
        ';
    }
?>