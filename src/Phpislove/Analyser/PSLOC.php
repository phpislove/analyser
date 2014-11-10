<?php namespace Phpislove\Analyser;

class PSLOC {

    /**
     * @param string $path
     * @return integer
     */
    public function directory($path)
    {

    }

    /**
     * @param string $filePath
     * @param string|null $language
     * @return integer
     */
    public function count($filePath, $language = null)
    {
        $lines = file($filePath, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

        return count(array_filter($lines, [$this, 'isNotComment']));
    }

    /**
     * @param string $directory
     * @return array
     */
    public function parseGitIgnoreFile($directory)
    {
        if (file_exists($path = $directory.'/.gitignore'))
        {
            return array_map(
                function($line)
                {
                    return trim($line, '/');
                },
                file($path, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES)
            );
        }

        return [];
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
