<?php
class Guess
{
    //PROPERTIES
    private $letter;
    //most current letter guessed
    private $attempts;
    //how many wrong guesses preceded this instance
    private $da_letters;
    //letters being compared to, fro the chosen word
    private $message;

    function __construct($letter, $attempts, $da_letters, $message)
    {
        $this->letter = $letter;
        $this->attempts = $attempts;
        $this->da_letters = $da_letters;
        $this->message = $message;
    }

    //METHODS
    function getLetter()
    {
        return $this->letter;
    }

    function setLetter($new_letter)
    {
        $this->letter = $new_letter;
    }

    function getAttempts()
    {
        $attempts = (count($_SESSION['play_on']['nays']));
        if ($attempts == 0)
        {
            $attempts = 'images/slimeman0.jpg';
        }
        elseif ($attempts == 1)
        {
            $attempts = 'images/slimeman1.jpg';
        }
        elseif ($attempts == 2)
        {
            $attempts = "images/slimeman2.jpg";
        }
        elseif ($attempts == 3)
        {
            $attempts = "images/slimeman3.jpg";
        }
        elseif ($attempts == 4)
        {
            $attempts = "images/slimeman4.jpg";
        }
        elseif ($attempts == 5)
        {
            $attempts = "images/slimeman5.jpg";
        }
        else
        {
            $attempts = "images/slimeman7gameover.jpg";
        }

        return $this->attempts;
    }

    function setAttempts($new_attempts)
    {
        $this->attempts = $new_attempts;
    }

    function getDaLetters()
    {
        $da_letters = ($_SESSION['play_on']['yays']);

        return $da_letters;
    }

    function setDaLetters($new_da_letters)
    {
        $this->da_letters = $new_da_letters;
    }

    function getMessage()
    {
        return ""
    }

    function setMessage($new_message)
    {
        $this->message = $new_message;
    }
    // function nayorYay($yesletters, $da_letters)
    // {
    //     $da_letters =
        //i wanna compare the letter, to the array of letters composing chosen word
        //method to match up the arrays from the guess word and chosen word
        //does the letter match any of the letters in the array that the string was split into?
        //is it already in the bank of words guessed thus far? if it matches any of those, return a string telling them to try agian
    // }

    function matchMaker($letter, $un_letter)
    {
        return ($letter == $un_letter);
    }

    function save()
    {
        array_push($_SESSION['play_on'], $this);
    }
    // static function saveYay()
    // {
    //     array_push($_SESSION['play_on']['yays'], $this);
    // }
    //
    // static function saveNay()
    // {
    //     array_push($_SESSION['play_on']['nays'], $this);
    // }

    static function getAll()
    {
        return $_SESSION['play_on'];
    }

    //implement this function after the 7th guess, using  a button labeled play again, linking to new guess page
    static function deleteAll()
    {
        $_SESSION['play_on'] = array();
    }

}
 ?>
