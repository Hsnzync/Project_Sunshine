$('#basicExample .time').timepicker({
    'showDuration': true,
    'timeFormat': 'g:ia'
});

$('#basicExample .date').datepicker({
    'format': 'm/d/yyyy',
    'autoclose': true
});

// initialize datepair
var basicExampleEl = document.getElementById('basicExample');
var datepair = new Datepair(basicExampleEl);


$('#disableTimeRangesExample').timepicker({
    'disableTimeRanges': [
        ['10', '12'],
        ['3am', '4:01am']
    ]
});

if ($('#alert').length > 0)
{
    $('#alert').delay(3000).fadeOut();
}
