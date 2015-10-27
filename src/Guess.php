<?php
class Guess
{
    //PROPERTIES
    private $letter;
    //most current letter guessed

    function __construct($letter)
    {
        $this->letter = $letter;
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

    function displayMessage()
    {
        $the_winners = $_SESSION['wins'];

        $this->letter = $current_guess;

        if (in_array($current_guess, $the_winners))
            {
                return "Yay! You guessed correctly!";
            }
            else
            {
                return "Try again";
            }
    }

    function chancesRemain()
    {
        $attempts = (count($_SESSION['nays']));
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

        return $attempts;
    }

    function saveWin()
    {
        array_push($_SESSION['wins'], $this);
    }

    function saveYay()
    {
        array_push($_SESSION['yays'], $this);
    }

    function saveNay()
    {
        array_push($_SESSION['nays'], $this);
    }

    static function getWins()
    {
        return $_SESSION['wins'];
    }

    static function getYays()
    {
        return $_SESSION['yays'];
    }

    static function getNays()
    {
        return $_SESSION['nays'];
    }

    //implement this function after the 7th guess, using  a button labeled play again, linking to new guess page
    static function deleteAll()
    {
        $_SESSION['yays'] = array();
        $_SESSION['nays'] = array();
        $_SESSION['wins'] = array();
    }

}
 ?>
