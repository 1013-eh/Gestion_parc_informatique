<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une archive</title>
</head>
<body>

    <h1>Ajouter une archive</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('archive.store') }}" method="POST">
        @csrf

        <label>Num série (format: SN00000329):</label>
        <input type="text" name="num_serie" value="{{ old('num_serie') }}" placeholder="SN00000329"><br><br>

        <label>Description:</label>
        <input type="text" name="description" value="{{ old('description') }}"><br><br>

        
        <button type="submit">Ajouter</button>
    </form>

    <a href="{{ route('archive.index') }}">Retour à la liste</a>

</body>
</html>