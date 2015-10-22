<?php
    //DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Guess.php";

    //INITIALIZE COOKIE SESSION
    session_start();

    $da_words = array('candy', 'yodle', 'dinosaur', 'paper', 'bottle', 'yep', 'drinking', 'tablet', 'monitor', 'candle', 'nope');
    $winning_letters = str_split(array_rand(array_flip($da_words)));
    // $try_it = ar

    if(empty($_SESSION['play_on']))
    {
        $_SESSION['play_on']['wins'] = $winning_letters;
        $_SESSION['play_on']['yays'] = array();
        $_SESSION['play_on']['nays'] = array();
    }


    //INITIALIZE APPLICATION (n uhh, find out what is the up w this "debug" thang)
    $app = new Silex\Application();
    $app['debug'] = TRUE;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

    //ROUTES
    // $app->get('/', function () use ($app)
    // {
    //     return $app['twig']->render('slimeman.html.twig');
    // });

    $app->get('/', function () use ($app)
    {
        //what info do i need to GET?
        //yay letters = then, which letters to display and which ones not to display yet, which message to show, number of chances remaining (how many in nay array), which picture to display
        $winning_letters = Guess::getWins();

        $guessed_letters = Guess::getYays();

        $matched_letters = array();

        foreach ($winning_letters as $w)
        {
            if(in_array($w, $guessed_letters))
            {
                array_push($matched_letters, $w);
             }
             else
             { array_push($matched_colors, '__');
             }
         }

        return $app['twig']->render('slimeman.html.twig', array('matched_letters' => $matched_letters));
    });

    $app->get('/new_guess', function () use ($app)
    {
        return $app['twig']->render('slimeman.html.twig');
    });

    $app->post('/new_guess', function () use ($app)
    {
        $new_letter = new Guess($_POST['letter']);
        $winning_letters = Guess::getWin();

        foreach ($winning_letters as $possible_match)
        {
            if ($possible_match == $new_letter)
            {
                $new_letter->saveYay();
            }
            else
            {
                $new_letter->saveNay();
            }
        }

        return $app['twig']->render('new_guess.html.twig');
    });

    return $app;
 ?>
