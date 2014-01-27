<?php
namespace forma\App\Models;

class OrganizationGroupUsers extends \Phalcon\Mvc\Model
{
    public $gid;
    public $uid;

    public function initialize() {
        $this->belongsTo("gid", "forma\App\Models\OrganizationGroups", "id");
        $this->belongsTo("uid", "forma\App\Models\Users", "id");
    }

    public function getGid() {
        return $this->gid;
    }

    public function getUid() {
        return $this->uid;
    }
}