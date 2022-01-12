<html>
    <head>
        <title>CV</title>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <p>{{$date}}</p>

        <h3>
            Name:
        </h3>
        <p>
            {{$name}} {{$lastName}}
        </p>
        <br>
        <h3>
            Localization:
        </h3>
        <p>
            Area of Residence is "{{$localization_main}}".
        </p>
        <br>
        <h3>
            Position:
        </h3>
        <p>
            {{$years}} years of experience in the field "{{$position_main}}" as "{{$position_sec}}".
        </p>
        <br>
    </body>
</html>