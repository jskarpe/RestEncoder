<?php
namespace Yuav\RestEncoderBundle\Twig;

class FilesizeExtension extends \Twig_Extension
{

    /**
     *
     * @param integer $bytes            
     * @return string
     */
    public function filesize($bytes)
    {
        if ($bytes <= 0) {
            return '0 KB';
        }
        if ($bytes === 1) {
            return '1 byte';
        }
        $mod = 1024;
        $units = array(
            'bytes',
            'KB',
            'MB',
            'GB',
            'TB',
            'PB'
        );
        for ($i = 0; $bytes > $mod && $i < count($units) - 1; ++ $i) {
            $bytes /= $mod;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'filesize' => new \Twig_Filter_Method($this, 'filesize')
        );
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return 'yuav_filesize_extension';
    }
}