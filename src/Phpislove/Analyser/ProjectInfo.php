<?php namespace Phpislove\Analyser;

class ProjectInfo {

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var array
     */
    protected $info;

    /**
     * @param string $directory
     * @return ProjectInfo
     */
    public function __construct($directory)
    {
        $this->directory = $directory;

        $this->loadInfo();
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->info['language'];
    }

    /**
     * @return array
     */
    public function getPackages()
    {
        if (isset ($this->info['third-party']['packages']))
        {
            return $this->info['third-party']['packages'];
        }

        return [];
    }

    /**
     * @return void
     */
    protected function loadInfo()
    {
        $this->info = json_decode(
            file_get_contents($this->directory.'/analyser-info.json'),
            true
        );
    }

}
