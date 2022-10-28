<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>

            <div class="container">
                <div class="card-group my-5">
                    @foreach( $products as $product)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                        @if ($loop->iteration % 3 === 0)
                        </div>
                        <div class="card-group my-5">
                        @endif
                    @endforeach
                </div>

            </div>
    </body>
</html>
