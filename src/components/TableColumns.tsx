import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';

import Disabled from './Disabled';

interface ParsedSQLProps {
	parsedSQL: {
		tableName: string;
		tableRows: any[];
		tableColumns: string[];
	};
}

/**
 * Table Columns Component.
 *
 * This function returns a JSX component that is
 * used to display Table Columns.
 *
 * @since 1.2.0
 *
 * @return {JSX.Element} The Table Columns component.
 */
const TableColumns = (): JSX.Element => {
	const { parsedSQL } = useSelect( ( select ) => {
		const store: any = select( 'sql-to-cpt' );

		return {
			parsedSQL: store.getParsedSQL(),
		};
	}, [] );

	return (
		<>
			{ parsedSQL.tableColumns.length > 0 && (
				<div className="sqlt-cpt-table-columns" role="list">
					<h3>{ __( 'Columns', 'sql-to-cpt' ) }</h3>
					{ parsedSQL.tableColumns.map(
						( name: string, index: number ) => {
							return <Disabled key={ index } name={ name } />;
						}
					) }
				</div>
			) }
		</>
	);
};

export default TableColumns;
