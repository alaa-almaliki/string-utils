#String Util

##Validator Util
######Example:
```
/**
 * @param string $value
 * @param array $options
 * @param bool $debug
 * @return bool
 */
StringUtils\Validator::isDate($value, $options = [], $debug = null);
```
######Methods
```
StringUtils\Validator::isDate           // validates date
StringUtils\Validator::isEmail          // validates email
StringUtils\Validator::isFile           // validates file
StringUtils\Validator::isName           // validates human name
StringUtils\Validator::isPassword       // validates password
StringUtils\Validator::isPhoneNumber    // validates phone number
StringUtils\Validator::isText           // validates text
StringUtils\Validator::isTime           // validates time
StringUtils\Validator::isAphabet        // validtes alphabetic string
StringUtils\Validator::isNumeric        // validates numeric string
StringUtils\Validator::isAlnum          // validates alphanumeric string
```
######Options
```
$options = [
       // generic options 
       'min_length' => 10,          // numeric
       'max_length' => 100,         // numeric
       'allow_xml' => false,        // boolean
       // date options
       'date_format' =>'dd/mm/yy',  // string (dd/mm/yy|dd/mm/yyyy|mm/dd/yy|mm/dd/yyyy)
       // file options
       'file_size' => 100,          // numeric
       'allowed_extensions' => 'pdf,xml,csv', // string
       // password options
       'basic_password' => true,    // boolean (true by default) if not provided
       'strict_password' => true,   // boolean
       // phone number options
       'country_code' => 'GB',      // required for phone numbers
       // time options
       'time_format' => 'h:s'       // string 'h:s'|'H:s' by default, ('h:s'|'H:s'|'H:s:i'|'h:s:i')
   ];
```