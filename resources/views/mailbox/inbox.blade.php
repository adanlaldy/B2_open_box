<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Boîte de réception - Open Box</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<main style="height: 100vh;">
<!--sidebar-->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary h-100" style="width: 280px; float: left;">
    <nav>
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none" href="/inbox">Open Box {{ Auth::user()->email }}</a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a class="nav-link active" href="/inbox">Boîte de réception</a></li>
            <li><a class="nav-link link-body-emphasis" href="/draft">Brouillons</a></li>
            <li><a class="nav-link link-body-emphasis" href="/sent">Messages envoyés</a></li>
            <li><a class="nav-link link-body-emphasis" href="/starred">Favoris</a></li>
            <li><a class="nav-link link-body-emphasis" href="/archive">Archives</a></li>
            <li><a class="nav-link link-body-emphasis" href="/spam">Spams</a></li>
            <li><a class="nav-link link-body-emphasis" href="/trash">Corbeille</a></li>
            <li><a class="nav-link link-body-emphasis"  href="/all_mail">Tous les messages</a></li>
        </ul>
    </nav>
</div>
<!--header-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <form class="form-inline my-2 my-lg-0">
            <div class="input-group">
                <div class="search-bar">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
        </form>
        <div class="navbar-nav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/offers">Changer d'abonnement</a></li>
                <li class="nav-item"><a class="nav-link" href="/parameters">Paramètres</a></li>
                <li class="nav-item"><a class="nav-link" href="/account">Paramètres du compte</a></li>
            </ul>
            <form action="{{route('auth.logout')}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>
<!--title of content / actions-->
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-lg-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all">
                <label class="form-check-label" for="select-all">Sélectionner tout</label>
            </div>
        </div>
        <div class="col-lg-6">
            <h1 class="h3 text-black">Boîte de réception</h1>
        </div>
        <div class="col-lg-4 d-flex justify-content-end">
            <button class="btn btn-primary d-inline-flex align-items-center">Tous les messages</button>
            <button class="btn btn-outline-secondary d-inline-flex align-items-center">Lus</button>
            <button class="btn btn-outline-secondary d-inline-flex align-items-center">Non lus</button>
            <button class="btn btn-outline-secondary d-inline-flex align-items-center">Avec pièces jointes</button>
            <button class="btn btn-outline-secondary d-inline-flex align-items-center">Trier</button>
        </div>
    </div>
    <hr>
</div>
<!--content-->
<article>
    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="email1">
                <label class="form-check-label" for="email1">
                    Email 1
                </label>
            </div>
        </div>
        <div class="col">John Doe</div>
        <div class="col">Meeting Reminder</div>
        <div class="col">2024-04-28</div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary">Favoris</button>
            <button type="button" class="btn btn-outline-info">Archiver</button>
            <button type="button" class="btn btn-outline-danger">Supprimer</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="email2">
                <label class="form-check-label" for="email2">
                    Email 2
                </label>
            </div>
        </div>
        <div class="col">Jane Smith</div>
        <div class="col">Project Update</div>
        <div class="col">2024-04-27</div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary">Favoris</button>
            <button type="button" class="btn btn-outline-info">Archiver</button>
            <button type="button" class="btn btn-outline-danger">Supprimer</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="email3">
                <label class="form-check-label" for="email3">
                    Email 3
                </label>
            </div>
        </div>
        <div class="col">Alice Johnson</div>
        <div class="col">Weekly Newsletter</div>
        <div class="col">2024-04-26</div>
        <div class="col">
            <button type="button" class="btn btn-outline-primary">Favoris</button>
            <button type="button" class="btn btn-outline-info">Archiver</button>
            <button type="button" class="btn btn-outline-danger">Supprimer</button>
        </div>
    </div>
    <hr>
</article>


<button class="btn btn-primary mt-3">Nouveau message</button></main>
</body>
</html>
