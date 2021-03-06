<?php
namespace forma\App\Forms\login;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Check,
    Phalcon\Forms\Element\Textarea,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\File,
    Phalcon\Forms\Element\Date,
    Phalcon\Forms\Element\Numeric,
    Phalcon\Forms\Element\Submit,
    Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Identical,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\ExclusionIn,
    Phalcon\Validation\Validator\InclusionIn,
    Phalcon\Validation\Validator\Regex,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Between,
    Phalcon\Validation\Validator\Confirmation;

class CreateForm extends Form
{
    public function initialize() {
        $this->setEntity($this);

        $loginUsername = new Text("login-username");
        $loginUsername->setLabel('Username: ');
        $loginUsername->setAttribute('placeholder', 'Required');
        $loginUsername->addValidator(new PresenceOf(Array(
            'message'=>'Username is required.'
        )));

        $loginPassword = new Password("login-password");
        $loginPassword->setLabel('Password: ');
        $loginPassword->setAttribute('placeholder', 'Required');
        $loginPassword->addValidator(new PresenceOf(Array(
            'message'=>'Password is required.'
        )));

        $loginDisplay = new Text("login-display");
        $loginDisplay->setLabel('Display Name: ');

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        )));

        //$this->add($csrf);
        $this->add($loginUsername);
        $this->add($loginPassword);
        $this->add($loginDisplay);
        $this->add(new Submit("Create", Array('class'=>'button button-green')));
    }

    public function getCsrf() {
        return $this->security->getToken();
    }
}