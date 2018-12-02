<?php

require_once realpath(__DIR__ . '/../../component.php');

class Element extends Component
{

    public static function attributes($attributes)
    {
        if (count($attributes) > 0) {
            $str = ' ';
            foreach ($attributes as $name => $value) {
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
        $this->update([ 'attributes'=>array() ]);
    }

    public function addAttributes($attributes)
    {
        $this->setState([ 'attributes'=>$attributes ]);
    }

    public function addClasses(...$classes)
    {
        $this->addAttributes([ 'class'=>$classes ]);
    }
}
