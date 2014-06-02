<?php

use Illuminate\Support\MessageBag;

class BaseForm {

	/**
	 * @var  Illuminate\Support\MessageBag
	 */
	protected $errors;

	/**
	 * @var  array
	 */
	protected $inputData;

	/**
	 * @var  boolean
	 */
	protected $passes;

	/**
	 * @var  Validator
	 */
	protected $validator;


	public function __construct() {
		$this->inputData = Input::all();

		if ($old = Input::old('errors')) {
			$this->errors = $old;
		} else {
			$this->errors = new MessageBag();
		}
	}


	protected function beforeValidation() {}


	/**
	 * @param   string  $key
	 * @return  mixed
	 */
	public function getError($key) {
		return $this->getErrors()->first($key);
	}


	/**
	 * @return  mixed
	 */
	public function getErrors() {
		return $this->errors;
	}


	/**
	 * @return  array
	 */
	public function getInputData() {
		return $this->inputData;
	}


	/**
	 * @return  boolean
	 */
	public function hasErrors() {
		return $this->getErrors()->any();
	}


	/**
	 * @return  boolean
	 */
	public function isPosted() {
			return Input::server('REQUEST_METHOD') == 'POST';
	}


	/**
	 * Check form validity.
	 *
	 * @param   array  $rules
	 * @return  boolean
	 *
	 * @throws  NoValidationRulesFoundException
	 */
	public function isValid(array $rules) {
		$this->beforeValidation();

		$validator = Validator::make($this->getInputData(), $rules);

		$this->errors = $validator->errors();
		$this->passes = $validator->passes();

		return $this->passes;
	}


	/**
	 * @param  MessageBag  $errors
	 */
	public function setErrors(MessageBag $errors) {
		$this->errors = $errors;
	}

}
