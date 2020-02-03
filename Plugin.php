<?php
namespace Kanboard\Plugin\TaskRemoveDate;
use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\TaskRemoveDate\Action\TaskRemoveDate;
class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new TaskRemoveDate($this->container));
    }
    public function getPluginName()
    {
        return 'TaskRemoveDate';
    }

    public function getPluginDescription()
    {
        return t('Remove due date when tasks are moved between columns');
    }

    public function getPluginAuthor()
    {
        return 'Michael Krecek & David Morlitz';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/dmorlitz/kanboard-TaskRemoveDate';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.44';
    }
}
