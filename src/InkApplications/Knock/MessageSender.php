<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock;

/**
 * Sends out the messages for logging in.
 *
 * @author Maxwell Vandervelde <Max@MaxVandervelde.com>
 */
interface MessageSender
{
    /**
     * Send the user a message with their login credentials.
     *
     * @param string $email The user email to be contacted.
     * @param string $code The user's one-time use login code
     * @param string $emailId A unique identifier for this interaction
     */
    public function send($email, $code, $emailId);
}
