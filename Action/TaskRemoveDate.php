<?php

namespace Kanboard\Plugin\TaskRemoveDate\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Rename Task Title
 *
 * @package action
 * @author  David Morlitz
 */
class TaskRemoveDate extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Automatically remove the task due date when the task is moved to another column');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_MOVE_COLUMN,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'column_id' => t('Column'),
            //'duration' => t('Duration in days'),
            //'color_id' => t('Color'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'task' => array(
                'column_id',
                'project_id',
				'date_due',

            ),
			
        );
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {	if ($data['task']['date_due'] == 0) {
    	$referencetext = "&#9745;" . date('d.m.Y H:i:s', $data['task']['date_due']);
    	} else {
   	 	$referencetext = "&#9745;" . date('d.m.Y H:i:s', $data['task']['date_due']);
		 if ($data['task']['reference'] != "") { $referencetext = $referencetext . " " . $data['task']['reference']; }
    	}		
		
		$values = array(
            'id' => $data['task_id'],
            'date_due' => strtotime("0"),
			'reference' => $referencetext
            //'color_id' => $this->getParam('color_id'),
        );

        return $this->taskModificationModel->update($values, false);
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['task']['column_id'] == $this->getParam('column_id');
    }
}
