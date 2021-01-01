$(document).ready(function () {

    var form = $('#check_form');
    $('#checkConnBtn').on('click', function () {
        $('#myTablesBody').empty();
        $('#tableBlock').hide();

        event.preventDefault();
        $.ajax({
            url: "checkConn.php",
            method: "POST",
            data: form.serialize(),
            beforeSend: function (data) {
                console.log(data);
                $('#loading').show();
            },
            success: function (response) {
                $('#errorBox').empty();
                response = JSON.parse(response);
                console.log(response.tablesInfo);
                if (typeof response.tablesInfo !== 'undefined') {
                    $('#tableBlock').show();
                    for (var i = 0; i <= response.tablesInfo.length - 1; i++) {
                        console.log(response.tablesInfo[i]);

                        $('#myTablesBody').append('<tr><th scope="row">' + i + '</th><td>' + response.tablesInfo[i].TABLE_NAME + '</td><td>' + response.tablesInfo[i].ENGINE + '</td></tr>');
                    }
                }
                $('#errorBox').append(response.alert)
            },
            complete: function (response) {
                // console.log(response);
                $('#loading').hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown);
            }
        })

    });

    $('#convertBtn').on('click', function () {
        var fromE = $('#from').val();
        var toE = $('#to').val();
        $('#convertedTablesBody').empty();
        $('#diffStroage').hide();

        if (fromE !== toE) {

            var convertForm = $('#convertForm');
            event.preventDefault();

            $.ajax({
                url: 'convert.php',
                method: 'POST',
                data: convertForm.serialize(),
                beforeSend: function (data) {
                    $('#convertLoading').show();
                    $('#convertBtn').attr('disabled', 'disabled');
                },
                success: function (response) {
                    response = JSON.parse(response)

                    if (typeof response !== 'undefined') {
                        $('#convertedTables').show();
                        for (var i = 0; i <= response.length - 1; i++) {
                            console.log(response[i]);
                            $('#convertedTablesBody').append(response[i]);
                        }
                    }
                    // console.log(response)
                },
                complete: function (response) {
                    $('#convertLoading').hide();
                    $('#convertBtn').removeAttr('disabled');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.status);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            })
        }
        else {
            $('#diffStroage').show();
        }
    })
});