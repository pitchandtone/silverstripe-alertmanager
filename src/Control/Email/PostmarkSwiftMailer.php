<?php

namespace DNADesign\AlertManager;

use Exception;
use SilverStripe\Control\Email\SwiftMailer;
use SilverStripe\Core\Convert;

/**
 * Wraps the standard SilverStripe SwiftMailer
 * so that we can handle HTTP responses from the API properly
 */

class PostmarkSwiftMailer extends SwiftMailer
{

    /**
     * @param Email $message
     * @return bool Whether the sending was "successful" or not
     */
    public function send($message)
    {
        $swiftMessage = $message->getSwiftMessage();
        $failedRecipients = array();
        $result = $this->sendSwift($swiftMessage, $failedRecipients);
        $message->setFailedRecipients($failedRecipients);
        return $result;
    }
}
