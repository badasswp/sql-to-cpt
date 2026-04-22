import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

import { handleImport, handleUpload } from '../utils';

/**
 * Import Button Component.
 *
 * This function returns a JSX component that is
 * used to display the Import Button.
 *
 * @since 1.2.0
 *
 * @return {JSX.Element} The Import Button component.
 */
const ImportButton = (): JSX.Element => {
	const { parsedSQL } = useSelect( ( select ) => {
		const store: any = select( 'sql-to-cpt' );

		return {
			parsedSQL: store.getParsedSQL(),
		};
	}, [] );

	return (
		<>
			{ ( parsedSQL?.tableRows?.length || 0 ) < 1 ? (
				<Button
					data-testid="upload"
					variant="primary"
					onClick={ handleUpload }
				>
					{ __( 'Upload SQL File', 'sql-to-cpt' ) }
				</Button>
			) : (
				<Button
					data-testid="convert"
					variant="primary"
					onClick={ handleImport }
				>
					{ __( 'Convert to CPT', 'sql-to-cpt' ) }
				</Button>
			) }
		</>
	);
};

export default ImportButton;
