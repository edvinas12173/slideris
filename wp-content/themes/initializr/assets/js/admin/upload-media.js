/**
 * Handle upload media button
 */
jQuery(document).ready(function($) {

    $(document).on("click", ".js-upload-media", function(e) {
        e.preventDefault();
        var $button = $(this);

        // Create the media frame.

        var fileFrame = wp.media({
            title: 'Select or upload image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        fileFrame.on('select', function() {

            var attachment = fileFrame.state().get('selection').first().toJSON();
            $($button.data('target')).val(attachment.id);
            $($button.data('target') + '-preview').val(attachment.filename);
            $($button.data('target')).change();
        });

        // Finally, open the modal
        fileFrame.open();
    });

    $(document).on("click", ".js-remove-media", function(e) {
        e.preventDefault();
        var $button = $(this);
        $($button.data('target')).val('');
        $($button.data('target') + '-preview').val('');
        $($button.data('target')).change();
    });


});
