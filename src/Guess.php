<?php
class Guess
{
    //properties
    private $letter;

    function __construct($a_letter)
    {
        $this->letter = $a_letter;
    }

    //methods
    function setLetter($new_letter)
    {
        $this->letter = $new_letter;
    }

    function getLetter()
    {
        return $this->letter;
    }

    function guessesRemaining()
    {
        count($_SESSION['play_on']['nays']);
        //use this for how many spaces?.. or foreach loops displaying "_" otherwise. count($_SESSION['play_on']['choice']);
                //how many letters are currently in the array of guesses. count em
    }

    function chosenWord()
    {
        $da_words = array('candy', 'yodle', 'dinosaur', 'paper', 'bottle', 'yep', 'drinking', 'tablet', 'monitor', 'candle', 'nope');
        $da_letters = str_split(array_rand(array_flip($da_words)));

        return $da_letters;
    }

    function nayorYay($yesletters, $da_letters)
    {

        //method to match up the arrays from the guess word and chosen word
        //does the letter match any of the letters in the array that the string was split into?
        //is it already in the bank of words guessed thus far? if it matches any of those, return a string telling them to try agian
    }

    function saveYay()
    {
        array_push($_SESSION['play_on']['yays'], $this);
    }

    static function getAll()
    {
        return $_SESSION['play_on'];
    }

    //implement this function after the 7th guess, using  a button labeled play again, linking to new guess page
    static function deleteAll()
    {
        $_SESSION['[play_on'] = array();
    }

}
 ?>
