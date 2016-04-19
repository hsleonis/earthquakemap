(function($) {
    $(document).ready(function($) {
        $('#energy_import').click(function() {
            $import_true = confirm('are you sure to import dummy content ? it will overwrite the existing data');
            if ($import_true == false) return;

            $('.import_message').html('<div class="update-nag notice"><div class="spinner is-active"></div>Data is being imported please be patient, while the awesomeness is being created :)  </div>');
            var data = {
                'action': 'energy_action'
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            $.post(ajaxurl, data, function(response) {
                $('.import_message').html('<div class="import_message_success update-nag notice">' + response + '</div>');
                //alert('Got this from the server: ' + response); //<i class="fa fa-spinner fa-3x fa-spin"></i>
            });
        });
    });

})(jQuery);