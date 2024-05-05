<!-- resources/views/outou.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body data-theme="light" class="py-4">
    <div class="mx-[6em]">
        <a href="/places" class="btn btn-sm bg-green-400">Kembali</a>
        <h1 class="text-center font-bold text-3xl mb-4">Hasil Pencarian</h1>
        @foreach ($searchResult as $result)
            <ul class="mb-4 card card-body shadow-xl border-2">
                <img src="" alt="">
                <li class="font-bold card-title">{{ $result['nama'] }}</li>
                <li>{{ $result['deskripsi'] }}</li>
            </ul>
        @endforeach
    </div>
</body>

</html>