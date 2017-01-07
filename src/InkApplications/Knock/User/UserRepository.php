<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock\User;

use DateTime;

/**
 * Service that is capable of finding and saving user credentials.
 *
 * Typically this will be saving the user object itself, like a normal user
 * repository, but this isn't required as long as the credentials for the user
 * are save and looked up as the TemporaryPasswordUser object.
 *
 * @author Maxwell Vandervelde <Max@MaxVandervelde.com>
 */
interface UserRepository
{
    /**
     * Find user credentials by an email address.
     *
     * @param string $email The unique email address of the user to lookup.
     * @return TemporaryPasswordUser A user that matches the given email.
     * @throws CredentialsNotFoundException If no user matching the given email
     *         Could be found.
     */
    public function findCredentialsByEmail($email): TemporaryPasswordUser;

    /**
     * Create a new local user object to be persisted.
     *
     * @param string $email The user's email address to base the user object on.
     *        if the user is being created for the first time.
     * @return TemporaryPasswordUser A newly created user-model to be persisted.
     */
    public function createUser($email): TemporaryPasswordUser;

    /**
     * Modify an existing user with new password credentials.
     *
     * @param TemporaryPasswordUser $user The original user object to be modified.
     * @param string $password The user's hashed temporary password.
     * @param string $salt Password Salt used when hashing the temporary password.
     * @param DateTime $passwordCreated Timestamp of when the temporary password was generated.
     */
    public function updateUserCredentials(TemporaryPasswordUser $user, $password, $salt, DateTime $passwordCreated);

    /**
     * Remove/Invalidate an existing user's password credentials.
     *
     * @param TemporaryPasswordUser $user The user object to be modified.
     */
    public function destroyUserCredentials(TemporaryPasswordUser $user);
}
