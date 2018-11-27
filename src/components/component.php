<?php

abstract class Component
{

    private const FILTER = array('id', 'name', 'onClick');

    protected $parameters;
    private $classes = array();
    private $attributes = array();

    private static function write($element, $parameters = null)
    {
        if ($element instanceof Component) {
            $element->build($parameters);
        } elseif (gettype($element) == 'string') {
            echo($element);
        }
    }

    private static function filterAttributes($attributes, $filter)
    {
        return array_filter(
            $attributes,
            function ($key) use ($filter) {
                return in_array($key, $filter);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    protected static function print($data = null, $parameters = null)
    {
        if ($data) {
            if (gettype($data) === 'array') {
                foreach ($data as $element) {
                    self::write($element, $parameters);
                }
            } else {
                self::write($data, $parameters);
            }
        }
    }

    public function __construct($parameters)
    {
        if (gettype($parameters) !== 'array') {
            print_r($parameters);
            echo('<br>');
            die('Parameters of component is not an associative array!');
        }
        $this->parameters = $parameters;
    }

    public function classes(...$classes)
    {
        if (count($this->classes) > 0) {
            echo 'class="' . implode(' ', array_merge($this->classes, $classes)) . '" ';
        }
    }

    public function addClasses(...$classes)
    {
        $this->classes = array_merge($this->classes, $classes);
    }

    public function attributes($attributes, $filter = null)
    {
        $flt = self::FILTER;
        if ($filter) {
            $flt = array_combine($flt, $filter);
        }
        $attributes = self::filterAttributes($attributes, $flt);
        $data = array_combine($this->attributes, $attributes);
        $atts = ' ';
        foreach ($data as $key => $val) {
            $atts .= $key . '="' . $val . '" ';
        }
        echo($atts);
    }

    public function data($parameters, $filter = null)
    {
        $className = '';
        if (in_array('class', $parameters)) {
            $className = $parameters['class'];
        }
        $this->classes($className);
        $this->attributes($parameters, $filter);
    }

    public function addAttributes($attributes, $filter = null)
    {
        if ($filter) {
            $attributes = self::filterAttributes($attributes, $filter);
        }
        $this->attributes = array_combine($this->attributes, $attributes);
    }

    public function build($parameters = array())
    {
        $data = array_merge($this->parameters, $parameters);
        $this->render($data);
    }
}
