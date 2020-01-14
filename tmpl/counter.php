<?php
/**
 * @version 2.0.0.stable
 * @package DJ-ImageSlider
 * @subpackage DJ-ImageSlider Component
 * @copyright Copyright (C) 2012 DJ-Extensions.com, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://dj-extensions.com
 * @author email contact@dj-extensions.com
 * @developer Szymon Woronowski - szymon.woronowski@design-joomla.eu
 *
 *
 * DJ-ImageSlider is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DJ-ImageSlider is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DJ-ImageSlider. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// no direct access
defined('_JEXEC') or die ('Restricted access'); 

$now = JFactory::getDate()->toUnix();
?>

<div class="mod_djl_counter djl_theme_<?php echo $cparams->get('theme','bootstrap') ?><?php echo $params->get('show_logo', 1) ? ' show_logo':'' ?>">

	<?php foreach($items as $item) { 
	
		$show_date = ($params->get('show_date') && $item->date != '0000-00-00 00:00:00');
		$show_venue = ($params->get('show_venue') && (!empty($item->venue) || !empty($item->city)));
		?>
		<div class="game_counter">
			
			<?php if(JFactory::getDate($item->date)->toUnix() > $now) { ?>
			<div class="dj-date-counter" data-time="<?php echo JFactory::getDate($item->date)->format('Y-m-d H:i:s') ?>">
				<span><span class="days">00</span></span>
				<span><span class="hours">00</span></span>
				<span><span class="mins">00</span></span>
				<span><span class="secs">00</span></span>
			</div>
			<?php } ?>
			
			<div class="game djl_clearfix">
				<div class="team_home">
					<?php if($params->get('show_logo', 1) && !empty($item->home_logo)) { ?>
						<img class="team_logo" src="<?php echo JURI::root(true).'/'.$item->home_logo ?>" alt="<?php echo htmlspecialchars($item->home_name) ?>" />
					<?php } ?>
					<span class="name">
						<?php echo htmlspecialchars($item->home_name); ?>
					</span>
				</div>
				<div class="vs_score">
				<?php if($item->status == 1) { ?>
					<span class="score"><?php echo $item->score_home .' : '.$item->score_away ?></span>
				<?php } else { ?>
					<span class="vs_sign"><?php echo JText::_('COM_DJLEAGUE_VS_SIGN'); ?></span>
				<?php } ?>
				</div>
				<div class="team_away">
					<?php if($params->get('show_logo', 1) && !empty($item->away_logo)) { ?>
						<img class="team_logo" src="<?php echo JURI::root(true).'/'.$item->away_logo ?>" alt="<?php echo htmlspecialchars($item->away_name) ?>" />
					<?php } ?>
					<span class="name">
						<?php echo htmlspecialchars($item->away_name); ?>
					</span>
				</div>
			</div>
			<?php if($params->get('show_date') || $params->get('show_venue')) { ?>
			<div class="time_venue">
				<?php if($show_date) { ?>
					<span class="time"><?php echo JHTML::date($item->date, 'l, j F Y H:i'); ?></span>
				<?php } ?>
				<?php if($show_date && $show_venue) { ?>
					<span class="sep">|</span>
				<?php } ?>
				<?php if($show_venue) { ?>
					<span class="venue">
						<span class="icon-location"></span><?php echo htmlspecialchars($item->venue); 
							echo (!empty($item->venue) && !empty($item->city) ? ',':''); ?>
							<?php echo htmlspecialchars($item->city); ?>
					</span>
				<?php } ?>
			</div>
			<?php } ?>
		</div>

<?php } ?>

<?php if($params->get('show_link', 1)) { ?>
<div class="schedule_link">
	<a href="<?php echo JRoute::_(DJLeagueHelperRoute::getScheduleRoute($params->get('tournament'), $params->get('season'), $params->get('team'))); ?>">
		<?php echo JText::_('COM_DJLEAGUE_SCHEDULE_SEE_ALL'); ?></a>
</div>
<?php } ?>

</div>