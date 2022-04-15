<?php declare(strict_types=1);
namespace ApplicationInsights\Channel\Contracts;

/**
 * THIS FILE IS AUTO-GENERATED.
 * Please do not edit manually.
 *
 * Use script at <root>/Schema/generateSchema.ps1
 */

/**
 * Data contract class for type Data_Point. Metric data single measurement.
 */
class Data_Point
{
    use Json_Serializer;

    /**
     * Data array that will store all the values.
     */
    private $_data;

    /**
     * Creates a new DataPoint.
     */
    public function __construct()
    {
        $this->_data['name'] = null;
        $this->_data['kind'] = Data_Point_Type::Measurement;
        $this->_data['value'] = null;
    }

    /**
     * Gets the ns field. Namespace of the metric.
     */
    public function getNs()
    {
        if (\array_key_exists('ns', $this->_data)) {
            return $this->_data['ns'];
        }

        return null;
    }

    /**
     * Sets the ns field. Namespace of the metric.
     */
    public function setNs($ns) : void
    {
        $this->_data['ns'] = $ns;
    }

    /**
     * Gets the name field. Name of the metric.
     */
    public function getName()
    {
        if (\array_key_exists('name', $this->_data)) {
            return $this->_data['name'];
        }

        return null;
    }

    /**
     * Sets the name field. Name of the metric.
     */
    public function setName($name) : void
    {
        $this->_data['name'] = $name;
    }

    /**
     * Gets the kind field. Metric type. Single measurement or the aggregated value.
     */
    public function getKind()
    {
        if (\array_key_exists('kind', $this->_data)) {
            return $this->_data['kind'];
        }

        return null;
    }

    /**
     * Sets the kind field. Metric type. Single measurement or the aggregated value.
     */
    public function setKind($kind) : void
    {
        $this->_data['kind'] = $kind;
    }

    /**
     * Gets the value field. Single value for measurement. Sum of individual measurements for the aggregation.
     */
    public function getValue()
    {
        if (\array_key_exists('value', $this->_data)) {
            return $this->_data['value'];
        }

        return null;
    }

    /**
     * Sets the value field. Single value for measurement. Sum of individual measurements for the aggregation.
     */
    public function setValue($value) : void
    {
        $this->_data['value'] = $value;
    }

    /**
     * Gets the count field. Metric weight of the aggregated metric. Should not be set for a measurement.
     */
    public function getCount()
    {
        if (\array_key_exists('count', $this->_data)) {
            return $this->_data['count'];
        }

        return null;
    }

    /**
     * Sets the count field. Metric weight of the aggregated metric. Should not be set for a measurement.
     */
    public function setCount($count) : void
    {
        $this->_data['count'] = $count;
    }

    /**
     * Gets the min field. Minimum value of the aggregated metric. Should not be set for a measurement.
     */
    public function getMin()
    {
        if (\array_key_exists('min', $this->_data)) {
            return $this->_data['min'];
        }

        return null;
    }

    /**
     * Sets the min field. Minimum value of the aggregated metric. Should not be set for a measurement.
     */
    public function setMin($min) : void
    {
        $this->_data['min'] = $min;
    }

    /**
     * Gets the max field. Maximum value of the aggregated metric. Should not be set for a measurement.
     */
    public function getMax()
    {
        if (\array_key_exists('max', $this->_data)) {
            return $this->_data['max'];
        }

        return null;
    }

    /**
     * Sets the max field. Maximum value of the aggregated metric. Should not be set for a measurement.
     */
    public function setMax($max) : void
    {
        $this->_data['max'] = $max;
    }

    /**
     * Gets the stdDev field. Standard deviation of the aggregated metric. Should not be set for a measurement.
     */
    public function getStdDev()
    {
        if (\array_key_exists('stdDev', $this->_data)) {
            return $this->_data['stdDev'];
        }

        return null;
    }

    /**
     * Sets the stdDev field. Standard deviation of the aggregated metric. Should not be set for a measurement.
     */
    public function setStdDev($stdDev) : void
    {
        $this->_data['stdDev'] = $stdDev;
    }
}
