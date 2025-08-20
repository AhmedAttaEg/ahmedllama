<!DOCTYPE html>
<html>
<head>
    <title>PDF List</title>
</head>
<body>
    

     <h1>Google Drive Connection</h1>
    <p>{{ $status }}</p>
    <p>Total files in this Drive folder: <strong>{{ $fileCount }}</strong></p>
    @if(count($fileNames))
        <ul>
            @foreach($fileNames as $name)
                <li>{{ $name }}</li>
            @endforeach
        </ul>
    @else
        <p>No PDF files found.</p>
    @endif


</body>
</html>
