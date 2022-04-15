<?php

declare(strict_types=1);

namespace ApplicationInsights;

use ApplicationInsights\Channel\Contracts\Utils;

/**
 * Main object used for managing users for other telemetry items.
 */
class Current_User
{
    /**
     * The current user id.
     */
    public $id;

    /**
     * Initializes a new Current_User.
     */
    public function __construct()
    {
        if (\array_key_exists('ai_user', $_COOKIE) && \is_string($_COOKIE['ai_user'])) {
            $parts = \explode('|', $_COOKIE['ai_user']);

            if (\count($parts) > 0) {
                $this->id = $parts[0];
            }
        }

        if ($this->id == null) {
            $this->id = Utils::returnGuid();
            $_COOKIE['ai_user'] = $this->id;
        }
    }
}
