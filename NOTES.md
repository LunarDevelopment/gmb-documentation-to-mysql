

# URLS 
https://developers.google.com/my-business/reference/rest/v4/accounts.locations#Location

Select JSON from page 
`$($("[id$=SCHEMA_REPRESENTATION]")[0]).find('tbody').text()`


## Scrape the docs 

Jquery to get ENUM values from accompanying Table. ID follows a standardised format. 
`$("[id^=Location\\.DayOfWeek\\.ENUM_VALUES\\.]")`


## Building the basic Parser 

Extend the `Doctrine\Common\Lexer\AbstractLexer` class and implement the `getCatchablePatterns`, `getNonCatchablePatterns`, and `getType methods`. Here is a very simple example lexer implementation named CharacterTypeLexer. It tokenizes a string to T_UPPER, T_LOWER andT_NUMBER tokens:


## Head over to [Regex Tester](https://www.regextester.com/95560)

When looking into parsing JSON with Regex [this answer helped a lot](https://answers.splunk.com/answers/677855/with-regular-expression-how-to-auto-extract-json-e.html). 

So that was a big head start on getting key value pairs with regex, here's the regex for reference: 
   ```regexp 
   (?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(true|false|[-0-9]+[\.]*[\d]*(?=,)|[0-9a-zA-Z\(\)\@\:\,\/\!\+\-\.\$\ \\\']*)(?:\")?
   ``` 
   I then altered it a little to make sure it didn't capture the below regexes but with null group 2 values as: 
   ```regexp 
  (?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(true|false|[-0-9]+[\.]*[\d]*(?=,)|[0-9a-zA-Z\(\)\@\:\,\/\!\+\-\.\$\ \\\\\']*)(?!\s*{|\s*\[)(?:[^\s*{]|[^\s*\[])
   ``` 
It wasn't hard to adapt the above to find matching 1-1 relationships and 1 to many relationships in the pseudo JSON respectively: 
```regexp 
(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?({)(?:\")?
(?:\"|\')([^"]*)(?:\"|\')(?=:)(?:\:\s*)(?:\")?(\[)(?:\")?
```
            

*Example Pseudo-JSON*
```json 
                {
  "name": string,
  "languageCode": string,
  "storeCode": string,
  "locationName": string,
  "primaryPhone": string,
  "additionalPhones": [
    string
  ],
  "address": {
    object(PostalAddress)
  },
  "primaryCategory": {
    object(Category)
  },
  "additionalCategories": [
    {
      object(Category)
    }
  ],
  "websiteUrl": string,
  "regularHours": {
    object(BusinessHours)
  },
  "specialHours": {
    object(SpecialHours)
  },
  "serviceArea": {
    object(ServiceAreaBusiness)
  },
  "locationKey": {
    object(LocationKey)
  },
  "labels": [
    string
  ],
  "adWordsLocationExtensions": {
    object(AdWordsLocationExtensions)
  },
  "latlng": {
    object(LatLng)
  },
  "openInfo": {
    object(OpenInfo)
  },
  "locationState": {
    object(LocationState)
  },
  "attributes": [
    {
      object(Attribute)
    }
  ],
  "metadata": {
    object(Metadata)
  },
  "priceLists": [
    {
      object(PriceList)
    }
  ],
  "profile": {
    object(Profile)
  },
  "relationshipData": {
    object(RelationshipData)
  }
}
```