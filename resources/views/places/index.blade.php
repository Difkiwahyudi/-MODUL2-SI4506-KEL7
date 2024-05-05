<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tempat Wisata</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Daftar Tempat Wisata di Indonesia</h1>
        @include('search')

        @if (session('search_history'))
            <div class="mt-4">
                <h2>History Pencarian</h2>
                <ul>
                    @foreach (session('search_history') as $history)
                        <div>
                            <form action="{{ route('remove.history') }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm  ml-2">  {{ $history }}
                                    <input type="hidden" name="history" value="{{ $history }}"></button>
                            </form>
                        </div>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>
</body>


</html>