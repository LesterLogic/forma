<?php
namespace forma\App\Models;

class Users extends \Phalcon\Mvc\Model
{
	protected $id;
	protected $username;
	protected $password;
	protected $displayname;
	protected $ldate;
	protected $active;
	protected $cdate;

    public function initialize() {
        $this->hasMany("id", "forma\App\Models\Organizations", "uid", Array('alias'=>'orgs'));
        $this->hasManyToMany("id", "forma\App\Models\Organization_GroupUsers", "uid", "gid", "forma\App\Models\Organization_Groups", "id", Array('alias'=>'groups'));
    }

    public function beforeValidationOnCreate() {
        $retVal = true;
        $this->setId();
        $this->setActive(1);
        $this->setCdate();
        $this->setLdate();

        if (Users::findFirst('username="'.$this->getUsername().'"') !== false) {
            $retVal = false;
        }

        return $retVal;
    }

	public function getId() {
		return $this->id;
	}

    private function setId() {
        $this->id = md5('User'.time().rand());
    }

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($name) {
		if (strlen($name) < 1 || strlen($name) > 255) {
			throw new \InvalidArgumentException('Incorrect field length for "name".');
		}
		$this->username = $name;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
        $config = $this->getDI()->get('config');
		if (strlen($password) < 1 || strlen($password) > 511) {
			throw new \InvalidArgumentException('Incorrect field length for "password".');
		}
		$this->password = crypt($password, $config['security']['encryption_key']);
	}

	public function getDisplayname() {
		return $this->displayname;
	}

	public function setDisplayname($name) {
		if (strlen($name) < 1 || strlen($name) > 511) {
			throw new \InvalidArgumentException('Incorrect field length for "displayname".');
		}
		$this->displayname = $name;
	}

	public function getLdate() {
		return $this->ldate;
	}

	public function setLdate() {
        $ldate = new \DateTime();
        $this->ldate = $ldate->format('Y-m-d H:i:s');
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function getCdate() {
		return $this->cdate;
	}

	public function setCdate() {
        $cdate = new \DateTime();
        $this->cdate = $cdate->format('Y-m-d H:i:s');
	}
}
