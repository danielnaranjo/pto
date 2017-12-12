//== Class definition

var BootstrapDatetimepicker = function () {

    //== Private functions
    var demos = function () {
        // minimal setup
        $('#m_datetimepicker_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy.mm.dd hh:ii'
        });

        $('#m_datetimepicker_1_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy.mm.dd hh:ii'
        });

        $('.m_datetimepicker_2').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy.mm.dd hh:ii'
        });

    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    BootstrapDatetimepicker.init();
});
