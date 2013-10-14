<?php

class Kiva_Sniffs_Functions_DisallowedFunctionsSniff implements PHP_CodeSniffer_Sniff {

	public $supportedTokenizers = array('PHP');

	public function register() {
	    return array(T_STRING);
	}

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		static $reported = array();

		$all_tokens = $phpcsFile->getTokens();

		if ($all_tokens[$stackPtr]['content'] == 'elpr') {
			$lno = $all_tokens[$stackPtr]['line'];
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('elpr() function left in code', $stackPtr);
			}
		} else if ($all_tokens[$stackPtr]['content'] == 'time') {
			$lno = $all_tokens[$stackPtr]['line'];
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('Usage of time() forbidden. Use Bc_Date::now()->asTimestamp() instead.', $stackPtr);
			}
		}
	}
}
