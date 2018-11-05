// CSS
require('font-awesome/css/font-awesome.min.css');
require('bootstrap/dist/css/bootstrap.min.css');
require('ionicons/dist/css/ionicons.min.css');
require('admin-lte/dist/css/AdminLTE.min.css');
require('admin-lte/dist/css/skins/skin-red.css');
require('admin-lte/plugins/iCheck/minimal/_all.css');
require('bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css');


// JS
require('bootstrap/dist/js/bootstrap.min.js');
require('admin-lte/dist/js/adminlte.min.js');
require('slimscroll/lib/slimscroll.js');
require('fastclick/lib/fastclick.js');
require('admin-lte/plugins/iCheck/icheck.min.js');
require('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
require('admin-lte/plugins/input-mask/jquery.inputmask.js');
require('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js');
require('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js');


$(document).ready(function(){
    $('.phone').inputmask({"mask": "+99 9 9999 9999"});

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
});