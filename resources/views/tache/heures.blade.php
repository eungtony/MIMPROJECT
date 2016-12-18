<table class="table">
    <thead>
    <tr>
        <th>Heure(s) notée(s)</th>
        <th>Description de la tâche</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mesheures as $heure)
        <form action="{{route('edit.hours', $heure->id)}}" method="POST">
            {{csrf_field()}}
            <tr>
                <td><input type="number" class="form-control" name="heures" value="{{$heure->heures}}"></td>
                <td><input type="text" class="form-control" name="description" value="{{$heure->description}}"></td>
                <td>
                    <button type="submit"
                            class="btn btn-primary btn-xs">
                        <i class="fa fa-pencil"></i>
                    </button>
        </form>
        <a href="{{action('tacheController@deleteHours', $heure->id)}}"
           data-method="delete"
           ata-confirm="Souhaitez-vous réellement supprimer cette heure ?"
           class="btn btn-danger btn-xs"><i
                    class="fa fa-trash-o "></i></a>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>