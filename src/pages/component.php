<?php

abstract class Component
{

    protected $props;
    protected $propsStructure;

    public static function GET($name)
    {
        return isset($_GET) && isset($_GET[$name]) ? $_GET[$name] : null;
    }

    public static function POST($name)
    {
        return isset($_POST) && isset($_POST[$name]) ? $_POST[$name] : null;
    }
    
    public static function print($data, $props = array())
    {
        if ($data) {
            if (gettype($data) === 'array') {
                foreach ($data as $element) {
                    self::write($element, $props);
                }
            } else {
                self::write($data, $props);
            }
        }
    }

    public static function extract($props, $structure)
    {
        $data = array();
        foreach ($structure as $key => $val) {
            if (is_numeric($key)) {
                if (array_key_exists($val, $props)) {
                    array_push($data, $props[$val]);
                } else {
                    array_push($data, null);
                }
            } else {
                if (isset($props[$key])) {
                    array_push($data, $props[$key]);
                } else {
                    array_push($data, $val);
                }
            }
        }
        return $data;
    }

    protected static function merge($target, ...$sources)
    {
        foreach ($sources as $source) {
            foreach ($source as $key => $val) {
                if (array_key_exists($key, $target)) {
                    $type = gettype($target[$key]);
                    if ($type === 'array') {
                        if (self::isAssoc($target[$key])) {
                            $target[$key] = self::merge($target[$key], $val);
                        } else {
                            $target[$key] = array_unique(array_merge($target[$key], $val));
                        }
                    } else {
                        $target[$key] = $val;
                    }
                } else {
                    $target[$key] = $val;
                }
            }
        }
        return $target;
    }
    
    private static function write($element, $props)
    {
        if ($element) {
            $type = gettype($element);
            if (is_callable($element) && $element instanceof Closure) {
                $element($props);
            } elseif ($type === 'object' && $element instanceof Component) {
                $element->build($props);
            } elseif ($type === 'string') {
                echo($element);
            }
        }
    }

    private static function isAssoc(array $arr)
    {
        if (array() === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private static function getDefaultValue($type)
    {
        switch ($type) {
            case 'array':
            case 'map':
                return array();
            case 'number':
                return 0;
            case 'boolean':
                return false;
            case 'string':
                return '';
            default:
                return $type;
        }
    }

    private static function getProp($type, $target, $source)
    {
        switch ($type) {
            case 'array':
                return array_merge($target, $source);
            case 'map':
                return self::merge($target, $source);
            default:
                return $source;
        }
    }

    public function __construct($props)
    {
        if (gettype($props) !== 'array' || !self::isAssoc($props)) {
            die('Properties of component is not an associative array!');
        }
        $this->props = $props;
        $this->propsStructure = array();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->propsStructure)) {
            return $this->props[$name];
        }
        return null;
    }

    protected function setProps($props)
    {
        if ($props && self::isAssoc($props)) {
            foreach ($this->propsStructure as $prop => $type) {
                if (array_key_exists($prop, $props)) {
                    $this->props[$prop] = self::getProp($type, $this->props[$prop], $props[$prop]);
                }
            }
        }
    }

    protected function define($structure)
    {
        $this->propsStructure = self::merge($this->propsStructure, $structure);
        foreach ($this->propsStructure as $prop => $type) {
            if (!array_key_exists($prop, $this->props)) {
                $this->props[$prop] = self::getDefaultValue($type);
            }
        }
    }

    public function build($props)
    {
        $this->setProps($props);
        $this->render($props, ...self::extract($this->props, $this->propsStructure));
    }
}
