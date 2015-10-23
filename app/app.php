<?php
    //DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Guess.php";

    //INITIALIZE COOKIE SESSION
    session_start();

    $da_words = array('candy', 'yodle', 'dinosaur', 'paper', 'bottle', 'yep', 'drinking', 'tablet', 'monitor', 'candle', 'nope');
    $first_one = array('0');
    $winning_letters = str_split(array_rand(array_flip($da_words)));
    $winning_letters = array_merge($first_one, $winning_letters);
    $winning_instances = array();
    foreach ($winning_letters as $w)
    {
        array_push($winning_instances, ($w = new Guess(current($winning_letters))), (next($winning_letters)));
    }
    //
    // if(empty($_SESSION['play_on']))
    // {
        $_SESSION['play_on']['wins'] = $winning_instances;
        $_SESSION['play_on']['yays'] = array('k', 'c', 'd', 'e', 'o', 'r', 'a', 'b', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'p', 's', 't', 'u', 'w', 'y');
        $_SESSION['play_on']['nays'] = array();
    // }


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

        return $app['twig']->render('slimeman.html.twig', array('matched_letters' => $matched_letters));
    });

    $app->get('/new_guess', function () use ($app)
    {
        return $app['twig']->render('new_guess.html.twig');
    });

    $app->post('/new_guess', function () use ($app)
    {
        $new_letter = new Guess($_POST['letter']);
        $prize_letters = Guess::getWins();

            if (in_array($new_letter, $prize_letters))
            {
                $new_letter->saveYay();
            }
            else
            {
                $new_letter->saveNay();
            }
            var_dump($prize_letters);

        return $app['twig']->render('slimeman.html.twig', array('new_letter' => $new_letter));
    });

    return $app;
 ?>
