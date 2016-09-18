<?php
/*
 * Copyright (c) 2016 Ink Applications, LLC.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace InkApplications\Knock\User;

use RuntimeException;

/**
 * Thrown when an attempt to locate a User in data storage could not be found.
 *
 * @author Maxwell Vandervelde <Max@MaxVandervelde.com>
 */
class CredentialsNotFoundException extends RuntimeException {}
