<?php
error_reporting(0);
$opts = [
    'http' => [
        'method' => 'GET',
        'header' => ['User-Agent: PHP']
    ]
];

$pagina  = $_POST['pagina'];

$linguagem  = $_POST['linguagem'];
if($linguagem ==""){
    $linguagem = 'PHP';
}
$context = stream_context_create($opts);
$content = json_decode(file_get_contents("https://api.github.com/search/repositories?q=language:".$linguagem."&sort=stars&page=$pagina", false, $context));

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP language</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <style>
    .card-consultar {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
    }
    </style>



</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">
            <img src="Octocat.png" width="30" height="30" class="d-inline-block align-top" alt="">
            App language
        </a>
        <ul class="navbar-nav">
            <ul class="nav-item">
                <a href="https://github.com/joelsonRamos" class="nav-link">Joelson Ferreira</a>
            </ul>
        </ul>
    </nav>

    <div class="container">
        <div class="mt-5 ">
            <h4 class="text-center">
                Conheça os repositorios mais conhecidos de sua linguagem favorita
            </h4>

            <form method='POST'>
                <select name="linguagem" class="form-control form-control-lg">
                    <option value=""></option>
                    <option value="Kotlin">Kotlin</option>
                    <option value="Java">Java</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="TypeScript">TypeScript</option>
                    <option value="Go">Go</option>
                    <option value="PHP">PHP</option>
                    <option value="Swift">Swift</option>
                    <option value="Swift">C#</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
            </form>

        </div>

        <div class="row">


            <div class="card-consultar">
                <div class="card">
                    <div class="card-header">
                        The most starred repositories of a language in github
                    </div>


                    <div class="row">

                        <?php foreach($content->items as $item ){?>
                        <div class="col-sm-3 ">
                            <div class="card-body">
                                <div class="card bg-light">
                                    <img class="card-img-top" src="<?=$item->owner->avatar_url ; ?>"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title">Repositorio: <?=$item->full_name; ?></h4>
                                        <div class="row mt-5">
                                            <div class="col-sm-6">
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    <svg class="octicon octicon-star mr-1" height="16"
                                                        viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z">
                                                        </path>
                                                    </svg>
                                                    <?=$item->stargazers_count; ?>
                                                </h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    <svg class="octicon octicon-repo-forked mr-1" height="16"
                                                        viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M5 3.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm0 2.122a2.25 2.25 0 10-1.5 0v.878A2.25 2.25 0 005.75 8.5h1.5v2.128a2.251 2.251 0 101.5 0V8.5h1.5a2.25 2.25 0 002.25-2.25v-.878a2.25 2.25 0 10-1.5 0v.878a.75.75 0 01-.75.75h-4.5A.75.75 0 015 6.25v-.878zm3.75 7.378a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm3-8.75a.75.75 0 100-1.5.75.75 0 000 1.5z">
                                                        </path>
                                                    </svg>

                                                    <?=$item->forks; ?>
                                                </h6>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                            </div>
                        </div>

                        <?php }?>

                    </div>

                </div>

            </div>


            <form method="post">
            <p>
                <select name="pagina">
                    <?php for ($i=1; $i <= 34; $i++) { ?>

                    <option value="<?=$i?>"><?=$i?></option>

                    <?php }?>
                
                </select>
                <input type="submit" value="ir" />
            </p>
        </form>


        </div>
    </div>
    </div>

<!-- jquery -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>