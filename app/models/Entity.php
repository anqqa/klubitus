<?php
use \Illuminate\Database\Eloquent\Builder;


abstract class Entity extends Eloquent {

	/* @TODO: Remove after release */
	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	protected $guarded = [ 'id', 'created', 'created_at', 'modified', 'updated_at' ];

	/** @var  string  Column for latest scope */
	protected $latestColumn = 'id';


	/* TODO: Remove after release */
	public function getDateFormat() {
		return 'U';
	}


	/**
	 * Url slug.
	 *
	 * @return  string
	 */
	public function getSlugAttribute() {
		return implode('-', array($this->id, Text::slug($this->name)));
	}


	/**
	 * Scope: latest.
	 *
	 * @param   Builder  $query
	 * @return  Builder
	 * @deprecated
	 */
	public function scopeLatest(Builder $query) {
		return $query->orderBy($this->latestColumn, 'DESC');
	}


//
//	/** @var  array */
//	protected $validationRules = [];
//
//	/** @var  Validator */
//	protected $validator;
//
//
//	/**
//	 * Get validation errors.
//	 *
//	 * @return  array
//	 *
//	 * @throws  NoValidatorInstantiatedException;
//	 */
//	public function getErrors() {
//		if (!$this->validator) {
//			throw new NoValidatorInstantiatedException;
//		}
//
//		return $this->validator->errors();
//	}
//
//
//	/**
//	 * Get rules.
//	 *
//	 * @return  array
//	 */
//	protected function getPreparedRules() {
//		return $this->replaceIdsIfExists($this->validationRules);
//	}
//
//
//	/**
//	 * Check entity validity.
//	 *
//	 * @return  boolean
//	 *
//	 * @throws  NoValidationRulesFoundException
//	 */
//	public function isValid() {
//		if (!isset($this->validationRules)) {
//			throw new NoValidationRulesFoundException('No validation rule array defined in class ' . get_called_class());
//		}
//
//		$this->validator = Validator::make($this->getAttributes(), $this->getPreparedRules());
//
//		return $this->validator->passes();
//	}
//
//
//	/**
//	 * Replace primary key ids.
//	 *
//	 * @param   array  $rules
//	 * @return  array
//	 */
//	protected function replaceIdsIfExists(array $rules) {
//		$newRules = [];
//
//		foreach ($rules as $key => $rule) {
//			if (str_contains($rule, '<id>')) {
//				$replacement = $this->exists ? $this->getAttribute($this->primaryKey) : '';
//				$rule        = str_replace('<id>', $replacement, $rule);
//			}
//
//			array_set($newRules, $key, $rules);
//		}
//
//		return $newRules;
//	}
}

