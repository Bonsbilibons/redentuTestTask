<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <title>Upload</title>
</head>
<body>

    <div class="uploader-insert-box">
        <div class="text-center">
            <h3>Upload our XLSX</h3>
            @foreach($errors->all() as $error)
                <h4>{{ $error }}</h4>
            @endforeach
            {{ Form::open(['url' => route('uploader.uploadXLSX'), 'id' => 'upload-form']) }}
            {{ Form::file('xlsx', ['class' => 'form-control form-field', 'accept' => '.xlsx']) }}
            {{ Form::submit('Submit Uploading', ['class' => 'btn btn-success form-field', 'disabled' => true]) }}
            {{ Form::close() }}
        </div>
    </div>

</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('[name=xlsx]').on('change', function (event) {
        if ($(this).val()) {
            $('.btn-success').attr('disabled', false);
        } else {
            $('.btn-success').attr('disabled', true);
        }
    });

    $('#upload-form').on('submit', function (event) {
        event.preventDefault()
        $(this).find('.btn-success').attr('disabled', true);

        var form = this;
        const formData = new FormData(form);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $(form).find('[name=xlsx]').val('');
                $(form).find('.btn-success').attr('disabled', false);

                if (response.status === 'success') {
                    $('body').prepend(
                        '<div class="background-toner">' +
                            '<div class="response-info-box">' +
                                '<h4>Records with invalid structure ' + response.result.records_with_invalid_structure +
                                '</h4>' +
                                '<h4>New records ' + response.result.new_records_count +
                                '</h4>' +
                                '<h4>Duplicated records ' + response.result.duplicates_count +
                                '</h4>' +
                                '<h4>Time passed ' + response.time_passed +
                                '</h4>' +
                                '<button type="button" class="btn btn-success" id="close-response-info-box" onclick="closeInfoBox()">OK</button>' +
                            '</div>'+
                        '</div>'
                    );
                }
            },
            error: function (XMLHttpRequest, ajaxOptions, thrownError) {
                $(form).find('.btn-success').attr('disabled', false);
                alert(thrownError);
            }
        });
    });

    function closeInfoBox() {
        $('.background-toner').remove();
    }
</script>
