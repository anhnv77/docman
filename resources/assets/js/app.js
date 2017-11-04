window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});