<?php
    //DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Guess.php";

    //INITIALIZE COOKIE SESSION
    session_start();

    $da_words = array('candy', 'yodle', 'dinosaur', 'paper', 'bottle', 'yep', 'drinking', 'tablet', 'monitor', 'candle', 'nope');
    $da_letters = str_split(array_rand(array_flip($da_words)));

    if(empty($_SESSION['play_on']))
    {
        $_SESSION['play_on']['yays'] = $da_letters;
        $_SESSION['play_on']['nays'] = array();
    }


    //INITIALIZE APPLICATION (n uhh, find out what is the up w this "debug" thang)
    $app = new Silex\Application();
    $app['debug'] = TRUE;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

    //ROUTES
    $app->get('/', function () use ($app)
    {
        $da_letters = Guess::getDaLetters();

        $letters_matching_guess = array();

        foreach ($da_letters as $possible_match)
        {
            if ($possible_match->matchMaker($_GET['letter'], $possible_match))
            {
                array_push($letters_matching_guess, $possible_match);
            }
        }

        return $app['twig']->render('slimeman.html.twig', array('letters_matching_guess' => $letters_matching_guess));
    });

    $app->get('/new_guess', function () use ($app)
    {
        return $app['twig']->render('new_guess.html.twig');
    });

    $app->post('/', function () use ($app)
    {
        $attempts = count($_SESSION['play_on']['nays'];
        //(i can't use getAttempts method here? if so, how?)

        $da_letters = ($_SESSION['play_on']['yays']);

        $new_guess = new Guess($_GET['letter'], $attempts, $da_letters);

        foreach
        
        }

        return $app['twig']->render('slimeman.html.twig');
    });

    // $app->post('/slimeman', function () use ($app)
    // {
    //     $da_word = Guess::chosenWord();
    //
    //     $da_letters = str_split($da_word);
    //
    //     $da_guess = new Guess($_GET['letter']);
    //
    //     //search da_letters array for da_guess

    //
    //     return $app['twig']->render('slimeman.html.twig')
    //
    // });

    return $app;
 ?>
