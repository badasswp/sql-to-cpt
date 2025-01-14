import { __ } from '@wordpress/i18n';

import Disabled from './Disabled';

/**
 * Table Name Component.
 *
 * This function returns a JSX component that is
 * used to display a Table Name.
 *
 * @since 1.2.0
 *
 * @returns {JSX.Element}
 */
const TableName = ({ parsedSQL }): JSX.Element => {
  return (
    <>
      {
        parsedSQL.tableName && (
          <div className="sqlt-cpt-table-name" role="list">
            <h3>{ __( 'Table', 'sql-to-cpt' ) }</h3>
            <Disabled
              name={ parsedSQL.tableName }
            />
          </div>
        )
      }
    </>
  );
}

export default TableName;
