<?php

namespace core;

class Validator
{
    protected $data;
    protected $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules)
    {
        foreach ($rules as $field => $rule) {
            $ruleArray = explode('|', $rule);

            foreach ($ruleArray as $singleRule) {
                $this->applyRule($field, $singleRule);
            }
        }

        return $this;
    }

    public function fails()
    {
        return !empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    protected function applyRule($field, $rule)
    {
        $params = [];

        if (strpos($rule, ':') !== false) {
            list($rule, $params) = explode(':', $rule, 2);
            $params = explode(',', $params);
        }

        $method = 'validate' . ucfirst($rule);

        if (method_exists($this, $method)) {
            $this->$method($field, $params);
        }
    }

    protected function validateRequired($field)
    {
        if (empty($this->data[$field])) {
            $this->addError($field, 'The ' . $field . ' field is required.');
        }
    }

    protected function validateName($field)
    {
        $name = $this->data[$field];

        if (!preg_match("/^[a-zA-Z ]{2,50}$/", $name)) {
            $this->addError($field, 'Invalid name. It must contain only letters and spaces, and be between 2 and 50 characters long.');
        }
    }

    protected function validateUsername($field)
    {
        $name = $this->data[$field];
        if (!preg_match("/^[a-zA-Z0-9 ]{2,50}$/", $name)) {
            $this->addError($field, 'Invalid name. It must contain only letters, numbers and spaces, and be between 2 and 50 characters long.');
        }
    }

    protected function validateEmail($field)
    {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, 'The ' . $field . ' must be a valid email address.');
        }
    }

    protected function validatePassword($field)
    {
        if (strlen($this->data[$field]) < 8) {
            $this->addError($field, 'The ' . $field . ' must be at least 8 characters long.');
        }
    }

    protected function validateText($field)
    {
        $text = $this->data[$field];
        $textLength = strlen($text);

        if ($textLength < 200 || $textLength > 65000) {
            $this->addError($field, 'The ' . $field . ' must be between 200 and 65000 characters long.');
        }
    }


    protected function validatePrice($field)
    {
        if (!is_numeric($this->data[$field])) {
            $this->addError($field, 'The ' . $field . ' must be a valid numeric value.');
        }
    }

    protected function validateNumber($field)
    {
        if (!is_numeric($this->data[$field])) {
            $this->addError($field, 'The ' . $field . ' must be a valid numeric value.');
        }
    }

    protected function validateFile($field)
    {
        if (!isset($this->data[$field]['error']) || !is_array($this->data[$field])) {
            $this->addError($field, 'Invalid file upload.');
            return;
        }

        $file = $this->data[$field];

        // Check if the file was uploaded without errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->addError($field, 'Error uploading file.');
            return;
        }

        // Check file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            $this->addError($field, 'Invalid file format. Allowed formats: ' . implode(', ', $allowedExtensions));
        }

        // Check file size (max size: 5 MB by default)
        $maxSize = 5242880;
        if ($file['size'] > $maxSize) {
            $this->addError($field, 'File size exceeds the maximum limit of 5 MB.');
        }
    }

    protected function validateAddress($field)
    {
        if (empty($this->data[$field])) {
            $this->addError($field, 'The ' . $field . ' field is required.');
        } elseif (!preg_match("/^[a-zA-Z0-9\s,'-]+$/", $this->data[$field])) {
            $this->addError($field, 'Invalid characters in the ' . $field . ' field.');
        }
    }


    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }
}
