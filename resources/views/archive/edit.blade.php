<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'archive</title>
</head>
<body>

    <h1>Modifier l'archive</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('archive.update', $archive->id_archive) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Num série:</label>
        <input type="number" name="num_serie" value="{{ old('num_serie', $archive->num_serie) }}"><br><br>

        <label>Description:</label>
        <input type="text" name="description" value="{{ old('description', $archive->description) }}"><br><br>

        

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('archive.index') }}">Retour à la liste</a>

</body>
</html>