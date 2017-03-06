<?php
namespace Experiment;

class Mandelbrot
{
    /**
     * @var int
     */
    private $xResolution;

    /**
     * @var int
     */
    private $yResolution;

    /**
     * @param int $xResolution
     * @param int $yResolution
     */
    public function __construct($xResolution, $yResolution)
    {
        $this->xResolution = $xResolution;
        $this->yResolution = $yResolution;
    }

    /**
     * @param Complex $from
     * @param Complex $to
     * @param int     $iteration
     * @return string
     */
    public function render(Complex $from, Complex $to, $iteration = 100)
    {
        $ret = '';
        for ($y = 0; $y <= $this->yResolution; $y++) {
            for ($x = 0; $x <= $this->xResolution; $x++) {
                $ch = abs($to->i - $from->i);
                $cw = abs($to->r - $from->r);
                $c = new Complex($from->r + $x * $cw/$this->xResolution, $from->i - $y * $ch/$this->yResolution);
                $ret .= $this->dot($c, $iteration);
            }
            $ret .= PHP_EOL;
        }
        return $ret;
    }

    /**
     * @param Complex $c
     * @param int     $iteration
     * @return int
     */
    public function dot($c, $iteration)
    {
        $i = 0;
        $f = new Complex(0, 0);
        for (; ; $i++) {
            if ($f->length() > 2) {
                break;
            }
            $f = $f->sqr()->add($c);
            if ($i > $iteration || $f->length() < 0.0000001) {
                return ' ';
            }
        }
        return "\033[48;5;".$this->colorOf($i)."m \033[0m";
    }

    private function colorOf($iteration)
    {
        $ct = [
            196,202,208,214,220,226,190,154,118,82,46,47,48,49,50,51,45,39,33,27,21,57,93,129,165,201,200,199,198,197
        ];
        return $ct[$iteration % count($ct)];
    }
}
