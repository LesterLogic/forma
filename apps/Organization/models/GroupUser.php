<?php
namespace forma\Organization\Models;

class GroupUser extends \Phalcon\Mvc\Model
{
    protected $gid;
    protected $uid;

    public function initialize() {
        $this->setSource("Organization_GroupUser");
        $this->belongsTo("gid", "Group", "id");
        $this->hasMany("uid", "User", "id");
    }

    public function getGid() {
        return $this->gid;
    }

    public function setGid($gid) {
        if (strlen($gid) != 32) {
            throw new \InvalidArgumentException('Incorrect field length for "gid".');
        }
        $this->gid = $gid;
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
}