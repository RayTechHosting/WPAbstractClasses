import '../css/repeater.css';
import jQuery from 'jquery';

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

jQuery( 'body' ).on( 'click', '.close button', function() {
	jQuery( this ).parent().parent()[0].remove();
} );