import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

import Disabled from '../components/Disabled';

import { getModalParams } from '../utils';
import '../styles/app.scss';

interface SQLProps {
  tableName: string;
  tableColumns: string[];
  tableRows: any[];
}

/**
 * App Component.
 *
 * This function returns a JSX component that comprises
 * the Import Button and Fields.
 *
 * @since 1.0.0
 *
 * @returns {JSX.Element}
 */
const App = () => {
  const [parsedSQL, setParsedSQL] = useState<SQLProps>({
    tableName: '',
    tableColumns: [],
    tableRows: [],
  });

  /**
   * Handle Upload.
   *
   * This function is responsible for opening the
   * WP media modal to enable user select.
   *
   * @since 1.0.0
   *
   * @returns {void}
   */
  const handleModal = () => {
    const wpMediaModal = wp.media( getModalParams() );
    wpMediaModal.on( 'select', () => handleSelect(wpMediaModal) ).open();
  };

  /**
   * Handle Selection.
   *
   * This function is responsible for handling a
   * selection made by the user.
   *
   * @since 1.0.0
   *
   * @param {Object} wpMediaModal WP Media Modal.
   * @returns {void}
   */
  const handleSelect = async (wpMediaModal) => {
    const args = wpMediaModal.state().get('selection').first().toJSON();

    setParsedSQL(
      await apiFetch(
        {
          path: '/sql-to-cpt/v1/parse',
          method: 'POST',
          data: {
            ...args
          },
        }
      )
    );

    console.log(parsedSQL.tableRows);
  };

  return (
    <main>
      <Button
        variant="primary"
        onClick={handleModal}
      >
        { __('Import SQL File', 'sql-to-cpt') }
      </Button>
      <div>
        {
          parsedSQL.tableName && (
            <>
              <h3>{ __('Table', 'sql-to-cpt') }</h3>
              <Disabled name={parsedSQL.tableName} />
            </>
          )
        }
      </div>
      <div>
        {
          parsedSQL.tableColumns.length > 0 && (
            <>
              <h3>{ __('Columns', 'sql-to-cpt') }</h3>
              {
                parsedSQL.tableColumns.map((name) => {
                  return (
                    <Disabled name={name} />
                  )
                })
              }
            </>
          )
        }
      </div>
    </main>
  )
}

export default App;
