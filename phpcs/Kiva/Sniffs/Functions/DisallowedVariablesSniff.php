<?php

class Kiva_Sniffs_Functions_DisallowedVariablesSniff implements PHP_CodeSniffer_Sniff {

	public $supportedTokenizers = array('PHP');

	public function register() {
	    return array(T_VARIABLE);
	}

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		static $reported = array();

		$all_tokens = $phpcsFile->getTokens();

		if ($all_tokens[$stackPtr]['content'] == '$_COOKIE') {
			$lno = $all_tokens[$stackPtr]['line'];
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('Accessing $_COOKIE directly is forbidden. Use Bc_Cookie instead.', $stackPtr);
			}
		}
	}
}
