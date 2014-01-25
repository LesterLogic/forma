<?php
namespace forma\App\Models;

class User extends \Phalcon\Mvc\Model
{
	public $id;
	public $username;
	public $password;
	public $displayname;
	public $ldate;
	public $active;
	public $cdate;

    public function initialize() {
        $this->hasMany("id", "forma\App\Models\Organization", "uid");
        $this->hasManyToMany("id", "forma\App\Models\Organization_GroupUser", "uid", "gid", "forma\App\Models\Organization_Group", "id");
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
		$this->name = $name;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		if (strlen($password) < 1 || strlen($password) > 511) {
			throw new \InvalidArgumentException('Incorrect field length for "password".');
		}
		$this->password = $password;
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
		$this->ldate = new DateTime();
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
		$this->cdate = new DateTime();
	}
}
