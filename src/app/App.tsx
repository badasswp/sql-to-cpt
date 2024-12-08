import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';
import { Button } from '@wordpress/components';
import { useState } from '@wordpress/element';
import type { MediaFrame } from '@wordpress/media-utils';

import Notice from '../components/Notice';
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
  const [sqlNotice, setSqlNotice] = useState<string>('');
  const [parsedSQL, setParsedSQL] = useState<SQLProps>(
    {
      tableName: '',
      tableColumns: [],
      tableRows: [],
    }
  );

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
   * @param {MediaFrame} wpMediaModal WP Media Modal.
   * @returns Promise<void>
   */
  const handleSelect = async (wpMediaModal: MediaFrame): Promise<void> => {
    const args = wpMediaModal.state().get('selection').first().toJSON();

    // Reset.
    setSqlNotice( '' );
    setParsedSQL(
      {
        tableName: '',
        tableColumns: [],
        tableRows: [],
      }
    );

    // Parse SQL.
    try {
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
    } catch ( { message } ) {
      setSqlNotice( message );
    }
  };

  const handleImport = async() => {
    try {
      const url = await apiFetch(
        {
          path: '/sql-to-cpt/v1/import',
          method: 'POST',
          data: {
            ...parsedSQL
          },
        }
      );

      if (url) {
        window.location.href = `${url}`
      }
    } catch ( { message } ) {
      setSqlNotice( message );
    }
  }

  return (
    <main>
      {parsedSQL.tableRows.length < 1 ? (
        <Button
          variant="primary"
          onClick={handleModal}
        >
          {__('Import SQL File', 'sql-to-cpt')}
        </Button>
      ) : (
        <Button
          variant="primary"
          onClick={handleImport}
        >
          {__('Convert to CPT', 'sql-to-cpt')}
        </Button>
      )}
      <div>
        {
          sqlNotice && (
            <Notice message={sqlNotice} />
          )
        }
      </div>
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
