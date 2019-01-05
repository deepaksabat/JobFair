(function ($) {
    "use strict";

    var url = window.location;
    var element = $('.sidebar-menu li .dropdown-menu li a').filter(function() {
        return this.href == url;
    }).addClass('active');

    $(document).on('click', '.sidebar-menu li a.list-group-item-action', function(e){
        var $that = $(this);

        var hasDropdown = $that.siblings('.dropdown-menu').length;
        if (hasDropdown){
            e.preventDefault();
        }

        if ( ! $that.closest('li').hasClass('active')) {
            $that.siblings('ul').slideToggle();
            $that.find('.arrow i').toggleClass('open-icon');
        }
    });

    $(document).on('change', '.country_to_state', function(e){
        e.preventDefault();

        var country_id = $(this).val();
        $.ajax({
            type : 'POST',
            url : page_data.routes.get_state_option_by_country,
            data : {country_id : country_id, _token : page_data.csrf_token},
            success: function(data){
                $('.state_options').html(data.state_options);
            }
        });
    });

    if (jQuery().datepicker){
        $('.date_picker').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: new Date(),
            autoclose: true
        });
    }
    if (jQuery().tooltip) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    $(document).on('click','.category_delete', function (e) {
        if (!confirm("Are you sure? its can't be undone")) {
            e.preventDefault();
            return false;
        }

        var selector = $(this);
        var data_id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url : page_data.routes.delete_categories,
            data: {data_id: data_id, _token: page_data.csrf_token},
            success: function (data) {
                if (data.success == 1) {
                    selector.closest('tr').remove();
                }
            }
        });
    });


    /**
     * Settings Panel
     */
    $('.ajax-updating input[type="checkbox"], input[type="radio"]').click(function(){
        var input_name = $(this).attr('name');
        var input_value = 0;
        if ($(this).prop('checked')){
            input_value = $(this).val();
        }
        $.ajax({
            url : page_data.routes.save_settings,
            type: "POST",
            data: { [input_name]: input_value, _token: page_data.csrf_token},
        });
    });
    $('.ajax-updating input[name="date_format"]').click(function(){
        $('#date_format_custom').val($(this).val());
    });
    $('.ajax-updating input[name="time_format"]').click(function(){
        $('#time_format_custom').val($(this).val());
    });
    /**
     * Send settings option value to server
     */
    $('.ajax-updating #settings_save_btn').click(function(e){
        e.preventDefault();

        var $that = $(this);

        var form_data = $that.closest('form').serialize();
        $.ajax({
            url : page_data.routes.save_settings,
            type: "POST",
            data: form_data,
            beforeSend : function () {
                $that.attr('disabled', 'disabled');
                $that.addClass('updating-btn');
            },
            success : function (data) {

            },
            complete: function () {
                $that.removeClass('updating-btn');
                $that.removeAttr('disabled');
            }
        });
    });

    /**
     * show or hide stripe and paypal settings wrap
     */
    $('#enable_paypal').click(function(){
        if ($(this).prop('checked')){
            $('#paypal_settings_wrap').slideDown();
        }else{
            $('#paypal_settings_wrap').slideUp();
        }
    });
    $('#enable_stripe').click(function(){
        if ($(this).prop('checked')){
            $('#stripe_settings_wrap').slideDown();
        }else{
            $('#stripe_settings_wrap').slideUp();
        }
    });

    $('#enable_bank_transfer').click(function(){
        if ($(this).prop('checked')){
            $('.bankPaymetWrap').slideDown();
        }else{
            $('.bankPaymetWrap').slideUp();
        }
    });


})( jQuery );