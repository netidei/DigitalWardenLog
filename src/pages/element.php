<?php

require_once realpath(__DIR__ . '/component.php');

class Element extends Component
{

    public static function attributes($props)
    {
        [$attributes] = self::define($props, ['attributes'=>array()]);
        if (count($attributes) > 0) {
            $str = ' ';
            foreach ($list as $name => $value) {
                $str .= $name . '="' . self::toString($value) . '" ';
            }
            echo $str;
        }
    }

    private static function toString($value)
    {
        switch (gettype($value)) {
            case 'array':
                return implode(' ', $value);
            default:
                return $value;
        }
    }

    public function __construct($state)
    {
        parent::__construct($state);
        $this->update([
            'attributes'=>array(),
            'attributesList'=>['class', 'id', 'name']
        ]);
    }

    public function addAttributes($attributes)
    {
        $this->setState([ 'attributes'=>$this->getAttributes($attributes) ]);
    }

    public function addClasses(...$classes)
    {
        $this->setState([ 'attributes'=>[ 'class'=>$classes ] ]);
    }

    private function getAttributes($attributes = array())
    {
        $data = self::merge($this['attributes'], $attributes);
        foreach ($data as $key => $val) {
            if (!in_array($key, $this['attributesList'])) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
