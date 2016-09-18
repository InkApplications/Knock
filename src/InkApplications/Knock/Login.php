<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock;

use DateTime;
use InkApplications\Knock\User\TemporaryPasswordUser;
use InkApplications\Knock\User\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Manages the User to assign temporary credentials for the email-login links.
 *
 * @author Maxwell Vandervelde <Max@MaxVandervelde.com>
 */
class Login
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var MessageSender
     */
    private $messageSender;

    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $encoder, MessageSender $messageSender)
    {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
        $this->messageSender = $messageSender;
    }

    /**
     * Begin the authentication process for a user.
     *
     * This generates a new password for the user and then triggers an email
     * to be sent with those login credentials.
     *
     * @param string $email The unique user email to begin the process for.
     */
    public function start($email)
    {
        $user = $this->userRepository->findCredentialsByEmail($email);

        if ($this->passwordRecentlyCreated($user)) {
            return;
        }

        $code = base64_encode(random_bytes(32));
        $salt = base64_encode(random_bytes(16));
        $emailSalt = substr(sha1(random_bytes(16)), 0, 8);

        $user->setSalt($salt);
        $user->setPassword($this->encoder->encodePassword($user, $code));
        $user->setPasswordCreated(new DateTime());
        $this->userRepository->saveUserCredentials($user);

        $this->messageSender->send($email, $code, $emailSalt);
    }

    /**
     * Determine if the user's password has already been generated within the
     * last minute.
     *
     * This helps reduce errors in sending multiple emails as well as preventing
     * an encoding time attack.
     *
     * @param TemporaryPasswordUser $user The user to lookup the password
     *        created time for.
     * @return bool Whether the password has been created within the last minute.
     */
    public function passwordRecentlyCreated(TemporaryPasswordUser $user)
    {
        $minuteAgo = new DateTime();
        $minuteAgo->modify('-1 minute');

        if ($user->getPasswordCreated() < $minuteAgo) {
            return false;
        }

        return true;
    }
}
