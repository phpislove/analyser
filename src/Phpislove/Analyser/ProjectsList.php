<?php namespace Phpislove\Analyser;

class ProjectsList {

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var array
     */
    protected $projects = [];

    /**
     * @param string $directory
     * @return ProjectsList
     */
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param string $directory
     * @param string $name
     * @return void
     */
    public function add($directory, $name)
    {
        $this->load();

        $this->projects['projects'][$name] = [
            'path' => $directory,
        ];

        $this->save();
    }

    /**
     * @return void
     */
    protected function load()
    {
        if ( ! file_exists($path = $this->directory.'/projects.json'))
        {
            file_put_contents($path, json_encode([], JSON_PRETTY_PRINT));

            return;
        }

        $this->projects = json_decode(file_get_contents($path), true);
    }

    /**
     * @return void
     */
    protected function save()
    {
        file_put_contents(
            $this->directory.'/projects.json',
            json_encode($this->projects, JSON_PRETTY_PRINT)
        );
    }

}
