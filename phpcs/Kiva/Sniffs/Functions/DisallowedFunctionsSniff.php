<?php

class Kiva_Sniffs_Functions_DisallowedFunctionsSniff implements PHP_CodeSniffer_Sniff {

	public $supportedTokenizers = array('PHP');

	public function register() {
	    return array(T_STRING);
	}

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		static $reported = array();

		$all_tokens = $phpcsFile->getTokens();

		$lno = $all_tokens[$stackPtr]['line'];
		if ($all_tokens[$stackPtr]['content'] == 'elpr') {
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('elpr() function left in code', $stackPtr);
			}
		} else if ($all_tokens[$stackPtr]['content'] == 'time') {
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('Usage of time() forbidden. Use Bc_Date::now()->asTimestamp() instead.', $stackPtr);
			}
		} else if ($all_tokens[$stackPtr]['content'] == 'error_log') {
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('Usage of error_log() forbidden. Use Bc_Logger instead with the right channel.', $stackPtr);
			}
		}
	}
}
