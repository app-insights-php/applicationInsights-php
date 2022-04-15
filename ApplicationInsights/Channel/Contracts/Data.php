<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * THIS FILE IS AUTO-GENERATED.
 * Please do not edit manually.
 *
 * Use script at <root>/Schema/generateSchema.ps1
 */

/**
 * Data contract class for type Data. Data struct to contain both B and C sections.
 */
class Data
{
    use Json_Serializer;

    /**
     * Data array that will store all the values.
     */
    private $_data;

    /**
     * Creates a new Data.
     */
    public function __construct()
    {
        $this->_data['baseData'] = null;
    }

    /**
     * Gets the baseType field. Name of item (B section) if any. If telemetry data is derived straight from this, this should be null.
     */
    public function getBaseType()
    {
        if (\array_key_exists('baseType', $this->_data)) {
            return $this->_data['baseType'];
        }

        return null;
    }

    /**
     * Sets the baseType field. Name of item (B section) if any. If telemetry data is derived straight from this, this should be null.
     */
    public function setBaseType($baseType) : void
    {
        $this->_data['baseType'] = $baseType;
    }

    /**
     * Gets the baseData field. Container for data item (B section).
     */
    public function getBaseData()
    {
        if (\array_key_exists('baseData', $this->_data)) {
            return $this->_data['baseData'];
        }

        return null;
    }

    /**
     * Sets the baseData field. Container for data item (B section).
     */
    public function setBaseData($baseData) : void
    {
        $this->_data['baseData'] = $baseData;
    }
}
