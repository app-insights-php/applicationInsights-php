<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * THIS FILE IS AUTO-GENERATED.
 * Please do not edit manually.
 *
 * Use script at <root>/Schema/generateSchema.ps1
 */

/**
 * Data contract class for type Application.
 */
class Application
{
    use Json_Serializer;

    /**
     * Data array that will store all the values.
     */
    private $_data;

    /**
     * Creates a new Application.
     */
    public function __construct()
    {
        $this->_data = [];
    }

    /**
     * Gets the ver field. Application version. Information in the application context fields is always about the application that is sending the telemetry.
     */
    public function getVer()
    {
        if (\array_key_exists('ai.application.ver', $this->_data)) {
            return $this->_data['ai.application.ver'];
        }

        return null;
    }

    /**
     * Sets the ver field. Application version. Information in the application context fields is always about the application that is sending the telemetry.
     */
    public function setVer($ver) : void
    {
        $this->_data['ai.application.ver'] = $ver;
    }
}
