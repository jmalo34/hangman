<?php
    //DEPENDENCIES
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Guess.php";

    //INITIALIZE COOKIE SESSION
    session_start();

    if(empty($_SESSION['play_on']))
    {
        $_SESSION['play_on'] = array();
    }

    //INITIALIZE APPLICATION (n uhh, find out what is the up w this "debug" thang)
    $app = new Silex\Application();
    $app['debug'] = TRUE;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__."/../views"));

    //ROUTES
    // $app->get('/slimeman', function () use ($app)
    // {
    //     return $app['twig']->render('slimeman.html.twig');
    // });

    $app->get('/new_guess', function () use ($app)
    {
        return $app['twig']->render('new_guess.html.twig');
    });

    $app->post('/slimeman', function () use ($app)
    {
        $da_guess = new Guess($_GET['letter']);
        $da_guess->save();

        return $app['twig']->render('slimeman.html.twig', array('new_guess' => $da_guess));
    });

    $app->get('/slimeman', function () use ($app)
    {
        $already = Guess::getAll();

        $chosen_one = Guess::chosenWord();

        $correct_guess = array();

        foreach ($already as $or_nah)
        {
            if ($or_nah->nayorYay($_GET['']))
        }
    })

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
