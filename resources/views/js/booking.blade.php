<script type="text/javascript">
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('.timepicker').datetimepicker({
        format: 'HH:mm:ss'
    });

    $(document).ready(function (e) {
        // e.preventDefault();
        changeType();
        $('#booking_type').trigger('change');
        // $('.slot').hide();
        // $('#booking_slot').val('');
        $(document).off('change','#booking_type');
        $(document).on('change','#booking_type',function (e) {
        e.preventDefault();
       changeType();
        });

        function changeType() {
            var selected_type=$('#booking_type').val();
            if(selected_type=='Full day'){
                $('.slot').hide();
                $('#booking_slot').val('');
            }
            else{
                $('.slot').show();
                if($('#booking_slot').val() == '' || $('#booking_slot').val() == null ){
                    $('#booking_slot').val('Morning');
                }
            }

        }
    });
</script>