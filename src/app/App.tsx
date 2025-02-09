import apiFetch from '@wordpress/api-fetch';
import { useState } from '@wordpress/element';
import type { MediaFrame } from '@wordpress/media-utils';

import Notice from '../components/Notice';
import ProgressBar from '../components/ProgressBar';
import ImportButton from '../components/ImportButton';
import TableName from '../components/TableName';
import TableColumns from '../components/TableColumns';
import Purge from '../components/Purge';

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
const App = (): JSX.Element => {
  const [ isLoading, setIsLoading ] = useState<boolean>( false );
  const [ sqlNotice, setSqlNotice ] = useState<string>( '' );
  const [ parsedSQL, setParsedSQL ] = useState<SQLProps>(
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
  const handleUpload = (): void => {
    const wpMediaModal = wp.media( getModalParams() );
    wpMediaModal.on( 'select', () => handleSelect( wpMediaModal ) ).open();
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
    const args = wpMediaModal.state().get( 'selection' ).first().toJSON();

    // Reset.
    setSqlNotice( '' );
    setParsedSQL(
      {
        tableName: '',
        tableColumns: [],
        tableRows: [],
      }
    );
    setIsLoading( true );

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
      setIsLoading( false );
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  };

  /**
   * Handle Import.
   *
   * This function is responsible for handling the
   * import made by the user.
   *
   * @since 1.1.0
   *
   * @returns Promise<void>
   */
  const handleImport = async (): Promise<void> => {
    setIsLoading( true );

    // Import SQL.
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
      if ( url ) {
        window.location.href = `${url}`
      }
      setIsLoading( false );
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  }

  return (
    <main>
      <section>
        <ImportButton
          parsedSQL={ parsedSQL }
          handleImport={ handleImport }
          handleUpload={ handleUpload }
        />
        <Purge
          setIsLoading={ setIsLoading }
          setSqlNotice={ setSqlNotice }
        />
      </section>
      <Notice message={ sqlNotice } />
      <ProgressBar
        isLoading={ isLoading }
      />
      <TableName
        parsedSQL={ parsedSQL }
      />
      <TableColumns
        parsedSQL={ parsedSQL }
      />
    </main>
  )
}

export default App;
