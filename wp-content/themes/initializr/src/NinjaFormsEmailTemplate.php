<?php
/**
 * Custom email template for for Ninja forms
 */
namespace App;

class NinjaFormsEmailTemplate
{

    function __construct()
    {
        add_filter('wp_mail_content_type', array($this, 'setEmailContentType') );

        /* Override email message output */
        add_filter('ninja_forms_action_email_message', array($this, 'overrideEmailMessage'), 10, 3);
    }

    function setEmailContentType(){
        return "text/html";
    }

    function overrideEmailMessage($message, $data, $actionSettings)
    {
        return EmailParser::parse('general', array(
            'message' => $message,
            'data' => $data,
        ));
    }
}
