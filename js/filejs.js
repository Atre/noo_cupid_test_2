var addtext = $('#addtext');

$('#checkbox').on('change', function () {
    if ($(this).is(':checked')) {
        addtext.show();
    } else {
        addtext.val('');
        addtext.hide();
    }
});

$('#submit').on('click', function(event) {
    event.preventDefault();
    $('#results').empty();
    var filename = $('#filename').val();
    var contents = $('#addtext').val();

    if (filename || contents) {
        $.post('', {filename: filename , content: contents }, function(data) {
            $('#results').html(data);
        })
    }
});