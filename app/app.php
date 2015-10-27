<?php
    //DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Guess.php";

    //INITIALIZE COOKIE SESSION
    session_start();

    if(empty($_SESSION['wins']))
    {
        $_SESSION['wins'] = array();
        $_SESSION['yays'] = array();
        $_SESSION['nays'] = array();

    $da_words = array('candy', 'yodle', 'dinosaur', 'paper', 'bottle', 'yep', 'drinking', 'tablet', 'monitor', 'candle', 'nope');
    $winning_letters = str_split(array_rand(array_flip($da_words)));

    foreach ($winning_letters as $w)
    {
        $w = new Guess($w);
        $w->saveWin();
    }
};

    //INITIALIZE APPLICATION (n uhh, find out what is the up w this "debug" thang)
    $app = new Silex\Application();
    $app['debug'] = TRUE;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

    $app->get('/', function () use ($app)
    {
        //what info do i need to GET?
        //yay letters = then, which letters to display and which ones not to display yet, which message to show, number of chances remaining (how many in nay array), which picture to display
        $golden_letters = Guess::getWins();

        $guessed_letters = Guess::getYays();
        $incorrect_guesses = Guess::getNays();

        $matched_letters = array();

        foreach ($golden_letters as $g)
        {
            if(in_array($g, $guessed_letters))
            {
                array_push($matched_letters, $g);
             }
             else
             {
                 array_push($matched_letters, '__');
             }
         }
        //  var_dump($guessed_letters);
        //  var_dump($matched_letters);
        //  var_dump($golden_letters);
echo "<pre>";
print_r($new_letter);
echo "</pre><br>";

echo "<pre>";
print_r($golden_letters);
echo "</pre><br>";

echo "<pre>";
print_r($guessed_letters);
echo "</pre><br>";

echo "<pre>";
print_r($incorrect_guesses);
echo "</pre><br>";

echo "<pre>";
print_r($matched_letters);
echo "</pre><br>";

        return $app['twig']->render('slimeman.html.twig', array('matched_letters' => $matched_letters));
    });

    $app->get('/new_guess', function () use ($app)
    {
        return $app['twig']->render('new_guess.html.twig');
    });

    $app->post('/playing', function () use ($app)
    {
        $new_letter = new Guess($_POST['letter']);
        $golden_letters = Guess::getWins();
                $guessed_letters = Guess::getYays();

            if (in_array($new_letter, $golden_letters))
            {
                $new_letter->saveYay();
            }
            else
            {
                $new_letter->saveNay();
            }

        $incorrect_guesses = Guess::getNays();
        //
        // $matched_letters = array();
        //
        // foreach ($golden_letters as $g)
        // {
        //     if(in_array($g, $guessed_letters))
        //     {
        //         array_push($matched_letters, $g);
        //      }
        //      else
        //      {
        //          array_push($matched_letters, '__');
        //      }
        //  }

echo "<pre>";
print_r($new_letter);
echo "</pre><br>";

echo "<pre>";
print_r($golden_letters);
echo "</pre><br>";

echo "<pre>";
print_r($guessed_letters);
echo "</pre><br>";

echo "<pre>";
print_r($incorrect_guesses);
echo "</pre><br>";

echo "<pre>";
print_r($matched_letters);
echo "</pre><br>";

        return $app['twig']->render('slimeman.html.twig', array('matched_letters' => $matched_letters));
    });

    $app->post("/restart_game", function () use ($app)
    {
        Guess::deleteAll();

        return $app['twig']->render('restart_game.html.twig');
    });

    return $app;
 ?>
