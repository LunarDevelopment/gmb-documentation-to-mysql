<?php
/**
 * Copyright (c) 2019.
 *
 */

/**
 * Created by Lewis Dimmick.
 * Deliver Marketing
 * File: index.php
 * User: Lewis
 * Date: 11/02/2019
 * Time: 15:26
 */
require 'vendor/autoload.php';

use Src\Parser\Extractor\PseudoJsonExtractor;
use Src\Parser\Lexer\PseudoJsonLexer;

$pseudoJsonExtractor = new PseudoJsonExtractor(new PseudoJsonLexer());
$pseudoJson = $pseudoJsonExtractor->getUpperCaseCharacters('1aBcdEfgHiJ12');

print_r($pseudoJson);



