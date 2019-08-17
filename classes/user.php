<?php
class user
{
    private $_db,
        $_data,
        $_sessionName,
        $_isloggedIn;

    public function __construct($user = null)
    {
        $this->_db = db::getInstance();
        $this->_sessionName = config::get('session/session_name');
        if (!$user) {
            if (session::exists($this->_sessionName)) {
                $user = session::get($this->_sessionName);
                if ($this->find($user)) {
                    $this->_isloggedIn = true;
                } else {
                    // output process
                }
            } else {
                $this->find($user);
            }
        }
    }
    public function create($fields = array())
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an new account');
        }
    }
    public function find($user = null)
    {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }

            return false;
        }
    }

    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isloggedIn()) {
            $id = $this->data()->id;
        }

        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There Was Error While Updateing Profile');
        }
    }

    public function login($username = null, $password = null)
    {
        $user = $this->find($username);
        if ($user) {
            if ($this->data()->password === hash::make($password, $this->data()->salt)) {
                session::put($this->_sessionName, $this->data()->id);
                return true;
            }
        }
        return false;
    }
    public function data()
    {
        return $this->_data;
    }
    public function isloggedIn()
    {
        return $this->_isloggedIn;
    }
}
