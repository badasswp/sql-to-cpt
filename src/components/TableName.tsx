import { __ } from '@wordpress/i18n';

import Disabled from './Disabled';

interface ParsedSQLProps {
  parsedSQL: {
    tableName: string;
    tableRows: any[];
    tableColumns: string[];
  }
}

/**
 * Table Name Component.
 *
 * This function returns a JSX component that is
 * used to display a Table Name.
 *
 * @since 1.2.0
 *
 * @param {Object} props - The component props.
 * @param {ParsedSQLProps} props.parsedSQL - The parsed SQL object.
 *
 * @returns {JSX.Element}
 */
const TableName = ( { parsedSQL }: ParsedSQLProps ): JSX.Element => {
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
