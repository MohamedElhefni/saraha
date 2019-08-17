<?php
class upload
{
    private $_db,
        $_errors = array(),
        $_passed = false,
        $_size = 1048576,
        $file,
        $target_dir,
        $target_file,
        $imageFileType;

    public function __construct($file)
    {
        $this->_db = db::getInstance();
        $this->file = $file;
        $this->target_dir = 'uploads/';
        $this->target_file = $this->target_dir . basename($file['name']);
        $this->imageFileType = strtolower(pathinfo($this->target_file, PATHINFO_EXTENSION));
    }

    public function check($fields)
    {
        foreach ($fields as $item => $rule) {
            switch ($item) {
                case 'size':
                    if ($this->file['size'] > $rule * $this->_size) {
                        $this->addError("file is very large");
                    }
                    break;
                case 'extensions':
                    if (
                        $this->imageFileType != "jpg" && $this->imageFileType != "png" && $this->imageFileType != "jpeg"
                        && $this->imageFileType != "gif"
                    ) {
                        $this->addError("sorry the allowed Extension is jpg, png ,jpeg");
                    }
                    break;
                case 'exists':
                    if ($rule == 'unique') {
                        if (file_exists($this->target_file)) {
                            $this->addError("sorry the file already Exists");
                        }
                    }
                    break;
                case 'image':
                    if ($rule) {
                        if (getimagesize($this->file['tmp_name']) == false) {
                            $this->addError("sorry the file Must Be Valid Image");
                        }
                    }
                    break;
            }
        }

        if (empty($this->_errors)) {
            return $this->_passed = true;
        }
        return $this;
    }

    public function addError($err)
    {
        return $this->_errors[] = $err;
    }
    public function errors()
    {
        return $this->_errors;
    }
    public function passed()
    {
        return $this->_passed;
    }
    public function file()
    {
        return $this->target_file;
    }
}
