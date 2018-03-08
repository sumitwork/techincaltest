<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\MailChimp;


class APIController extends Controller {
	
    /**
     * @var \App\Helpers\MailChimp
     */
	private $mailChimp;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct() {

		$key = 'cc75a848004fbd053cc3c228abb1976e-us12';

		$this->mailChimp = new MailChimp($key);
	}


    /**
     * Make MailChimp API Requests
     *
     * @return json
     */
	public function request(Request $request) {

        // validation and all necessary checks have been ommited 
        try {
            
            // make mail chimp API requests
            $httpResponse = $this->mailChimp->request($request->method(), $request->path(), !empty(json_decode($request->getContent(), true)) ? json_decode($request->getContent(), true) : []);
            
            // return response
            return response()->json($httpResponse);
        
        } catch (\Exception $e) {    
            return response()->json($e->getMessage());
        }
	}
}
