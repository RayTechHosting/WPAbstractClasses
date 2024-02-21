import jQuery from 'jquery';
//TODO: complete setup for multiple conditions on one page.
function check_for_conditions () {
	const condition_elements = jQuery('.condition')
	if( 0 < condition_elements.length ) {
		for( const [index, condition_element] of Object.entries(condition_elements.toArray())) {
			const conditions: JSON = JSON.parse(jQuery(condition_element).data('conditions').replaceAll(/\\/g, ''));
			for( const [condition, value] of Object.entries(conditions)) {
				const tag_id:string = '#' + condition;
				const tag = jQuery(tag_id).children('input')[0];
				for (let [key, attrValue] of Object.entries(value)) {
					check_value(key, tag, attrValue, jQuery(condition_element));
					/*jQuery(tag).on('change', () => {
						check_value(key, tag, attrValue, condition_element);
					})*/
					jQuery(tag).on('input', () => {
						check_value(key, tag, attrValue, jQuery(condition_element));
					})
				}
			}
		}
	}
}

function check_value(key: string, tag: HTMLInputElement, value: string | boolean | unknown, element: JQuery<HTMLElement>) {
	if ( 'value' === key ) {
		if ( value !== jQuery(tag).val() ) {
			element.hide();
		} else {
			element.show();
		}
	} else if ( 'checked' === key ) {
		if ( true !== tag.checked ) {
			element.hide();
		} else {
			element.show();
		}
	} else {
		if( value !== jQuery(tag).attr(key)) {
			element.hide();
		}
		else {
			element.show();
		}
	}
}

jQuery(function() {
	check_for_conditions();
});
