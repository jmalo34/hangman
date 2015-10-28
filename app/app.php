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
        $golden_letters = Guess::getWins();

        $guessed_letters = Guess::getYays();

        $matched_letters = array();

        $replacement_letter = new Guess('__');

        foreach ($golden_letters as $g)
        {
            if(in_array($g, $guessed_letters))
            {
                array_push($matched_letters, $g);
            }
            else
            {
                array_push($matched_letters, $replacement_letter);
            }
         }

echo "<pre>";
echo "GOLDEN(WINNING ARRAY) LETTERS <br>";
print_r($golden_letters);
echo "</pre><br>";

echo "<pre>";
echo "GUESSED(YAY ARRAY) LETTERS <br>";
print_r($guessed_letters);
echo "</pre><br>";

echo "<pre>";
echo "MATCHED LETTERS <br>";
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

            if (in_array($new_letter, $golden_letters))
            {
                $new_letter->saveYay();
            }
            else
            {
                $new_letter->saveNay();
            }

echo "<pre>";
echo "NEW LETTER (OBJECT, INSTANCE OF GUESS CLASS) <br>";
print_r($new_letter);
echo "</pre><br>";

echo "<pre>";
echo "GOLDEN(WINNING ARRAY) LETTERS <br>";
print_r($golden_letters);
echo "</pre><br>";

        return $app['twig']->render('play_made.html.twig', array('new_play' => $new_letter));
    });

    $app->post("/restart_game", function () use ($app)
    {
        Guess::deleteAll();

        return $app['twig']->render('restart_game.html.twig');
    });

    return $app;
 ?>
