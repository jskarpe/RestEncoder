<?php
namespace Yuav\RestEncoderBundle\Twig;

class SecondsExtension extends \Twig_Extension
{

    public function millisecondsToTime($milliseconds)
    {
        return $this->secondsToTime((int) ($milliseconds / 1000));
    }

    /**
     *
     * @param integer $bytes            
     * @return string
     */
    public function secondsToTime($inputSeconds)
    {
        $then = new \DateTime(date('Y-m-d H:i:s', time() - $inputSeconds));
        $now = new \DateTime(date('Y-m-d H:i:s', time()));
        $diff = $then->diff($now);
        
        $format = array();
        if ($diff->y > 0) {
            $format[] = "%yy";
        }
        if ($diff->m !== 0) {
            $format[] = "%mm";
        }
        if ($diff->d !== 0) {
            $format[] = "%dd";
        }
        if ($diff->h !== 0) {
            $format[] = "%hh";
        }
        if ($diff->i !== 0) {
            $format[] = "%im";
        }
        if ($diff->s !== 0) {
            $format[] = "%ss";
        }
        
        // Use the two biggest parts
        if (count($format) > 1) {
            $format = array_shift($format) . array_shift($format);
        } else {
            $format = array_pop($format);
        }
        
        return $diff->format($format);
    }

    /**
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'seconds_to_time' => new \Twig_Filter_Method($this, 'secondsToTime'),
            'milliseconds_to_time' => new \Twig_Filter_Method($this, 'millisecondsToTime')
        );
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return 'yuav_seconds_extension';
    }
}