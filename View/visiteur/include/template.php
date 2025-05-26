<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="../../Public/css/visiteur.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title><?= $titre ; ?></title>
</head>
<body class="body m-0 p-0">
    <main class="min-vh-100">
    <header>
        <nav class="navbar navbar-expand-md bg-transparent  fixed-top px-3 ">
            <a href="#" class="navbar-brand collapse navbar-collapse col-lg-4 col-md-4 col-sm-1 col-1">
                <i class="bi bi-openai fs-4 text-light"></i>
            </a>
            <span class="navbar-text  col-lg-4 col-md-4 col-sm-10 col-10  text-start">
                    <form class="text-center"  role="search" id="recherche">
                            <div class="row  m-0 p-0  align-items-center">  <!-- justify-content-center align-items-center -->          
                                <div class=" col-1 text-end ">
                                    <i class="bi bi-search fs-5 text-secondary text-end"></i>
                                </div>
                                <div class=" col-lg-7 col-md-7 col-sm-9 col-9  ">
                                    <input class="form-control bg-transparent border border-0 text-start outline-0 " type="search" placeholder="Rechercher sur le Web" aria-label="Search"/>
                                </div>
                            </div>
                    </form>
            </span>
            <button class="navbar-toggler bg-light  col-sm-2 col-2" data-bs-toggle="collapse" data-bs-target="#navbar-content">
                <span class="navbar-toggler-icon "></span>
            </button>
             <nav class="collapse navbar-collapse col-lg-4 col-md-4 meteo  justify-content-center align-items-center " id="navbar-content">          
                <ul class="navbar-nav ">
                    <li class="nav-item"><a href="" class="nav-link active link-light disabled fs-5">Dakar</a> </li>
                    <li class="nav-item"><a href="" class="nav-link link-light disabled"><span class="fs-5 me-2">23</span>  <i class="bi bi-moon-fill text-warning fs-5"></i> <sup><i class="bi bi-cloud-lightning pe-2 text-secondary fs-6"></i></sup></a> </li>
                </ul>
            </nav>
          
            <nav class="collapse navbar-collapse col-lg-4 col-md-4   justify-content-center align-items-center " id="navbar-content">          
                <ul class="navbar-nav ">
                    <li class="nav-item"><a href="" class="nav-link active link-light">Accueil</a> </li>
                    <li class="nav-item"><a href="" class="nav-link link-light">Categories</a> </li>
                    <li class="nav-item"><a href="" class="nav-link link-light">Contact</a> </li>
                    <li class="nav-item"><a href="" class="nav-link link-secondary disabled">A propos</a> </li>
                </ul>
            </nav>
            
        </nav>
    </header>
    
    <div class="container "> 
         <?= $content ;?> 
        
    </div>
 </main>

   <footer>
    
   </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>