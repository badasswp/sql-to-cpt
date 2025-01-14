import { __ } from '@wordpress/i18n';

import Disabled from './Disabled';

/**
 * Table Columns Component.
 *
 * This function returns a JSX component that is
 * used to display Table Columns.
 *
 * @since 1.2.0
 *
 * @returns {JSX.Element}
 */
const TableColumns = ({ parsedSQL }): JSX.Element => {
  return (
    <>
      {
        parsedSQL.tableColumns.length > 0 && (
          <div className="sqlt-cpt-table-columns" role="list">
            <h3>{ __( 'Columns', 'sql-to-cpt' ) }</h3>
            {
              parsedSQL.tableColumns.map( ( name: string, index: number ) => {
                return (
                  <Disabled key={ index } name={ name } />
                )
              })
            }
          </div>
        )
      }
    </>
  );
}

export default TableColumns;
