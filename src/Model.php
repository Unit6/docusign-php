<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign;

/**
 * Model class for handling DocuSign requests.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Model
{
    protected $id;
    protected $data = array();

    public function __construct()
    {
        //
    }

    public function __call($name, $arguments)
    {
        $pattern = '/(get|set)([A-Z]{1}[\S]+)/';
        $found = preg_match($pattern, $name, $matches);

        if ($found) {
            list($name, $prefix, $key) = $matches;

            // fix the camelCasing.
            $key = lcfirst($key);

            $parameters = $this->getParameters();

            if ($this->isParameterValid($key)) {
                if ($prefix === 'set') {
                    $this->data[$key] = (isset($arguments[0]) ? $arguments[0] : null);
                    return;
                } elseif ($prefix === 'get') {
                    return (isset($this->data[$key]) ? $this->data[$key] : null);
                }
            }
        }

        throw new Exception\Model('Undefined method in Model class.');
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    public function __get($name)
    {
        if ( ! isset($this->data[$name])) {
            throw new Exception\Model('Undefined property in Model class.');
        }

        return $this->data[$name];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getParameters()
    {
        $parts = explode('\\', get_called_class());
        $name  = lcfirst(end($parts));

        return Parameters::${$name};
    }

    public function isParameterValid($key)
    {
        $parameters = $this->getParameters();

        return isset($parameters[$key]);
    }

    public function assignData($source)
    {
        $parameters = $this->getParameters();

        foreach ($source as $key => $value) {
            if (isset($parameters[$key])) {
                $type = $parameters[$key];

                // coerce valid types.
                if (   gettype($value) !== $type
                    && in_array( $type, Parameters::$typeOptions ) )
                {
                    settype( $value, $type );
                }

                $this->data[$key] = $value;
            }
        }
    }
}