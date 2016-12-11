<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock\User;

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
     * Save the user and/or its password credentials.
     *
     * This method is invoked after the user's password has been modified and
     * needs to be persisted to the application's data storage.
     *
     * @param TemporaryPasswordUser $user The user/credentials that need to be saved.
     */
    public function saveUserCredentials(TemporaryPasswordUser $user);

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
     * @return TemporaryPasswordUser A newly created user-model to be persisted.
     */
    public function createUser($email): TemporaryPasswordUser;
}
