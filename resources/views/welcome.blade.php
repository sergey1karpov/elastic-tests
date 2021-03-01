<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
  
        <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET"> @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </nav>
        <div class="container">
            <div class="row row justify-content-center">
                <div class="col-8 m-2">
                    <div class="card m-2" style="border: none">
                        <form action="{{ route('create') }}" method="POST" class="mb-4"> @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="title">                      
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="description" placeholder="description">                      
                            </div>
                            <input class="btn btn-sm btn-success" type="submit" value="Send">
                        </form>
                    </div>    
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    @foreach($posts as $post)
                    <div class="card m-2">
                        <div class="card-header">
                            {{$post->title}}
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{$post->description}}</p>
                            </blockquote>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-3 mt-2">
                    {{$posts->links()}} 
                </div>
            </div>    
        </div>
    </body>
</html>
