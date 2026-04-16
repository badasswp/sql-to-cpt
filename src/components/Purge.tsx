import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { useDispatch } from '@wordpress/data';
import apiFetch from '@wordpress/api-fetch';

import { handlePurge } from '../../src/utils';

/**
 * Purge Component.
 *
 * This function returns a JSX component that is
 * used to purge the CPT and its contents.
 *
 * @since 1.3.0
 *
 * @return {JSX.Element} The Purge component.
 */
const Purge = (): JSX.Element => {
	const [ postType, setPostType ] = useState( '' );

	return (
		<div className="sqlt-purge">
			<select
				onChange={ ( e ) => {
					setPostType( e.target.value );
				} }
			>
				<option>Select CPT</option>
				{ sqlt.postTypes.map( ( item: string, index: number ) => {
					return <option key={ index }>{ item }</option>;
				} ) }
			</select>
			<Button
				variant="tertiary"
				onClick={ () => handlePurge( postType ) }
			>
				{ __( 'Purge CPT', 'sql-to-cpt' ) }
			</Button>
		</div>
	);
};

export default Purge;
