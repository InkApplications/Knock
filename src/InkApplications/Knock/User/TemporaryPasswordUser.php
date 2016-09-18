<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
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
    public function getPasswordCreated();

    /**
     * Change the user's password salt.
     *
     * @param string $salt The plaintext password salt associated with the password.
     */
    public function setSalt($salt);

    /**
     * Change the user's password.
     *
     * @param string $password An encrypted/hashed password.
     */
    public function setPassword($password);

    /**
     * Change when the user's password was last changed.
     *
     * @param DateTime $created The timestamp of when the user's password was changed.
     */
    public function setPasswordCreated(DateTime $created);
}
