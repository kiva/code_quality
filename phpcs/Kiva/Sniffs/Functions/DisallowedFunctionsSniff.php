<?php

class Kiva_Sniffs_Functions_DisallowedFunctionsSniff implements PHP_CodeSniffer_Sniff {

	public $supportedTokenizers = array('PHP');

	private $forbiddenTokens = array(
		 'elpr'                  => 'elpr() function left in code'
		,'time'                  => 'Usage of time() forbidden. Use Bc_Date::now()->asTimestamp() instead.'
		,'strtotime'             => 'Usage of strtotime() forbidden. Use Bc_Date::createFromString()->asTimestamp() instead.'
		,'error_log'             => 'Usage of error_log() forbidden. Use Bc_Logger instead with the right channel.'
		,'extract'               => 'Usage of extract() forbidden.'
		,'session_id'            => 'Usage of session_id() forbidden. Use Bc_Session::getId() instead.'
		,'session_regenerate_id' => 'Usage of session_regenerate_id() forbidden. Use Bc_Session::regenerateId() instead.'
		,'session_name'          => 'Usage of session_name() forbidden. Use Bc_Session::getName() instead.'
		,'session_destroy'       => 'Usage of session_destroy() forbidden. Use Bc_Session::destroy() instead.'
		,'session_unset'         => 'Usage of session_unset() forbidden. Use Bc_Session::clear() instead.'
	);

	public function register() {
	    return array(T_STRING);
	}

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		static $reported = array();

		$all_tokens = $phpcsFile->getTokens();
		$lno = $all_tokens[$stackPtr]['line'];

		foreach ($this->forbiddenTokens as $token => $message) {
			if($all_tokens[$stackPtr]['content'] == $token) {
				if (!isset($reported[$lno])) {
					$reported[$lno] = true;
					$phpcsFile->addError($message, $stackPtr);
				}
			}
		}
	}
}
