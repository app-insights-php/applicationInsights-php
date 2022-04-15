<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * THIS FILE IS AUTO-GENERATED.
 * Please do not edit manually.
 *
 * Use script at <root>/Schema/generateSchema.ps1
 */

/**
 * Data contract class for type Event_Data. Instances of Event represent structured event records that can be grouped and searched by their properties. Event data item also creates a metric of event count by name.
 */
class Event_Data extends Base_Data implements Data_Interface
{
    /**
     * Creates a new EventData.
     */
    public function __construct()
    {
        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Event';
        $this->_dataTypeName = 'EventData';
        $this->_data['ver'] = 2;
        $this->_data['name'] = null;
    }

    /**
     * Gets the ver field. Schema version.
     */
    public function getVer()
    {
        if (\array_key_exists('ver', $this->_data)) {
            return $this->_data['ver'];
        }

        return null;
    }

    /**
     * Sets the ver field. Schema version.
     */
    public function setVer($ver) : void
    {
        $this->_data['ver'] = $ver;
    }

    /**
     * Gets the name field. Event name. Keep it low cardinality to allow proper grouping and useful metrics.
     */
    public function getName()
    {
        if (\array_key_exists('name', $this->_data)) {
            return $this->_data['name'];
        }

        return null;
    }

    /**
     * Sets the name field. Event name. Keep it low cardinality to allow proper grouping and useful metrics.
     */
    public function setName($name) : void
    {
        $this->_data['name'] = $name;
    }

    /**
     * Gets the properties field. Collection of custom properties.
     */
    public function getProperties()
    {
        if (\array_key_exists('properties', $this->_data)) {
            return $this->_data['properties'];
        }

        return null;
    }

    /**
     * Sets the properties field. Collection of custom properties.
     */
    public function setProperties($properties) : void
    {
        $this->_data['properties'] = $properties;
    }

    /**
     * Gets the measurements field. Collection of custom measurements.
     */
    public function getMeasurements()
    {
        if (\array_key_exists('measurements', $this->_data)) {
            return $this->_data['measurements'];
        }

        return null;
    }

    /**
     * Sets the measurements field. Collection of custom measurements.
     */
    public function setMeasurements($measurements) : void
    {
        $this->_data['measurements'] = $measurements;
    }
}
