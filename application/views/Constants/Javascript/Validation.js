goog.require('goog.dom');
goog.require('goog.json');
goog.require('goog.proto2.ObjectSerializer');
goog.require('goog.string.StringBuffer');
goog.require('i18n.phonenumbers.AsYouTypeFormatter');
goog.require('i18n.phonenumbers.PhoneNumberFormat');
goog.require('i18n.phonenumbers.PhoneNumberType');
goog.require('i18n.phonenumbers.PhoneNumberUtil');
goog.require('i18n.phonenumbers.PhoneNumberUtil.ValidationResult');

/*
Validates the given date string using a regex pattern
also makes sure that the year, month and day isn't above 
returns bool
*/
function validateDate(date){
    var pattern = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
    var dateArray = date.split("/");
    
    //valid year
    if(!validateYear(dateArray[2])) return false;
    //valid month
    if(dateArray[1] > 12) return false;
    //valid day
    //months with 31 days
    if(dateArray[1] == 1 || dateArray[1] == 3 || dateArray[1] == 5 || dateArray[1] == 7 || dateArray[1] == 8 || dateArray[1] == 10 || dateArray[1] == 12){
        if(dateArray[0] > 31) return false;
    }
    //months with 30 days
    if(date[1] == 4 || date[1] == 6 || date[1] == 9 || date[1] == 11){
        if(dateArray[0] > 30) return false;
    }
    //febuary, non leap year
    if(dateArray[1] == 2 && dateArray[2] % 4 != 0){
        if(dateArray[0] > 28) return false;
    }
    //febuary, leap year
    if(dateArray[1] == 2 && dateArray[2] % 4 == 0 && dateArray[2] % 400 == 0){
        if(dateArray[0] > 29)return false;
    }
    return pattern.test(date);
}

/*
validates a given year
Makes sure given year is smaller or equal to current year
Returns bool
*/
function validateYear(year){
    if(year > new Date().getFullYear()) return false;
    else return true;
}

/*
Validates the given email string using a regex pattern
Returns bool
*/
function validateEmail(email){
    var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
    return pattern.test(email);
}

/*
validates phone numbers
returns strings: "valid", "INVALID_COUNTRY_CODE", "TOO_SHORT" or "TOO_LONG
*/
function validatePhoneNumber(number){
    var phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
    var number = phoneUtil.parseAndKeepRawInput(phoneNumber, regionCode);
    var isPossible = phoneUtil.isPossibleNumber(number);
    
    if(!isPossible){
        var PNV = i18n.phonenumbers.PhoneNumberUtil.ValidationResult;
        
        switch (phoneUtil.isPossibleNumberWithReason(number)) {
            case PNV.INVALID_COUNTRY_CODE:
                return ('INVALID_COUNTRY_CODE');
            case PNV.TOO_SHORT:
                return ('TOO_SHORT');
            case PNV.TOO_LONG:
                return ('TOO_LONG');
        }
    }
    else{
        var isNumberValid = phoneUtil.isValidNumber(number);
        if(isNumberValid) return "valid";
    }
}

/*
takes a string of the selections delimetered using semicolons and the min/max number allowed to be selected
Then checks to see that the number selected falls within the range.
Returns bool
*/
function validateNumberOfSelections(selections, min, max){
    var split = selections.split(";");
    console.log(split.length);
    if(split.length > max)return false;
    if(split.length < min)return false;
    else return true;
}