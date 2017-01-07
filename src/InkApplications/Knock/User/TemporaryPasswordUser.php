<?php
/*
 * Copyright (c) 2016-2017 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock\User;

use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * A Security user that can have a temporary password assigned to it.
 *
 * @author Maxwell Vandervelde <Max@MaxVandervelde.com>
 */
interface TemporaryPasswordUser extends UserInterface
{
    /**
     * A DateTime object that indicates when the temporary password was assigned
     * to the user.
     *
     * This is to be used to indicate whether the temporary password is still
     * valid.
     *
     * @return DateTime|null The timestamp that the user's password was generated.
     */
    public function getPasswordCreated(): DateTime;

    /**
     * Get the user's email address.
     *
     * @return string
     */
    public function getEmail();
}
