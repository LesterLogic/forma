<?php
namespace forma\Organization\Models;

class Organization extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $uid;
    protected $name;
    protected $active;
    protected $cdate;

    public function getId() {
        return $this->id;
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
        $this->active = $active;
    }

	public function getCdate() {
		return $this->cdate;
	}

	public function setCdate() {
		$this->cdate = new DateTime();
	}
}