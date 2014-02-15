<?php
namespace forma\App\Models;

use Phalcon\Mvc\Model\Message as Message;

class Contacts extends \Phalcon\Mvc\Model
{
    protected $id;
    protected $cid;
    protected $uid;
    protected $mdate;
    protected $type;
    protected $name;
    protected $prefix;
    protected $firstname;
    protected $middlename;
    protected $lastname;
    protected $suffix;
    protected $title;
    protected $department;
    protected $company;
    protected $industry;
    protected $sic;
    protected $revenue;
    protected $employees;
    protected $image;
    protected $phone;
    protected $email;
    protected $people;
    protected $im;
    protected $social;
    protected $url;
    protected $rss;
    protected $dates;
    protected $address;
    protected $notes;
    protected $cdate;

    public function getId() {
        return $this->id;
    }

    private function setId() {
        $this->id = md5('Contact'.time().rand());
    }

    public function getCid() {
        return $this->cid;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function getMdate() {
        return $this->mdate;
    }

    private function setMdate() {
        $mdate = new \DateTime();
        $this->mdate = $mdate->format('Y-m-d H:i:s');
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getMiddlename() {
        return $this->middlename;
    }

    public function setMiddlename($middlename) {
        $this->middlename = $middlename;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getSuffix() {
        return $this->suffix;
    }

    public function setSuffix($suffix) {
        $this->suffix = $suffix;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDepartment() {
        return $this->department;
    }

    public function setDepartment($department) {
        $this->department = $department;
    }

    public function getCompany() {
        return $this->company;
    }

    public function setCompany($company) {
        $this->company = $company;
    }

    public function getIndustry() {
        return $this->industry;
    }

    public function setIndustry($industry) {
        $this->industry = $industry;
    }

    public function getSic() {
        return $this->sic;
    }

    public function setSic($sic) {
        $this->sic = $sic;
    }

    public function getRevenue() {
        return $this->revenue;
    }

    public function setRevenue($revenue) {
        $this->revenue = $revenue;
    }

    public function getEmployees() {
        return $this->employees;
    }

    public function setEmployees($employees) {
        $this->employees = $employees;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPeople() {
        return $this->people;
    }

    public function setPeople($people) {
        $this->people = $people;
    }

    public function getIm() {
        return $this->im;
    }

    public function setIm($im) {
        $this->im = $im;
    }

    public function getSocial() {
        return $this->social;
    }

    public function setSocial($social) {
        $this->social = $social;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getRss() {
        return $this->rss;
    }

    public function setRss($rss) {
        $this->rss = $rss;
    }

    public function getDates() {
        return $this->dates;
    }

    public function setDates($dates) {
        $this->dates = $dates;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }

    public function getCdate() {
        return $this->cdate;
    }

    public function setCdate() {
        $cdate = new \DateTime();
        $this->cdate = $cdate->format('Y-m-d H:i:s');
    }
}