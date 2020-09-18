jQuery(document).ready(function($) {
    $(function() {

        var barHeight;

        // Show notification bar
        if ($('.bnb').length > 0) {
            barHeight = $('.bnb').outerHeight();
            $('body').addClass('has-bnb');
            if ($('.bnb-top').length > 0) {
                $('body').css('padding-top', barHeight);
            }
        }

        // Hide Button
        $(document).on('click', '.bnb-hide', function(e) {

            e.preventDefault();

            var $this = $(this);

            if (!$this.hasClass('active')) {
                if ($('.bnb-top').length > 0) {
                    $this.closest('.bnb').removeClass('bnb-shown').addClass('bnb-hidden');
                    $('body').css('padding-top', 0);
                } else if ($('.bnb-bottom').length > 0) {
                    $this.closest('.bnb').removeClass('bnb-shown').addClass('bnb-hidden');
                }
            }
        });

        // Show Button
        $(document).on('click', '.bnb-show', function(e) {

            e.preventDefault();

            var $this = $(this);

            if (!$this.hasClass('active')) {
                barHeight = $('.bnb').outerHeight();
                if ($('.bnb-top').length > 0) {
                    $this.closest('.bnb').removeClass('bnb-hidden').addClass('bnb-shown');
                    $('body').css('padding-top', barHeight);
                } else if ($('.bnb-bottom').length > 0) {
                    $this.closest('.bnb').removeClass('bnb-hidden').addClass('bnb-shown');
                }
            }
        });
    });
});