import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';

import Disabled from './Disabled';

/**
 * Table Name Component.
 *
 * This function returns a JSX component that is
 * used to display a Table Name.
 *
 * @since 1.2.0
 *
 * @return {JSX.Element} The Table Name component.
 */
const TableName = (): JSX.Element => {
	const { parsedSQL } = useSelect( ( select ) => {
		const store: any = select( 'sql-to-cpt' );

		return {
			parsedSQL: store.getParsedSQL(),
		};
	}, [] );

	return (
		<>
			{ parsedSQL?.tableName && (
				<div className="sqlt-cpt-table-name" role="list">
					<h3>{ __( 'Table', 'sql-to-cpt' ) }</h3>
					<Disabled name={ parsedSQL?.tableName || '' } />
				</div>
			) }
		</>
	);
};

export default TableName;
