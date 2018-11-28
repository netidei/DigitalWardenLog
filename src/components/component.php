<?php

abstract class Component
{

    private const FILTER = ['id', 'name', 'onClick'];

    protected $parameters;
    private $classes = array();
    private $attributes = array();

    private static function write($element, $parameters = array())
    {
        if ($element) {
            $type = gettype($element);
            if (is_callable($element) && $element instanceof Closure) {
                $element($parameters);
            } elseif ($type === 'object' && $element instanceof Component) {
                $element->build($parameters);
            } elseif ($type === 'string') {
                echo($element);
            }
        }
    }

    private static function filterAttributes($attributes, $filter)
    {
        $data = array();
        foreach ($attributes as $key => $value) {
            if (in_array($key, $filter)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }

    private static function isAssoc(array $arr)
    {
        if (array() === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private static function merge($target, ...$sources)
    {
        foreach ($sources as $source) {
            foreach ($source as $key => $val) {
                if (array_key_exists($key, $target)) {
                    switch (gettype($target[$key])) {
                        case 'array':
                            $target[$key] = self::isAssoc($target) ? self::merge($target[$key], $val) : array_merge($target[$key], $val);
                            break;
                        default:
                            $target[$key] = $val;
                            break;
                    }
                } else {
                    $target[$key] = $val;
                }
            }
        }
        return $target;
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

    protected static function safe($parameters, $names)
    {
        foreach ($names as $key => $val) {
            if (is_numeric($key)) {
                if (!array_key_exists($val, $parameters)) {
                    $parameters[$val] = null;
                }
            } elseif (!array_key_exists($key, $parameters) || !isset($parameters[$key])) {
                $parameters[$key] = $val;
            } elseif (gettype($val) === 'array' && gettype($parameters[$key]) !== 'array') {
                $parameters[$key] = array($parameters[$key]);
            }
        }
        return $parameters;
    }

    public function __construct($parameters)
    {
        if (gettype($parameters) !== 'array') {
            die('Parameters of component is not an associative array!');
        }
        $this->parameters = $parameters;
    }

    public function addClasses(...$classes)
    {
        $this->classes = array_merge($this->classes, $classes);
    }

    public function addAttributes($attributes, $filter = array())
    {
        $attributes = self::filterAttributes($attributes, $filter);
        $this->attributes = self::merge($this->attributes, $attributes);
    }

    public function classes($parameters)
    {
        $str = ' ';
        if ($parameters && array_key_exists('class', $parameters)) {
            $cls = $parameters['class'];
            $type = gettype($cls);
            $str .= 'class="';
            if ($type === 'array') {
                $str .= implode(' ', array_merge($this->classes, $cls));
            } elseif ($type === 'string') {
                $str .= implode(' ', $this->classes) . ' ' . $cls;
            }
            $str .= '" ';
        } else {
            $str .= 'class="' . implode(' ', $this->classes) . '" ';
        }
        return $str;
    }

    public function attributes($attributes = array(), $filter = array())
    {
        $atts = $this->classes($attributes);
        $filters = array_merge(self::FILTER, $filter);
        $attributes = self::filterAttributes($attributes, $filters);
        $data = self::merge($this->attributes, $attributes);
        foreach ($data as $key => $val) {
            $atts .= $key . '="' . $val . '" ';
        }
        echo $atts;
    }

    public function build($parameters = array())
    {
        $data = $parameters ? self::merge($this->parameters, $parameters) : $this->parameters;
        $this->render($data);
    }
}
