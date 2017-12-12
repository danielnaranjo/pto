<table class="table">
    <!--begin::Thead-->
    <thead>
        <?php foreach ($results[0] as $key => $value) : ?>
            <?php $fields[] = $key; ?>
        <?php endforeach; ?>
        <tr>
            @foreach ($fields as $field)
            @if (preg_match("/_id/i", $field))
            <td>
                #
            </td>
            @else
            <td>
                {{ $field }}
            </td>
            @endif
            @endforeach
            <td>

            </td>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($results as $result)
        <tr>
            @foreach ($fields as $f)
                @if (preg_match("/_id/i", $f))
                <td>
                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
                        <input type="checkbox" id="{{ $result->$f }}">
                        <span></span>
                    </label>
                </td>
                @else
                <td>
                    {{ $result->$f }}
                </td>
                @endif
            @endforeach
            <td>
                <a href="#">Editar</a>
                <a href="#">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <!--end::Tbody-->
</table>
<p>
    {{ $results->links() }}
</p>
