<html>
    <head>
        <title> {{ $title_select }} </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <h1> Volcanion 統計儀表板 </h1>
        <h2> {{ $title_select }} </h2>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">Flood Fire</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if ( $title_select  === 'all')
                        <a class="nav-item nav-link active" href="#">All<span class="sr-only">(current)</span></a>
                    @else
                        <a class="nav-item nav-link" href="http://140.119.164.228/Overall">All</a>
                    @endif 
                    
                    @if ( $title_select === 'Ptt')
                        <a class="nav-item nav-link active" href="#">Ptt<span class="sr-only">(current)</span></a>
                    @else
                        <a class="nav-item nav-link" href="http://140.119.164.228/Ptt">Ptt</a>
                    @endif

                    @if ( $title_select  === 'Twitter')
                        <a class="nav-item nav-link active" href="#">Twitter<span class="sr-only">(current)</span></a>
                    @else
                        <a class="nav-item nav-link" href="http://140.119.164.228/Twitter">Twitter</a>
                    @endif

                    @if ($title_select  === 'News')
                        <a class="nav-item nav-link active" href="#">News <span class="sr-only">(current)</span></a>
                    @else
                        <a class="nav-item nav-link" href="http://140.119.164.228/News">News</a>
                    @endif

                    <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Facebook</a>
                </div>
            </div>
        </nav>

    </head>
</html>
