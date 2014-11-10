<?php namespace Phpislove\Analyser;

use RecursiveDirectoryIterator;

class PSLOC {

    /**
     * @param string $path
     * @return integer
     */
    public function directory($path)
    {
        $files = new RecursiveDirectoryIterator($path);
        $psloc = 0;

        $gitIgnore = $this->parseGitIgnoreFile($path);

        $isIgnored = function($path) use($gitIgnore)
        {
            foreach ($gitIgnore as $prefix)
            {
                if (strpos(ltrim($path, '/'), $prefix) === 0)
                {
                    return false;
                }
            }

            return true;
        };

        foreach ($files as $file)
        {
            if (in_array($file->getFilename(), ['..', '.'])
                or $file->isDir() or $isIgnored($file->getRealPath()))
            {
                continue;
            }

            $psloc += $this->count($file->getRealPath());
            // in case you want count(path, language)
            // $language = (new ProjectInfo($path))->getLanguage();
        }

        return $psloc;
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
