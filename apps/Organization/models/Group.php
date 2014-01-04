<?php
namespace forma\Organization\Models;

class Group extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $oid;
    protected $pid;
    protected $name;

    public function initialize() {
        $this->setSource("Organization_Group");
        $this->belongsTo("id", "Company", "oid");
        $this->belongsTo("id", "Group", "pid");
        $this->hasManyToMany("id", "GroupUser", "gid", "uid", "User", "id");
    }

    public function getId() {
        return $this->id;
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