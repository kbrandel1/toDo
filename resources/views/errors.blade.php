@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong> Whoops! Something went wrong!</strong>


        <br><br>

        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
                @endforeach

        </ul>
    </div>
@endif
