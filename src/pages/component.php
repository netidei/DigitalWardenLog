<?php

abstract class Component
{

    protected $state;
    protected $stateStructure;

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

    public static function define($data, $structure)
    {
        $result = array();
        foreach ($structure as $key => $val) {
            if (is_numeric($key)) {
                if (array_key_exists($val, $data)) {
                    array_push($result, $data[$val]);
                } else {
                    array_push($result, null);
                }
            } else {
                if (isset($data[$key])) {
                    array_push($result, $data[$key]);
                } else {
                    array_push($result, $val);
                }
            }
        }
        return $result;
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
            if ($type === 'array') {
                self::print($element, $props);
            } elseif (is_callable($element) && $element instanceof Closure) {
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

    private static function getValue($default, $target, $source)
    {
        $type = gettype($default);
        if ($type === 'array') {
            if (self::isAssoc($default)) {
                return self::merge($target, $source);
            }
            return array_merge($target, $source);
        }
        return $source;
    }

    public function __construct($state)
    {
        if (gettype($state) !== 'array' || !self::isAssoc($state)) {
            die('State of component is not an associative array!');
        }
        $this->state = $state;
        $this->stateStructure = array();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->stateStructure)) {
            return $this->state[$name];
        }
        return null;
    }

    protected function setState($state)
    {
        if ($state && self::isAssoc($state)) {
            foreach ($this->stateStructure as $key => $default) {
                if (array_key_exists($key, $state)) {
                    $this->state[$key] = self::getValue($default, $this->state[$key], $state[$key]);
                }
            }
        }
    }

    protected function update($structure)
    {
        $this->stateStructure = self::merge($this->stateStructure, $structure);
        foreach ($this->stateStructure as $key => $default) {
            if (!array_key_exists($key, $this->state)) {
                $this->state[$key] = $default;
            }
        }
    }

    public function build($props)
    {
        $state = self::define($this->state, $this->stateStructure);
        $this->render($props, ...$state);
    }
}
