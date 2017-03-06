<?php

require_once 'Psr4AutoloaderClass.php';

$autoloader = new Psr4AutoloaderClass();
$autoloader->addNamespace('\Experiment', __DIR__.'/src/Experiment');
$autoloader->register();

$speed = 1.1;

$coord = new \Experiment\Complex(-1.749721929742338571710438695186828716, 0.0000290166477536876274764422704374969315895);

$mandelbrot = new \Experiment\Mandelbrot(100, 40);
$rot = 0;
for ($bound = 4; ; $bound /= $speed) {
    $iterations = min(20000, 100 + sqrt(1/$bound));
    $from = (clone $coord)->add(new \Experiment\Complex(-$bound, $bound));
    $to = (clone $coord)->add(new \Experiment\Complex($bound, -$bound));

    echo "\033[1;1f"; // cursor to top-left corner
    echo $mandelbrot->setRotation($rot+=0.1)->render($from, $to, $iterations);
    usleep(20000);
}
