<?php

class validate
{
    private $_passed = false,
        $_errors = array(),
        $_db    = null;

    public function __construct()
    {
        $this->_db = db::getInstance();
    }
    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                if ($rule === 'required' && empty($value)) {
                    $this->addError("$item Is Required");
                } else if (!empty($value)) {
                    switch ($rule): case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("$item Must Be Minimum Of $rule_value");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("$item Must Be Maximum Of $rule_value");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("$rule_value Must Match $item");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("$item Already Exist");
                            }
                            break;
                    endswitch;
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }
    public function passed()
    {
        return $this->_passed;
    }
}
