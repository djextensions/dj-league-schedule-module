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

$cday = '';
?>

<div class="mod_djl_schedule djl_theme_<?php echo $cparams->get('theme','bootstrap') ?>">

<table class="table table-hover">
	<tbody>
		<?php foreach($items as $item) {
			
			$show_date = ($params->get('show_date') && $item->date != '0000-00-00 00:00:00');
			$show_venue = ($params->get('show_venue') && (!empty($item->venue) || !empty($item->city)));
			
			if($params->get('show_date')) {
				if($show_date) {
					$day = JHTML::date($item->date, 'l, j F Y');
				} else {
					$day = $item->round ? JText::sprintf('COM_DJLEAGUE_N_ROUND', $item->round) : JText::_('COM_DJLEAGUE_UNKNOWN_GAME_DATE');
				}
			
				if($day != $cday) {
					$cday = $day; ?>
					<tr><td colspan="3" class="game_day"><?php echo $cday ?></td></tr>
				<?php }
			} ?>
			
			<tr>
				<td class="team_home">
					<?php if($params->get('show_logo', 1) && !empty($item->home_logo)) { ?>
						<img class="team_logo" src="<?php echo JURI::root(true).'/'.$item->home_logo ?>" alt="<?php echo htmlspecialchars($item->home_name) ?>" />
					<?php } ?>
					<span class="name">
						<?php echo htmlspecialchars($item->home_name); ?>
					</span>
				</td>
				<td class="vs_score nowrap">
					<?php if($item->status == 1) { ?>
						<span class="score"><?php echo $item->score_home .' : '.$item->score_away ?></span>
					<?php } else { ?>
						<span class="vs_sign"><?php echo JText::_('COM_DJLEAGUE_VS_SIGN'); ?></span>
					<?php } ?>
				</td>
				<td class="team_away">
					<?php if($params->get('show_logo', 1) && !empty($item->away_logo)) { ?>
						<img class="team_logo" src="<?php echo JURI::root(true).'/'.$item->away_logo ?>" alt="<?php echo htmlspecialchars($item->away_name) ?>" />
					<?php } ?>
					<span class="name">
						<?php echo htmlspecialchars($item->away_name); ?>
					</span>
				</td>
			</tr>
			<?php 
			
			if($show_date || $show_venue) { ?>
			<tr>
				<td class="time_venue" colspan="3">
				<?php if($show_date) { ?>
					<span class="time"><span class="icon-clock"></span><?php echo JHTML::date($item->date, 'H:i'); ?></span>
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
				</td>
			</tr>
			<?php } ?>
		<?php } ?>
	</tbody>
	<?php if($params->get('show_link', 1)) { ?>
	<tfoot>
		<tr>
			<td class="schedule_link" colspan="5">
				<a href="<?php echo JRoute::_(DJLeagueHelperRoute::getScheduleRoute($params->get('tournament'), $params->get('season'), $params->get('team'))); ?>">
					<?php echo JText::_('COM_DJLEAGUE_SCHEDULE_SEE_ALL'); ?></a>
			</td>
		</tr>
	</tfoot>
	<?php } ?>
</table>

</div>