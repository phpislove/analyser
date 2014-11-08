<?php namespace Phpislove\Analyser;

class PSLOC {

    /**
     * @param string $filePath
     * @return integer
     */
    public function count($filePath)
    {
        $lines = file($filePath, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

        return count(array_filter($lines, [$this, 'isNotComment']));
    }

    /**
     * @param string $line
     * @return boolean
     */
    protected function isNotComment($line)
    {
        foreach (['#', '*', '//', '/*'] as $commentPrefix)
        {
            if (strpos(trim($line), $commentPrefix) === 0)
            {
                return false;
            }
        }

        return true;
    }

}
