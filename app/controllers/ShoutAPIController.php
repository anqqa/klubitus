<?php
use Dingo\Api\Exception\StoreResourceFailedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ShoutAPIController extends BaseAPIController {

	/** @var  ShoutRepository */
	protected $shouts;


	/**
	 * @param  ShoutRepository  $shouts
	 */
	public function __construct(ShoutRepository $shouts) {
		$this->shouts = $shouts;
	}


	/**
	 * API: Latest shouts.
	 */
	public function index() {
		return $this->shouts->getLatest(min(100, abs((int)\Input::get('limit', 100))), 'id', 'user');
	}


	/**
	 * API: Send shout.
	 */
	public function store() {
		if (!Auth::check()) {
			throw new AccessDeniedHttpException('Must be authenticated.');
		}

		// Validate
		$rules = [
			'shout' => [ 'required' ]
		];

		$payload = Input::only('shout');

		$validator = Validator::make($payload, $rules);

		if ($validator->fails()) {
			throw new StoreResourceFailedException('Could not save shout.', $validator->errors());
		}

		// Shout it
		Shout::create([
			'shout'     => Input::get('shout'),
			'author_id' => Auth::user()->id
		]);
	}

}
