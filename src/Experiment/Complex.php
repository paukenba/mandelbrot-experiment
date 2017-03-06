<?php
namespace Experiment;

class Complex
{
    public $r;
    public $i;

    /**
     * @param float $r
     * @param float $i
     */
    public function __construct($r = 0.0, $i = 0.0)
    {
        $this->r = $r;
        $this->i = $i;
    }

    public function add(Complex $c)
    {
        $this->r += $c->r;
        $this->i += $c->i;
        return $this;
    }

    public function sub(Complex $c)
    {
        return $this->add($c->negate());
    }

    public function negate()
    {
        $this->r = -$this->r;
        $this->i = -$this->i;
        return $this;
    }

    public function divide($number)
    {
        $this->r /= $number;
        $this->i /= $number;
        return $this;
    }

    public function multiple($number)
    {
        $this->r *= $number;
        $this->i *= $number;
        return $this;
    }

    public function sqr()
    {
        $r = $this->r * $this->r - $this->i * $this->i;
        $this->i = $this->i * $this->r * 2;
        $this->r = $r;
        return $this;
    }

    public function __toString()
    {
        return $this->r . ($this->i < 0 ? ' - ' : ' + ') . abs($this->i) . 'i';
    }

    public function length()
    {
        return sqrt($this->i * $this->i + $this->r * $this->r);
    }
}
