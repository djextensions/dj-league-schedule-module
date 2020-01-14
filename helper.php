<?php
/**
 * @version $Id$
 * @package DJ-Events
 * @copyright Copyright (C) 2012 DJ-Extensions.com LTD, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Michal Olczyk - michal.olczyk@design-joomla.eu
 *
 * DJ-Events is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-Events is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-Events. If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
// no direct access
defined('_JEXEC') or die ('Restricted access');

class modDJLeagueScheduleHelper
{
	static function getItems(&$params) {
    	
    	$items = array();
    	
    	JModelLegacy::addIncludePath(JPATH_BASE.'/components/com_djleague/models', 'DJLeagueModel');
    	$model = JModelLegacy::getInstance('Schedule', 'DJLeagueModel', array('ignore_request'=>true));
    	
    	$tournament = $params->get('tournament', $params->get('league'));
    	$model->setState('filter.tournament', $tournament);
    	
    	$season = $params->get('season', 1);
    	$model->setState('filter.season', $season);
    	
    	$team = $params->get('team');
    	$model->setState('filter.team', $team);
		
		if($params->get('type', 'future') == 'future') {
			
			$from = JFactory::getDate()->format('Y-m-d H:i');
			$model->setState('filter.from', $from);
			
			$model->setState('filter.status', 0);
			
			$model->setState('list.ordering', 'a.date');
			$model->setState('list.direction', 'asc');
			
		} else {
			
			$to = JFactory::getDate()->format('Y-m-d H:i');
			$model->setState('filter.to', $to);
			
			$model->setState('filter.status', 1);
				
			$model->setState('list.ordering', 'a.date');
			$model->setState('list.direction', 'desc');
		}
		
		$model->setState('list.start', 0);
		$model->setState('list.limit', $params->get('limit', 0));
				
		$items = $model->getItems();
		
		return $items;
    }
	
}
