

# URLS 
https://developers.google.com/my-business/reference/rest/v4/accounts.locations#Location

Select JSON from page 
`$($("[id$=SCHEMA_REPRESENTATION]")[0]).find('tbody').text()`


## Building the basic Parser 

Extend the `Doctrine\Common\Lexer\AbstractLexer` class and implement the `getCatchablePatterns`, `getNonCatchablePatterns`, and `getType methods`. Here is a very simple example lexer implementation named CharacterTypeLexer. It tokenizes a string to T_UPPER, T_LOWER andT_NUMBER tokens:



