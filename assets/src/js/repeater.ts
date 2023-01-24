
/**
 * Copyright (C) 2020 RayTech Hosting <royk@myraytech.net>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 * @category   Library
 * @package    WordPress
 * @subpackage WPAbstractClasses
 * @author     Kevin Roy <royk@myraytech.net>
 * @license    GPL-v2 <https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html>
 * @version    0.7.0
 * @since      0.7.0
 */

import '../css/repeater.css';
import jQuery from 'jquery';

/**
 * Add a set of fields on click,
 */
jQuery('body').on('click', '#repeater_add', function(e) {
	e.preventDefault();
	const meta = jQuery( this ).data('meta_key');
	let html = jQuery('#rtabstract_repeater_' + meta).clone()
	const inputGroups = jQuery(html).children('div').children('p');
	jQuery(inputGroups).each((index, p) => {
		const input = jQuery(p).children('input')[0];
		const input_key = jQuery(input).data('input-key');
		const name = jQuery(input).attr('id');
		let loop: number = 0;
		let id: RegExpMatchArray | null;
		if( 'undefined' !== typeof name ) {
			id = name!.match(/[a-zA-Z\-\_]*/g);
			loop = getLastId(id![0] as String) + 1;
		} else {
			loop = 0;
		}
		jQuery( input ).attr( 'id', id![0].replace(/-blank/, '') + '-' + input_key + '-' + loop );
		jQuery( input ).attr( 'name', id![0].replace(/-blank/, '') + '[' + loop + '][' + input_key + ']' );
	});
	jQuery(this).parent().children('.grid').append(html.html());
	
});

/**
 * Grabs the highest id of all the repeated fields.
 * 
 * @param {String} name input name to look for.
 * @returns {number}
 */
function getLastId(name: String): number {
	const prefix: String = name.replace(/-blank/, '');
	const inputs = jQuery('[id^="' + prefix + '"]');
	let loop_ids: number[] = [];
	inputs.each((index, input) => {
		if( ! jQuery(input).attr('id')!.match(/\-blank/g)) {
			const loop = jQuery(inputs[index]).attr('id')!.match(/[\d*]/g);
			const loop_id: number = parseInt(loop![0]);
			loop_ids.push(loop_id);
		}
	});
	return Math.max(...loop_ids);
}

/**
 * Removes a set of repeated fields.
 */
jQuery( 'body' ).on( 'click', '.close button', function() {
	jQuery( this ).parent().parent()[0].remove();
} );