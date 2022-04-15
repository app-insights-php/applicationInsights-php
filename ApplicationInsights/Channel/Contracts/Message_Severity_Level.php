<?php declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

abstract class Message_Severity_Level
{
    public const VERBOSE = Severity_Level::Verbose;

    public const INFORMATION = Severity_Level::Information;

    public const WARNING = Severity_Level::Warning;

    public const ERROR = Severity_Level::Error;

    public const CRITICAL = Severity_Level::Critical;
}
