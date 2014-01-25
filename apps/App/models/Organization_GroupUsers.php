<?php
namespace forma\App\Models;

class Organization_GroupUser extends \Phalcon\Mvc\Model
{
    public $gid;
    public $uid;

    public function initialize() {
        $this->belongsTo("gid", "forma\App\Models\Organization_Group", "id");
        $this->belongsTo("uid", "forma\App\Models\User", "id");
    }

    public function getGid() {
        return $this->gid;
    }

    public function getUid() {
        return $this->uid;
    }
}