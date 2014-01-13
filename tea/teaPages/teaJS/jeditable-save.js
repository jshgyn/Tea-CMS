$(document).ready(function() {
     $('.imageDesc').editable('teaScripts/t_saveDesc.php', {
        indicator : 'Saving...',
        type : 'textarea',
        event     : 'dblclick',
        placeholder : 'No Description.',
        submitdata : { _method: "put" },
        submit : 'OK',
        cancel : 'Cancel'
     });

     $('.catLat').editable('teaScripts/t_saveLat.php', {
        indicator : 'Saving...',
        type : 'textarea',
        event     : 'dblclick',
        placeholder : 'No Latitude Set.',
        submitdata : { _method: "put" },
        submit : 'OK',
        cancel : 'Cancel'
     });

     $('.catLong').editable('teaScripts/t_saveLong.php', {
        indicator : 'Saving...',
        type : 'textarea',
        event     : 'dblclick',
        placeholder : 'No Longitude Set.',
        submitdata : { _method: "put" },
        submit : 'OK',
        cancel : 'Cancel'
     });

     $('.catTitle').editable('teaScripts/t_saveCatTitle.php', {
        indicator : 'Saving...',
        type : 'textarea',
        event     : 'dblclick',
        placeholder : 'No Title Set.',
        submitdata : { _method: "put" },
        submit : 'OK',
        cancel : 'Cancel'
     });

 });