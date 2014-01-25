<?php
namespace forma\App\Models;

class Organization_Group extends \Phalcon\Mvc\Model
{
    public $id;
    public $oid;
    public $pid;
    public $name;

    public function initialize() {
        $this->belongsTo("oid", "forma\App\Models\Organization", "id");
        $this->belongsTo("id", "forma\App\Models\Organization_Group", "pid");
        $this->hasManyToMany("id", "forma\App\Models\Organization_GroupUser", "gid", "uid", "forma\App\Models\User");
    }

    public function getId() {
        return $this->id;
    }

    private function setId() {
        $this->id = md5('Organization_Group'.time().rand());
    }

    public function getOid() {
        return $this->oid;
    }

    public function setOid($oid) {
		if (strlen($oid) != 32) {
			throw new \InvalidArgumentException('Incorrect field length for "oid".');
		}
		$this->oid = $oid;
    }

    public function getPid() {
        return $this->pid;
    }

    public function setPid($pid) {
		if (strlen($pid) != 32) {
			throw new \InvalidArgumentException('Incorrect field length for "pid".');
		}
		$this->pid = $pid;
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
}