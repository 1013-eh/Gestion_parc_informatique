<!DOCTYPE html>
<html>
<head>
    <title>Liste des archives</title>
</head>
<body>

    <h1>Liste des archives</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <a href="{{ route('archive.create') }}">Ajouter une archive</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Num série</th>
            <th>Description</th>
            <th>Date archivage</th>
            <th>Action</th>
        </tr>

        @foreach($archives as $archive)
        <tr>
            <td>{{ $archive->id_archive }}</td>
            <td>{{ $archive->num_serie }}</td>
            <td>{{ $archive->description }}</td>
            <td>{{ $archive->date_archivage }}</td>
            <td>
                <a href="{{ route('archive.edit', $archive->id_archive) }}">Modifier</a>

                <form action="{{ route('archive.destroy', $archive->id_archive) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer cette archive ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>