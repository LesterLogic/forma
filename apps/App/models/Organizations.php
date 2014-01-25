<?php
namespace forma\App\Models;

class Organization extends \Phalcon\Mvc\Model
{
    public $id;
    public $uid;
    public $name;
    public $active;
    public $cdate;

    public function initialize() {
        $this->hasMany("id", "forma\App\Models\Organization_Group", "oid");
    }

	public function getId() {
		return $this->id;
	}

    private function setId() {
        $this->id = md5('Organization'.time().rand());
    }

	public function getUid() {
		return $this->uid;
	}

    public function setUid($uid) {
		if (strlen($uid) != 32) {
			throw new \InvalidArgumentException('Incorrect field length for "uid".');
		}
		$this->uid = $uid;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
		if (strlen($name) < 1 || strlen($name) > 511) {
			throw new \InvalidArgumentException('Incorrect field length for "name".');
		}
		$this->name = $name;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        if (strlen($active) != 1) {
			throw new \InvalidArgumentException('Incorrect field length for "active".');
		}
        $this->active = $active;
    }

    public function getCdate() {
        return $this->cdate();
    }
}