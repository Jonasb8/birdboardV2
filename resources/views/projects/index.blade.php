<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>Birdboard</h1>
            <ul>
                @foreach ($projects as $project)
                    <li>{{ $project->title }}</li>    
                @endforeach
            </ul>
    </body>
</html>
