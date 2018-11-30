<?php

require_once realpath(__DIR__ . '/component.php');

class Element extends Component
{

    private $attributes;
    private $attributesList;

    private static function toString($value)
    {
        switch (gettype($value)) {
            case 'array':
                return implode(' ', $value);
            default:
                return $value;
        }
    }

    public function __construct($props)
    {
        parent::__construct($props);
        $this->attributes = array();
        $this->attributesList = array('class', 'id', 'name');
        [$attributesList, $attributes] = self::extract($props, ['attributesList'=>array(), 'attributes'=>array()]);
        $this->addAttributesNames(...$attributesList);
        $this->addAttributes($attributes);
    }

    public function addAttributes($attributes)
    {
        $this->attributes = $this->getAttributes($attributes);
    }

    public function addAttributesNames(...$names)
    {
        $this->attributesList = array_unique(array_merge($this->attributesList, $names));
    }

    protected function attributes($props)
    {
        [$attributes] = self::extract($props, ['attributes'=>array()]);
        $list = $this->getAttributes($attributes);
        $str = ' ';
        foreach ($list as $name => $value) {
            $str .= $name . '="' . self::toString($value) . '" ';
        }
        echo $str;
    }

    private function getAttributes($attributes = array())
    {
        $data = self::merge($this->attributes, $attributes);
        foreach ($data as $attr => $val) {
            if (!in_array($attr, $this->attributesList)) {
                unset($data[$attr]);
            }
        }
        return $data;
    }
}
