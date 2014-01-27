<?php
namespace forma\App\Models;

use forma\App\Models\OrganizationGroups,
    forma\App\Models\OrganizationGroupUsers as GroupUser,
    Phalcon\Mvc\Model\Message as Message;

class Organizations extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $uid;
    protected $name;
    protected $active;
    protected $cdate;

    public function initialize() {
        $this->hasMany("id", "forma\App\Models\OrganizationGroups", "oid");
    }

    public function beforeValidationOnCreate() {
        $retVal = TRUE;
        $this->setId();
        $this->setActive(1);
        $this->setCdate(date('Y-m-d H:i:s', time()));

        $rootGroup = new OrganizationGroups();
        $rootGroup->setOid($this->id);
        $rootGroup->setPid(0);
        $rootGroup->setName('Root');
        if ($rootGroup->save() !== FALSE) {
            $defaultGroupNames = Array(
                'Administrators', 'Editors', 'Viewers'
            );
            foreach ($defaultGroupNames as $name) {
                $group = new OrganizationGroups();
                $group->setOid($this->id);
                $group->setPid($rootGroup->getId());
                $group->setName($name);
                $group->save();
            }
        } else {
            $this->appendMessage(new Message('Unable to create root group.'));
            $retVal = FALSE;
        }

        return $retVal;
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

    public function setCdate() {
        $cdate = new \DateTime();
        $this->cdate = $cdate->format('Y-m-d H:i:s');
    }
}